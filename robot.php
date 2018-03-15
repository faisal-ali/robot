<?php

class Robot {
    
    private $currentXcoOrdinate;
    private $currentYcoOrdicate;
    private $placed;
    private $currentFace;
    private $tableTop;
    private $linkedFaces;
    
    function __construct(TableTop $tableTop) {
        
        $this->tableTop = $tableTop;
        $this->placed = false;
        $this->linkedFaces = [
            ROBOT_FACE_NORTH => new Face(ROBOT_FACE_WEST, ROBOT_FACE_EAST),
            ROBOT_FACE_SOUTH => new Face(ROBOT_FACE_EAST, ROBOT_FACE_WEST),
            ROBOT_FACE_WEST => new Face(ROBOT_FACE_SOUTH, ROBOT_FACE_NORTH),
            ROBOT_FACE_EAST => new Face(ROBOT_FACE_NORTH, ROBOT_FACE_SOUTH)
        ];
    }
    
    public function getTableTop() {
        return $this->tableTop;
    }
    
    public function isPlaced() {
        return $this->placed;
    }
    
    public function getCurrentXcoOrdinate() {
        return $this->currentXcoOrdinate;
    }
    
    public function getCurrentYcoOrdinate() {
        return $this->currentYcoOrdinate;
    }
    
    public function getCurrentFace() {
        return $this->currentFace;
    }
    
    public function getLinkedFaces() {
        return $this->linkedFaces;
    }
    
    public function setCurrentXcoOrdinate($xCoOrdinate) {
        
        if(is_numeric($xCoOrdinate) == false) {
            throw new Exception('X CoOrdinates must be Integer');
        }
        
        $this->currentXcoOrdinate = $xCoOrdinate;
    }
    
    public function setCurrentYcoOrdinate($yCoOrdinate) {
        
        if(is_numeric($yCoOrdinate) == false) {
            throw new Exception('Y CoOrdinate must be Integer');
        }
        
        $this->currentYcoOrdinate = $yCoOrdinate;
    }
    
    public function setCurrentFace($face) {
        if(in_array($face, array_keys($this->linkedFaces)) == false) {
            throw new Exception('Face shold be either:' . implode(", ", array_keys($this->getLinkedFaces)));
        }
        
        $this->currentFace = $face;
    }
    
    private function setPlaced($placed = true) {
        $this->placed = $placed;
    }
    
    
    public function place($xCoOrdinate, $yCoOrdinate, $face) {
        
        if($this->getTableTop()->isInsideTableTop($xCoOrdinate, $yCoOrdinate)) {
            
            $this->setCurrentXcoOrdinate($xCoOrdinate);
            $this->setCurrentYcoOrdinate($yCoOrdinate);
            $this->setCurrentFace($face);
            $this->setPlaced();
        }
        
    }
    
    public function move() {
        
        if($this->isPlaced()) {
            
            $new_y_coordinate = $this->getCurrentYcoOrdinate();
            $new_x_coordinate = $this->getCurrentXcoOrdinate();
            
            switch($this->getCurrentFace()) {
            
                case ROBOT_FACE_NORTH:
                    $new_y_coordinate += 1;
                    break;
                    
                case ROBOT_FACE_SOUTH:
                    $new_y_coordinate -= 1;
                    break;
                    
                case ROBOT_FACE_EAST:
                    $new_x_coordinate += 1;
                    break;
                    
                case ROBOT_FACE_WEST:
                    $new_x_coordinate -= 1;
                    break;
            }
            
            if($this->getTableTop()->isInsideTableTop($new_x_coordinate, $new_y_coordinate)) {
                $this->setCurrentXcoOrdinate($new_x_coordinate);
                $this->setCurrentYcoOrdinate($new_y_coordinate);
            }
            
        }
    }
    
    public function changeFace($direction) {
        
        if($this->isPlaced()) {
            
            $linked_face = $this->linkedFaces[$this->getCurrentFace()];
            switch($direction) {
                
                case COMMAND_DIRECTION_LEFT:
                    $this->setCurrentFace($linked_face->getLeftFace());
                    break;
                case COMMAND_DIRECTION_RIGHT:
                    $this->setCurrentFace($linked_face->getRightFace());
                    break;
            }
        }
    }
    
    public function report() {
        
        if($this->isPlaced()) {
            return 'Output: ' . $this->getCurrentXcoOrdinate() . 
            ', ' . $this->getCurrentYcoOrdinate() . 
            ', ' . $this->getCurrentFace();
        }
        else{
            return "\n";
        }
    }
}