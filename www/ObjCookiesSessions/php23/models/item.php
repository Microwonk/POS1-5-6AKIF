<?php

class Item {
    private int $id;
    private int $count;

    /**
     * @param int $id
     * @param int $count
     */
    public function __construct(int|string $id, int|string $count) {
        $this->id = intval($id);
        $this->count = intval($count);
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getCount(): int {
        return $this->count;
    }

    public function setCount(int $count): void {
        $this->count = $count;
    }
}