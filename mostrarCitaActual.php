<?php
session_start();
include_once 'Models/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita Actual</title>
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
    <h1>Creative Smile</h1>
    <nav>
        <ul>
            <li><a href="../vistas/interfazPaciente.php">Inicio</a></li>
            <li><a href="AgendarCita.php">Agendar cita</a></li>
            <li><a href="mostrarCitaActual.php">Ver Cita Actual</a></li>
            <li><a href="modificarDatos.php">Actualizar datos</a></li>
            <li><a href="cerrarCesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<div class="container mt-4">
    <h2 class="text-center mb-4">Tu cita actual</h2>

    <?php
    $id_usuario = $_SESSION['id_usuario'];

    $stmt = $conexion->prepare("CALL mostrar_citas_actuales(?)");
    if ($stmt === false) {
        echo "<div class='alert alert-danger'>Error en la consulta: " . $conexion->error . "</div>";
    } else {
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();
    ?>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Fecha de solicitud</th>
                <th>Especialidad</th>
                <th>Fecha de cita</th>
                <th>Hora inicial</th>
                <th>Hora final</th>
                <th>Doctor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['fecha_solicitud']}</td>
                        <td>{$row['especialidad']}</td>
                        <td>{$row['fecha_cita']}</td>
                        <td>{$row['hora_inicial']}</td>
                        <td>{$row['hora_final']}</td>
                        <td>{$row['nombre_doctor']}</td>
                    </tr>";
       

    // Mostrar el botón solo si está programada
    if (strtolower(trim($row['nombre_estado'])) === 'programada') {
        echo "<tr><td colspan='6'>
            <form action='../controllers/cancelarCita.php' method='post' onsubmit='return confirm(\"¿Estás seguro de cancelar esta cita?\");'>
                <input type='hidden' name='id_cita' value='{$row['id_citas_agendadas']}'>
                <div class='mb-2'>
                    <textarea name='motivo' required placeholder='Motivo de la cancelación' class='form-control'></textarea>
                </div>
                <button type='submit' class='btn btn-danger'>Cancelar cita</button>
            </form>
        </td></tr>";
        }
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No tienes citas agendadas</td></tr>";
}
?>
        </tbody>
    </table>

    <?php
        $stmt->close();
    }
    $conexion->close();
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>