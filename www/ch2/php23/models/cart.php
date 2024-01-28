<?php

class Cart {

    private array $selectedBooks;
    private int $itemsCount;

    // singleton pattern
    private static Cart $INSTANCE;
    public static function get() : Cart {
        if (is_null(self::$INSTANCE)) {
            self::$INSTANCE = new Cart();
        }
        return self::$INSTANCE;
    }

    // privater constructor
    private function __construct() {
        $this->selectedBooks = $this->loadItems();
    }

    // adds but also checks if the item is already in the cart
    public function add($item) : void {
        foreach ($this->selectedBooks as $i) {
            if ($i->getId() == $item->getId()) {
                $i->addCount($item->getCount());
                $this->save();
                return;
            }
        }
        
        $this->selectedBooks[] = $item;
        $this->save();
    }

    public function remove(Item $item) : bool {
        foreach ($this->selectedBooks as $i => $book) {
            if ($book['id'] == $item->getId()) {
                unset($this->selectedBooks[$i]);
                $this->save();
                return true;
            }
        }
        return false;
    }

    public function getSelectedOfItem(int $id) : int {
        foreach ($this->getSelectedBooks() as $book) {
            if ($book->getId() == $id) {
                return $book->getCount();
            }
        }
        return 0;
    }

    public function getSelectedBooks() : array {
        return $this->selectedBooks;
    }

    public function save() : void {
        setcookie('cart', serialize($this->selectedBooks), time() + (86400 * 30), "/");
        $this->setItemsCount();
    }

    public function loadItems() : array {
        if (!isset($_COOKIE['cart'])) {
            return [];
        }
        return unserialize($_COOKIE['cart']);
    }

    public function setItemsCount() : void {
        $count = 0;
        foreach($this->selectedBooks as $i){
            if(!is_null($i->getCount())) {
                // count of individual items
                $count = $count + $i->getCount();
            }
        }
        // count of all indivual items summed up
        $this->itemsCount = $count;
    }

    public function getItemsCount() : int {
        return $this->itemsCount;
    }
}