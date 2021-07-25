<?php

namespace History;

/**
 * A vector
 */
class Vect
{
    /**
     * @var float $x X coord.
     * @var float $y Y coord.
     * @var float $z Z coord.
     */
    var float $x;
    var float $y;
    var float $z;

    /**
     * Constructor.
     * 
     * @param mixed $x
     *   Vector or x coordinate.
     * @param float $y
     *   Y coordinate.
     * @param float $z
     *   Z coordinate.
     */
    function __construct($x = 0, float $y = 0, float $z = 0) {
        if ( $x instanceof Vect ) {
            $this->x = $x->x;
            $this->y = $x->y;
            $this->z = $x->z;
        } else {
            $this->x = $x;
            $this->y = $y;
            $this->z = $z;
        }
    }
    
    /**
     * Adds another vect to this.
     * 
     * @param Vect $v
     *   The other vector.
     */
    public function addVect(Vect &$v):void {
        $this->x += $v->x;
        $this->y += $v->y;
        $this->z += $v->z;
    }

    /**
     * Adds to this.
     * 
     * @param float $x
     *   The X coordinate.
     * @param float $y
     *   The Y coordinate.
     * @param float $z
     *   The Z coordinate.
     */
    public function add(float $x, float $y, float $z):void {
        $this->x += $x;
        $this->y += $y;
        $this->z += $z;
    }

    /**
     * Sets the values.
     * 
     * @param mixed $xOrV
     *   Vector or x coordinate.
     * @param float $y
     *   Y coordinate.
     * @param float $z
     *   Z coordinate.
     */
    public function set($xOrV = 0, float $y = 0, float $z = 0) {
        if ( $xOrV instanceof Vect ) {
            $this->x = $xOrV->x;
            $this->y = $xOrV->y;
            $this->z = $xOrV->z;
        } else {
            $this->x = $xOrV;
            $this->y = $y;
            $this->z = $z;
        }
    }
}