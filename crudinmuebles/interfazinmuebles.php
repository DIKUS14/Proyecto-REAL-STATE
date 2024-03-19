<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener el ID del inmueble desde la URL
$idInmueble = isset($_GET['id']) ? $_GET['id'] : null;

// Validar que se proporcionó un ID de inmueble válido
if (!$idInmueble) {
    echo 'ID de inmueble no válido.';
    exit;
}

// Consultar la información del inmueble por su ID
$consultaInmueble = "SELECT * FROM TBLInmueble WHERE IdInmueble = $idInmueble";
$resultado = mysqli_query($con, $consultaInmueble);

// Validar que se encontró el inmueble
if (!$resultado || mysqli_num_rows($resultado) === 0) {
    echo 'Inmueble no encontrado.';
    exit;
}

// Obtener los datos del inmueble
$datosInmueble = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Inmueble</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../codigo_css/pag.css">
    <link rel="stylesheet" href="../codigo_css/styleinterfazin.css">

    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mina&display=swap" rel="stylesheet">
</head>

<body>
<header>
    <!-- Barra de navegacion -->
    <!-- Aquí va la barra de navegación -->
</header>

<div class="container">
    <!-- Título de la localidad -->
    <h1 class="text-center d-flex">Sector <?= $datosInmueble['Localidad'] ?></h1>
    <br>

    <!-- Carrusel de imágenes -->
    <!-- Aquí va el carrusel de imágenes -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicadores del carrusel -->
        <!-- Aquí van los indicadores del carrusel -->

        <!-- Imágenes del carrusel -->
        <!-- Aquí van las imágenes del carrusel -->

        <!-- Controles de navegación del carrusel -->
        <!-- Aquí van los controles de navegación del carrusel -->
    </div>

    <!-- Descripción del inmueble -->
    <div class="mt-4">
        <h3>Descripción del Inmueble</h3>
        <p><?= $datosInmueble['descripcion'] ?></p>
    </div>
    <br><br><br><br>

    <!-- Características del inmueble -->
    <div class="columna row mt-12">
        <!-- Aquí van las características del inmueble -->
    </div>

    <!-- Precio del inmueble -->
    <div class="pre col-lg-6">
        <!-- Aquí va el precio del inmueble -->
    </div>

    <!-- Ubicación del inmueble -->
    <h1>Ubicación</h1>
    <br>
    <!-- Aquí va la imagen de la ubicación -->

    <br><br>
    <h1>Recomendación</h1>
</div>

<!-- Footer -->
<!-- Aquí va el footer -->

<!-- Scripts de Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
