<?php
function View($view = [], $data = [])
{
    // extract biến tất cả các key của array thành biến
    global $message;
    extract($data);
    if (is_array($view)) extract($view);

    return require(is_array($view) ? $layout . '.php' : $view . '.php');
}
function back($with = [])
{
    if (is_array($with)) {
        session_push('message', $with);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
function redirect($url, $with = [])
{
    if (is_array($with)) {
        session_push('message', $with);
    }
    header('Location: ' . $url);
}
