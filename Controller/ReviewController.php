<?php
require_once 'Request/validateProductReview.php';
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
        session_exists('current_user') ?? redirect('?controller=auth');
        $reviewProduct = $query->table('product_reviews')->select(['products.name' => 'product_name', 'product_reviews.*'])->join('products', 'product_id')->paginate(25);
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/ProductReview'], ['reviewProduct' => $reviewProduct]);
        break;
    case 'detail_get':
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/detailProductReview']);
        break;
    case 'create_post':
        try {
            $req = validateProductReview();
            $query->table('product_reviews')->insert([
                'name' => $req['name'],
                'product_id' => $_GET['id'],
                'user_id' =>   $current_user['id'] ?? NULL,
                'email' => $req['email'],
                'scores' => $req['rating'],
                'text' => $req['review']
            ]);
            back(['success' => 'tạo thành công']);
        } catch (Exception $e) {
        }
        break;
    default:
        echo 'không có file';
}
