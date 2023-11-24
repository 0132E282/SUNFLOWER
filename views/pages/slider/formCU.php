<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <?php View('components/alerts') ?>
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header d-flex  align-items-center justify-content-between ">
                    <h5>tạo slider sản phẩm</h5>
                    <div class="action">
                        <?php if (empty($slider['id'])) : ?>
                            <button class="btn btn-primary btn-more"><i class='bx bxs-add-to-queue'></i></button>
                        <?php endif ?>
                    </div>
                </div>
                <div class="card-body">
                    <form action="?controller=slider&action=<?= isset($slider['id']) ? 'update&id=' . $slider['id'] : 'create' ?>" method="POST">
                        <div class="form-wrapper">
                            <div class="form-item pb-5">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="d-flex justify-content-center align-items-center  h-100">
                                            <label class="position-relative" for="slider-images" style="cursor: pointer;" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                                <img src="<?= $slider['images'] ?? '' ?>" class="img-fluid" alt="...">
                                                <input class="input-images-slider" name=" <?= isset($slider['images']) ? 'slider-images' : 'slider-images[]' ?>" value="<?= json_encode($slider['images']) ?? '' ?>" type="text" hidden id="slider-images">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="slider-alt" class="form-label">tên slider</label>
                                            <input type="text" class="form-control" name="<?= isset($slider['name']) ? 'slider-name' : 'slider-name[]' ?>" value="<?= $slider['name'] ?? '' ?>" id="slider-alt" placeholder="tên hình ảnh">
                                        </div>
                                        <div class="mb-3">
                                            <label for="slider-path" class="form-label">đường dẫn </label>
                                            <input type="text" class="form-control" id="slider-path" name="<?= isset($slider['url']) ? 'slider-path' : 'slider-path[]' ?>" value="<?= $slider['url'] ?? '' ?>" placeholder="đường dẫn slider">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button w-100" class="btn btn-primary" fdprocessedid="9wkysc"><?= isset($slider['id']) ? 'cập nhập slider' : 'tạo slider' ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalUploadFile', ['id' => 'manager-file']) ?>
<script>
    const inputImageList = document.querySelectorAll('.input-images-slider[type="text"]');
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