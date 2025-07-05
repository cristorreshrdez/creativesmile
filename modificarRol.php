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
    include "models/conexion.php";
    
    $id = $_GET['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE id_usuario = '$id'";

    $resultado = $conexion->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e0bbff, #957dad);
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

    </lu>

            
        </nav>
    </header>

    <div class="container">
        <p class="h1 text-center text-primary">Modificar rol</p>
        <div class="form-container">

        <?php
    include "controllers/modificarUs.php";
 
?>
            <form action="" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                <label for="id" class="form-label">id:</label>
                <input type="text" class="form-control" id="id" value="<?php echo $_GET['id_usuario']; ?>" name="id" >
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" value="<?php echo $row['nombre']; ?>" name="nom" readonly>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" class="form-control" id="apellido" value="<?php echo $row['apellido']; ?>" name="ape" readonly>
                </div>
                <div class="mb-3">
                    <label for="fecha_de_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_de_nacimiento" value="<?php echo $row['fecha_de_nacimiento']; ?>" name="fec" readonly>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="text" class="form-control" id="correo" value="<?php echo $row['correo']; ?>" name="cor" readonly>
                </div>
                
                <?php
                 $genero = $row['sexo']; 
                 ?>

                <div class="mb-3">
                 <label for="sexo">Sexo</label>
                <select name="sex" id="sexo" class="form-control" >
               <option value="">Elija el género</option>
                 <option value="masculino" <?php if($genero == "masculino") echo "selected"; ?>>Masculino</option>
                  <option value="femenino" <?php if($genero == "femenino") echo "selected"; ?>>Femenino</option>
               <option value="otro" <?php if($genero == "otro") echo "selected"; ?>>Otro</option>
                 </select>
                 </div>

     
                
        

                <div class="mb-3">
                <label for="">tipo de rol</label>
                   <select name="rol" id="rol" onchange="mostrarEspecialidad()" >
                   <option name="">seleccione el rol</option>
                  <option value="1" >paciente</option>
                  <option value="2">Doctor</option>
                   <option value="3">Asistente</option>
                   <option value="4">administrador</option>
                </div>



                <div class="mb-3">
                    <label for="Direccion" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" id="Direccion" value="<?php echo $row['Direccion']; ?>" name="Dir" readonly>
                </div>

               
                <div id="campo_especialidad" style="display: none; margin-top: 10px;">
                   <label for="especialidad">Elija tipo de especialidad:</label>
                      <select name="especialidad" id="especialidad">
                               <option value="1">Ortodoncia</option>
                               <option value="2">Endodoncia </option>
                               <option value="3">Periodoncia </option>
                               <option value="4">Prostodoncia </option>
                               <option value="5">Cirugía oral </option>
                               <option value="6">Odontología pediátrica</opiton>
                               <option value="7">Odontología estética</opiton>
                               <option value="7"> Odontología General</opiton>
                               </select>
                                </div>

             

                <button type="submit" class="btn btn-block" name="modificar" value="ok">Modificar</button>
            </form>

             
            
                <script>
    function mostrarEspecialidad() {
        const rol = document.getElementById('rol').value; 
        const campo = document.getElementById('campo_especialidad'); 
        const input = document.getElementById('especialidad'); 

        
        if (rol == '2') {  
            campo.style.display = 'block';  
            input.setAttribute('required', 'required'); 
        } else {
            campo.style.display = 'none';  
            input.removeAttribute('required'); 
            input.value = '';  
        }
    }

    
    window.onload = function() {
        mostrarEspecialidad();  
    }
</script>
        </div>
    </div>
</body>
</html>