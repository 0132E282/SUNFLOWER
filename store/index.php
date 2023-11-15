<?php

function upload_file($file, $option = [])
{
    $typeAllow = ['jpg', 'jpeg', 'png', 'doc', 'jpeg', 'gif', 'pptx', 'xls', 'rar'];
    $sizeAllow = $option['size'] ?? 5;
    $store = !empty($option['store']) ? 'store/' . $option['store'] : 'store';
    $error = [];
    // tách filename thành một array mỗi khi có dấu chấm
    $filenameArr = explode('.', $file['name']);
    // lấy phần tử array cuối cùng của mảng (lấy đôi mởi rộng)
    $ext = end($filenameArr);
    // tạo một di sử dụng uniqid rồi bâm thành chuổi kí tự gắn đuôi của $text vào
    $newFileName = md5(uniqid()) . '.' . $ext;
    if (in_array($ext, $typeAllow)) {
        $size = $file['size'] / 1024 / 1024; // đổi size byte thành mb bytes / 1024 = kilobytes / 1024 = mb
        if ($size <= $sizeAllow) {
            $upload = move_uploaded_file($file['tmp_name'], $store . '/' . $newFileName);
            if (!$upload) return $error[] = 'tải lên không thành công';
            return $store . '/' . $newFileName;
        } else {
            return $error[] = 'size của nó phải <=' . $sizeAllow;
        }
    } else {
        return $error[] = 'type của file phải có đuôi ' . join(',', $typeAllow);
    }
}
