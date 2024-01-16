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
    foreach ($data as $d) {
        $book = new Book($d['id'], $d['title'], $d['price'], $d['stock']);
        ?>
        <form action='index.php' method='post'>
            <div class='row border-bottom'>
                <p>
                    <?= $book->getTitle(); ?>
                </p>
                <div class='col-sm-4'>
                    <?= $book->getPrice(); ?>€
                </div>
                <div class='col-sm-2'>
                    <label>
                        <select name='count'>
                            <option value='' hidden>* Menge *</option>
                            <?php
                            for ($i = 1; $i <= $book->getStock(); $i++) {
                                ?>
                                <option value='<?php echo $i ?>'>
                                    <?php echo $i ?>
                                </option>
                                <?php
                            }
                            ?>

                        </select>
                    </label>
                </div>
                <div class='col-md-3'>
                    <input
                            type='hidden'
                            name='id'
                            value='<?= $book->getId(); ?>'>
                    <button
                            class='btn btn-secondary'
                            type='submit'
                            name='submit'
                            value="submit">
                        Hinzufügen
                    </button>
                </div>
            </div>
        </form>
        <?php
    }
    ?>
</div>

</body>
</html>
