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
        $db->set_charset("utf8");
        $query = "SELECT * FROM usuarios;";
        $resultado = mysqli_query($db, $query);
        $usuarios = [];
        $i = 0;
        while( $row = mysqli_fetch_assoc($resultado)){
            $usuarios[$i]['nombre'] = $row['nombre'];
            $usuarios[$i]['idUsuario'] = $row['idUsuario'];
            $usuarios[$i]['apellido'] = $row['apellido'];
            $usuarios[$i]['tipoUsuario'] = $row['tipoUsuario'];
            $usuarios[$i]['nombreUsuario'] = $row['nombreUsuario'];
            $i++;
        }
    return $usuarios;
    } catch (\Throwable $th) {
        echo $th;
    }
    mysqli_close($db);
}

?>