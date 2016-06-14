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
class ArmyContext implements Context, SnippetAcceptingContext
{
    private $player;
    private $npc;
    private $dice;
    private $dice2;
    private $diff;

    public function __construct()
    {
        $this->dice = new Dice();
        $this->dice2 = new Dice();
        $this->npc = new Npc($this->dice2);
        $this->player = new Player($this->dice, $this->npc);
    }

    /**
     * @Given I roll a dice of :arg1
     */
    public function iRollADiceOf()
    {
      return  $this->dice->rollDice();
    }

    /**
     * @When I add the roll to my strength of :roll
     */
    public function iAddTheRollToMyStrengthOf($roll)
    {
        $this->player->addToStrength($roll);

    }

    /**
     * @When NPC has an attack of :NpcAttack
     */
    public function npcHasAnAttackOf($NpcAttack)
    {
        $this->player->setAttack($NpcAttack);
    }

    /**
     * @When NPC has health of :NpcHealth
     */
    public function machineHasHealthOf($NpcHealth)
    {
        $this->npc->setAttack($NpcHealth);
    }

    /**
     * @Then NPC health should be :newHealth
     */
    public function npcHealthShouldBe($newHealth)
    {
        Assert::assertEquals(
            intval($newHealth),
            $this->npc->getHealth()
        );
    }

    /**
     * @When my health is :myHealth
     */
    public function myHealthIs()
    {
        return $this->player->getHealth();
    }

    /**
     * @Then my health should be :newHealth
     */
    public function myHealthShouldBe($newHealth)
    {
        Assert::assertEquals(
            intval($newHealth),
            $this->player->getHealth()
        );
    }

    /**
     * @Then NPC health should be reduced to :newHealth
     */
    public function npcHealthShouldBeReducedTo()
    {
        $diff = $this->player->getAttack() - $this->npc->getAttack();
        $this->npc->setHealth($this->npc->getHealth() - $diff);
    }

    /**
     * @Then my health should be reduced to :arg1
     */
    public function myHealthShouldBeReducedTo($arg1)
    {
        $diff = $this->npc->getAttack() - $this->player->getAttack();
        $this->player->setHealth($this->player->getHealth() - $diff);
    }

}
