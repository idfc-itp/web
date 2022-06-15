<?php
    require 'utilidades/funciones.php';
    $usuarios = obtenerUsuarios();
    echo json_encode($usuarios);
?>