<?php 

class Face {
    private $left_face;
    private $right_face;
    
    function __construct($left, $right) {
        $this->left_face= $left;
        $this->right_face = $right;
    }
    
    public function getLeftFace() {
        return $this->left_face;
    }
    
    public function getRightFace() {
        return $this->right_face;
    }
}