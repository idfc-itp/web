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
    // Variable que permitirá mostrar alertas condicionales
    $resultado = $_GET['resultado']  ?? null;
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if($id){
            // Consulta para eliminar el usuario de la base de datos
            $query = "DELETE FROM usuarios WHERE idUsuario = ${id};";
            $consulta = mysqli_query($db, $query);
            if($consulta){
                header('location: /usuarios.php?resultado=2');
            }
        }
    }
?>

<main class="admin">
    <div class="admin__container">
        <h1 class="admin__heading">Administrador de Usuarios</h1>
        <div class="boton-contenedor">
            <a href="../index.php" class="formulario__button 
            boton-block">Volver</a>
        </div>
        <?php
            if( intval($resultado) === 1 ) {?>
                <div class="alert success">Usuario Actualizado Correctamente</div>
            <?php }elseif( intval($resultado) === 2){?>
                <div class="alert success">Usuario Eliminado Correctamente</div>
                <?php } ?>
        <div class="admin__tabla">
            <table class="usuarios">
                <thead class="usuarios__head">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nombre Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="usuarios__body">
                    
                </tbody>
            </table>
        </div>
    </div>
</main>
    <script src="../../Js/tablaUsuarios.js" type="module"></script>
<?php
    include '../../utilidades/footer.php';
?>