<?php

include "constant.php";
include BASE_PATH."Boostrap/config.php";
include BASE_PATH."vendor/autoload.php";
include BASE_PATH."libs/helpers.php";

# connect to database with PDO
global $database_config;
try {
    $pdo = new PDO("mysql:host=$database_config->host;dbname=$database_config->dbname;charset=$database_config->charset", $database_config->user, $database_config->password);
}catch (PDOException $e){
    diePage('Connection Failed : ' . $e -> getMessage());
};

include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."libs/lib-tasks.php";

