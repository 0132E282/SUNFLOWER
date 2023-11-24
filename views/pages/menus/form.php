<div class="container-xxl flex-grow-1 container-p-y">
    <div class="w-100">
    </div>
    <div class="row ">
        <div class="col-md-4">
            <div class="card mb-4  h-100 position-sticky ">
                <div class="d-flex justify-content-between align-content-center card-header">
                    <h5 class="m-0 ">Tạo danh mục sản phẩm</h5>
                    <a href="?controller=category" class="btn btn-icon btn-secondary" fdprocessedid="x31gvo">
                        <i class="bx bx-add-to-queue"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="?controller=category&amp;action=create_category " method="POST">
                        <div class="mb-3">
                            <label for="name_category" class="form-label">tên danh mục</label>
                            <input id="name_category" value="" name="name" class="form-control" type="text" placeholder="danh mục" fdprocessedid="5dmahi">
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">danh mục cha</label>
                            <select id="defaultSelect" class="form-select" fdprocessedid="fwn97q" name="parent_id">
                                <option value="0">chọn danh mục cha</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="28">thời trang cho bé</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="27">thời trang nữ</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="26">thời trang nam</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="30">quần tay nam</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="25">áo khoác nam</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="29">áo sơ mi nam</option>

                                Warning: Undefined array key "id" in D:\coder\laravel\duAnMau\views\pages\products\category.php on line 23
                                <option value="31">áo khoác nữ</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="bnh72h">tạo danh mục</button>
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
                            <th>tên danh mục</th>
                            <th>cấp danh mục</th>
                            <th>người tạo</th>
                            <th>ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td>thời trang cho bé</td>
                            <td>danh mục cha</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:13:20</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="ygqppm">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=28"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=28" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>thời trang nữ</td>
                            <td>danh mục cha</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:13:08</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="j5n8g">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=27"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=27" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>thời trang nam</td>
                            <td>danh mục cha</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:12:51</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="7ukmz">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=26"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=26" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>quần tay nam</td>
                            <td>thời trang nam</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:18:28</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="29jibc">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=30"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=30" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>áo khoác nam</td>
                            <td>thời trang nam</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-18 06:52:17</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="py83ej">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=25"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=25" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>áo sơ mi nam</td>
                            <td>thời trang nam</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:18:15</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="79ag0h">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=29"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=29" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>áo khoác nữ</td>
                            <td>thời trang nữ</td>
                            <td>Phúc Nuyễn Hoàng</td>
                            <td>2023-11-21 23:18:44</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="pji2qg">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=category&amp;id=31"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-category" data-value="?controller=category&amp;action=delete_category&amp;id=31" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class="bx bx-trash"></i>xóa</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>