<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
switch ($action) {
    case 'index':
        $data = $query->table('users')->select()->limit(1)->offset(2)->all();
        View(['layout' => 'layouts/defaultLayout', 'content' => 'users'], ['user' => $data]);
        break;
    case 'create':
        $data = $query->table('users')->insert(['username' => "hoangphuc", 'password' => 1]);
        print_r($data);
        break;
    case 'update':
        $data = $query->table('users')->where('id', '=', 4)->update(['username' => "hoangphuc1", 'password' => 1]);
        print_r($data);
        break;
    case 'delete':
        $data = $query->table('users')->where('id', '=', 4)->delete();
        print_r($data);
        break;
    default:
        echo 'không có file';
}
