<?php

include "Boostrap/init.php";

$home_page = site_url();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $action = $_GET['action'];
    $params = $_POST;
    if ($action == 'register')
    {
        $result = register($params);
        if (!$result)
        {
            Messeg("Error : an error in registration!!");
        }else{
            Messeg("register is successfully !! Welcome . <br><a href='$home_page'>Back to HomePage...</a>");
        }
    }
    if ($action == 'login')
    {
        $result = login($params['email'] ,$params['password']);
        if (!$result)
        {
            Messeg("Username or Password Invalid");
        }else{
            Messeg("You are now Logged In.<br><a href='{$home_page}'>Manage Your Tasks</a>",'success');
        }
    }
}
include "tpl/tpl-auth.php";