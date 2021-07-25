<?php

namespace History;

use History\Thing;
use History\Vect;

/**
 * A thing with physics.
 */
class PhysicalThing extends Thing
{
    /**
     * Physics.
     * @var Vect $position Position vector.
     * @var Vect $velocity Velocity vector.
     */
    var Vect $position;
    var Vect $velocity;

    /**
     * Constructor.
     */
    function __construct($opts = []) {
        parent::__construct($opts);

        $this->position = new Vect();
        $this->velocity = new Vect();
    }

    /**
     * Returns the coordinates globally.
     * 
     * @return object
     *   Global coordinates.
     */
    function position(): Vect
    {
        $coord = new Vect($this->position);
        $obj = &$this;
        while ($p = $obj->parent) {
            echo "\n p:{$p->id}\n";
            if ( $p instanceof PhysicalThing ) {
                $coord->addVect($p->position);
            }

            $p = $p->parent;
        }
        return $coord;
    }

    /**
     * Sets the position.
     * 
     * @param mixed $xOrV
     *   Either the x coordinate, or a Vect.
     * @param float $y
     *   Y coordinate
     * @param float $z
     *   Z coordinate
     * 
     * @return PhysicalThing
     *   Self.
     */
    function setPosition($xOrV, float $y = 0, float $z = 0):PhysicalThing {
        if ( $xOrV instanceof Vect ) {
            $this->position->set($xOrV);
        } else {
            $this->position->set($xOrV, $y, $z);
        }

        return $this;
    }
}
