<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui4
$current_user = session_get('current_user');
$query = new Query();
switch ($action) {
    case 'index_get':
        $page = 25 * ($_GET['page'] - 1);
        $products = $query->table('products')->select()->limit(25)->offset($page)->all();
        break;
    case 'cart_get':
        $cart = session_get('product_cart');
        break;
    case 'detail_get':
        try {
            $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
            if (count($product) > 0) {
                $query->table('products')->where('id', '=',  $product['id'])->update(['count_likes' =>  $product['count_likes'] + 1]);
                // View(['layout' => 'layouts/adminLayout', 'content' => 'pages/shop/detail']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'create_get':
        try {
            $cart = session_get('product_cart');
            $productItem = [
                'name' => $_POST['name'] ?? "Áo sơ mi nam dài tay Aristino ALS12102 màu Xanh tím than",
                'quantity' => $_POST['quantity'] ?? 123,
                'price' => $_POST['price'] ?? 123,
                'images' => $_POST['images'] ?? "Áo sơ mi nam dài tay Aristino ALS12102 màu Xanh tím than",
                'options' => $_POST['options'] ?? ['s', 'do'],
            ];
            if (isset($cart[$_GET['id']]) && array_intersect_assoc($cart[$_GET['id']]['options'], $productItem['options'])) {
                $cart[$_GET['id']]['quantity'] += $_POST['quantity'];
            } else {
                $cart[$_GET['id']] = $productItem;
            }
            session_push('product_cart', $cart);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete':
        $cart = session_get('product_cart');
        if (isset($cart['id'])) {
            unset($cart[$_GET['id']]);
        }
        session_push('product_cart', $cart);
        break;
    default:
        echo 'không có file';
}
