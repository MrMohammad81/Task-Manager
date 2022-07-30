<?php
defined('BASE_PATH')  or die("Permision Denied");
function GetCurrentUrl(): int
{
    return 1;
}

function power($p , $b)
{
    return $p**$b;
}

 function asset(string $path): string
{
    return APP_URL . '/assets/' . $path;
}

function diePage($msg)
{
    echo "<div style='margin: 95px 400px; background-color: lavender; padding: 50px; border-radius: 5px; border: 1px solid; font-family: sans-serif'>$msg</div>";
    die();
}

function Messeg($msg , $cssClass = 'info')
{
    echo "<div class='$cssClass' style='margin: 10px auto; background-color: lavender;text-align: center ; width: 40% ; padding: 20px; border-radius: 5px; border: 1px solid; font-family: sans-serif'>$msg</div>";
}
# is ajax request
function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {
        return true;
    }
    return false;
}

# die and dump
function dd($var)
{
    echo "<pre style='color: rebeccapurple; background-color: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #1276ab;'>";
    var_dump($var);
    echo "</pre>";
}

function site_url($uri = '')
{
    return BASE_URL .$uri;
}
