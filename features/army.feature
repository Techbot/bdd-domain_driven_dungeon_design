Feature: Army creation
  in order to play game
  As a player
  I need to create an army of four warriors

  Rules :
  - Player is given a random army of four warriors
  - Player can reject army and rechoose random army
  - Each warrior has an attack and health statistic
  - The total amount of attributes to be divided up amongst the four warriors attack and strength stats is 80

  Scenario: Player gets new army option at beginning of game
    Given a new Game
    When I chose 1
    Then I should have a new army


  Scenario: Player gets new army at beginning of game
    Given a new Game
    When I chose 0
    Then I should get a new army option

  Scenario: Player accepts army
    Given a new Game
    When I chose 1
    And myArmy is accepted

    Then the total attributes points should be 80

  Scenario: Player accepts army
    Given a new Game
    When I chose 1
    And myArmy is accepted

    Then the total number of characters should be 4