<?php

require_once 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use History\RNG;

/**
 * Tests the RNG class.
 */
final class RNGTest extends TestCase
{

    /**
     * Basic RNG construction.
     * 
     * @covers History\RNG::init()
     * @covers History\RNG::rand()
     */
    public function testConstruct(): void
    {
        RNG::init(123);

        $firstValue = RNG::rand(1,10);
        $this->assertEquals(10, RNG::rand(1,10));    
        for($i = 0; $i < 10; $i++) {   
            $this->assertGreaterThan(0, RNG::rand(1,10));     
            $this->assertLessThan(11, RNG::rand(1,10));     
        }  

        RNG::init(123);
        $this->assertEquals($firstValue, RNG::rand(1,10));
    }
}
