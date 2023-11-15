<div class="container-xxl flex-grow-1 container-p-y">
    <?php
    if (!empty($_GET['success'])) {
        echo '<div class="alert alert-success" role="alert">
        ' . $_GET['success'] . '
      </div>';
    }
    if (!empty($_GET['error'])) {
        echo '<div class="alert  alert-danger" role="alert">
        ' . $_GET['error'] . '
      </div>';
    }
    ?>
    <div class="card ">
        <form class="row g-3 bg-while" action="?controller=users&action=create_user" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="<?= $user['photo_url'] ?? 'public/assets/img/avatars/1.png' ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" class="account-file-input" name="avatar" hidden="" accept="image/png, image/jpeg">
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" fdprocessedid="axbads">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="user_name" class="form-label">Tên tài khoản</label>
                        <input type="text" value="<?= $user['name'] ?? '' ?>" class="form-control" id="user_name" placeholder="tên tài khoản" name="name">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="tài khoản" class="form-label">tài khoản</label>
                        <input type="text" value="<?= $user['username'] ?? '' ?>" class="form-control" id="tài khoản" name="username">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="user_password" class="form-label">mật khẩu</label>
                        <input type="password" <?= !empty($user['password']) ? 'disabled' : '' ?> class="form-control" id="user_password" name="password">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="role_users" class="form-label">quyền hạng</label>
                        <select id="role_users" class="form-select" aria-label="Default select example" name="role">
                            <?php foreach ($role_list as $role) {
                                echo '<option value="' . $role['id'] . '" ' . ($user['role_id'] == $role['id'] ? 'selected' : '') . '>' . $role['name'] . ' </option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="public/assets/js/pages-account-settings-account.js">
</script>