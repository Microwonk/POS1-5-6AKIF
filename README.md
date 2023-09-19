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

$_POST für post requests
