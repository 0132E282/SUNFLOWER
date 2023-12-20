<?php
session_start();
$cart = $_SESSION['product_cart'] ?? [];
?>

<?php if (!empty($cart) && count($cart) > 0) : ?>
    <?php foreach ($cart as $cart) : ?>

        <li class="header-cart-item flex-w flex-t m-b-12 p-0">
            <a href="?controller=shop&action=delete-cart&id=<?= $cart['id'] ?>">
                <div class="header-cart-item-img">
                    <img src="<?= $cart['images'] ?>" alt="IMG">
                </div>
            </a>
            <div class="header-cart-item-txt p-t-8">
                <a href="?controller=shop&action=detail&id=<?= $cart['product_id'] ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                    <?= $cart['name'] ?>
                </a>

                <span class="header-cart-item-info">
                    <?= $cart['quantity'] ?> x <?= $cart['price'] ?>
                </span>
            </div>
        </li>
    <?php endforeach ?>
<?php endif ?>