<?php
session_start();
include_once 'Models/conexion.php';
if(!isset($_SESSION['nombre'])){ 
 header('location: login.php');
 exit();
}



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doctores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            max-width: 1200px;
            margin-top: 40px;
        }

        .form-container {
            margin-bottom: 30px;
            background-color: #fff;
            padding: 20px;
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

        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            text-align: center;
        }

        .table th {
            background-color: #6a1b9a;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f4f7fa;
        }

        .table td a {
            color: #6a1b9a;
            text-decoration: none;
        }

        .table td a:hover {
            color: #9c4dcc;
        }
    </style>
</head>
<body>

<header>
        <h1>creative smile</h1>
        <nav>
            <ul>
                <li><a href="/vistas/interfazAsistente.php">inicio</a></li>
             
                <li><a href="../registrarCita.php">Registrar cita</a></li>
                <li><a href="../mostrarDoctor.php ">Doctores</a></li>
                <li><a href="../modificarDatosAsistente.php">Actualizar datos</a> </li>
                <li><a href="../cerrarCesion.php">Cerrar Sesión </a> </li>

                

   
               
            </ul>
        </nav>
    </header>

<div class="container mt-4">
    <h2 class="text-center mb-4">Lista de doctores</h2>

    <div class="row mb-4 justify-content-center">
    <div class="col-md-8">
        <div class="d-flex gap-2">
            <form class="d-flex flex-grow-1" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" class="form-control me-2" id="nombre" name="nombre" placeholder="Buscar por nombre">
                <button type="submit" class="btn btn-info">Buscar</button>
            </form>
            <a class="btn btn-warning" href="/reportes/imprimirusuarios.php">Ver Detalles</a>
        </div>
    </div>
</div>


    <?php
        include "Models/conexion.php";
        $where = "";

        if (!empty($_POST)) {
            $valor = $_POST['nombre'];
            if (!empty($valor)) {
                $where = "WHERE nombre LIKE '%$valor%'";
            }
        }

        $sql = "SELECT d.id_usuario, u.nombre ,u.apellido,u.correo,d.id_servicio,s.especialidad 
                FROM doctor d join usuario u on d.id_usuario = u.id_usuario
                join servicios s on d.id_servicio = s.id_servicio  $where";
        $resultado = $conexion->query($sql);
    ?>
 
 

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>correo</th>
                <th>especialidad</th>
                
                
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['apellido']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><?php echo $row['especialidad']; ?></td>
                


                
            </tr>
            <?php
                }
            } else {
                echo '<tr><td colspan="7" class="text-center">No se encontraron registros</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>