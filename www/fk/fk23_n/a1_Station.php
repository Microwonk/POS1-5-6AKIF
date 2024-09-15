<?php

require_once "a1_Messung.php";
class Station {
    private array $messungen;

    public function __construct() {
        $this->messungen = [];
    }

    public function hinzufuegen(BMessung $messung): void {
        $this->messungen[] = $messung;
    }

    public function berechneDurchschnitt(): float {
        $sum = 0;
        foreach ($this->messungen as $m) {
            $sum += $m->getWert();
        }
        return $sum / count($this->messungen);
    }
}