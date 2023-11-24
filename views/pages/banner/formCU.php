<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?php View('components/alerts') ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex  align-items-center justify-content-between ">
                    <h5>tạo banner sản phẩm</h5>
                    <div class="action">
                        <?php if (empty($banner['id'])) : ?>
                            <button class="btn btn-primary btn-more"><i class='bx bxs-add-to-queue'></i></button>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="?controller=banner&action=<?= isset($banner['id']) ? 'update&id=' . $banner['id'] : 'create' ?>" method="POST">
                        <div class="form-wrapper">
                            <div class="form-item pb-5">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="d-flex justify-content-center align-items-center  h-100">
                                            <label class="position-relative" for="banner-images" style="cursor: pointer;" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                                <img src="<?= $banner['images'] ?? '' ?>" class="img-fluid" alt="...">
                                                <input class="input-images-banner" name=" <?= isset($banner['images']) ? 'banner-images' : 'banner-images[]' ?>" value="<?= json_encode($banner['images']) ?? '' ?>" type="text" hidden id="banner-images">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="banner-alt" class="form-label">tên banner</label>
                                            <input type="text" class="form-control" name="<?= isset($banner['name']) ? 'banner-name' : 'banner-name[]' ?>" value="<?= $banner['name'] ?? '' ?>" id="banner-alt" placeholder="tên hình ảnh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="banner-path" class="form-label">đường dẫn </label>
                                            <input type="text" class="form-control" id="banner-path" name="<?= isset($banner['url']) ? 'banner-path' : 'banner-path[]' ?>" value="<?= $banner['url'] ?? '' ?>" placeholder="đường dẫn banner">
                                        </div>
                                        <div class="mb-3">
                                            <label for="defaultSelect" class="form-label">nhóm banner</label>
                                            <select id="defaultSelect" class="form-select" name=" <?= isset($banner['banner_group_id']) ? 'banner-group'  : 'banner-group[]' ?>" fdprocessedid="806b3q">
                                                <option>chọn nhóm banner</option>
                                                <?php foreach ($bannerGroup as $key => $value) : ?>
                                                    <option value="<?= $value['id'] ?>" <?= isset($banner['banner_group_id']) && $banner['banner_group_id'] ==   $value['id'] ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button w-100" class="btn btn-primary" fdprocessedid="9wkysc">tạo nhóm banner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalUploadFile', ['id' => 'manager-file']) ?>
<script>
    const inputImageList = document.querySelectorAll('.input-images-banner[type="text"]');
    const btnMore = document.querySelector('.btn-more');
    inputImageList.forEach(function(input) {
        input.onclick = function(e) {
            e.currentTarget.parentElement.querySelector('.img-fluid').src = JSON.parse(e.target.value);
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        btnMore.onclick = function(e) {
            const formWrapper = document.querySelector('.form-item');
            const formWrapperNode = formWrapper.cloneNode(true);
            formWrapperNode.classList.add('border-top', 'pt-3');
            formWrapper.parentElement.appendChild(formWrapperNode);
        }
    })
</script>