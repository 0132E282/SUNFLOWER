<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Tài khoản người dùng</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên sản phẩm</th>
                    <th>người tạo</th>
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
                            <div class="position-relative" style="width: 40px;">
                                <img src="<?= $value['feature_image'] ?>" class="rounded-circle w-100 h-100">

                            </div>
                        </td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['user_name'] ?></td>
                        <td><?= $value['price'] ?></td>
                        <td><?= $value['discount'] ?></td>
                        <td><?= $value['quantity'] ?></td>
                        <td><?= $value['count_buy'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="?controller=users&amp;action=lock_user&amp;action=update&amp;id=84"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                    <a id="btnShowModalBlock" data-value="?controller=users&amp;action=lock_user&amp;id=84" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#blockAccount"><i class="bx bx-lock-alt me-1"></i>khóa tài khoản</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>