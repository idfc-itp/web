<?php
    require 'utilidades/funciones.php';
    $libros = obtenerLibros();
    echo json_encode($libros);
?>