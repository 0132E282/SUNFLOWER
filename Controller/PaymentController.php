<?php
require_once "Request/validateCheckout.php";

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
    case 'index_post':
        try {
            $req = validateFormCheckout();
            $productCart = session_get('product_cart');
            if (!empty($productCart) && count($productCart) > 0) {
                $customers = $query->table('customers')->insert([
                    'name' =>  $req['name'],
                    'phone_number' =>  $req['phone-number'],
                    'email' =>  $req['email'],
                    'detail_address' =>  $req['detail_address'],
                    'provincial_city' =>  $req['city_​province'],
                    'district' =>  $req['district'],
                    'wards' =>  $req['wards'],
                    'id_user ' => $current_user['id'] ?? 0,
                ]);
                if (!empty($customers) && count($customers) > 0) {
                    $status = $query->table('status')->select()->where('is_default', '=', 1)->first();
                    $order = $query->table('orders')->insert([
                        'customers_id' => $customers['id'],
                        'status_id' => $status['id'],
                        'shipper' =>  $req['shipper'],
                        'payment' =>  $req['payment'],
                        'note' =>  $req['note'],
                    ]);
                    if (!empty($order) && count($order) > 0) {
                        foreach ($productCart as $value) {
                            $query->table('order_item')->insert([
                                'price' => $value['price'],
                                'product_customization_id' => $value['customization_id'],
                                'order_id' => $order['id'],
                                'quantity' => $value['quantity'],
                            ]);
                        }
                    }
                }
            }
            back();
        } catch (Exception $e) {
        }
        break;
    case 'momo_post':
        try {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = "10000";
            $orderId = time() . "";
            $redirectUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
            $ipnUrl = "https://webhook.site/b3088a6a-2d17-4f8d-a383-71389a6c600b";
            $extraData = "";


            if (!empty($_POST)) {
                $partnerCode = $_POST["partnerCode"];
                $accessKey = $_POST["accessKey"];
                $serectkey = $_POST["secretKey"];
                $orderId = $_POST["orderId"]; // Mã đơn hàng
                $orderInfo = $_POST["orderInfo"];
                $amount = $_POST["amount"];
                $ipnUrl = $_POST["ipnUrl"];
                $redirectUrl = $_POST["redirectUrl"];
                $extraData = $_POST["extraData"];

                $requestId = time() . "";
                $requestType = "payWithATM";
                $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                //before sign HMAC SHA256 signature
                $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data = array(
                    'partnerCode' => $partnerCode,
                    'partnerName' => "Test",
                    "storeId" => "MomoTestStore",
                    'requestId' => $requestId,
                    'amount' => $amount,
                    'orderId' => $orderId,
                    'orderInfo' => $orderInfo,
                    'redirectUrl' => $redirectUrl,
                    'ipnUrl' => $ipnUrl,
                    'lang' => 'vi',
                    'extraData' => $extraData,
                    'requestType' => $requestType,
                    'signature' => $signature
                );
                $result = execPostRequest($endpoint, json_encode($data));
                $jsonResult = json_decode($result, true);  // decode json

                //Just a example, please check more in there

                header('Location: ' . $jsonResult['payUrl']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
        break;
}
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        )
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}
