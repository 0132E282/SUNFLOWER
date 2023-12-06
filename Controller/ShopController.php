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
        $category = $query->table('category')->select()->all();
        $products = $query->table('products')->select()->limit(25)->offset($page)->all();
        View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/index'], ['category' => $category, 'products' => $products]);
        break;
    case 'cart_get':
        $cart = session_get('product_cart');
        break;
    case 'detail_get':
        try {
            $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($product) && count($product) > 0) {
                $query->table('products')->where('id', '=',  $product['id'])->update(['count_views' =>  $product['count_views'] + 1]);
                $product['images_list'] = $query->table('image')->select(['image_url', 'alt', 'id'])->where('product_id', '=', $product['id'])->all();
                $product['images_list'][] = ['image_url' => $product['feature_image'], 'id' => $product['id']];
                $attr = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();
                foreach ($attr as $key => $value) {
                    $attr[$key]['children'] = $query->table('attribute_customization')
                        ->select()
                        ->join(
                            'product_customization',
                            'customization_id'
                        )
                        ->join(
                            'attribute',
                            'attribute_id'
                        )
                        ->where('product_customization.product_id', '=', $product['id'])->where('attribute.parent_id', '=',  $value['id'])->groupBy('attribute.id')->all();
                }
            }
            View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/detail'], ['product' => $product, 'attr' => $attr]);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'add-cart_post':
        try {
            $cart = session_get('product_cart');
            $product = $query->table('attribute_customization')
                ->select(
                    [
                        'products.feature_image' => 'feature_image',
                        'products.id' => 'product_id',
                        'products.category_id' => 'category_id',
                        'discount' => 'discount',
                        'products.name' => 'name',
                        'product_customization.id' => 'customization_id',
                        'product_customization.price' => 'customization_price',
                        'products.price' => 'products_price',

                    ]
                )
                ->join('product_customization', 'customization_id')
                ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
                ->where('product_customization.product_id', '=', $_GET['id'])
                ->whereIn('attribute_id', [...$_POST['attr']])->orderBy('products.id')->having('count(product_customization.id)', '=', 2)->all();

            $product['attributes'] = $query->table('attribute')->select()->whereIn('id', $_POST['attr'])->all();
            print_r(json_encode($product));
            exit;
            if (!empty($product) && count($product) > 0) {
                $productItem = [
                    'id' => $product['product_id'],
                    'customization_id' => $product['customization_id'],
                    'name' =>  $product['name'],
                    'quantity' => $_POST['num-product'] ?? 1,
                    'price' => $product['customization_price'] ?? $product['products_price'],
                    'images' => $product['feature_image'],
                    'attr' => count($product['attributes']) > 0 ? array_map(function ($attr) {
                        return ['name' => $attr['name'], 'id' => $attr['id']];
                    }, $product['attributes']) : [],
                ];
                $coderProduct = $_GET['id'] . $product['customization_id'];
                if (isset($cart[$coderProduct])) {
                    $cart[$coderProduct]['quantity'] += $_POST['num-product'] ?? 1;
                } else {
                    $cart[$coderProduct] = $productItem;
                }
                session_push('product_cart', $cart);
                print_r(json_encode(session_get('product_cart')));
            }
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
