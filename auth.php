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
            redirect(site_url('index.php'));
        }
    }
    if ($action == 'login')
    {
        $result = login($params['email'] ,$params['password']);
        if (!$result)
        {
            Messeg("Username or Password Invalid");
        }else{
            redirect(site_url('index.php'));
        }
    }
}
include "tpl/tpl-auth.php";