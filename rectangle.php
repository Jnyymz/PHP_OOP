<?php
class Rectangle {
    private float $width;
    private float $height;

    public function __construct(float $width = 1, float $height = 1) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea(): float {
        return $this->width * $this->height;
    }

    public function getPerimeter(): float {
        return 2 * ($this->width + $this->height);
    }
}

$defaultRectangle = new Rectangle();
echo "Default Rectangle (1 x 1)\n";
echo "Area: " . $defaultRectangle->getArea() . "\n";
echo "Perimeter: " . $defaultRectangle->getPerimeter() . "\n\n";
