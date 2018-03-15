<?php

include_once('constants.php');
include_once('robot.php');
include_once('tableTop.php');
include_once('face.php');

function init() {
    $tableTop = new TableTop(5,5);
    
    if($tableTop->getWidth() == null ||$tableTop->getHeight() == null) {
        echo "Error: Wrong argumnets for table creation\n";
    }

    $robot = new Robot($tableTop);
    $commands = [];

    $command_file = fopen("commands.txt", "r") or die("Unable to open file!");
    $commands = explode("\n", fread($command_file,filesize("commands.txt")));
    fclose($command_file);

    $i = 0;
        
    while($i < count($commands)){
        $args = explode(' ', $commands[$i]);
        
        if(count($args) == 0) continue;
        
        try {
        
            switch($args[0]) {
                
                case COMMAND_PLACE:
                    
                    if(count($args) == 1) {
                        echo "Invalid PLACE command: " . $commands[$i] . "\n";
                        continue;
                    }
                    
                    $place_args = explode(",", $args[1]);
                    if(count($place_args) < 3) {
                        echo "Invalid PLACE command: " . $commands[$i] . "\n";
                        continue;
                    }
                    
                    $robot->place($place_args[0], $place_args[1], $place_args[2]);
                        
                    break;
                    
                case COMMAND_MOVE:
                    $robot->move();
                    break;
                    
                case COMMAND_REPORT:
                    echo $robot->report() . "\n";
                    break;
                    
                case COMMAND_DIRECTION_LEFT:
                case COMMAND_DIRECTION_RIGHT:
                    $robot->changeFace($args[0]);
                    break;
            }
        }
        catch(Exception $e) {
                
            echo $e->getMessage();
        }
        
        $i++;
        
    }
}

init();
