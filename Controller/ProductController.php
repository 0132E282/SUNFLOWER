<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
session_exists('current_user') ? $current_user = session_get('current_user') :  redirect('?controller=auth');
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
    case 'update_get':
        $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($product)) {
            $product['images'] = $query->table('image')->select()->where('product_id', '=', $product['id'])->all();
        }
        $categoryList = $query->table('category')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/form'], ['categoryList' => $categoryList, 'product' => $product]);
        break;
    case 'update_post':
        $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($product)) {
            $query->table('products')->where('id', '=', $product['id'])->update([
                'name' => input('name-product') ?? $product['name'],
                'description' => input('description-product')  ?? $product['description'],
                'category_id ' => input('category')  ?? $product['category_id'],
                'price' => input('price-product') ?? $product['price'],
                'feature_image' => input('feature_image') ?? $product['feature_image'],
                'quantity' => input('quantity-product') ?? $product['quantity-product'],
                'discount' => input('discount-product') ?? $product['discount-product']
            ]);
            if ($product) {
                $query->table('image')->where('product_id', '=', $product['id'])->delete();
                foreach (json_decode($_POST['description-images']) as $key => $value) {
                    $image = $query->table('image')->insert([
                        'image_url' => $value,
                        'product_id' => $product['id'],
                        'alt' => 'description image ' . $product['name']
                    ]);
                }
                back(['success' => 'cập nhập sản phẩm thành công']);
            }
        }
        back(['error' => 'không tìm thấy sản phẩm']);
        break;
    case 'delete_get':
        $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($product)) {
            $query->table('image')->where('product_id', '=', $product['id'])->delete();
            $query->table('products')->where('id', '=', $product['id'])->delete();
            back(['success' => 'xóa sản phẩm thành công ' . $product['name']]);
        } else {
            back(['error' => 'không tìm thấy sản phẩm']);
        }
        break;
    case 'detail_get':
        $product = $query->table('products')->select([
            'users.id' => 'user_id',
            'users.name' => 'user_name',
            'category.name' =>  'category_name',
        ])->where('id', '=', $_GET['id'])->join('users', 'user_id')->join('category', 'category_id')->first();
        print_r(json_encode($product));
        break;
    default:
        echo 'không có file';
}
