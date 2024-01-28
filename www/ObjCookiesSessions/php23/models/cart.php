<?php

class Cart {

    private array $selectedBooks;
    private int $itemsCount;

    private static $INSTANCE;
    public static function get() : Cart {
        if (is_null(self::$INSTANCE)) {
            self::$INSTANCE = new Cart();
        }
        return self::$INSTANCE;
    }
    private function __construct() {
        $this->selectedBooks = $this->loadItems();
    }

    // adds but also checks if the item is already in the cart
    public function add($item) : void {
        foreach ($this->selectedBooks as $i) {
            if ($i->getId() == $item->getId()) {
                $i->setCount($i->getCount() + $item->getCount());
                $this->save();
                return;
            }
        }
        $this->selectedBooks[] = $item;
        $this->save();
    }

    function deleteItemFromCart($itemId) : array {
        if (isset($_COOKIE['cart'])) {
            $cartData = $this->getSelectedBooks();
            foreach ($cartData as $key => $d) {
                if ($d->getId() == $itemId) {
                    unset($cartData[$key]);
                }
            }
            $cartData = array_values($cartData);
            $this->selectedBooks = $cartData;
            $this->save();
            return $this->getSelectedBooks();
        }

    }

    public function remove(Item $item) : bool {
        foreach ($this->selectedBooks as $i => $book) {
            if ($book['id'] == $item->getId()) {
                unset($this->selectedBooks[$i]);
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
                $count = $count + $i->getCount();
            }
        }
        $this->itemsCount = $count;
    }

    public function getItemsCount() : int {
        return $this->itemsCount;
    }
}