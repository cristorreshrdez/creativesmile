<?php
session_start();
include_once 'Models/conexion.php';
if(!isset($_SESSION['nombre'])){ 
 header('location: login.php');
 exit();
}

$nombreUsuario = $_SESSION['nombre'];

?>

<?php

include_once 'Models/conexion.php';


$row = [];

if (isset($_SESSION['id_usuario'])) {
    $id = $_SESSION['id_usuario'];
    $resultado = $conexion->query("SELECT * FROM usuario WHERE id_usuario = '$id'");
    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_array(MYSQLI_ASSOC);
    }
}

?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e0bbff, #957dad); /* Color de fondo degradado */
        }

        header {
            background-color: #6a1b9a;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 2em;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.1em;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #9c4dcc;
        }

        .container {
            max-width: 900px;
            margin-top: 40px;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-size: 1.1em;
            color: #6a1b9a;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .btn {
            background-color: #6a1b9a;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #9c4dcc;
        }
    </style>
</head>
<body>
<header>
        <h1>creative smile</h1>
        <nav>
            <ul>
            <li><a href="/vistas/interfazAdministrador.php">inicio</a></li> 
               <li><a href="../mostrarUsuario.php">Gestión de Roles</a></li>
               <li><a href="../enviarCorreo.php">Enviar correo</a></li>
               <li> <a href="../modificarDatosAdministrador.php">Actualizar datos </a></li>
                <li> <a href="../cerrarCesion.php">Cerrar Sesión </a></li>

                

   
               
            </ul>
        </nav>
    </header>

    <div class="container">
        <p class="h1 text-center text-primary">Modificar datos</p>
        <div class="form-container">

        <?php
    include "controllers/ModificarDatosAdministrador.php";
 
?>

            <form action="" method="POST" enctype="multipart/form-data">
                
            <input type="hidden" class="form-control" id="id" value="<?php echo isset($_GET['id_usuario']) ? htmlspecialchars($_GET['id_usuario']) : ''; ?>" name="id">

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" name="nom">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" value="<?php echo $row['apellido']; ?>" name="ape">
                </div>
                <div class="mb-3">
    <label for="tipo_identificacion">Tipo de identificación</label>
    <select name="tip" id="tipo_identificacion" class="form-control">
        <option value="">Seleccione tipo de identificación</option>
        <option value="tarjeta_identidad" <?php if($row['tipo_identificacion'] == "tarjeta_identidad") echo "selected"; ?>>Tarjeta de Identidad</option>
        <option value="cedula_ciudadania" <?php if($row['tipo_identificacion'] == "cedula_ciudadania") echo "selected"; ?>>Cédula de Ciudadanía</option>
        <option value="cedula_extranjera" <?php if($row['tipo_identificacion'] == "cedula_extranjera") echo "selected"; ?>>Cédula Extranjera</option>
        <option value="pasaporte" <?php if($row['tipo_identificacion'] == "pasaporte") echo "selected"; ?>>Pasaporte</option>
    </select>
</div>
                <div class="mb-3">
                    <label for="fecha_de_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_de_nacimiento" value="<?php echo $row['fecha_de_nacimiento']; ?>" name="fec">
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="text" class="form-control" id="correo" value="<?php echo $row['correo']; ?>" name="cor">
                </div>
                
               
                <div class="mb-3">
                    <label for="Direccion" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="Direccion" value="<?php echo $row['Direccion']; ?>" name="Dir">
                </div>

                

                <button type="submit" class="btn btn-block" name="modificar" value="ok">Modificar</button>
            </form>
        </div>
    </div>
</body>
</html>