<?php
    session_start();
    if($_SESSION['tipoUsuario'] === 'usuario'){
        header('location: ../../index.php');
    }
    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
    include '../../utilidades/heading.php';
    require '../../utilidades/database.php';
    $db = conectarDB();
    $errores = [];
    $titulo = '';
    $autor = '';
    $rutaLibro = '';
    $descripcion = '';

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
        
        if(!$rutaLibro['name']){
            $errores[] = "El archivo es Obligatorio";
        }
        $medida = 1000 * 400;
        if($rutaLibro['size'] > $medida){
            $errores[] = "El tamaño del archivo es muy pesado, intenta con otro";
        }

        if(empty($errores)){
            // Subiendo los libros al servidor
            $carpetaLibros = '../../Libros/';

            // Generando un nombre único para los libros
            $nombreArchivo = md5( uniqid( rand(), true ) );

            move_uploaded_file($rutaLibro['tmp_name'], $carpetaLibros. $nombreArchivo. ".pdf");
            $rutaReal =  '../Libros/' . $nombreArchivo. ".pdf";
            
            //Insert a la base de datos
            $query = "INSERT INTO Libros(titulo, autor, descripcion, rutaLibro) VALUES ('$titulo', '$autor', '$descripcion', '$rutaReal');";
            echo($query);
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('Location: /admin/index.php?resultado=1');
            }else{
                $errores[] = "Falló la inserción";
            }
        }else{
            // print_r ($errores);
        }
        mysqli_close($db);
    }
?>

<main class="crear">
    <div class="crear__container">    
        <h1 class="crear__heading">Crear</h1>
        <?php
            foreach ($errores as $error) : ?>
                <div class="alert error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            
        <a href="../index.php" class="formulario__button">Volver</a>
        <form action="/admin/libros/crear.php" method="POST" class="formulario" enctype="multipart/form-data">
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

            <button type="submit" class="form__button">Crear</button>

        </form>
    </div>
</main>

<?php
    include '../../utilidades/footer.php';
?>