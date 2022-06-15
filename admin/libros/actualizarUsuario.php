<?php
    if(!isset($_SESSION)){
        session_start();
    }
    // if($_SESSION['tipoUsuario'] === 'usuario'){
    //     header('location: ../../index.php');
    // }
    // if(!$_SESSION['login']){
    //     header('location: ../../index.php');
    // }
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
    $nombre = '';
    $apellido = '';
    $nombreUsuario = '';

    // Consulta para obtener el usuario a editar
    $query = "SELECT * FROM usuarios WHERE idUsuario = $id;";
    
    $resultado = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    $nombre = $usuario['nombre'];
    $apellido = $usuario['apellido'];
    $nombreUsuario = $usuario['nombreUsuario'];
    
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        // Obtención y sanitización de datos
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $nombreUsuario = mysqli_real_escape_string($db, $_POST['nombreUsuario']);

        if(!$nombre){
            $errores[] = 'El campo de Nombre es obligatorio';
        }
        
        if(!$apellido){
            $errores[] = 'El campo de apellido es obligatorio';
        }
        
        if(!$nombreUsuario){
            $errores[] = 'El nombre de usuario es obligatorio';
        }


        if(empty($errores)){
            
            //Insert a la base de datos
            $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', nombreUsuario = '$nombreUsuario' WHERE idUsuario = $id;";
        
            $resultado = mysqli_query($db, $query);
            if($resultado){
                header('Location: ../index.php?resultado=4');
            }else{
                $errores[] = "Falló la inserción";
            }
        }
        mysqli_close($db);
    }
?>

<main class="crear">
    <div class="crear__container">    
        <h1 class="crear__heading">Actualizar Usuario</h1>
        <?php
            foreach ($errores as $error) : ?>
                <div class="alert error">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
            
        <a href="./usuarios.php" class="formulario__button">Volver</a>
        <form method="POST" class="formulario" enctype="multipart/form-data">
            <legend class="formulario__legend">Información General</legend>
            <div class="input">
                <label for="nombre">Nombre: </label>
                <input class="formulario__input" type="text" id="nombre" value="<?php echo $nombre?>" name="nombre" placeholder="nombre del libro">
            </div>

            <div class="input">
                <label for="apellido">Apellido: </label>
                <input class="formulario__input" type="text" id="apellido" name="apellido" value="<?php echo $apellido;?>" placeholder="apellido del libro">
            </div>

            <div class="input">
                <label for="nombreUsuario">Nombre Usuario: </label>
                <input class="formulario__input" type="text" id="nombreUsuario" name="nombreUsuario" value="<?php echo $nombreUsuario;?>" placeholder="nombreUsuario del libro">
            </div>

            <button type="submit" class="form__button">Actualizar</button>

        </form>
    </div>
</main>

<?php
    include '../../utilidades/footer.php';
?>