<?php

    session_start();
    if($_SESSION['tipoUsuario'] === 'usuario'){
        header('location: ../index.php');
    }
    if(!$_SESSION['login']){
        header('location: ../index.php');
    }
    // Variable que permitirá mostrar alertas condicionales
    $resultado = $_GET['resultado']  ?? null;

    include '../utilidades/heading.php';
    require '../utilidades/database.php';
    
    $db = conectarDB();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id){
            // Eliminar el archivo pdf
            $query = "SELECT rutaLibro FROM libros  WHERE idLibro = ${id};";
            $resultado = mysqli_query($db, $query);
            $libro = mysqli_fetch_assoc($resultado);
            unlink($libro['rutaLibro']);

            // Consulta para eliminar el libro de la base de datos
            $query = "DELETE FROM libros WHERE idLibro = ${id};";
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('location: /admin/index.php?resultado=3');
            }
        }
    }
?>

<main class="admin">
    <div class="admin__container">
        <h1 class="admin__heading">Administrador de Libros</h1>
        <?php
            if( intval($resultado) === 1 ) {?>
                <div class="alert success">Libro Creado Correctamente</div>
            <?php }elseif( intval($resultado) === 2){?>
                <div class="alert success">Libro Actualizado Correctamente</div>
                <?php } elseif( intval($resultado) === 3 ){?>    
                <div class="alert success">Libro Eliminado Correctamente</div>
                <?php } elseif( intval($resultado) === 4 ){?>    
                <div class="alert success">Usuario Actualizado Correctamente</div>
                <?php } elseif( intval($resultado) === 5 ){?>    
                <div class="alert success">Usuario Eliminado Correctamente</div>
                <?php } ?>
        <nav class="navegacion">
            <a href="./libros/crear.php" class="navegacion__link">Nuevo Libro</a>
            <a href="./libros/usuarios.php" class="navegacion__link">Ver Usuarios</a>
            <a href="reporte.php" class="navegacion__link">Generar Reporte</a>
        </nav>
        <div class="admin__tabla">
            <table class="libros">
                <thead class="libros__head">
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Ruta del Libro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="libros__body">
                    
                </tbody>
            </table>
        </div>
    </div>
</main>
    <script src="../Js/tablaLibros.js" type="module"></script>
<?php
    include '../utilidades/footer.php';
?>