<?php
    require './utilidades/database.php';
    $db = conectarDB();

    $errores = [];
    $resultado = '';
    $usuarioNombre = '';
    $pass = '';
    
    $resultado = $_GET['resultado'] ?? null;
    // Obtención de datos del formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // Sanitización de los datos
        $usuarioNombre = mysqli_real_escape_string($db, $_POST['usuario']);
        $pass = mysqli_real_escape_string($db, $_POST['password']);
        // Verificación de los campos
        if($usuarioNombre === '' || $pass === ''){
            $errores[] = 'Todos los campos son obligatorios';
        }
        if(empty($errores)){
            // Query para revisar si un usuario existe
            $query = "SELECT * FROM usuarios Where nombreUsuario = '$usuarioNombre';";
            $consulta = mysqli_query($db, $query);

            if($consulta->num_rows){
                $usuario = mysqli_fetch_assoc($consulta);
                
                // Verifica si el password es correcto
                $correcto = password_verify($pass, $usuario['password']);
                // Password erroneo
                if(!$correcto){
                    $errores[] = 'Contraseña Incorrecta';
                }else{
                    // Password correcto
                    session_start();

                    // Se llena el arreglo de sesión con información del usuario
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['tipoUsuario'] = $usuario['tipoUsuario'];
                    $_SESSION['login'] = true;

                    if($usuario['tipoUsuario'] === 'admin'){
                        header('location: ./admin/index.php');
                    }else{
                        header('location: index.php');
                    }
                }
            }else{
                $errores[] = "El usuario no existe";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Login</title>
</head>
    <main class="login login-degradado">
        <div class="login__container">
            <h2 class="login__heading">Iniciar Sesión</h2>
            <div class="login__parent">
                <?php if(  intval($resultado) === 1 ):?>
                    <div class="alert success">Usuario creado correctamente</div>
                <?php endif;?>
                <?php if(  $errores ):?>
                    <div class="alert error"><?php echo $errores[0]?></div>
                <?php endif;?>
                <div class="login__content">
                    <form method="POST">
                        <legend class="login__legend">Email y Password</legend>

                        <label for="usuario" class="formulario__label">Usuario: </label>
                        <input type="text" name="usuario" class="formulario__input" value="<?php echo $usuarioNombre;?>">
                        <label for="password" class="formulario__label">Contraseña: </label>
                        <input type="password" name="password" class="formulario__input">
                        <input type="submit" value="Iniciar Sesión" class="form__button input-submit">
                        <a href="./register.php" class="form__button">Crear Cuenta</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="./Js/funciones.js" type="module"></script>
    <script src="./Js/validarLogin.js" type="module"></script>
    <!-- <script src="./Js/app.js"></script> -->
    <?php
        mysqli_close($db);
    ?>
</body>
</html>
