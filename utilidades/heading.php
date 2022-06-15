<?php
    if(!isset($_SESSION)){
        session_start();
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
    <link rel="stylesheet" href="/styles/style.css">
    <title>BiblioTec</title>
</head>
<body>
    <header class="header">
        <div class="header__container">
            <div class="header__flex">
                <div class="header__logo">
                    <a href="/" class="header__link">BiblioTec</a>
                </div>
                <nav class="nav">
                    <?php if($_SESSION['login']){ ?>
                        <a href="/cerrarSesion.php" class="nav__link">Cerrar Sesión</a>
                    <?php }?>
                </nav>
            </div>
        </div>
    </header>

    