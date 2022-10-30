<?php
session_start();

if (!isset($_SESSION['user_array']) ) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>DAWBI-M07-Pt11</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include_once "topmenu.php"; ?>
    <div class="container-fluid">
        <div class="container" style="text-align: center;">
            <h2>Menús del dia</h2>
            <br>
            <section class="wrap">
                <div class="column-3 columns">
                    <h3>Menú mediodia</h3>
                    <div class="container-fluid" style="background-size: cover;">
                        <hr>
                        <h4>Primeros Platos</h4>
                        <p>Arroz con setas</p>
                        <p>Ensalada mixta</p>
                        <p>Patatas a lo pobre.</p>
                        <p>Gazpacho de la casa</p>
                        <br>
                        <h4>Segundos Platos</h4>
                        <p>Chuleton de burgos</p>
                        <p>Filete de salmon brasado</p>
                        <p>Entrecot con pimienta blanca</p>
                        <p>Revuelto de alcachofas</p>
                        <br>
                        <p class="precio-menu">
                            Precio:
                            <span style="background-color: yellow;">17€</span>
                        </p>
                    </div>
                    <div class="container-fluid" style="background-size: cover;">
                        <h3>Menú noche</h3>
                        <hr>
                        <h4>Primeros Platos</h4>
                        <p>Arroz con setas</p>
                        <p>Ensalada mixta</p>
                        <p>Patatas a lo pobre</p>
                        <p>Gazpacho de la casa</p>
                        <br>
                        <h4>Segundos Platos</h4>
                        <p>Chuleton de burgos</p>
                        <p>Filete de salmon brasado</p>
                        <p>Entrecot con pimienta blanca</p>
                        <p>Revuelto de alcachofas</p>
                        <br>
                        <p class="precio-menu">
                            Precio:
                            <span style="background-color: yellow;">20€</span>
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <?php include_once "footer.php"; ?>
    </div>
</body>

</html>