<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

$mensaje = "";

if (isset($_POST['guardar'])) {
    // Recoger datos del formulario
    $idInmueble = $_POST['doc'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $estrato = $_POST['estrato'];
    $areaConstruida = $_POST['Area_construida'];
    $numBaños = $_POST['N_baños'];
    $numHabitaciones = $_POST['N_habitaciones'];
    $numPisos = $_POST['N_pisos'];
    $N_cocinas = $_POST['Cocina'];
    $garaje = $_POST['Garaje'];
    $patio = $_POST['Patio'];
    $estudio = $_POST['Estudio'];
    $descripcion = $_POST['descripcion']; // Nueva línea para recoger la descripción
    $categoriaId = $_POST['categoria'];
    $contacto = $_POST['contacto'];
    $precio = str_replace('$', '', $_POST['precio']);
    $precio = trim($precio);

    // Verificar que los campos requeridos no estén vacíos
    if (empty($idInmueble) || empty($localidad) || empty($direccion) || empty($estrato) || empty($areaConstruida) || empty($numBaños) || empty($numHabitaciones) || empty($numPisos) || empty($categoriaId) || empty($contacto) || empty($precio)) {
        echo '<div class="alert alert-danger" role="alert">Por favor, complete todos los campos obligatorios.</div>';
    } else {
        // Consulta de inserción para el inmueble
        $insercion = "INSERT INTO tblinmueble (Precio, Localidad, Dirección, Estrato, Area_construida, NumeroPisos, Habitaciones, Baños, Cocina, Garaje, Patio, Estudio, Descripcion, Contacto, codigoc) 
        VALUES ('$precio', '$localidad', '$direccion', '$estrato', '$areaConstruida', '$numPisos', '$numHabitaciones', '$numBaños', '$N_cocinas', '$garaje', '$patio', '$estudio', '$descripcion', '$contacto', '$categoriaId')";

        // Ejecutar consulta de inserción del inmueble
        if (mysqli_query($con, $insercion)) {
            echo '<div class="alert alert-success" role="alert">Inmueble registrado correctamente.</div>';

            // Recoger el ID del inmueble insertado
            $idInmueble = mysqli_insert_id($con);

            // Procesar las imágenes
            if (isset($_FILES['imagenes']['name']) && is_array($_FILES['imagenes']['name'])) {
                $uploadDirectory = 'imagenes/';

                foreach ($_FILES['imagenes']['name'] as $key => $name) {
                    if ($_FILES['imagenes']['error'][$key] === UPLOAD_ERR_OK) {
                        $fileExtension = pathinfo($name, PATHINFO_EXTENSION);
                        $uniqueName = uniqid('img_') . '_' . time() . '.' . $fileExtension;
                        $uploadPath = $uploadDirectory . $uniqueName;

                        if (move_uploaded_file($_FILES['imagenes']['tmp_name'][$key], $uploadPath)) {
                            $rutaImagen = $uploadPath;
                            $sql = "INSERT INTO imagenesinmuebles (IdInmueble, RutaImagen) VALUES ('$idInmueble', '$rutaImagen')";
                            if (!mysqli_query($con, $sql)) {
                                $mensaje .= 'Error al guardar la ruta de la imagen en la base de datos: ' . mysqli_error($con) . '<br>';
                            }
                        } else {
                            $mensaje .= 'Error al mover el archivo cargado.<br>';
                        }
                    }
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al crear el registro: ' . mysqli_error($con) . '</div>';
        }
    }
}

if (!empty($mensaje)) {
    echo '<div class="alert alert-info" role="alert">' . $mensaje . '</div>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Captura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../codigo_css/createimg.css">
</head>

<body>
    <div class="container">
        <div class="text-center">
            <h1 class="mt-5">REGISTRO DE INMUEBLES</h1>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="doc" class="form-label">Numero de Inmueble (ID)</label>
                <input type="number" class="form-control" name="doc" size="5">
            </div>
            <div class="mb-3">
                <label for="imagenes" class="form-label">Subir imágenes:</label>
                <input type="file" class="form-control" name="imagenes[]" accept="image/*" multiple id="imagenes">
            </div>
            <div id="image-preview" class="image-preview"></div>

            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio" placeholder="no incluir el signo $ en el precio.">
                <div class="invalid-feedback">
                    Debe incluir el signo $ en el precio.
                </div>
            </div>
            <div class="mb-3">
                <label for="localidad" class="form-label">Localidad</label>
                <input type="text" class="form-control" name="localidad" size="10">
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"></textarea>
           
