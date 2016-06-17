# domain_driven_dungeon_design
**DDDD: **A simple multiplayer RPG using domain driven design in Php

Some basic stuff for a simple server based stats game using DDD,TDD and BDD.

Most likely event driven using eventstore.

Uses docker to access Mysql for Fos_User

A player cycles through a selection of armies until one is chosen.
This army consists of 4 characters.

Each character has two stats strength and health.

The total stats of all four characters will equal 80 at the beginning of a game, these are divided semi randomly across the four players.
The player may now enter the Dungeon arena against another army of four. Being of either Easy, Normal or Hard difficulty.
An easy team will have a total stats of 79 points, a normal will have 80 stats points and a Hard will have 81 stat points, divided amongst the opposing team.
The player may now line her characters against the opposing team in a manner she thinks most likely to result in the most damage to the opposing team while incurring least dame to her team.
Once the game begins one sits back and watches each round unfold.
If last man standing is player. Team is rejuvenated with one extra stat point to be allocated at random to one of the characters stats.

Players can login.
High Scores on Front Page


