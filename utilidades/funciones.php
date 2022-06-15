<?php
function obtenerLibros() : array{
    try {
        //Import de la conexión
        require 'database.php';
        $db = conectarDB();
        $db->set_charset("utf8");
        //Redacción de la consulta
        $sql = "Select * from libros;";
        $consulta = mysqli_query( $db, $sql );
        
        $libros = [];
        $i = 0;
        //Obtención de resultados
        while($row = mysqli_fetch_assoc($consulta)){
            $libros[$i]['idLibro'] = $row['idLibro'];
            $libros[$i]['titulo'] = $row['titulo'];
            $libros[$i]['autor'] = $row['autor'];
            $libros[$i]['descripcion'] = $row['descripcion'];
            $libros[$i]['rutaLibro'] = $row['rutaLibro'];
            $i++;
        }
        return  $libros;

    }catch (\Throwable $th) {
        var_dump($th);
    }
    mysqli_close($db);
}

function obtenerUsuarios() : array{
    try {
        require 'database.php';
        $db = conectarDB();
        $sql = "SELECT * FROM usuarios where tipoUsuario = 'usuario';";
        $consulta = mysqli_query($db, $sql);
        $usuarios = [];
        $i = 0;
        while($row = mysqli_fetch_assoc($consulta)){
            $usuarios[$i]['nombre'] = $row['nombre'];
            $usuarios[$i]['idUsuario'] = $row['idUsuario'];
            $usuarios[$i]['apellido'] = $row['apellido'];
            $usuarios[$i]['tipoUsuario'] = $row['tipoUsuario'];
            $i++;
        }
        return $usuarios;
    } catch (\Throwable $th) {
        echo $th;
    }
    mysqli_close($db);
}

function obtenerDescargas() : array{
    try {
        require 'database.php';
        $db = conectarDB();
        $sql = "SELECT * FROM descargas;";
        $consulta = mysqli_query($db, $sql);
        $descargas = [];
        $i = 0;
        while($row = mysqli_fetch_assoc($consulta)){
            $descargas[$i]['idUsuario'] = $row['idUsuario'];
            $descargas[$i]['idLibro'] = $row['idLibro'];
            $i++;
        }
        return $descargas;
    } catch (\Throwable $th) {
        echo $th;
    }
    mysqli_close($db);
}

?>