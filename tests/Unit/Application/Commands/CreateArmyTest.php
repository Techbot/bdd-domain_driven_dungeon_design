<?php


use \AppBundle\Controller\DefaultController;
use \DeckOfCards\Domain\Army;
/**
 * Created by PhpStorm.
 * User: techbot
 * Date: 14/06/16
 * Time: 13:58
 */
class CreateArmyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function anArmyIsCreated()
    {
        $controller = new DefaultController();
        $thing = $controller->doSomething();
        $this->assertInstanceOf(Army::class, $thing);
    }
    
}
