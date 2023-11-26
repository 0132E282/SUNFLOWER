<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <?php if (isset($orderby)) : ?>
                    <div class="col-3">
                        <div class="row">
                            <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">xấp sếp </label>
                            <div class="col-md-8">
                                <select id="defaultSelect" class="form-select" fdprocessedid="8k2ey4">
                                    <?php foreach ($orderby as $value) : ?>
                                        <option value="<?= $value['value'] ?>" <?= isset($_POST['order']) && $value['value'] == $_POST['order'] ? 'selected' : "" ?>><?= $value['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">theo</label>
                            <div class="col-md-8">
                                <select id="defaultSelect" class="form-select" fdprocessedid="8k2ey4">
                                    <option value="DESC">DESC (tăng dần)</option>
                                    <option value="ASC">ASC (giảm dần)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endif ?>
                <div class="col-3">
                    <div class="row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Text</label>
                        <div class="col-md-10">
                            <select id="defaultSelect" class="form-select" fdprocessedid="8k2ey4">
                                <option>Default select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <h5 class="card-header">Tài khoản người dùng</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên sản phẩm</th>
                    <th>người tạo</th>
                    <th>danh mục</th>
                    <th>giá sản phẩm</th>
                    <th>giá giảm</th>
                    <th>kho</th>
                    <th>đã bán</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($products as $key => $value) : ?>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="position-relative" style="width: 60px;">
                                <img src="<?= $value['feature_image'] ?>" class="w-100 h-100">
                            </div>
                        </td>
                        <td style="max-width: 300px; cursor: pointer;" data-value="<?= $value['id'] ?>" class="btn-show-modal" data-bs-toggle="modal" data-bs-target="#modal-product"><?= $value['name'] ?></td>
                        <td><?= $value['user_name'] ?></td>
                        <td><?= $value['category_name'] ?></td>
                        <td><?= number_format($value['price']) . ' đ'  ?></td>
                        <td><?= number_format($value['discount']) . ' đ'  ?></td>
                        <td><?= number_format($value['quantity']) ?></td>
                        <td><?= number_format($value['count_buy']) ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="?controller=product&action=update&id=<?= $value['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                    <a id="btn-delete-product" data-value="?controller=product&action=delete&id=<?= $value['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-product"><i class='bx bx-trash me-1'></i>xóa sản phẩm</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-product', 'title' => 'xóa banner', 'content' => 'bạn chắc muốn xóa nó không']) ?>
<?php View('components/modal/modalProducts') ?>
<script>
    const btnShowModalList = document.querySelectorAll('.btn-show-modal');
    btnShowModalList.forEach(function(button) {
        button.onclick = function(e) {
            document.querySelector('.btn-show-modal.active')?.classList.remove('active');
            e.currentTarget.classList.add('active');
        }
    })
</script>