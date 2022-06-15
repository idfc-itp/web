<?php
    session_start();
    var_dump($_SESSION);
    if(!$_SESSION['login']){
        header('location: ./login.php');
    }
    include './utilidades/heading.php';
    require './utilidades/database.php';
    
    $db = conectarDB();
    // Variable que permitirá mostrar alertas condicionales
    $resultado = $_GET['resultado']  ?? null;


    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){
        $query = "SELECT * FROM libros WHERE idLibro = $id;";
        $resultado = mysqli_query($db, $query);
        if(!$resultado->num_rows){
            header('location: /index.php');
        }
        $libro = mysqli_fetch_assoc($resultado);
        $titulo = $libro['titulo'];
        $autor = $libro['autor'];
        $descripcion = $libro['descripcion'];
        $idLibro = $libro['idLibro'];
    }else{
        header('location: /');
    }
?>
<main class="libro__info">
    <div class="libro__container">
        <h2 class="libro__info__heading"><?php echo $titulo;?></h2>
        <p class="libro__info__autor"><span class="libro__info__span">Autor: </span><?php echo $autor;?></p>
        <p class="libro__info__id"> <span class="libro__info__span">Identificador: </span> <?php echo $idLibro;?></p>
        <p class="libro__info__desc"><span class="libro__info__span">Descripción: </span><?php echo $descripcion;?></p>
    </div>

</main>
<script src="mostrarLibro.js" type="module"></script>
<?php
    mysqli_close($db);
    include "./utilidades/footer.php";
?>