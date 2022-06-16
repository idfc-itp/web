<?php
    if(!isset($_SESSION)){
        session_start();
    }
    if(!$_SESSION['login']){
        header('location: ./login.php');
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
    <title>Document</title>
</head>
<body class="body">
    <header class="header hero">
        <div class="header__container">
            <div class="header__flex">
                <div class="header__logo">
                    <a id="link" href="/" class="header__link ">BiblioTec</a>
                </div>
                <nav class="nav">
                    <?php if($_SESSION['login']){ ?>
                        <a href="cerrarSesion.php" id="link" class="nav__link">Cerrar Sesión</a>
                    <?php }?>
                </nav>
            </div>
        </div>
        <section class="hero__section">
            <div class="hero__container">
                <div class="hero__contenido">
                    <h1 class="hero__titulo">Bienvenido a BiblioTec</h1>
                </div>
            </div>
        </section>
    </header>

    <main class="libros-main">
        <div class="libros__container">
            <div class="libros__contenido">
                <h2 class="libros__heading">Libros Disponibles</h2>
                <p class="libros__desc">El siguiente listado corresponde a los libros que se encuentran disponibles en BiblioTec:</p>
                <div class="libros__grid">
                
                </div> <!-- Fin de libros__grid -->
            </div>
        </div>
    </main>
    <script src="./Js/funciones.js" type="module"></script>
    <script src="./Js/app.js" type="module"></script>
<?php
    include './utilidades/footer.php';
?>