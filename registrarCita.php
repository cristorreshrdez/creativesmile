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
    <title>Registrar Cita</title>
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

<?php
  include "models/conexion.php";
  include "controllers/CitasDisponibles.php";
  ?>

<header>
    <h1>Creative Smile</h1>
    <nav>
        <ul>
            <li><a href="/vistas/interfazAsistente.php">Inicio</a></li>
            <li><a href="../registrarCita.php">Registrar Cita</a></li>
            <li><a href="../mostrarDoctor.php">Doctores</a></li>
            <li><a href="../modificarDatosAsistente.php">Actualizar datos</a> </li>
            <li><a href="../cerrarCesion.php">Cerrar Sesión</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="form-container">
        <h2>Registrar Cita</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="doctor">Doctor:</label>
                <select class="form-control" name="doc" id="id_doctor" required>
                    <option value="">Seleccione el doctor</option>
                    <?php
                    include "models/conexion.php";
                    $sql = "SELECT id_doctor, nombre FROM doctor JOIN usuario ON doctor.id_usuario = usuario.id_usuario;";
                    $resultado = $conexion->query($sql);
                    
                    while ($doctor = $resultado->fetch_assoc()) {
                        echo "<option value='" . $doctor['id_doctor'] . "'>" . $doctor['nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hora_inicio">Hora inicial:</label>
                <select class="form-control" name="ini" required>
                    <option value="">Seleccione hora inicial</option>
                    <?php
                    for ($hora = 7; $hora <= 19; $hora++) {
                        $hora_formato = str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00";
                        $hora_AmPm = date("h:i A", strtotime($hora_formato)); 
                        echo "<option value='$hora_formato'>$hora_AmPm</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="hora_final">Hora final:</label>
                <select class="form-control" name="fin" required>
                    <option value="">Seleccione hora final</option>
                    <?php
       
            for ($h = 8; $h <= 20; $h++) {
            
                $Hora = str_pad($h, 2, "0", STR_PAD_LEFT) .":00";
                
                $Am_Pm = date("h:i A", strtotime($Hora)); 
                                  echo "<option value='$Hora'>$Am_Pm</option>";
                               
                            }
                           ?>
                  </select>
              </div>


            <div>
            <label for="fecha_cita">fecha de cita:</label>
            <input type="date" id="fecha_cita" name="fec" required />
            </div>
        
       
            <div>
      <label for=""> tipo de especialidad</label>
      <select name="tip" id="id_servicio">
        <option value="" >seleccion tipo de especialidad</option>
        <option value="1">Ortodoncia</option>
        <option value="2">Endodoncia</option>
        <option value="3">Periodoncia</option>
        <option value="4">Prostodoncia</option>
        <option value="5">Cirugía oral</option>
        <option value="6">Odontología pediátrica</option>
        <option value="7">Odontología estética</option>
        <option value="8"> Odontología General</option>
        </select>
       </div>

      

           
       <input type="hidden" id="disponibilidad" value="1" name="dis" />

    
     
        

            
          
            <button type="submit" name="registrar" value="ok">Registrar</button>
        </form>
    </div>