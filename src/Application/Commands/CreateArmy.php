<?php
namespace DeckOfCards\Application\Commands;

use DeckOfCards\Domain\ArmyId;


class CreateArmy
{

    /**
     * var string
     */
    private $id;
    
    /**
     * @param string $id
     */
    public function __construct($id)
    {
       $this->id = $id;
    }
    
    /**
     * return  DeckId
     */
    public function getId()
    {
        return ArmyId::fromString($this->id);
    }
}