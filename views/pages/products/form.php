<div class="container-xxl flex-grow-1 container-p-y">
    <?php if (!empty($message['success'])) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <?= $message['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <form action="?controller=product&action=create" method="POST" name="form-product">
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nameProducts" class="form-label">tên sản phẩm</label>
                            <input type="text" class="form-control" id="nameProducts" name="name-product" placeholder="nhập tên sản phẩm mà bạn muốn" fdprocessedid="uggdbw">
                        </div>
                        <div>
                            <label for="description-products" class="form-label">mô tả sản phẩm</label>
                            <textarea class="form-control" id="description-products" name="description-product" rows="7" spellcheck="false"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category_list" class="form-label">chọn danh mục sản phẩm</label>
                            <select class="form-select" id="category_list" name="category" fdprocessedid="mnavrk">
                                <option selected="">chọn danh mục sản phảm</option>
                                <?php foreach ($categoryList as $key => $value) : ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity-product" class="form-label">số lượng sản phẩm</label>
                            <input type="text" class="form-control" id="quantity-product" name="quantity-product" placeholder="nhập giá sản phẩm" name="price-product" fdprocessedid="uggdbw">
                        </div>
                        <div class="mb-3">
                            <label for="price_product" class="form-label">giá sản phẩm</label>
                            <input type="text" class="form-control" id="price_product" placeholder="nhập giá sản phẩm" name="price-product" fdprocessedid="uggdbw">
                        </div>
                        <div class="mb-3">
                            <label for="discount-product" class="form-label">giá sản phẩm được giảm</label>
                            <input type="text" class="form-control" id="discount-product" name="discount-product" placeholder="nhập giảm giá sản phẩm" fdprocessedid="uggdbw">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card ">
                    <div class="card-header">
                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-lg w-100 " type="submit" fdprocessedid="jihxsi">tạo sản phẩm</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="input-feature_image" class="form-label ">
                                Ảnh sản phẩm
                            </label>
                            <label for="input-feature_image" class="form-label ">
                                <img src="public\assets\img\default\product-default.png" id="uploaded-feature_image" class="img-thumbnail mx-auto d-block w-50" alt="...">
                            </label>
                            <div class="button-wrapper">
                                <label for="input-feature_image" class="btn btn-primary me-2 mb-4 btn-input-file" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                    <span class="d-none d-sm-block">tải hình sản phẩm</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="text" id="input-feature_image" class="input-file-images" name="feature_image" hidden="">
                                </label>
                                <label type="button" class="btn btn-outline-secondary account-image-reset mb-4" fdprocessedid="axbads">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </label>
                                <p class="text-muted mb-0">Được phép JPG, GIF hoặc PNG. Kích thước tối đa 800K</p>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="list-image-review mb-3 d-flex flex-wrap">
                            </div>
                            <div class="button-wrapper">
                                <label type="button" class="btn btn-primary me-2 btn-input-file" tabindex="0" data-bs-toggle="modal" data-bs-target="#manager-file">
                                    <span class="d-none d-sm-block">tải ảnh mô tả</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="input" id="input-description-images" class="input-file-images" name="description-images" hidden="">
                                </label>
                                <button type="button" class="btn btn-outline-secondary reset-images " fdprocessedid="axbads">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php View('components/modal/modalUploadFile', ['id' => 'manager-file']) ?>

<script src="https://cdn.tiny.cloud/1/g8a7cmcv53x66nhue0tp27n51tk8cyg7so0mrqbzh2a37ycw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="public/assets/js/validate.js"></script>
<script>
    validate({
        form: 'form-product',
        rules: [
            validate.require('name-product'),
            validate.isNumber('price-product'),
            validate.require('price-product'),
        ]
    });
</script>
<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script type="text/javascript">
    tinymce.init({
        selector: '#description-products',
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
    const inputImages = document.querySelector('#input-description-images');
    const listImagesReview = document.querySelector('.list-image-review');
    const btnInputFile = document.querySelectorAll('.btn-input-file');
    btnInputFile.forEach(item => {
        item.onclick = (e) => {
            document.querySelector('.btn-input-file.active')?.classList.remove('active');
            e.currentTarget.classList.add('active');
        }
    })
    inputImages.onclick = function(e) {
        if (e.currentTarget.value) {
            listImagesReview.innerHTML = JSON.parse(e.currentTarget.value)?.map((value) => {
                return `
            <div class="w-25 position-relative ">
                <img src="${value}" class="rounded float-start" alt="image-review" style="width: 70px;">
            </div>
            `;
            }).join('\n');
        }
    }
    document.querySelector('#input-feature_image').onclick = function(e) {
        if (e.target.value) {
            e.target.value = JSON.parse(e.target.value)[0];
            document.querySelector('#uploaded-feature_image').src = e.target.value;
        }
    }
</script>