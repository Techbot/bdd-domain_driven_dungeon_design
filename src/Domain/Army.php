<?php 
namespace DeckOfCards\Domain;

final class Army
{
    /**
     * @var ArmyId
     */
    private $id;

    /**
     * @var Character[]
     */
    private $characters;

    /**
     * @param ArmyId $id
     * @param Character[] $characters
     */
    public function __construct(ArmyId $id, $characters)
    {
        $this->id = $id;

        $this->characters = $characters;
    }

    /**
     * @param ArmyId $armyId
     * @return Army
     */
    public static function standard(ArmyId $armyId)
    {
        return new Army(
            $armyId,
            [
                Character::fromString('Human,10,10'),
                Character::fromString('Dwarf,20,20'),
                Character::fromString('Elf,10,20'),
                Character::fromString('Halfling,10,20'),

            ]
        );
    }

    /**
     * @return ArmyId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Character[]
     */
    public function getCharacters()
    {
        return $this->characters;
    }

    /**
     * @return Character
     */
    public function drawCharacter()
    {
        return array_shift($this->characters);
    }

    public function shuffle()
    {
        shuffle($this->characters);
    }
}
