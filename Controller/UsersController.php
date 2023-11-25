<?php
require_once 'Request/validateFormUser.php';
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
session_exists('current_user') ? $current_user = session_get('current_user') :  redirect('?controller=auth');
$query = new Query();
switch ($action) {
    case 'index':
        $data = $query->table('users')->select(['users.id' => 'id', 'users.photo_url' => 'photo_url', 'role.name' => 'role_name', 'users.*', 'users.name' => 'user_name', 'username', 'users.created_at' => 'created_at'])->join('role', 'role_id', 'id', 'left')->orderBy('created_at')->limit(25)->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/table'], ['user_list' => $data]);
        break;

    case 'lock_user':
        $user = $query->table('users')->select()->where('id', '=', $_GET['user'])->first();
        if ($user) {
            $data =  $query->table('users')->where('id', '=', $user['id'])->update([
                'locked' => 1
            ]);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case 'unlock_user':
        $user = $query->table('users')->select()->where('id', '=', $_GET['user'])->first();
        if ($user) {
            $data =  $query->table('users')->where('id', '=', $user['id'])->update([
                'locked' => 0
            ]);
        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
    case 'create_user':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $req = validateFormUserCreate();
            try {
                $username = $query->table('users')->select()->where('username', '=', $$req['username'])->first();
                if (is_array($username)) throw new Exception('tài khoản nầy đã có người tạo');
                if (isset($_FILES)) {
                    $file_url = upload_file($_FILES['avatar'], ['store' => 'avatar']);
                }

                $hashed_password = password_hash($req['password'], PASSWORD_DEFAULT);
                $data = $query->table('users')->insert([
                    'username' => $req['username'],
                    'password' =>  $hashed_password,
                    'name' => $req['name'],
                    'photo_url' => $file_url,
                    'role_id' => $req['role'],
                ]);
                if ($data) back(['success' => 'tạo tài khoản thành công ! oke']);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            break;
        }
        break;
    case 'create':
        $role = $query->table('role')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/form'], ['role_list' => $role]);
        break;
    case 'update':
        $user = $query->table('users')->select()->where('id', '=', $_GET['id'])->first();
        if ($user) {
            $role = $query->table('role')->select()->all();
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/form'], ['role_list' => $role, 'user' => $user]);
        }
        back(['' => 'update tài khoản thành công']);
        break;
    case 'update_user':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $req = validateFormUserUpdate();
            $user = $query->table('users')->select()->where('id', '=', $_GET['id'])->first();
            if ($user) {
                if (!empty($req['password'])) {
                    $hashed_password = password_hash($req['password'], PASSWORD_DEFAULT);
                }
                if ($_FILES['avatar']) {
                    $file_url = upload_file($_FILES['avatar'], ['store' => 'avatar']);
                }
                $query->table('users')->where('id', '=', $_GET['id'])->update([
                    'name' => $req['name'] ?? $user['name'],
                    'password' => $hashed_password ?? $user['password'],
                    'role_id' => $req['role'] ?? $user['role'],
                    'name' => $req['name'] ?? $user['name'],
                    'photo_url' =>   $file_url ?? $user['photo_url'],
                ]);
            }
            back(['success' => 'cập nhập tài khoản người dùng thành công ! oke']);
        }
        break;
    case 'delete':
        $data = $query->table('users')->where('id', '=', 4)->delete();
        print_r($data);
        break;
    default:
        echo 'không có file';
}
