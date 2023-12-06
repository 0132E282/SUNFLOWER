<?php
require_once 'Request/validateFormStatus.php';

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
        $statusList = $query->table('status')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/status'], ['statusList' => $statusList]);
        break;
    case 'create_get':
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/formStatus']);
        break;
    case 'create_post':
        try {
            $req = validateFormStatus();
            if (isset($req['is_default'])) {
                $dataDefault =  $query->table('status')->where('is_default', '=', 1)->update(['is_default' => 0]);
            }
            $dataRes = $query->table('status')->insert([
                'name' => $req['name'],
                'description' => $req['description'],
                'user_id' => $current_user['id'],
                'icon' => $req['icon'],
                'total_bill' => $req['total_bill'] ?? 0,
                'is_default' => $req['is_default'] ?? 0,
                'type' => $req['type'],
            ]);
            if (count($dataRes)) back(['success' => 'tạo trạng thái thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/formStatus'], ['statusDetail' => $statusDetail]);
        break;
    case 'update_post':
        try {
            $req = validateFormStatus();
            $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($statusDetail) && count($statusDetail) > 0) {
                if (isset($req['is_default'])) {
                    $dataDefault =  $query->table('status')->where('is_default', '=', 1)->update(['is_default' => 0]);
                }
                $query->table('status')->where('id', '=', $_GET['id'])->update([
                    'name' => $req['name'] ??   $statusDetail['name'],
                    'description' => $req['description'] ?? $statusDetail['description'],
                    'icon' => $req['icon'] ?? $statusDetail['icon'],
                    'total_bill' => $req['total_bill'] ?? 0,
                    'is_default' => $req['is_default'] ?? 0,
                    'type' => $req['type'],
                ]);
                back(['success' => 'tạo trạng thái thành công']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
