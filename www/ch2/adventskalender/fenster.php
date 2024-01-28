<?php
class Fenster {
    private const BILDER = [
        [
            "pfad" => "bilder/bild4.jpg",
            "beschreibung" => "A Plätzchen a day, keeps the Weihnachtsstress away.",
            "fensternr" => 4
        ],
        [
            "pfad" => "bilder/bild7.jpg",
            "beschreibung" => "Es heißt im Advent nicht, ich habe zugenommen, sondern: Ich habe gewichtelt.",
            "fensternr" => 7
        ],
        [
            "pfad" => "bilder/bild12.jpg",
            "beschreibung" => "Langsam könntest Du mal über Glühwein nachdenken",
            "fensternr" => 12
        ],
        [
            "pfad" => "bilder/bild1.jpg",
            "beschreibung" => "Warum feiern wir ausgerechnet immer dann Weihnachten, wenn die Geschäfte voll sind?",
            "fensternr" => 1
        ],
        [
            "pfad" => "bilder/bild3.jpg",
            "beschreibung" => "Warum summen die Bienen? Weil sie den Text nicht auswendig können",
            "fensternr" => 3
        ],
        [
            "pfad" => "bilder/bild8.jpg",
            "beschreibung" => "Mami, Mami, ich habe immer noch Kopfschmerzen. Dann geh doch bitte endlich von der Dartscheibe weg!",
            "fensternr" => 8
        ],
        [
            "pfad" => "bilder/bild11.jpg",
            "beschreibung" => "Warum steht der Burgernländer mit einen Kerze vor dem Spiegel? Er feiert den zweiten Advent.",
            "fensternr" => 11
        ],
        [
            "pfad" => "bilder/bild10.jpg",
            "beschreibung" => "Für diesen Winter habe ich mir gleich zwei Schneeschippen gekauft: Ich paarschippe jetzt!",
            "fensternr" => 10
        ],
        [
            "pfad" => "bilder/bild9.jpg",
            "beschreibung" => "Wie zieht sich ein Eskimo im Winter an? So schnell wie möglich!",
            "fensternr" => 9
        ],
        [
            "pfad" => "bilder/bild2.jpg",
            "beschreibung" => "Wieso freuen sich Verbrecher auf den Winter? Wintereinbruch ist nicht strafbar!",
            "fensternr" => 2
        ],
        [
            "pfad" => "bilder/bild19.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 19
        ],
        [
            "pfad" => "bilder/bild13.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 13
        ],
        [
            "pfad" => "bilder/bild15.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 15
        ],
        [
            "pfad" => "bilder/bild18.jpg",
            "beschreibung" => "Was ist besser als ein POS-Test? Ein POS-Test vor Weihnachten",
            "fensternr" => 18
        ],
        [
            "pfad" => "bilder/bild14.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 14
        ],
        [
            "pfad" => "bilder/bild6.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 6
        ],
        [
            "pfad" => "bilder/bild17.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 17
        ],
        [
            "pfad" => "bilder/bild24.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 24
        ],
        [
            "pfad" => "bilder/bild5.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 5
        ],
        [
            "pfad" => "bilder/bild20.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 20
        ],
        [
            "pfad" => "bilder/bild21.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 21
        ],
        [
            "pfad" => "bilder/bild16.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 16
        ],
        [
            "pfad" => "bilder/bild22.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 22
        ],
        [
            "pfad" => "bilder/bild23.jpg",
            "beschreibung" => "Hier könnte dein Spruch stehen.",
            "fensternr" => 23
        ]
    ];


    public static function get() : array {
        return self::BILDER;
    }

    public static function getRandom() : array {
        $cop = self::BILDER;
        shuffle($cop);
        return $cop;
    }
}

?>