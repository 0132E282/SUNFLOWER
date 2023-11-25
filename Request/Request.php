<?php
function old($name)
{
    global $error;
    return isset($error[$name]) ? $error[$name]['old'] : '';
}
function input($name)
{
    return $_GET[$name] ||  $_POST[$name];
}
