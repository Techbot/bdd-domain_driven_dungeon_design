<?php

namespace AppBundle\Controller;

use DeckOfCards\Domain\ArmyId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use League\Tactician\CommandBus;
use DeckOfCards\Application\Commands\CreateArmy;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;



class DefaultController extends Controller
{

    private $commandbus;

    public function __construct(  )
    {
        $locator = new InMemoryLocator([]);
        $handlerMiddleware = new CommandHandlerMiddleware(
            new ClassNameExtractor,
            $locator,
            new HandleInflector
        );
        $this->commandbus = new CommandBus([$handlerMiddleware]);
       
    }

    public function doSomething()
    {
        $armyId = ArmyId::generate();
        $command = new CreateArmy($armyId);
        $this->commandbus->handle($command);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
