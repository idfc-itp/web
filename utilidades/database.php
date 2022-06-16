<?php
    header('Access-Control-Allow-Origin: *');
    function conectarDB() : mysqli{
        // $db = mysqli_connect('localhost', 'u597798595_root', 'Di mi nombre1', 'u597798595_bibliotec');
        $db = mysqli_connect('localhost', 'root', '', 'bibliotec');
        $db->set_charset("utf8");
        if(!$db){
            print("Error en la conexión");
            exit;
        }
        return $db;
    }
?>