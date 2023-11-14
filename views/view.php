<?php
function View($view = [], $data = [])
{
    try {
        // extract biến tất cả các key của array thành một chut
        extract($data);
        if (is_array($view)) extract($view);
        return require_once(is_array($view) ? $layout . '.php' : $view . '.php');
    } catch (\Exception $e) {
        echo $e->getMessage();
    }
}
