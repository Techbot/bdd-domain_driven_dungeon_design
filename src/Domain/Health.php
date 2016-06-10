<?php 
namespace DeckOfCards\Domain;
final class Health
{
    /**
     * @var string
     */
    private $health;
    /**
     * @var string[]
     */
    private static $healths = [
        '10',
        '20',
        '30',
        '40'
    ];
    /**
     * @param string $health
     */
    private function __construct($health)
    {
        $this->health = $health;
    }
    /**
     * @param string $health
     * @return Health
     */
    public static function fromString($health)
    {
       // echo $health;
       
        $health = (string) $health;
     //   if (! in_array($health, array_keys(static::$healths))) {
     //       throw new IncorrectHealthValue;
    //    }
        return new Health($health);
    }
    /**
     * @return string
     */
    public function __toString()
    {
        return $this->health;
    }
}