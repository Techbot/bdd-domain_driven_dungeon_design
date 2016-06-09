<?php 
namespace DeckOfCards\Domain;

interface ArmyRepository
{
    /**
     * @param ArmyId $armyId
     * @return Army
     */
    public function findById(ArmyId $armyId);

    /**
     * @param Army $army
     */
    public function add(Army $army);
}
