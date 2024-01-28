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
    $cart->remove($_POST['itemId']);
    header("refresh:0");
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <a href="index.php" class="btn btn-primary mt-3 mb-3">Zurück</a>
        </div>
        <div class="col-sm-3">
            <h1>Einkaufswagen</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Menge</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($items as $item) {
                            foreach ($data as $d) {
                                $book = new Book($d['id'], $d['title'], $d['price'], $d['stock']);
                                if ($item->getId() == $book->getId()) { ?>
                                    <tr>
                                        <td><?= $book->getTitle() ?></td>
                                        <td><?= $book->getPrice() . "€" ?></td>
                                        <td>Menge: <?= $item->getCount() ?></td>
                                        <td>
                                            <form action="warenkorb.php" method="post">
                                                <input type="hidden" name="itemId" value="<?= $item->getId(); ?>">
                                                <button type="submit" name="delete" class="btn btn-secondary">Entfernen</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                    if (!is_null($book->getPrice())) {
                                        $summe += $book->getPrice() * $item->getCount();
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            </div>
            <div class="col-sm-3">
                <div class="sticky-top" style="top: 15px;">
                    <p class="badge bg-primary m-2 p-2">Summe: <?= $summe ?>€</p>
                </div>
        </div>
    </div>
</div>
</body>
</html>
