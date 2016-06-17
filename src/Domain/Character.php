<?php 
namespace DeckOfCards\Domain;

final class Character
{
    /**
     * @var Race
     */
    private $race;

    /**
     * @var Strength
     */
    private $strength;

    /**
     * @var Health
     */
    private $health;

    /**
     * @param Race $race 
     * @param Strength $strength
     * @param Health $health
     */
    public function __construct(Race $race, Strength $strength, Health $health)
    {
        $this->race = $race;

        $this->strength = $strength;

        $this->health = $health;
    }

    /**
     * @param string $character
     * @return Character
     */
    public static function fromString($character)
    {
        list($race, $strength, $health) = explode(',', $character);
  
        return new Character(

            Race::fromString($race),
            Strength::fromString($strength),
            Health::fromString($health)
        );
    }

    /**
     * @return Race
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @return Strength
     */
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return Health
     */
    public function getHealth()
    {
        return $this->health;
    }

    public function __toString()
    {
        return (string) $this->race . (string) $this->strength . (string) $this->health;
    }
}