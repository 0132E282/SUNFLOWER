<?php
require_once 'Request/validateAuth.php';
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
$current_user = session_get('current_user', []);
switch ($action) {
    case 'index':
        View(['layout' => 'layouts/adminLayoutEmpty', 'content' => 'pages/auth/LoginAdmin']);
        break;
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $req = validateAuth();
            $username = $_POST['username'];
            $user = $query->table('users')->select(['role.name' => 'role_name', 'users.*'])->join('role', 'role_id', 'id')->where('username', '=', $username)->first();
            if ($user && password_verify($_POST['password'], $user['password']) && $user['locked'] == 0) {
                $current_user = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'photo_url' => $user['photo_url'],
                    'role_id' => $user['role_id'],
                    'role_name' => $user['role_name'],
                    'locked' => $user['locked']
                ];
                session_push('current_user', $current_user);
                redirect('index.php?controller=dashboard', ['success' => 'đăng nhập thành công']);
            } else {
                back(['error' => 'tài khoản hoạt mật khẩu không chín xát']);
            }
        }
        break;
    case 'logout':
        if (session_get('current_user')) {
            session_remove('current_user');
            redirect('index.php?controller=auth');
        }
        break;
    case 'login_user':

        break;
    default:
        echo 'không có file';
}
