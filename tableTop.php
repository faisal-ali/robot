<?php 

class TableTop {
    
    private $width;
    private $height;
    
    function __construct($width, $height) {
        
        $this->setWidth($width);
        $this->setHeight($height);
    }
    
    private function setWidth($width) {
        if(is_numeric($width)) {
            $this->width = $width;
        }
    }
    
    private function setHeight($height) {
        if(is_numeric($height)) {
            $this->height = $height;
        }
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function isInsideTableTop($xCoOrdinate, $yCoOrdinate) {
        
        return $xCoOrdinate >= 0 && $xCoOrdinate < $this->getWidth() 
            && $yCoOrdinate >= 0 && $yCoOrdinate < $this->getHeight();
    }
}