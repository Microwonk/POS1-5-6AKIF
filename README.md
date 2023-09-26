# POS1-5-6AKIF
Repository for 5-6AKIF WebDev.

# Mitschrift
9/19/2023 \
PHP setup mit Docker docker-compose.yml \
PHP basics gelernt, kann ich schon. \
$ var, gibt alle datentypen die man braucht, array und assoziatives array, foreach und for schleife, while.. usw...
Funktion is ganz easy:
```
function Foo(string $name = "user", int|float $age) : ?array {
    if (!empty($age)) {
        return array($name => $age);
    }
    return null;
}
```



statische Typ-Vergabe:
```
int: $num = 1;
```
sonst:
```
$str = 'asdasdadajajsa';
```

Operatoren generell, sind wie in Java, nur der concat op ist ein . statt + \
Spezielle ops sind: ?: (Ternärer), ?? (Null-Koaleszenz), ??= (Null-Koaleszenz assign operator), ** hochzahl, ...$numbers (spread op) [1, 2, 3, 4]..., & = reference (call by reference kann hier verwendet werden) ->  theoretisch ein pointer

## Wichtige Globals in PHP:
```
$_GET[] // for get requests (ein großes assoziatives Array)
$_POST[] // for post requests /´´/
$_SESSION[], $_COOKIES[] // cookies und session cookies, auch eine Map
```
## Error handling:
```
function a(int $b, int $c): string|null {
    if ($b === $c) throw new Error('b und c dürfen nicht gleich sein!');
    return $b . $c;
}
```
## Fortgeschrittene Beispiele:
```
int: $i = match($var) { // match expr.
    'Hi' => 1,
    default => 2,
}

// anonyme Funktionen
$irgendwas = array_map(
    function($n) {
        return $n*2;
    },
    [1,2,3,4,5,6]
);

// shorthand anonyme Funktion
$irgendwas = array_map(
    fn($n) => $n*2,
    [1,2,3,4,5,6]
);
```
## Klassen, Abstrakte Klassen, Vererbung und Interfaces:
```
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
```
das 'form' wurde bereits gemacht, aber validation noch nicht.
