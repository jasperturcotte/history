<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use History\PhysicalThing;

/**
 * Tests the PhysicalThing class.
 */
final class PhysicalThingTest extends TestCase
{

    /**
     * Tests position.
     * 
     * @covers History\PhysicalThing::position()
     * @covers History\PhysicalThing::setPosition()
     */
    public function testPosition(): void
    {
        // Baseline
        $thing = new PhysicalThing();
        $pos = $thing->position();
        $this->assertEquals(0, $pos->x);
        $this->assertEquals(0, $pos->y);
        $this->assertEquals(0, $pos->z);

        $thing->setPosition(1,2,3);
        $pos = $thing->position();
        $this->assertEquals(1, $pos->x);
        $this->assertEquals(2, $pos->y);
        $this->assertEquals(3, $pos->z);
       
        // Parent/child relationship
        $parent = new PhysicalThing();
        $parent->setPosition(1,2,3);
        $parent->addChild($thing);
        $pos = $thing->position();
        $this->assertEquals(2, $pos->x);
        $this->assertEquals(4, $pos->y);
        $this->assertEquals(6, $pos->z);

    }
}
