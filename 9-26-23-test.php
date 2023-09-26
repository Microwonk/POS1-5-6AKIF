<?php

namespace test;
define('HALLO', 'Hallo');
const HI = 'Hi';

int: $i = match(HI) {
    'Hi' => 1,
    default => 2,
};

$irgendwas = array_map(

    function($n) {
        return $n*2;
    },
    [1,2,3,4,5,6]
);

$irgendwas = array_map(
    fn($n) => $n*2,
    [1,2,3,4,5,6]
);

// wie ein Interface
trait HelloTrait {
    public abstract function say_hello();
}

abstract class MyInheritedClass {
    public string $c;

    public function __construct(string $c) {
        $this->c = $c;
    }

    public function getC() {
        return $this->c;
    }
}

class MyClass extends MyInheritedClass implements HelloTrait {
    const A = 'A';
    private int $a;
    private int $b;

    public function __construct(int $a, int $b) {
        parent::__construct('Hallo');
        $this->a = $a;
        $this->b = $b;
    }

    public function plus(): int {
        return $this->a + $this->b;
    }

    public function get_const() {
        return self::A;
    }

    public function sayHello() {
        echo "Hello!";
    }
}

$mc = new MyClass(1, 2);
echo $mc->plus(); // Output: 3
echo MyClass::A; // Output: A
echo $mc->get_const(); // Output: A
echo $mc->getC(); // Output: Hallo
$mc->sayHello(); // Output: Hello!

?>