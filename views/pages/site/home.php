<?php View('components/slider') ?>

<!-- banner -->
<?php View('components/home/banner', ['nameBannerGroup' => 'home-panner', ...$data]) ?>



<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
    <div class="container">
        <div class="p-b-10">
            <h3 class="ltext-103 cl5">
                TỔNG QUAN SẢN PHẨM
            </h3>
        </div>

        <div class="flex-w flex-sb-m p-b-52">
            <?php View('components/product/product-filter', ['category' => $category]) ?>
        </div>

        <div class="row isotope-grid">
            <?php if (!empty($products) && count($products) > 0) : ?>
                <?php foreach ($products as $value) : ?>
                    <?php View('components/product/product-cart', $value) ?>
                <?php endforeach ?>
            <?php endif ?>
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="?controller=shop&page=1" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                xem thêm
            </a>
        </div>
    </div>
</section>