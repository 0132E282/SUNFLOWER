<?php
require_once 'validate.php';
function validateCustomization()
{
    $handle = [
        'product' => ['required'],
        'product_code' => ['required'],
        'attribute' => ['required'],
    ];
    $message = [
        'product.required' => 'hãy chọn sản phẩm',
        'product_code.required' => 'mã sản phẩm không được để trống',
        'attribute.required' => 'thuộc tính không được để trống',
    ];
    return validate($handle, $message);
}
