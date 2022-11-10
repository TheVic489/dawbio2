<?php

namespace shapes;

/**
 * Interface Shape
 * @author ProvenDev
 */
interface Shape {
    /**
     * calculates shape area.
     */
    public function area(): float;
    /**
     * calculates shape perimeter.
     */
    public function perimeter(): float;
}
