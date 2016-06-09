<?php
namespace DeckOfCards\Application\Commands;

use DeckOfCards\Domain\Army;
use DeckOfCards\Domain\ArmyRepository;
use DeckOfCards\Infrastructure\Repositories\InMemoryArmyRepository;

class CreateArmyHandler
{
    /**
     * @var ArmyRepository
     */
    private $armies;

    /**
     * @param InMemoryArmyRepository $armies
     */
    public function __construct (InMemoryArmyRepository $armies){

        $this->armies = $armies;
    }

   /**
    * @param CreateArmy $command
    */
    public function handle(CreateArmy $command)
    {
        $id =$command->getId();

        $army =Army::standard($id);

        $this->armies->add($army);
    }
}