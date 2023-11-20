<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
$current_user = session_get('current_user', []);
$currentDate = new DateTime();
switch ($action) {
    case 'index':
        $category_detail = [];
        if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $category_list = $query->table('category')->select(['users.name' => 'user_name', 'category.*'])->join('users', 'user_id')->all();
            if (!empty($_GET['id'])) {
                $category_detail = $query->table('category')->select()->where('id', '=', $_GET['id'])->first();
            }
            $category_list = array_map(function ($category) use ($query) {
                $category_parent = $query->table('category')->select()->where('id', '=', $category['parent_id'])->orderBy(['parent_id', 'created_at'])->first();
                return $category = [...$category, 'parent_name' => $category_parent['name'] ?? 'danh mục cha'];
            }, $category_list);
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/formCategory'], ['category_list' => $category_list, 'category_detail' => $category_detail]);
        }
        break;
    case 'delete':
        if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $categoryQuery = $query->table('category');
            $category = $categoryQuery->select()->where('id', '=', $_GET['id'])->first();
            if (count($category) > 0) {
                $categoryQuery->where('id', '=', $_GET['id'])->delete();
                back(['success' => 'danh mục sản phẩm đã xóa']);
            }
        }
        break;
    case 'update_category':
        if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $query->table('category')->where('id', '=', $_GET['id'])->update([
                'name' => $_POST['name'],
                'parent_id' => $_POST['parent_id'],
                // 'updated_at' => $currentDate->format('Y-m-d H:i:s'),
            ]);
            back(['success' => 'cập nhập danh mục sản phẩm thành công']);
        }
        break;
    case 'create_category':
        try {
            if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
                $category = $query->table('category')->insert([
                    'name' => input('name'),
                    'parent_id' => input('parent_id'),
                    'user_id' => $current_user['id'],
                ]);
                if ($category) back(['success' => 'tạo danh mục sản phẩm thành công']);
            }
        } catch (Exception $e) {
        }
        break;
    default:
        echo 'không có file';
}