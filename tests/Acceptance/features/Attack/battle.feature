Feature: Attack Battle
  in order to play game
  As a player
  I need to attack another random npc player

  Rules :
  - Both players begin with 100 health
  - Both players begin with 10 strength
  - Each round both players roll one dice and and it to the strentgh to make an attack
  - Player with lower attack  loses health points equal to difference in attack
  - First player whose health = 0 loses

  Scenario: Player attack is greater than npc attack
    Given I roll a dice of 6
    When I add the roll to my strength of 10
    And NPC has an attack of 15
    And NPC has health of 100
    Then NPC health should be reduced to 90

  Scenario: Player attack is less than npc attack
    Given I roll a dice of 4
    When I add the roll to my strength of 10
    And NPC has an attack of 15
    And my health is 100
    Then my health should be reduced to 90

  Scenario: Player attack is equal than npc attack
    Given I roll a dice of 6
    When I add the roll to my strength of 10
    And NPC has an attack of 16
    And NPC has health of 100
    Then NPC health should be 100
