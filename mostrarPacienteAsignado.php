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
    <title>Pacientes Asignados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(to bottom, #e0bbff, #957dad);">

<header class="bg-purple text-white py-3 text-center" style="background-color: #6a1b9a;">
    <h1>Creative Smile</h1>
    <nav>
        <ul class="nav justify-content-center">
            <li class="nav-item"><a class="nav-link text-white" href="/vistas/interfazDoctor.php">Inicio</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="mostrarPacienteAsignado.php">Mostrar cita actual</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="modificarDatosDoctor.php">Actualizar Datos</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="cerrarCesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<div class="container mt-4">
    <h2 class="text-center mb-4">Citas Programadas</h2>

    <?php
    // Obtener id_doctor
    $id_usuario = $_SESSION['id_usuario'];
    $query = $conexion->prepare("SELECT id_doctor FROM doctor WHERE id_usuario = ?");
    $query->bind_param("i", $id_usuario);
    $query->execute();
    $res = $query->get_result();
    if ($res && $row = $res->fetch_assoc()) {
        $id_doctor = $row['id_doctor'];
    } else {
        echo "<div class='alert alert-danger'>No se encontró el doctor.</div>";
        exit();
    }
    $query->close();

    // Llamar al procedimiento
    $stmt = $conexion->prepare("CALL mostrar_pacientes_actuales(?)");
    $stmt->bind_param("i", $id_doctor);
    $stmt->execute();
    $resultado = $stmt->get_result();
    ?>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Fecha de Solicitud</th>
                <th>Especialidad</th>
                <th>Fecha de Cita</th>
                <th>Hora Inicial</th>
                <th>Hora Final</th>
                <th>Paciente</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    if (strtolower(trim($row['nombre_estado'])) === 'programada') {
                        echo "<tr>
                            <td>{$row['fecha_solicitud']}</td>
                            <td>{$row['especialidad']}</td>
                            <td>{$row['fecha_cita']}</td>
                            <td>{$row['hora_inicial']}</td>
                            <td>{$row['hora_final']}</td>
                            <td>{$row['nombre_paciente']}</td>
                          
                        </tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No hay citas programadas.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    $stmt->close();
    $conexion->close();
    ?>
</div>

</body>
</html>
