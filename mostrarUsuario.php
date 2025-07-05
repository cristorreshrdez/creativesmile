<?php
session_start();
include_once 'Models/conexion.php';
if(!isset($_SESSION['nombre'])){ 
 header('location: login.php');
 exit();
}

$nombreUsuario = $_SESSION['nombre'];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a53887caa8.js" crossorigin="anonymous"></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom, #e0bbff, #957dad); /* Color de fondo morado */
    margin: 0; /* Eliminar márgenes del body */
    padding: 0; /* Eliminar relleno del body */
}

header {
    background-color: #5e2d79; /* Color de fondo del encabezado */
    color: white;
    padding: 0; /* Eliminar relleno del encabezado */
    text-align: center; /* Alineación del texto al centro */
}

header h1 {
    font-size: 2em;
    margin: 0; /* Eliminar márgenes del título */
    padding: 20px 0; /* Espaciado superior e inferior para el título */
}

nav ul {
    display: flex;
    justify-content: center;
    list-style: none;
    padding: 0;
    margin: 0; /* Eliminar márgenes de la lista de navegación */
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
            margin-top: 50px;
        }

        .btn {
            background-color: #5e2d79;
            color: white;
            padding: 10px 20px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #9c4dcc;
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
            color: #5e2d79;
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
            background-color: #5e2d79;
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f4f7fa;
        }

        .table i {
            cursor: pointer;
        }

        .table td a {
            color: #5e2d79;
            text-decoration: none;
        }

        .table td a:hover {
            color: #9c4dcc;
        }
    </style>
</head>
<body>
</head>
<body>
</head>
<body>

<header>
    <h1>creative smile</h1>
    <nav>
        <ul>
            <li><a href="/vistas/interfazAdministrador.php">Inicio</a></li> 
            <li><a href="../mostrarUsuario.php">Gestión de Roles</a></li>
            <li><a href="../enviarCorreo.php">Enviar correo</a></li>
            <li> <a href="../modificarDatosAdministrador.php">Actualizar datos </a></li>
            <li><a href="../cerrarCesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<div class="container mt-4">
    <h2 class="text-center mb-4">Lista de Usuarios</h2>

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

    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                
            </form>
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

        $sql = "SELECT u.*, r.nombre_rol 
        FROM copia_respaldo.usuario u
        INNER JOIN copia_respaldo.uso_roles ur ON u.id_usuario = ur.id_usuario
        INNER JOIN copia_respaldo.roles r ON ur.id_roles = r.id_roles
        $where";
        $resultado = $conexion->query($sql);
    ?>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Sexo</th>
                <th>rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['id_usuario']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['apellido']; ?></td>
                <td><?php echo $row['fecha_de_nacimiento']; ?></td>
                <td><?php echo $row['Direccion']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><?php echo $row['sexo']; ?></td>
                <td><?php echo $row['nombre_rol']; ?></td>
                <td>
                    <a href="modificarRol.php?id_usuario=<?php echo $row['id_usuario']; ?>" title="Editar">
                        <i class="fas fa-edit text-white" style="font-size:24px;"></i>
                    </a>
                </td>
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