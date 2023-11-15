<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Tài khoản người dùng</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên người dùng</th>
                    <th>tài khoản</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach ($user_list as $key => $value) {
                    echo '<tr>
                <td>' . ++$key . '</td>
                <td> <img src="' . $value['photo_url'] . '" class="rounded-circle" style="width: 40px;" /></td>
                <td>' . $value['name'] . '</td>
                <td>' . $value['username'] . '</td>
                <td>
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                    </div>
                </td>
            </tr>';
                }
                ?>

            </tbody>
        </table>
    </div>

</div>