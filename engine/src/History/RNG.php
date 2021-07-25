<?php

namespace History;

/**
 * Seeded randon number generator.
 */
class RNG {


    /** 
     * Initializer
     * 
     * @param int $seed
     *   The seed to set, if any.
     */
    public static function init($seed = FALSE) {
        if ( $seed !== FALSE ) {
            mt_srand($seed);
        }
    }

    /**
     * Returns random int.
     * 
     * @param int $min
     *   Minimum value.
     * @param int $max
     *   Maxinum value.
     * 
     * @return int
     *   Random value.
     */
    public static function rand($min, $max) {
        return mt_rand($min, $max);
    }

}