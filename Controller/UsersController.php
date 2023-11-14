<?php
require_once './views/view.php';
require_once './Model/Query.php';
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
$query = new Query();
switch ($action) {
    case 'index':
        $data = $query->select()->from('users')->all();
        View('users', ['user' => $data]);
        break;
    default:
        echo 'không có file';
}
