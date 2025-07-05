<?php
session_start();
include_once 'Models/conexion.php';

if (!isset($_SESSION['nombre'])) {
    header('location: login.php');
    exit();
}

$nombreUsuario = $_SESSION['nombre'];

include "models/conexion.php";
include "controllers/CitasDisponibles.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Citas Odontológicas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Estilos generales */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to bottom, #e0bbff, #957dad);
      color: #fff;
    }

    header {
      background-color: #5e2d79;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    header h1 {
      font-size: 2.5em;
      color: white;
      margin: 0;
    }

    nav ul {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
      margin: 20px 0 0 0;
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

    h2 {
      color: #6a1b9a;
      text-align: center;
    }

    /* Panel de agendar citas */
    .form-container {
      background-color: #fff;
      color: #6a1b9a;
      max-width: 600px;
      margin: 40px auto;
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    }

    label {
      font-size: 1.1em;
      margin-bottom: 5px;
      display: block;
    }

    input[type="date"],
    input[type="time"],
    input[type="radio"] {
      display: block;
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: 1px solid #ddd;
    }

    input[type="radio"] {
      width: auto;
      margin-right: 10px;
    }

    button {
      display: block;
      background-color: #6a1b9a;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      width: 100%;
      font-size: 1.2em;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #9c4dcc;
    }
  </style>
</head>
<body>

<header>
  <h1>Creative Smile</h1>
  <nav>
    <ul>
      <li><a href="/vistas/interfazPaciente.php">Inicio</a></li>
      <li><a href="../AgendarCita.php">Agendar cita</a></li>
      <li><a href="../mostrarCitaActual.php">Ver Cita Actual</a></li>
      <li><a href="modificarDatos.php">Actualizar datos</a></li>
      <li><a href="../cerrarCesion.php">Cerrar Sesión</a></li>
    </ul>
  </nav>
</header>

<main>
  <section class="form-container">
    <h2>Solicitar Nueva Cita</h2>
    <?php
    // Mostrar el mensaje de éxito si existe
    if (isset($_SESSION['mensaje'])) {
        echo "<p class='alert alert-success'>" . $_SESSION['mensaje'] . "</p>"; // Mensaje de éxito
        unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
      <div>
        <label for="fecha_cita">Fecha:</label>
        <input type="date" id="fecha_cita" name="fec" min="<?= date('Y-m-d'); ?>" required>

      </div>

      <div>
        <label for="especialidad">Especialidad</label>
        <select name="esp" id="especialidad" required>
          <option value="">Selecciona la especialidad</option>
          <option value="1">Ortodoncia</option>
          <option value="2">Endodoncia</option>
          <option value="3">Periodoncia</option>
          <option value="4">Protodoncia</option>
          <option value="5">Cirugía Oral</option>
          <option value="6">Odontología Pediátrica</option>
          <option value="7">Odontología Estética</option>
          <option value="8">Odontología General</option>
        </select>
      </div>

      <button type="submit" name="buscar" value="ok">Buscar</button>
    </form>

    <?php
    if (isset($_POST['buscar'])) {
      $fecha = $_POST['fec'];
      $especialidad = $_POST['esp'];

      if (!empty($fecha) && !empty($especialidad)) {
        $sql = "SELECT c.id_cita, c.fecha_cita, c.hora_inicial, c.hora_final, c.disponibilidad, 
                       s.especialidad, d.id_doctor, u.id_usuario, u.nombre, u.apellido
                FROM doctor d 
                JOIN citas_disponibles c ON d.id_doctor = c.id_doctor
                JOIN usuario u ON d.id_usuario = u.id_usuario
                JOIN servicios s ON c.id_servicio = s.id_servicio
                WHERE c.fecha_cita = ? AND c.id_servicio = ? AND c.disponibilidad = 1";

        if ($stmt = $conexion->prepare($sql)) {
          $stmt->bind_param("si", $fecha, $especialidad);
          $stmt->execute();
          $resultado = $stmt->get_result();

          if ($resultado->num_rows > 0) {
            echo "<h3>Citas Disponibles</h3>";
            echo "<ul>";
            while ($fila = $resultado->fetch_assoc()) {
              echo "<li>";
              echo "Doctor: " . $fila['nombre'] . " " . $fila['apellido'] . " | Fecha: " . $fila['fecha_cita'] . 
                   " | Hora: " . $fila['hora_inicial'] . " - " . $fila['hora_final'] . " | Especialidad: " . $fila['especialidad'];
              echo " <a href='../controllers/AgendarCitaFinal.php?id_cita=" . $fila['id_cita'] . "'>Agendar</a>";
              echo "</li>";
            }
            echo "</ul>";
          } else {
            echo "<p>No hay citas disponibles para esa fecha.</p>";
          }
        } else {
          echo "<p>Error al preparar la consulta.</p>";
        }
      } else {
        echo "<p>Por favor, selecciona una fecha y especialidad.</p>";
      }
    }
    ?>
  </section>
</main>

</body>
</html>