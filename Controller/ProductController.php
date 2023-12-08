<?php
require_once 'Request/validateFormProducts.php';
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
        $orderby = [
            ['name' => 'ngày tạo', 'value' => 'created_at',],
            ['name' => 'theo giá', 'value' => 'price',],
            ['name' => 'số lượng like', 'value' => 'count_likes',],
            ['name' => 'số  try cập sản phẩm', 'value' => 'count_views',],
            ['name' => 'số sản phẩm đã bán', 'value' => 'count_buy',],
            ['name' => 'số sản phẩm', 'value' => 'quantity',],
            ['name' => 'số bình luật', 'value' => 'count_comments',],
        ];
        $statistical_products = $query->table('products')->select([
            'count(id)' => 'total_products',
            'sum(count_buy)' => 'total_sold',
            'sum(price * quantity)' => 'total_pice',
            'sum( quantity)' => 'total_warehouse',
        ])->first();
        $product_list = $query->table('products')->select(['users.id' => 'user_id', 'users.name' => 'user_name', 'category.name' => 'category_name', 'products.*'])->join('users', 'user_id')->join('category', 'category_id')->orderBy('products.created_at')->all();
        View(
            ['layout' => 'layouts/adminLayout', 'content' => 'pages/products/table'],
            [
                'products' => $product_list,
                'orderby' => $orderby,
                'statistical_products' => $statistical_products
            ]
        );
        break;
    case 'create_get':
        $categoryList =  $query->table('category')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/form'], ['categoryList' => $categoryList]);
        break;
    case 'create_post':
        try {
            $req = validateFormProducts();
            $product = $query->table('products')->insert([
                'name' => $req['name-product'],
                'user_id' => $current_user['id'],
                'description' => $req['description-product'],
                'category_id ' => $req['category'],
                'price' => $req['price-product'],
                'feature_image' => $req['feature_image'],
                'quantity' => $req['quantity-product'],
                'discount' => $req['discount-product']
            ]);
            if (count($product) > 0) {
                if (isset($req['description-images'])) {
                    foreach (json_decode($req['description-images']) as $key => $value) {
                        $image = $query->table('image')->insert([
                            'image_url' => $value,
                            'product_id' => $product['id'],
                            'alt' => 'description image ' . $product['name']
                        ]);
                    }
                }
                back(['success' => 'tạo sản phẩm thành công']);
            } else {
                throw new Exception('tạo sản phẩm thất bai');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
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
        $req = validateFormProducts();
        if (is_array($product)) {
            $query->table('products')->where('id', '=', $product['id'])->update([
                'name' =>  $req['name-product'] ?? $product['name'],
                'description' =>  $req['description-product']  ?? $product['description'],
                'category_id ' =>  $req['category']  ?? $product['category_id'],
                'price' =>  $req['price-product'] ?? $product['price'],
                'feature_image' =>  $req['feature_image'] ?? $product['feature_image'],
                'quantity' =>  $req['quantity-product'] ?? $product['quantity-product'],
                'discount' =>  $req['discount-product'] ?? $product['discount-product']
            ]);
            $imagesDescription = json_decode($_POST['description-images'], true);
            if (is_array($product)) {
                if (isset($imagesDescription) && count($imagesDescription) > 0) {
                    $query->table('image')->where('product_id', '=', $product['id'])->delete();
                    foreach ($imagesDescription as $key => $value) {
                        $image = $query->table('image')->insert([
                            'image_url' => $value,
                            'product_id' => $product['id'],
                            'alt' => 'description image ' . $product['name']
                        ]);
                    }
                }
                back(['success' => 'cập nhập sản phẩm thành công']);
            }
        } else {
            back(['error' => 'không tìm thấy sản phẩm']);
        }
        break;
    case 'delete_get':
        $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($product)) {
            $query->table('products')->where('id', '=', $product['id'])->delete();
            back(['success' => 'xóa sản phẩm thành công ' . $product['name']]);
        } else {
            back(['error' => 'không tìm thấy sản phẩm']);
        }
        break;
    case 'detail_get':
        $product = $query->table('products')
            ->select([
                'users.name' => 'user_name',
                'users.id' => 'user_id',
                'category.name' => 'category_name',
                'category.id' => 'category_id',
                'products.*'
            ])
            ->join('users', 'user_id')
            ->join('category', 'category_id')
            ->where('products.id', '=', $_GET['id'])->first();
        if ($product) {
            $product['images'] = $query->table('image')->select()->where('product_id', '=', $product['id'])->all();
        }
        print_r(json_encode($product));
        break;
    case 'products_attributes_get':
        $products = $query->table('product_customization')->select([
            'products.name' => 'product_name',
            'products.feature_image' => 'product_feature_image',
            'products.price' => 'product_price',
            'products.id' => 'product_id',
            'product_customization.*'
        ])->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')->all();
        $products = array_map(function ($product) use ($query) {
            $attributes = $query->table('attribute_customization')->select('name')->join('attribute', 'attribute_id')->where('customization_id', '=', $product['id'])->all();
            return [...$product, 'attributes' =>  $attributes];
        }, $products);
        print_r(json_encode($products));
        break;
    default:
        View('error/404');
        break;
}
