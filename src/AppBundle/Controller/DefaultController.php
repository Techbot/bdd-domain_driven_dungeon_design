<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use DeckOfCards\Application\Commands\CreateArmyHandler;
use DeckOfCards\Domain\ArmyId;
use DeckOfCards\Domain\Round;
use GuzzleHttp\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use League\Tactician\CommandBus;
use DeckOfCards\Application\Commands\CreateArmy;
use DeckOfCards\Infrastructure\Repositories\InMemoryArmyRepository;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;

use EventStore\EventStore;
use EventStore\WritableEvent;
use EventStore\WritableEventCollection;

class DefaultController extends Controller
{
    private $commandbus;
    private $armies;
    private $armyId;
    private $user;
    private $opposingArmyId;
    private $opposingArmy;
    private $round;

    public function __construct()
    {
        $locator = new InMemoryLocator([]);
        $handlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor,
            $locator,
            new HandleInflector
        );
        $this->commandbus = new CommandBus([$handlerMiddleware]);
        $this->armies = new InMemoryArmyRepository;
        $locator->addHandler(
            new CreateArmyHandler($this->armies),
            CreateArmy::class
        );
    }

    public function doSomething()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $this->user = $this->getUser();

        $this->armyId = ArmyId::generate();
        $command = new CreateArmy($this->armyId);
        $this->commandbus->handle($command);

        $newArmy = $this->armies->findById($this->armyId);
        $newPlayer = $entityManager->find('AppBundle\Entity\Player', $this->user->getId()) ?
            $entityManager->find('AppBundle\Entity\Player', $this->user->getId()) : new Player ;

        $newPlayer->setArmy(($newArmy));
        $newPlayer->setArmyId(($this->armyId));

        $entityManager->persist($newPlayer);
        $entityManager->flush();

        return $newArmy;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->user = $this->getUser();
        if ($this->user != null) {
            // replace this example code with whatever you need
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
                'army' => $this->doSomething()->getCharacters(),
                'armyId' => $this->armyId
            ]);

        } else {
            return $this->render('default/home.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
            ]);
        }
    }

    /**
     * @Route("/accept", name="accept")
     */
    public function acceptAction(Request $request)
    {
        $this->user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $newPlayer = $entityManager->find('AppBundle\Entity\Player', $this->user->getId());

        if ($request->get('fname') == $newPlayer->getArmyId()) {
            $army = json_decode($newPlayer->getArmy());
            // replace this example code with whatever you need
            return $this->render('default/game.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
                'army' => $army,
                'armyId' => $newPlayer->getArmyId()
            ]);
        }
    }

    /**
     * @Route("/easy", name="easy")
     */
    public function easyAction(Request $request)
    {
        $this->user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $player = $entityManager->find('AppBundle\Entity\Player', $this->user->getId());
        $this->opposingArmyId = ArmyId::generate();
        $command = new CreateArmy($this->opposingArmyId);
        $this->commandbus->handle($command);
        $this->opposingArmy = $this->armies->findById($this->opposingArmyId);
        //this would be localhost
        $es = new EventStore('http://172.26.0.2:2113');
        $enemyArmies= [];
        foreach ($this->opposingArmy->getCharacters()as $char){
            $enemyArmy = new \stdClass();
            $enemyArmy->race = $char->getRace()->__toString();
            $enemyArmy->health = $char->getHealth()->__toString();
            $enemyArmy->strength = $char->getStrength()->__toString();
            $enemyArmies[] = $enemyArmy;
        }
        $events = new WritableEventCollection([
            WritableEvent::newInstance('init', 
                ['player' => $this->user->getId(),
                 'army' => json_decode($player->getArmy()), 
                 'opposingArmy' => $enemyArmies
                ]),
        ]);
        $es->writeToStream('DDDD', $events);

        // replace this example code with whatever you need
        return $this->render('default/round.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
            'army' => json_decode($player->getArmy()),
            'armyId' => $player->getArmyId(),
            'opposingArmy' => $this->opposingArmy->getCharacters()
        ]);
    }

    /**
     * @param Request $request
     * @Route("/round", name="homepage2")
     * @return Response
     * @throws \EventStore\Exception\WrongExpectedVersionException
     */

    public function writeToStore(Request $request)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://172.26.0.2:2113/projection/three/state?partition=player-1', [
            'auth' => ['admin', 'changeit']
        ]);
        //echo $res->getStatusCode();
        // 200
        //echo $res->getHeaderLine('content-type');
        // 'application/json; charset=utf-8'
        //echo $res->getBody();
        $this->round = new Round($res->getBody());
        $this->user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $player = $entityManager->find('AppBundle\Entity\Player', $this->user->getId());

        $army = json_decode($player->getArmy());
        $es = new EventStore('http://localhost:2113');
        $result = $this->compare();
        $events = new WritableEventCollection([
            WritableEvent::newInstance('round', [
                    'player' => $this->user->getId(),
                    'playerChoice' => $this->playerChoice,
                    'machineChoice' => $this->machineChoice, 'result'=>$result]),
        ]);
        $es->writeToStream('RockPaperScissors', $events);
        return new Response( json_encode([$this->machineChoice, $this->playerChoice, $this->user->getId()]));
    }

    /**
     * @Route("/fight", name="fight")
     */
    public function fightAction(Request $request)
    {
        $this->user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();
        $player = $entityManager->find('AppBundle\Entity\Player', $this->user->getId());
        $opposingArmy = $this->armies->findById($this->opposingArmyId);
        // replace this example code with whatever you need
        return $this->render('default/round.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..'),
            'army' => json_decode($player->getArmy()),
            'armyId' => $player->getArmyId(),
            'opposingArmy' => $opposingArmy->getCharacters()
        ]);
    }
}
