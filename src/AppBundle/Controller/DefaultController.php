<?php
namespace AppBundle\Controller;

use DeckOfCards\Application\Commands\CreateArmyHandler;
use DeckOfCards\Domain\ArmyId;
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

class DefaultController extends Controller
{
    private $commandbus;
    private $armies;

    public function __construct(  )
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
        $armyId = ArmyId::generate();
        $command = new CreateArmy($armyId);
        $this->commandbus->handle($command);
        return $this->armies->findById($armyId);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'army'=>$this->doSomething()->getCharacters()
        ]);
    }
}
