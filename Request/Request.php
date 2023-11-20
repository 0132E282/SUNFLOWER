<?php
function input($name)
{
    if (!empty($_POST[$name]) && $_POST[$name] != '') {
        return $_POST[$name];
    } else if (!empty($_POST[$name]) && $_POST[$name] != '') {
        return $_POST[$name];
    }
}
