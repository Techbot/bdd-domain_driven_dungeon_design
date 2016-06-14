<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
Use PHPUnit_Framework_Assert as Assert;
Use Battle\Dice;
Use Battle\Npc;
Use Battle\Player;

/**
 * Defines application features from the specific context.
 */
class AttackContext implements Context, SnippetAcceptingContext
{
    private $player;


    public function __construct()
    {

        $this->dice = new Dice();
        $this->dice2 = new Dice();
        $this->npc = new Npc();
        $this->player = new Player();
    }

    /**
     * @Given a new Game
     */
    public function aNewGame()
    {
       $this->game = new \Battle\Game();
    }






    /**
     * @Given NPC chose :arg1
     */
    public function npcChose()
    {
        return  $this->npc->choose();
    }

    /**
     * @When I chose :arg1
     */
    public function iChose()
    {
        return  $this->player->choose();
    }

    /**
     * @When NPC health is :arg1
     */
    public function npcHealthIs()
    {
        return  $this->npc->getHealth();
    }

    /**
     * @Then NPC health should be reduced to :health
     */
    public function npcHealthShouldBeReducedTo($health)
    {

        $this->npc->setHealth($this->npc->getHealth() - 10);

        Assert::assertEquals($health, $this->npc->getHealth());



    }

    /**
     * @When my health is :arg1
     */
    public function myHealthIs($arg1)
    {
        $this->player->getHealth($arg1);
    }

    /**
     * @Then my health should be reduced to :health
     */
    public function myHealthShouldBeReducedTo($health)
    {
        $this->player->setHealth($this->player->getHealth() -10 );
        Assert::assertEquals($health, $this->player->getHealth());
    }

    /**
     * @When NPC has health of :arg1
     */
    public function npcHasHealthOf($arg1)
    {
        $this->npc->getHealth($arg1);
    }

    /**
     * @Then NPC health should be :health
     */
    public function npcHealthShouldBe($health)
    {

        Assert::assertEquals($health, $this->npc->getHealth());



    }

    /**
     * @When I have health of :arg1
     */
    public function iHaveHealthOf($arg1)
    {
        $this->npc->getHealth($arg1);
    }

    /**
     * @Then my health should be :arg1
     */
    public function myHealthShouldBe($arg1)
    {
        $this->npc->getHealth($arg1);
    }

}