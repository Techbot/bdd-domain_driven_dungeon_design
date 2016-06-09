<?php namespace DeckOfCards\Domain;



final class Race
{
    /**
     * @var string
     */
    private $race;
    /**
     * @var string[]
     */
    private static $races = [
        'human', 'dwarf', 'elf', 'halfling'
    ];
    /**
     * @param string $race
     */
    private function __construct($race)
    {
        $this->race = $race;
    }

    /**
     * @param $race
     * @return Race
     * @throws IncorrectRaceValue
     */
    public static function fromString($race)
    {
        $race = strtolower((string) $race);
        if (! in_array($race, static::$races)) {
            throw new IncorrectRaceValue();
        }
        return new Race($race);
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->race;
    }
}