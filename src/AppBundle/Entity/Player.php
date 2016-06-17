<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use DeckOfCards\Domain\Army;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="player")
 */
class Player  
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;


    /**

     * @ORM\Column(type="string")
     * @var string
     */
    protected $armyId;

    /**

     * @ORM\Column(type="string")
     * @var string
     */
    protected $army;
     
    
    public function __construct()
    {
         // your own logic
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getArmyId()
    {
        return $this->armyId;
    }

    /**
     * @param string $armyId
     */
    public function setArmyId($armyId)
    {
        $this->armyId = $armyId;
    }

    public function getArmy(): string
    {
        return $this->army;
    }

    public function setArmy( Army $army)
    {
        $array =[];
        $chars = $army->getCharacters();

        foreach ($chars as $char){
            $race = $char->getRace();

            $health = $char->getHealth();
            $strength = $char->getStrength();
            $array[] =["$race", "$health", "$strength"];
        }
        $army = json_encode($array);
        $this->army = $army;
    }
}
