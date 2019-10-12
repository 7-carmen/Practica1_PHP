    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    </head>
    <div id="login" name="login">
        <form action="index.php" method="get">
            <br />Usuario: <br /> <input type='text' name='usuario'><br />
            <br />Contraseña: <br /> <input type='password' name='contraseña'><br />
            <br /> <input type="submit" value="Logearse"><br />
            <br /> <input type="hidden" name="do" value="logearse"><br />
        </form>
        <?php
        if ($data["mensaje"] != null) {
            echo "<div style='color:red'>" . $data["mensaje"] . "</div>";
        }
        ?>
    </div>
    <div id="registro">
        <form action="index.php" method="get">
            <br /> Nick del usuario:<br /> <input type='text' name='usuario'><br />
            <br /> Contraseña:<br /> <input type='password' name='contraseña'><br />
            <br /> Nombre: <br /> <input type='text' name='nombre'><br />
            <br /> Apellidos:<br /> <input type='text' name='apellidos'><br />
            <br /> Correo: <br /> <input type='text' name='correo'><br />
            <br /> <input type="submit" value="Registrarse">
            <br /> <input type="hidden" name="do" value="registrarse"><br />
        </form>
    </div>

    </html>