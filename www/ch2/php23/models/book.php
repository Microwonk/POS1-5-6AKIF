<?php

class Book {
    private int $id;
    private string $title;
    private float $price;
    private int $stock;

    /**
     * @param int $id
     * @param string $title
     * @param float $price
     * @param int $stock
     */
    public function __construct(int $id, string $title, float $price, int $stock) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setStock(int $stock): void {
        $this->stock = $stock;
    }
}