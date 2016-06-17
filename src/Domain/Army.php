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
                Character::fromString("Human, " . self::random_score() . " , " . self::random_score() ),
                Character::fromString("Dwarf, " . self::random_score() . " , " . self::random_score() ),
                Character::fromString("Elf, " .   self::random_score() . " , " . self::random_score() ),
                Character::fromString("Halfling, " . self::random_score() . " , " . self::random_score()),
            ]
        );
    }

    public static function random_score() {
        STATIC $count = 0;
        STATIC $total_stats_used = 0;
        $number = rand(6,12);
        If ($count ==3){
            $number = 40 - $total_stats_used;
        }
        If ($count ==7){
            $number = 80 - $total_stats_used;
        }
        $total_stats_used += $number;
        If ($count ==7){
            echo 'total ' . $total_stats_used . ' ';
        }
        $count++;
        return $number;
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
