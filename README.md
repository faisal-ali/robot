# robot


ASSUMPTIONS/CONSTRAINTS OF PROGRAM:

1) This is a command line progam, so a terminal will be required to execute the program.
2) Commands will always be exected from commands.txt file.
3) File should have commands in upper case only and in the correct format.
4) Nothing will be displayed in case of wrong command except for wrong PLACE command arguments.
5) Code will exit excecution if commands file is not found.

INSTALLATION INSTRUCTIONS:

1) The application is build on PHP version 5.5.38. Please install it if not already installed on system.
2) Install phpunit from link below for testing purposes. 

https://phpunit.de/getting-started/phpunit-4.html

Note: Download this version of phpunit to avoid signature related errors https://phar.phpunit.de/phpunit-4.6.9.phar

LIST OF VALID COMMANDS:

1) PLACE X-Coordinate, Y-Coordinate, Face. eg PLACE 1,1, SOUTH
2) MOVE
3) LEFT
4) RIGHT
5) REPORT

CODE EXECUTION:

1) After downloading project go to "robot" folder.
2) Make sure there is a "commands.txt" file in the project otherwise a file not found exception will be thrown. If not then create one and add any number of valid commands (from Commands section below), each on new line in upper case WIHTOUT "," at the end.
3) From within the "robot" folder,write:
  
  php index.php

4) Above command will display output IF the commands in commands.txt file have:
  a) a valid PLACE command and
  b) a REPORT command after any number of commands after PLACE command.

TESTING:

1) From robot folder, run:

  phpunit --bootstrap autoload.php RobotTest

Where phpunit should be downloaded and placed in right place from installation steps above.