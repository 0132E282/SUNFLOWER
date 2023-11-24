<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui4
session_exists('current_user') ? $current_user = session_get('current_user') :  redirect('?controller=auth');
$query = new Query();
switch ($action) {
    case 'index_get':
        $menusList = $query->table('menus')->select(['users.name' => "user_name", 'menus.*'])->join('users', 'user_id')->orderBy('created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/index'], ['menusList' => $menusList]);
        break;
    case 'create_get':
        $menusList = $query->table('menus')->select()->orderBy('created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/formCU'], ['menusList' => $menusList]);
        break;
    case 'create_post':
        try {
            $menus =  $query->table('menus')->insert([
                'name' => $_POST['name'],
                'parent_id' => $_POST['menus_parent'],
                'url' => $_POST['menu_url'] ?? '',
                'description' => $_POST['description'],
                'user_id' => $current_user['id'],
            ]);
            if (count($menus) > 0) back(['success' => 'tạo menu thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        try {
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (count($menu) > 0) {
                $menusList = $query->table('menus')->select()->orderBy('created_at')->all();
                View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/formCU'], ['menusList' => $menusList, 'menu' => $menu]);
            } else {
                throw new Exception('không tìm thấy menu');
            }
        } catch (\Exception $e) {
            back(['error' => $e->getMessage()]);
        }

        break;
    case 'update_post':
        try {
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (count($menu) > 0) {
                $query->table('menus')->where('id', '=', $menu['id'])->update([
                    'name' => $_POST['name'],
                    'parent_id' => $_POST['menus_parent'],
                    'url' => $_POST['menu_url'] ?? '',
                    'description' => $_POST['description'],
                ]);
                back(['success' => 'tạo menu thành công']);
            };
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete_get':

        try {
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (isset($menu['id'])) {
                $query->table('menus')->where('id', '=',  $menu['id'])->delete();
                back(['success' => 'xóa thành công']);
            } else {
                throw new Exception('không tìm thấy menu');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
