<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro de Usuario</title>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #e0bbff, #957dad);
            color: #fff;
        }

        /* Encabezado */
        header {
            background-color: #5e2d79;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 2.5em;
            margin: 0;
        }

        header a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2em;
            margin: 0 15px;
        }

        header a:hover {
            text-decoration: underline;
        }

        /* Contenedor principal */
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #5e2d79;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .form-container label {
            display: block;
            font-size: 1em;
            margin-bottom: 5px;
            color: #e0bbff;
        }

        .form-container input,
        .form-container select,
        .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-container input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        .form-container button {
            background-color: #7d3e9d;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container button:hover {
            background-color: #b583d1;
        }

        .form-container a {
            color: #e0bbff;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
  include "models/conexion.php";
  include "controllers/usuarios.php";
  ?>
    <header>
        <h1>Creative Smile</h1>
        <a href="index.html">Inicio</a>
        <a href="login.php">Iniciar Sesión</a>
        <a href= "crearUsuario.php">Registrarse</a>
        <a href="index.html#nosotros">Nosotros</a>
        <a href="Equipo.html">Equipo</a>
        
    </header>

    <div class="form-container">
        <h2>Crear Cuenta</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="id_usuario">Identificación: </label>
            <input type="number" id="id_usuario" name="id" placeholder="Ingrese su identificación" required />

            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="nom" placeholder="Ingrese su nombre" required />

            <label for="apellido">Apellido: </label>
            <input type="text" id="apellido" name="ape" placeholder="Ingrese su apellido" required />

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="Dir" placeholder="Ingrese su dirección" required />

            <label for="fecha_de_nacimiento">Fecha de Nacimiento: </label>
            <input type="date" id="fecha_de_nacimiento" name="fec" required />
            
        

      <label for="tipo_identificacion">Tipo de identificación</label>
      <select name="tip" id="tipo_identificacion">
        <option value="" >Seleccione su tipo de identificacion</option>
        <option value="tarjeta_identidad">tarjeta_identidad</option>
        <option value="cedula_ciudadania">Cédula de Ciudadanía</option>
        <option value="cedula_extranjera">Cédula Extranjera</option>
        <option value="pasaporte">Pasaporte</option>
        </select>
        

            <label for="correo">Correo: </label>
            <input type="email" id="correo" name="cor" placeholder="Ingrese su correo" required />

    
      <label for="">sexo</label>
      <select name="sex" id="sexo">
        <option value="" >Eliga el género</option>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
        </select>
        

            <label for="contrasena">Contraseña: </label>
            <input type="password" id="contrasena" name="con" placeholder="Ingrese su contraseña" required />

            <button type="submit" name="registrar" value="ok">Registrar</button>
        </form>
    </div>
</body>
</html>