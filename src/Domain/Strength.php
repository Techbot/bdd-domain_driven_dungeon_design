<?php namespace DeckOfCards\Domain;



final class Strength
{
    /**
     * @var string
     */
    private $strength;
    /**
     * @var string[]
     */
    private static $strengths = [
        '20', '30', '40', '50', '60', '70', '80', '90', '10'
    ];
    /**
     * @param string $strength
     */
    private function __construct($strength)
    {
        $this->strength = $strength;
    }

    /**
     * @param $strength
     * @return Strength
     * @throws IncorrectStrengthValue
     */
    public static function fromString($strength)
    {
        $strength = strtoupper((string) $strength);
        if (! in_array($strength, static::$strengths)) {
            throw new IncorrectStrengthValue();
        }
        return new Strength($strength);
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->strength;
    }
}