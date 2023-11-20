<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
echo $action;
$current_user = session_get('current_user');
switch ($action) {
    case 'index_get':
        $product_list = $query->table('products')->select(['users.id' => 'user_id', 'users.name' => 'user_name', 'products.*'])->join('users', 'user_id')->orderBy('products.created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/table'], ['products' => $product_list]);

        break;
    case 'create_get':
        $categoryList = $query->table('category')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/form'], ['categoryList' => $categoryList]);
        break;
    case 'create_post':
        $product = $query->table('products')->insert([
            'name' => input('name-product'),
            'user_id' => $current_user['id'],
            'description' => input('description-product'),
            'category_id ' => input('category'),
            'price' => input('price-product'),
            'feature_image' => input('feature_image'),
            'quantity' => input('quantity-product'),
            'discount' => input('discount-product')
        ]);
        if ($product) {
            foreach (json_decode($_POST['description-images']) as $key => $value) {
                $image = $query->table('image')->insert([
                    'image_url' => $value,
                    'product_id' => $product['id'],
                    'alt' => 'description image ' . $product['name']
                ]);
            }
            back(['success' => 'tạo sản phẩm thành công']);
        }
        break;
    default:
        echo 'không có file';
}
