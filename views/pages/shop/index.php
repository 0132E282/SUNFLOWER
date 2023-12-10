<!-- Product -->
<div class="bg0 m-t-23 p-b-140">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <?php View('components/product/product-filter', ['category' => $category ?? []]) ?>
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
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php if (count($page) > 0) : ?>
                        <?php if ($page['current_page'] > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?controller=shop&page=1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php for ($i = 1; $i <= $page['total_pages']; $i++) : ?>
                            <?php if ($i < $page['current_page'] + 3 && $i > $page['current_page'] - 3) : ?>
                                <li class="page-item"><a class="page-link" href="?controller=shop&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endif ?>
                        <?php endfor; ?>
                        <?php if ($page['current_page'] < $page['total_pages']) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?controller=shop&page=<?= $page['total_pages'] ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>

                </ul>
            </nav>
        </div>
    </div>
</div>