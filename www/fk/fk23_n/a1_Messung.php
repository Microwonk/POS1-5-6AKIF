<?php

class Messung {

    private static int $ID_COUNTER = 0;
    private DateTime $datum;
    private int $wert;

    private int $id;

    /**
     * @param DateTime $datum
     * @param int $wert
     * @param int $id
     */
    public function __construct(DateTime $datum, int $wert)
    {
        $this->datum = $datum;
        $this->wert = $wert;
        $this->id = self::$ID_COUNTER++;
    }


    public function getWert(): int
    {
        return $this->wert;
    }

    public function setWert(int $wert): void
    {
        $this->wert = $wert;
    }


}