<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="row ">
        <div class="col-md-4">
            <div class="card mb-4  h-100 position-sticky ">
                <div class="d-flex justify-content-between align-content-center card-header">
                    <h5 class="m-0 ">Tạo danh tạo thuộc tính</h5>
                    <a href="?controller=attribute" class="btn btn-icon btn-secondary" fdprocessedid="x31gvo">
                        <i class='bx bx-add-to-queue'></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?= empty($detailAttribute['id']) ? '?controller=attribute&action=create' : '?controller=attribute&action=update&id=' . $detailAttribute['id'] ?> " method="POST">
                        <div class="mb-3">
                            <label for="name_attribute" class="form-label">tên thuộc tính</label>
                            <input id="name_attribute" value="<?= $detailAttribute['name'] ?? '' ?>" name="name" class="form-control" type="text" placeholder="danh mục" fdprocessedid="5dmahi">
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">loại </label>
                            <select id="defaultSelect" class="form-select" fdprocessedid="fwn97q" name="type">
                                <option value="text" <?= !empty($detailAttribute['type']) && $detailAttribute['type'] == 'text' ? 'selected' : '' ?>>nội dung</option>
                                <option value="color" <?= !empty($detailAttribute['type']) && $detailAttribute['type'] == 'color' ? 'selected' : '' ?>>màu</option>
                                <option value="src" <?= !empty($detailAttribute['type']) && $detailAttribute['type'] == 'src' ? 'selected' : '' ?>>hình ảnh</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name_attribute" class="form-label">giá trị</label>
                            <input id="name_attribute" name="value" value="<?= $detailAttribute['value'] ?? '' ?>" class=" form-control" type="text" placeholder="danh mục" fdprocessedid="5dmahi">
                        </div>
                        <div class="mb-3">
                            <label for="name_attribute" class="form-label">đường dẫn tỉnh</label>
                            <input id="name_attribute" name="static_path" value="<?= $detailAttribute['static_path'] ?? '' ?>" class="form-control" type="text" placeholder="danh mục" fdprocessedid="5dmahi">
                        </div>
                        <div class="mb-3">
                            <label for="description-attribute" class="form-label">mô tả thuộc tích</label>
                            <textarea class="form-control" id="description-attribute" value="<?= $detailAttribute['description'] ?? '' ?>" rows="3" name="description" spellcheck="false"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">nhóm thuộc tính</label>
                            <select id="defaultSelect" class="form-select" fdprocessedid="fwn97q" name="parent_id">
                                <option value="0">chọn danh mục cha</option>
                                <?php if (!empty($parentAttribute)) :  ?>
                                    <?php foreach ($parentAttribute as $key => $attribute) : ?>
                                        <?php if ($attribute['id'] != $detailAttribute['id']) :  ?>
                                            <option value="<?= $attribute['id'] ?>" <?= !empty($detailAttribute['parent_id']) && $attribute['id'] == $detailAttribute['parent_id'] ? 'selected' : ''  ?>><?= $attribute['name'] ?></option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="bnh72h"><?= !empty($detailAttribute['id']) ? 'cập nhập thuộc tính' : ' tạo thuộc tính' ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4  h-100">
                <h5 class="card-header">Danh sách danh mục</h5>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>tên thuộc tính</th>
                            <th>giá trị</th>
                            <th>đường dân tỉnh</th>
                            <th>mô tả thuộc tính</th>
                            <th>ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (!empty($attributeList)) : ?>
                            <?php foreach ($attributeList as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['value'] ?></td>
                                    <td><?= $value['static_path'] ?></td>
                                    <td><?= $value['description'] ?></td>
                                    <td><?= $value['created_at'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="?controller=attribute&id=<?= $value['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                                <a data-value="<?= '?controller=attribute&action=delete&id=' . $value['id'] ?>" class="dropdown-item btn-delete-attr" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-attribute"><i class='bx bx-trash'></i>xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-attribute', 'btnShowModal' => 'btn-delete-attr', 'title' => 'xóa tài danh mục', 'content' => 'bạn chắc muốn xóa nó không']) ?>