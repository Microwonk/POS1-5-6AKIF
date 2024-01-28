<?php
require_once "models/book.php";
require_once "models/cart.php";
require_once "models/item.php";
require_once "models/data_access.php";

$cart = Cart::get();
$items = $cart->loadItems();
$itemCount = 0;
foreach ($items as $i) {
    $itemCount += $i->getCount();
}

if (isset($_POST['submit'])) {
    if (($_POST['count'] ?? 0) != 0) {
        $item = new Item($_POST['id'] ?? 0, $_POST['count'] ?? 0);
        $cart->add($item);
        $cart->setItemsCount();
        $itemCount += $item->getCount();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Book-Shop</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1 class="mt-5 mb-3 col-sm-6">Bücher</h1>

        <div class="col-sm-6 mt-5 mb-3">
            <a href="warenkorb.php">
                <button class="btn btn-primary" name="warenkorb">Warenkorb
                    <span style="font-size: 1.3em; font-style: italic;"><?= $itemCount ?></span>
                    <span style="font-style: italic;">Artikel</span>
                </button>
            </a>
        </div>
    </div>

    <?php
    $data = getAllBooks();
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Preis</th>
                <th>Menge</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $d) {
                $book = new Book($d['id'], $d['title'], $d['price'], $d['stock']);
            ?>
                <tr>
                    <td><?= $book->getTitle(); ?></td>
                    <td><?= $book->getPrice(); ?>€</td>
                    <td>
                        <form action='index.php' method='post'>
                        <?php
                            $stockLeft = $book->getStock() - $cart->getSelectedOfItem($book->getId());
                            if ($stockLeft != 0) {
                                echo "<label for='count'>Menge:</label>";
                                echo "<select id='count' name='count'>";
                                
                                for ($i = 0; $i < $stockLeft; $i++) {
                                    echo '<option value=' . ($i + 1) . '>' . ($i + 1) . '</option>';
                                }
                                echo "</select>";
                            } else {
                                echo "<p>Kein Bestand mehr vorhanden</p>";
                            }
                        ?>

                    </td>
                    <td>
                    <?php
                    if ($stockLeft != 0) {
                    ?>
                        <input type='hidden' name='id' value='<?= $book->getId(); ?>'>
                        <button class='btn btn-secondary' type='submit' name='submit' value="submit">
                            Hinzufügen
                        </button>
                    <?php 
                    } 
                    ?>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
