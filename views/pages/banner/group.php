<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>

    <div class="row">
        <div class="col-4">
            <div class="card mb-4">
                <h5 class="card-header">tạo nhóm banner</h5>
                <div class="card-body">
                    <form action="?controller=banner&action=<?= isset($bannerGroup['id']) ? 'update-group&id=' . $bannerGroup['id'] : 'create-group' ?>" method="post">
                        <div class="mb-4">
                            <label for="group-name" class="form-label">tên group</label>
                            <input type="text" class="form-control" id="group-name" name="name" value="<?= $bannerGroup['name'] ?? '' ?>" placeholder="tên group" fdprocessedid="ewfbhm">
                        </div>
                        <div class="mb-4">
                            <label for="group-description" class="form-label">mô tả</label>
                            <textarea class="form-control" id="group-description" name="description" rows="3"> <?= $bannerGroup['description'] ?? '' ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="8o0s66"><?= isset($bannerGroup['id']) ? 'cập nhập nhóm' : 'tạo nhóm' ?></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card mb-4  h-100">
                <h5 class="card-header">Danh sách danh mục</h5>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>tên danh mục</th>
                            <th>mô tả</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (isset($groupList) && count($groupList) > 0) : ?>
                            <?php foreach ($groupList as $key => $value) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td><?= $value['description'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="gcw3wo">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="?controller=banner&action=update-banner-group&id=<?= $value['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                                <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=26" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr class="text-center ">
                                <td colspan="4">không có dữ liệu</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>