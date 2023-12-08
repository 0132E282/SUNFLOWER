<?php
require_once 'validate.php';
function validateFormCheckout()
{
    $handle = [
        'name' => ['required'],
        'phone-number' => ['required', 'isNumber'],
        'shipper' => ['required'],
        'city_province' => ['required'],
        'district' => ['required'],
        'wards' => ['required'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
    ];
    return validate($handle, $message);
}
