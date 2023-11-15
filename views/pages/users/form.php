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
    <form class="row g-3 mt-5" action="?controller=users&action=create_user" method="POST" enctype="multipart/form-data">
        <div class="col-12">
            <label for="user_avatar" class="form-label">avatar</label>
            <input class="form-control" type="file" id="user_avatar" name="avatar">
        </div>
        <div class="col-12">
            <label for="user_name" class="form-label">Tên tài khoản</label>
            <input type="text" class="form-control" id="user_name" placeholder="tên tài khoản" name="name">
        </div>
        <div class="col-md-6">
            <label for="tài khoản" class="form-label">tài khoản</label>
            <input type="text" class="form-control" id="tài khoản" name="username">
        </div>
        <div class="col-md-6">
            <label for="user_password" class="form-label">mật khẩu</label>
            <input type="password" class="form-control" id="user_password" name="password">
        </div>

        <div class="col-12">
            <select class="form-select" aria-label="Default select example" name="role">
                <?php foreach ($role_list as $role) {
                    echo '<option value="' . $role['id'] . '">' . $role['name'] . ' </option>';
                } ?>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
        </div>
    </form>
</div>