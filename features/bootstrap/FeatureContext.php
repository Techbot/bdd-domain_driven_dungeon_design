<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use DeckOfCards\Domain\Army;
use DeckOfCards\Domain\ArmyId;
/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    
    
    private $choice;

    private $army;

    private $myArmy;

    private $totalStats;

    private $opponentArmy;

    public function __construct()
    {
        
    }

    /**
     * @Given a new Game
     */
    public function aNewGame()
    {
       return new \DeckOfCards\Domain\Game();
    }

    /**
     * @When I chose :arg1
     */
    public function iChose($choice)
    {
       $this->choice = $choice;
    }

    /**
     * @Then I should have a new army
     */
    public function iShouldHaveANewArmy()
    {
        $this->myArmy = $this->army;

        return  $this->myArmy;
    }

    /**
     * @Then I should get a new army option
     */
    public function iShouldGetANewArmyOption()
    {
        $armyId = ArmyId::generate();

        $this->army = Army::standard($armyId);
      
        return $this->army;
    }

    /**
     * @When myArmy is accepted
     */
    public function myArmyIsAccepted()
    {
        $this->choice = 1;
    }

    /**
     * @Then the total attributes points should be :arg1
     */
    public function theTotalAttributesPointsShouldBe($arg1)
    {
        $armyId = ArmyId::generate();

        $this->myArmy = Army::standard($armyId);
        
        foreach ($this->myArmy->getCharacters() as $character){
            $this->totalStats += (int)$character->getStrength()->__toString() + (int)$character->getHealth()->__toString();
        }
        return $this->totalStats;
    }

    /**
     * @Then the total number of characters should be :arg1
     */
    public function theTotalNumberOfCharactersShouldBe($arg1)
    {
        $armyId = ArmyId::generate();
        $this->myArmy = Army::standard($armyId);
        return count($this->myArmy->getCharacters());
    }

    /**
     * @Given a new round
     */
    public function aNewRound()
    {
      return new \DeckOfCards\Domain\Round();
    }

    /**
     * @Then Opponent should have a new army
     */
    public function opponentShouldHaveANewArmy()
    {  
        $armyId = ArmyId::generate();
        $this->opponentArmy = Army::standard($armyId);
        return   $this->opponentArmy;

    }

}
