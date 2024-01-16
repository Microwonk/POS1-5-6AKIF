<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Warenkorb</title>
</head>
<body>
<?php

require_once "models/cart.php";
require_once "models/book.php";
require_once "models/item.php";
require_once "models/data_access.php";

$cart = Cart::get();
$items = $cart->loadItems();
$data = getAllBooks();
$summe = 0;

if (isset($_POST['delete'])) {
    $cart->deleteItemFromCart($_POST['itemId']);
    header("Location: warenkorb.php");
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm10">
            <h1>Einkaufswagen</h1>
        </div>
        <div class="col-sm-2 card-img-top">
            <img src="images/shopping_cart.png" width="64" alt="shopping cart">
        </div>
    </div>
    <div class="row">
            <?php
            foreach ($items as $item) {
                foreach ($data as $d) {
                    $book = new Book($d['id'], $d['title'], $d['price'], $d['stock']);
                    if ($item->getId() == $book->getId()) { ?>
                        <div class="row m-3">
                            <form action="warenkorb.php" method="post">
                                <input type="hidden" name="itemId" value="<?php echo $item->getId(); ?>">
                                <h3>
                                    <?= $book->getTitle() ?>
                                </h3>
                                <div class="mt-2">
                                    <?= $book->getPrice() . "€" ?>
                                </div>
                                <div class="mt-2">
                                    Menge: <?= $item->getCount() ?>
                                </div>
                                <button
                                        type="submit"
                                        name="delete"
                                        class="mt-2 btn btn-secondary">
                                    Entfernen
                                </button>
                                <?php
                                if (!is_null($book->getPrice())) {
                                    $summe += $book->getPrice() * $item->getCount();
                                }
                                ?>
                                <div>
                                    <p style="margin-bottom:0; margin-right:0.5em">
                                        Summe:
                                    </p>
                                    <output>
                                        <?= $summe . "€" ?>
                                    </output>
                                </div>
                            </form>
                        </div>
                    <?php }
                }
            }
            ?>
    </div>
</div>
</body>
</html>
