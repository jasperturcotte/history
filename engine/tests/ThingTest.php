<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use History\Thing;

/**
 * Tests the Thing class.
 */
final class ThingTest extends TestCase
{

    /**
     * Basic Thing construction.
     * 
     * @covers History\Thing::__construct()
     * @covers History\Thing::resetCounter()
     */
    public function testConstruct(): void
    {
        $thing = new Thing();
        $this->assertEquals(1, $thing->id);

        $thing = new Thing();
        $this->assertEquals(2, $thing->id);

        $thing = new Thing(['id' => 10]);
        $this->assertEquals(10, $thing->id);  
        
        Thing::resetCounter();
        $thing = new Thing();
        $this->assertEquals(1, $thing->id);
    }

    /**
     * Tests basic parent/child functions.
     * 
     * @covers History\Thing::addChild()
     * @covers History\Thing::addParent()
     * @covers History\Thing::clearParent()
     * @covers History\Thing::removeChild()
     * @covers History\Thing::recalculateChildren()
     */
    public function testParentChild(): void
    {
        Thing::resetCounter();
        $parent = new Thing();
        $child = new Thing();

        // Establish IDs
        $this->assertEquals(1, $parent->id);
        $this->assertEquals(2, $child->id);

        // Does array search work?
        $testArray = [NULL, $child];
        $this->assertEquals(1, array_search($child, $testArray));

        //Test Adding/removing children
        $this->assertEquals(0, $parent->numChildren);
        $parent->addChild($child);
        $this->assertEquals(1, $parent->numChildren);

        // No duplicates
        $parent->addChild($child);
        $this->assertEquals(1, $parent->numChildren);

        // Child parent relationship?
        $this->assertEquals(1, $child->parent->id);

        // Remove child
        $returnedChild = $parent->removeChild($child);
        $this->assertEquals(2, $returnedChild->id);
        $this->assertEquals(NULL, $returnedChild->parent);
        $this->assertEquals(0, $parent->numChildren);

        // Switch parents
        $parent1 = new Thing();
        $parent2 = new Thing();
        $child2 = new Thing();
        $parent1->addChild($child2);
        $this->assertEquals(1, $parent1->numChildren);
        $this->assertEquals(0, $parent2->numChildren);
        $this->assertEquals($parent1->id, $child2->parent->id);

        $parent2->addChild($child2);
        $this->assertEquals(0, $parent1->numChildren);
        $this->assertEquals(1, $parent2->numChildren);
        $this->assertEquals($parent2->id, $child2->parent->id);
     
        // Add child, but clear from parent
        $parent->addChild($child);
        $this->assertEquals($parent->id, $child->parent->id);
        $this->assertEquals($child->id, $parent->children[0]->id);
        $this->assertEquals(1, $parent->numChildren);
        $returnedParent = $child->clearParent();
        $this->assertEquals(1, $returnedParent->id);
        $this->assertEquals(0, $parent->numChildren);       
    }
}
