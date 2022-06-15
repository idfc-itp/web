<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if($_SESSION['tipoUsuario'] === 'usuario'){
        header('location: ../../index.php');
    }
    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
    // Imports importantes
    include '../../utilidades/heading.php';
    require '../../utilidades/database.php';
    
    // Obtención del id del libro a editar
    $id = $_GET['id'];
    
    // Validar que el id obtenido es un número
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header('location: ../index.php');
    }
    
    $db = conectarDB();
    $errores = [];
    $titulo = '';
    $autor = '';
    $rutaLibro = '';
    $descripcion = '';

    // Consulta para obtener el libro a editar
    $query = "SELECT * FROM libros WHERE idLibro = $id;";
    
    $resultado = mysqli_query($db, $query);
    $libro = mysqli_fetch_assoc($resultado);
    $titulo = $libro['titulo'];
    $autor = $libro['autor'];
    $rutaLibro = $libro['rutaLibro'];
    $descripcion = $libro['descripcion'];
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        // Obtención y sanitización de datos
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $autor = mysqli_real_escape_string($db, $_POST['autor']);
        $rutaLibro = $_FILES['rutaLibro'];
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);

        if(!$titulo){
            $errores[] = 'El campo de Titulo es obligatorio';
        }
        
        if(!$autor){
            $errores[] = 'El campo de Autor es obligatorio';
        }
        
        if(!$rutaLibro){
            $errores[] = 'El archivo del libro es obligatorio';
        }
        
        if(strlen($descripcion) < 50){
            $errores[] = 'El campo de Descripción es obligatorio y debe de contener, al menos, 50 caracteres';
        }

        $medida = 1000 * 4000;
        if($rutaLibro['size'] > $medida){
            $errores[] = "El tamaño del archivo es muy pesado, intenta con otro";
        }

        if(empty($errores)){
            // Subiendo los libros al servidor
            $carpetaLibros = '../../Libros/';
            $rutaReal = '';

            if($rutaLibro['name']){
                // Se elimina el archivo previo
                unlink($carpetaLibros.$libro['rutaLibro']);
                // Generando un nombre único para los libros
                $nombreArchivo = md5( uniqid( rand(), true ) );

                move_uploaded_file($rutaLibro['tmp_name'], $carpetaLibros. $nombreArchivo. ".pdf");
                $rutaReal =  '../Libros/' . $nombreArchivo. ".pdf";
            }else{
                $rutaReal = $libro['rutaLibro'];
            }

            
            //Insert a la base de datos
            $query = "UPDATE Libros SET titulo = '$titulo', autor = '$autor', descripcion = '$descripcion', rutaLibro = '$rutaReal' WHERE idLibro = $id;";
        
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('Location: ../index.php?resultado=2');
            }else{
                $errores[] = "Falló la inserción";
            }
        }
        mysqli_close($db);
    }
?>

<main class="crear">
    <div class="crear__container">    
        <h1 class="crear__heading">Actualizar</h1>
        <?php
            foreach ($errores as $error) : ?>
                <div class="alert error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            
        <a href="../index.php" class="formulario__button">Volver</a>
        <form method="POST" class="formulario" enctype="multipart/form-data">
            <legend class="formulario__legend">Información General</legend>
            <div class="input">
                <label for="titulo">Titulo: </label>
                <input class="formulario__input" type="text" id="titulo" value="<?php echo $titulo?>" name="titulo" placeholder="Titulo del libro">
            </div>

            <div class="input">
                <label for="autor">Autor: </label>
                <input class="formulario__input" type="text" id="autor" name="autor" value="<?php echo $autor;?>" placeholder="Autor del libro">
            </div>

            <div class="input">
                <label for="descripcion">Descripcion: </label>
                <textarea name="descripcion" id="descripcion" cols="30"rows="10"> <?php echo $descripcion;?> </textarea>
            </div>

            <div class="input">
                <label for="rutaLibro">Archivo pdf: </label>
                <input type="file" name="rutaLibro" id="rutaLibro" accept=".pdf">
            </div>

            <button type="submit" class="form__button">Actualizar</button>

        </form>
    </div>
</main>

<?php
    include '../../utilidades/footer.php';
?>