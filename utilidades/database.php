<?php
    header('Access-Control-Allow-Origin: *');
    function conectarDB() : mysqli{
        $db = mysqli_connect('localhost', 'root', '', 'bibliotec');
        $db->set_charset("utf8");
        if(!$db){
            print("Error en la conexión");
            exit;
        }
        return $db;
    }
?>