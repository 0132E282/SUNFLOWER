<?php
function View($url, $data = [])
{
    // extract biến tất cả các key của array thành một chuổi
    extract($data);
    return require_once($url . '.php');
}
