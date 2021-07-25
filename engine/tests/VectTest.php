<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use History\Vect;

/**
 * Tests the Vect class.
 */
final class VectTest extends TestCase
{

    /**
     * Basic Vect construction.
     * 
     * @covers History\Vect::__construct()
     * @covers History\Vect::set()
     */
    public function testConstruct(): void
    {
       $v = new Vect();
       $this->assertEquals(0, $v->x);
       $this->assertEquals(0, $v->y);
       $this->assertEquals(0, $v->z);

       $v2 = new Vect(1,2,3);
       $this->assertEquals(1, $v2->x);
       $this->assertEquals(2, $v2->y);
       $this->assertEquals(3, $v2->z);     
       
       $v3 = new Vect($v2);
       $this->assertEquals(1, $v3->x);
       $this->assertEquals(2, $v3->y);
       $this->assertEquals(3, $v3->z);    
       
       $v->set(10,11,12);
       $this->assertEquals(10, $v->x);
       $this->assertEquals(11, $v->y);
       $this->assertEquals(12, $v->z);

       $v->set($v2);
       $this->assertEquals(1, $v->x);
       $this->assertEquals(2, $v->y);
       $this->assertEquals(3, $v->z);
    }

    /**
     * Tests Vect math.
     * 
     * @covers History\Vect::add()
     * @covers History\Vect::addVect()
     */
    public function testAdd(): void
    {
        $v1 = new Vect(1, 2, 3);
        $v2 = new Vect(-1, 5, -6);

        // Make sure v1 as updated but not v2
        $v1->addVect($v2);
        $this->assertEquals(0, $v1->x);
        $this->assertEquals(7, $v1->y);
        $this->assertEquals(-3, $v1->z);
        $this->assertEquals(-1, $v2->x);
        $this->assertEquals(5, $v2->y);
        $this->assertEquals(-6, $v2->z);

        $v1->add(1,1,1);
        $this->assertEquals(1, $v1->x);
        $this->assertEquals(8, $v1->y);
        $this->assertEquals(-2, $v1->z);

        $v1->add(-2,-1,-1);
        $this->assertEquals(-1, $v1->x);
        $this->assertEquals(7, $v1->y);
        $this->assertEquals(-3, $v1->z);     
    }

}
