<?php
class QuadraticEquation {
    private float $a;
    private float $b;
    private float $c;

    public function __construct(float $a, float $b, float $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getA(): float {
        return $this->a;
    }

    public function getB(): float {
        return $this->b;
    }

    public function getC(): float {
        return $this->c;
    }

    public function getDiscriminant(): float {
        return ($this->b * $this->b) - (4 * $this->a * $this->c);
    }

    public function getRoot1(): ?float {
        $disc = $this->getDiscriminant();
        if ($disc < 0) {
            return null; 
        }
        return (-$this->b + sqrt($disc)) / (2 * $this->a);
    }

    public function getRoot2(): ?float {
        $disc = $this->getDiscriminant();
        if ($disc < 0) {
            return null;
        }
        return (-$this->b - sqrt($disc)) / (2 * $this->a);
    }
}

$a = (float) readline("Enter coefficient a: ");
$b = (float) readline("Enter coefficient b: ");
$c = (float) readline("Enter coefficient c: ");

$equation = new QuadraticEquation($a, $b, $c);

echo "Discriminant: " . $equation->getDiscriminant() . "\n";

$root1 = $equation->getRoot1();
$root2 = $equation->getRoot2();

if ($root1 === null || $root2 === null) {
    echo "The equation has no real roots.\n";
} elseif ($root1 == $root2) {
    echo "The equation has one root: $root1\n";
} else {
    echo "The equation has two roots: $root1 and $root2\n";
}
?>
