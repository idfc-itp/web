<?php
    require './utilidades/database.php';
    $db = conectarDB();
    $errores = [];
    $alerta = [];
    $nombreUsuario = '';
    $nombre = '';
    $apellido = '';
    $password = '';
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        // Obtención y sanitización de datos
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $nombreUsuario = mysqli_real_escape_string($db, $_POST['nombreUsuario']);
        $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if(!$nombre ||  !$nombreUsuario || !$apellido || !$password ){
            $errores[] = "Todos los campos son obligatorios";        
        }
        if(empty($errores) && $nombreUsuario != ''){
            $query = "SELECT * FROM usuarios WHERE nombreUsuario='$nombreUsuario';";
            $resultado = mysqli_query($db, $query);
            $usuario = mysqli_fetch_assoc($resultado);
            if(!$usuario){
                //Insert a la base de datos
                $query = "INSERT INTO usuarios(nombre, nombreUsuario, apellido, password, tipoUsuario) VALUES ('$nombre', '$nombreUsuario', '$apellido', '$passwordHash', 'usuario');";
                $resultado = mysqli_query($db, $query);
                if($resultado){
                    header('Location: login.php?resultado=1');
                }else{
                    $errores[] = "Falló la inserción";
                }
            }else{
                $errores[] = "Usuario ya existente, intenta con otro";             
            }
        }
    }
    mysqli_close($db);
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
    <title>Crear una Cuenta</title>
</head>
    <main class="registro registro-degradado">
        <div class="registro__container">
            
        <?php
                foreach ($errores as $error) : ?>
                    <div class="alert error">
                        <?php echo $error; ?>
                    </div>
                <?php endforeach; ?>
            
            <div class="registro__content">
                <form method="POST" class="formulario__registro" action="register.php">
                    <div class="input">
                        <label for="nombre" class="input__label">Nombre: </label>
                        <input type="text" class="formulario__input input-nombre" placeholder="Nombre" value="<?php echo $nombre; ?>" name="nombre">
                    </div>
                    <div class="input">
                        <label for="apellido" class="input__label">Apellido: </label>
                        <input type="text" value="<?php echo $apellido; ?>" name="apellido" class="formulario__input input-apellido" placeholder="Apellido">
                    </div>
                    <div class="input">
                        <label for="usuario" class="input__label">Usuario: </label>
                        <input type="text"   name="nombreUsuario" value="<?php echo $nombreUsuario; ?>" class="formulario__input input-usuario" placeholder="Usuario">
                    </div>
                    <div class="input">
                        <label for="password" class="input__label">Contraseña: </label>
                        <input type="password" value="<?php echo $password; ?>"  name="password" name="password" class="formulario__input input-password"  placeholder="Contraseña">
                    </div>
                    <div class="form__buttons">
                    <button type="submit" class="form__button">Crear Cuenta</button>
                    <a href="./login.php" class="form__button">Cancelar</a>
                </div>
                </form>
            </div>
        </div>
    </main>
    <script src="./Js/consultarUsuarios.js" type="module"></script>
</body>
</html>