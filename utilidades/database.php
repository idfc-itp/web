<?php
    require '../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    header('Access-Control-Allow-Origin: *');
    function conectarDB() : mysqli{
        $db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'] ?? '', $_ENV['DB_BD']);
        $db->set_charset("utf8");
        if(!$db){
            print("Error en la conexión");
            exit;
        }
        return $db;
    }
?>