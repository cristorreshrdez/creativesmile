<?php
session_start();
include_once 'Models/conexion.php';

if (!isset($_SESSION['nombre'])) {
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
  <title>Sistema de Citas Odontológicas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
        body {
            margin: 0;
            background: linear-gradient(to bottom, #d9a9ff, #a971ff);
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #68007f;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .form-container {
            background: white;
            padding: 30px;
            max-width: 600px;
            margin: 50px auto;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #8000a3;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #8000a3;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #8000a3;
            color: white;
            padding: 14px;
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #9c4dcc;
        }

        small {
            color: #555;
        }
    </style>
</head>
<body>

<header>
  <h1>Creative Smile</h1>
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

<div class="form-container">
    <h2>Enviar correo a todos los usuarios</h2>

    <form action="../controllers/procesarEnvio.php" method="post">
        <label>Asunto:</label>
        <input type="text" name="asunto" placeholder="Ej: Conoce a tu doctor" required>

        <label>Mensaje:</label>
        <textarea name="mensaje" rows="8" placeholder="Escribe aquí tu mensaje..." required></textarea>

        <input type="submit" value="Enviar correo a todos">
    </form>
</div>

</body>
</html>



