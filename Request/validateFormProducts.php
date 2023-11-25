<?php
require_once 'validate.php';
function validateFormProducts()
{
    $handle = [
        'name-product' => ['required', 'minLength:4'],
        'category' => ['required'],
        'quantity-product' => ['required', 'isNumber'],
        'feature_image' => ['required'],
        'discount-product' => ['isNumber'],
        'price-product' => ['required', 'isNumber'],
    ];
    $message = [
        'name-product.required' => 'tên không được để trống',
        'category.required' => 'phải chọn danh mục sản phẩm',
        'quantity-product.required' => 'số lượng sản phẩm không được để trống',
        'quantity-product.isNumber' => 'số lượng sản phẩm sản phẩm phải là số',
        'feature_image.required' => 'ảnh không được để trống',
        'price-product.required' => 'không được để trống',
        'price-product.isNumber' => 'giá sản phẩm phải là số',
        'discount-product.isNumber' => 'giả giảm phải là số'

    ];
    return validate($handle, $message);
}
