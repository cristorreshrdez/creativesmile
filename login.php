<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
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

        nav ul {
            list-style: none;
            padding: 0;
            margin: 20px 0 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 20px;
            color: #fff;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #7d3e9d;
            border-color: #fff;
        }

        /* Formulario de inicio de sesión */
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #5e2d79;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h2 {
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container label {
            font-size: 1em;
            color: #e0bbff;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .form-container button {
            background-color: #7d3e9d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .form-container button:hover {
            background-color: #b583d1;
        }

        .form-container a {
            color: #e0bbff;
            text-decoration: none;
            font-size: 0.9em;
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
    <header>
        <h1>Creative Smile</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="CrearUsuario.php">Registrarse</a></li>
                <li><a href="index.html#nosotros">Nosotros</a></li>
                <li><a href="Equipo.html">Equipo</a></li>

              
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <form action="../Controllers/validarLogin.php" method="post">
            <h2>Inicio de Sesión</h2>
            <hr>
            <?php
            if (isset($_GET['error'])) { ?>
                <p class="text-danger text-center"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <label for="usuario">Identificación:</label>
            <input type="text" id="usuario" name="usuario" placeholder="Número de identificación" required>
            
            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" placeholder="Contraseña registrada" required>
            
            <button type="submit">Iniciar Sesión</button>
            <a href="CrearUsuario.php">¿No tienes una cuenta? Regístrate</a>
        </form>
    </div>
</body>
</html>