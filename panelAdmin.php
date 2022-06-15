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
    <header class="header-degradado">
        <div class="header__container">
            <div class="header-blanco">
                <div class="header__flex">
                    <div class="header__logo">
                        <a href="/" class="header__link">BiblioTec</a>
                    </div>
                    <nav class="nav">
                        <a href="" class="nav__link">Mi Perfil</a>
                        <a href="" class="nav__link">Logout</a>
                    </nav>
                </div>
        </div>
    </header>
    <main class="panel">
        <div class="panel__grid">
            <div class="panel__content">
                <div class="panel__content panel__container">
                    <div class="panel__usuarios panel-card">
                        <h2 class="panel__heading">Usuarios</h2>
                        <div class="usuarios"></div>
                    </div>
                    <div class="panel__libros panel-card">
                    <h2 class="panel__heading">Libros</h2>
                    </div>
                </div>
            </div>
            <aside class="sidebar">
                <div class="sidebar__container">
                    <div class="sidebar__links">
                        <a href="" class="sidebar__link sidebar__link-selected">Usuarios</a>
                        <a href="" class="sidebar__link">Libros</a>
                        <a href="" class="sidebar__link">Descargas</a>
                    </div>
                </div>
            </aside>
        </div>
    </main>
    <script src="./Js/consultarUsuarios.js" type="module"></script>
    <!-- <script src="./Js/app.js" type="module"></script> -->
<?php
    include './utilidades/footer.php';
?>