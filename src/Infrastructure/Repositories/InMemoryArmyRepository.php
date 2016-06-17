<?php 
namespace DeckOfCards\Infrastructure\Repositories;

use DeckOfCards\Domain\Army;
use DeckOfCards\Domain\ArmyId;
use DeckOfCards\Domain\ArmyRepository;

class InMemoryArmyRepository implements ArmyRepository
{
    /**
     * @var Army[]
     */
    private $items = [];
    /**
     * @param ArmyId $armyId
     * @return Army|null
     */
    public function findById(ArmyId $armyId)
    {
        $key = (string) $armyId;
        if (! array_key_exists($key, $this->items)) {
            return null;
        }
        return $this->items[$key];
    }
    /**
     * @param Army $army
     */
    public function add(Army $army)
    {
        $key = (string) $army->getId();
        $this->items[$key] = $army;
    }
}
