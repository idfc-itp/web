<?php
    if(!isset($_SESSION)){
        session_start();
    }
    require '../utilidades/database.php';
    $db = conectarDB();

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
    <section class="reporte__container">
        <h1 class="admin__heading">Reporte De Usuarios</h1>
        <div class="admin__tabla">
            <table class="usuarios" id="usuarios-reporte">
                <thead class="usuarios__head">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nombre Usuario</th>
                    </tr>
                </thead>
                <tbody class="usuarios__body">
                    
                </tbody>
            </table>
        </div>
    </section>
    <script src="../Js/reporteUsuarios.js" type="module"></script>
</body>
</html>

<?php
    // $html = ob_get_clean();
    // require_once './vendor/dompdf/autoload.inc.php';
    // use Dompdf\Dompdf;
    // $dompdf = new Dompdf;
    // $options = $dompdf->getOptions();
    // $options->set(array('IsRemoteEnabled' => true));
    // $dompdf -> setOptions($options);
    // $dompdf -> loadHtml($html);
    // $dompdf -> setPaper('letter');
    // $dompdf -> render(); //En este punto es donde se comienza a crear el PDF con los datos plasmados
    // $dompdf -> stream("Repoerte.pdf", array("Attachment" => false)); //Agrega el nombre y permive previsualizar el contenido del PDF. El atributo de attachment => false permite previsualizar el documento antes de descargarlo, si el valor de esta llave es true, que es el valor por defecto, el archivo se descargará automáticamente 
?> 