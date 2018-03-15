<?php

require_once('constants.php');

final class RobotTest extends PHPUnit_Framework_TestCase
{
    public $tableTop;
    public $robot;

    function __construct() {
        $this->tableTop = new TableTop(5,5);
        $this->robot = new Robot($this->tableTop);
    }

    public function testShouldNotCreateTableTopWithWrongArguments()
    {
        $tableTop = new TableTop('a',3);

        $this->assertEquals($tableTop->getWidth(), null);
        $this->assertNotEquals($tableTop->getHeight(), null);
    }

    public function testCanCreateTableTopFromValidArguments()
    {
        $this->assertEquals($this->tableTop->getWidth(), 5);
        $this->assertEquals($this->tableTop->getHeight(), 5);
    }

    public function testShouldCreateRobot()
    {
        $this->assertEquals(get_class($this->robot), Robot::class);
    }

    public function testShouldNotPlaceRobot()
    {
        $robot = new Robot($this->tableTop);
        $robot->place(-1,'a', ROBOT_FACE_SOUTH);

        $this->assertEquals($robot->isPlaced(), false);
        $this->assertEquals($robot->getCurrentXcoOrdinate(), null);
        $this->assertEquals($robot->getCurrentYcoOrdinate(), null);
        $this->assertEquals($robot->getCurrentFace(), null);
    }

    public function testShouldPlaceRobotCorrectly()
    {
        $this->robot->place('2',4, ROBOT_FACE_SOUTH);

        $this->assertEquals($this->robot->isPlaced(), true);
        $this->assertEquals($this->robot->getCurrentXcoOrdinate(), 2);
        $this->assertEquals($this->robot->getCurrentYcoOrdinate(), 4);
        $this->assertEquals($this->robot->getCurrentFace(), ROBOT_FACE_SOUTH);
    }

    public function testShouldMoveRobotCorrectly()
    {
        $this->robot->place(2,3, ROBOT_FACE_NORTH);
        $this->robot->move();

        $this->assertEquals($this->robot->getCurrentXcoOrdinate(), 2);
        $this->assertEquals($this->robot->getCurrentYcoOrdinate(), 4);
        $this->assertEquals($this->robot->getCurrentFace(), ROBOT_FACE_NORTH);
    }

    public function testShouldNotMoveRobotMoreThenTableHeight()
    {
        $this->robot->place(2,4, ROBOT_FACE_NORTH);
        $this->robot->move();

        $this->assertEquals($this->robot->getCurrentXcoOrdinate(), 2);
        $this->assertEquals($this->robot->getCurrentYcoOrdinate(), 4);
        $this->assertEquals($this->robot->getCurrentFace(), ROBOT_FACE_NORTH);
    }

    public function testShouldNotMoveRobotLessThenTableWidth()
    {
        $this->robot->place(0,4, ROBOT_FACE_WEST);
        $this->robot->move();

        $this->assertEquals($this->robot->getCurrentXcoOrdinate(), 0);
        $this->assertEquals($this->robot->getCurrentYcoOrdinate(), 4);
        $this->assertEquals($this->robot->getCurrentFace(), ROBOT_FACE_WEST);
    }

    public function testShouldReturnToOriginalPosition()
    {
        $this->robot->place(0,0, ROBOT_FACE_EAST);
        $this->robot->move();
        $this->robot->changeFace(COMMAND_DIRECTION_LEFT);
        $this->robot->move();
        $this->robot->changeFace(COMMAND_DIRECTION_LEFT);
        $this->robot->move();
        $this->robot->changeFace(COMMAND_DIRECTION_LEFT);
        $this->robot->move();
        $this->robot->changeFace(COMMAND_DIRECTION_LEFT);

        $this->assertEquals($this->robot->getCurrentXcoOrdinate(), 0);
        $this->assertEquals($this->robot->getCurrentYcoOrdinate(), 0);
        $this->assertEquals($this->robot->getCurrentFace(), ROBOT_FACE_EAST);
    }

    public function testShouldReportCorrectPosition()
    {
        $this->robot->place(0,0, ROBOT_FACE_EAST);
        $this->robot->move();
        $this->robot->move();
        $this->robot->changeFace(COMMAND_DIRECTION_LEFT);

        $this->assertEquals($this->robot->report(), 'Output: 2, 0, NORTH');
    }
}