Feature: Opponent Army creation
  in order to play a round
  As an opponent
  The Machine needs to select an army

  Rules :
  - Army is created based on p[layer selection of easy medium and hard
  - The total amount of attributes to be divided up amongst the opposing four warriors attack and strength stats is 79 for easy
  - The total amount of attributes to be divided up amongst the opposing four warriors attack and strength stats is 80 for normal
  - The total amount of attributes to be divided up amongst the opposing four warriors attack and strength stats is 81 for difficult

  Scenario: Player selects difficulty of opposing army
    Given a new round
    When I chose easy
    Then Opponent should have a new army


