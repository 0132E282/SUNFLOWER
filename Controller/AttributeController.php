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
        $attributeList = $query->table('attribute')->select()->orderBy('created_at')->all();
        if (!empty($_GET['id'])) {
            $detailAttribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        }
        $parentAttribute = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();
        $parentAttributeList =  renderParentAttribute($parentAttribute, $query);
        View(
            [
                'layout' => 'layouts/adminLayout',
                'content' => 'pages/products/attribute'
            ],
            [
                'parentAttribute' => $parentAttribute,
                'attributeList' => $parentAttributeList,
                'detailAttribute' => $detailAttribute ?? []
            ]
        );
        break;
    case 'create_post':
        $attribute = $query->table('attribute')->insert([
            'name' => input('name'),
            'value' => input('value'),
            'static_path' => input('static_path'),
            'parent_id' => input('parent_id'),
            'type' => input('type'),
            'user_id' => $current_user['id'],
            'description' => input('description')
        ]);
        if (is_array($attribute)) {
            back(['success' => 'tạo thuộc tính thành công']);
        }
        break;
    case 'update_post':
        $attribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($attribute)) {
            $query->table('attribute')->where('id', '=', $attribute['id'])->update([
                'name' => input('name') ?? $attribute['name'],
                'value' => input('value') ?? $attribute['value'],
                'static_path' => input('static_path') ?? $attribute['static_path'],
                'parent_id' => input('parent_id') ?? $attribute['parent_id'],
                'type' => input('type') ?? $attribute['type'],
                'description' => input('description') ?? $attribute['description']
            ]);
            back(['success' => 'tạo thuộc tính thành công']);
        }

        break;
    case 'delete_get':
        $attribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($attribute)) {
            $attributeChill = $query->table('attribute')->select()->where('parent_id', '=', $attribute['id'])->all();
            if (count($attributeChill) > 0) {
                back(['error' => 'bạn không thể xóa thuộc tính vì nó là cao nhất']);
            } else {
                $query->table('attribute')->where('id', '=', $_GET['id'])->delete();
                back(['error' => 'xóa thành công']);
            }
        }

        break;
    case 'customization_get':
        $attr_list = renderParentAttributeChill($query->table('attribute')->select()->where('parent_id', '=', 0)->all(), $query);
        $customizationList = $query->table('product_customization')->select(['products.name' => 'product_name', 'product_customization.*'])->join('products', 'product_id')->all();
        $products = $query->table('products')->select()->orderBy('created_at')->all();
        if (!empty($_GET['id'])) {
            $productDetail = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
        }
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/customization'], [
            'attr_list' => $attr_list,
            'products' => $products,
            'productDetail' => $productDetail ?? [],
            'customizationList' => $customizationList
        ]);
        break;
    case 'create_customization_post':
        $customization = $query->table('product_customization')->insert([
            'product_id' => input('product'),
            'price' => input('product_price'),
            'quantity' => input('product_quantity'),
            'code' => input('product_code'),
            'weight' => input('product_weight'),
        ]);
        if (count($customization) > 0) {
            foreach (input('attribute') as $key => $value) {
                $attribute = $query->table('attribute')->select()->where('id', '=', $value)->first();
                $query->table('attribute_customization')->insert([
                    'customization_id' => $customization['id'],
                    'attribute_id' => $attribute['id'],
                    'parent_id' => $attribute['parent_id'],
                ]);
            }
            back(['success' => 'tạo thành công']);
        }
        break;
    default:
        echo 'không có file';
}
function renderParentAttribute($dataAttribute, $query, $render = [])
{
    foreach ($dataAttribute as $value) {
        $attributeList =  $query->table('attribute')->select()->where('parent_id', '=', $value['id'])->all();
        if (count($attributeList) > 0 && is_array($attributeList)) {
            array_push($render, $value, ...renderParentAttribute($attributeList, $query));
        } else {
            if ($value['parent_id'] != 0) {
                $value['name'] = '-- ' . $value['name'];
            }
            array_push($render, $value);
        }
    }
    return $render;
}
function renderParentAttributeChill($dataAttribute, $query, $render = [])
{
    foreach ($dataAttribute as $value) {
        $attributeList =  $query->table('attribute')->select()->where('parent_id', '=', $value['id'])->all();
        if (count($attributeList) > 0 && is_array($attributeList)) {
            $value['children'] = renderParentAttribute($attributeList, $query);
            array_push($render, $value);
        } else {
            array_push($render, $value);
        }
    }
    return $render;
}