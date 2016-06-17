<?php
require_once __DIR__ . '/vendor/autoload.php';

use DeckOfCards\Domain\Character;
use DeckOfCards\Domain\Army;
use DeckOfCards\Domain\ArmyId;
use DeckOfCards\Application\Commands\CreateArmy;
use DeckOfCards\Application\Commands\CreateArmyHandler;

use League\Tactician\CommandBus;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;

$locator = new InMemoryLocator([]);
$handlerMiddleware = new CommandHandlerMiddleware(
    new ClassNameExtractor,
    $locator,
    new HandleInflector
);
$bus = new CommandBus([$handlerMiddleware]);

function print_card(Character $card)
{
    echo "[{$card->getRace()} :  {$card->getStrength()} : {$card->getHealth()}]";
}

function print_deck(Army $deck)
{
    echo "Army ID: {$deck->getId()}\n";
    echo "Characters: \n";
    foreach ($deck->getCharacters() as $character) {
        print_card($character);
    }
}

//$x = DeckId::generate();


$armies = new DeckOfCards\Infrastructure\Repositories\InMemoryArmyRepository;

$locator->addHandler(
    new CreateArmyHandler($armies),
    CreateArmy::class
);
$armyId = ArmyId::generate();
$bus->handle(
    new CreateArmy((string) $armyId)
);
print_deck(
    $armies->findById($armyId)
);
echo "\n";