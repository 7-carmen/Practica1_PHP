    <html>

    <head>
        <link rel="stylesheet" type="text/css" href="css.css" media="screen" />
    </head>
    <?php
    if (isset($data["mensaje"]) && $data["mensaje"] != null) {
        echo "<div style='color:red'>" . $data["mensaje"] . "</div>";
    }

    $usersList = $data["usersList"];
    echo "<h1>Bienvenido administrador:</h1>";
    echo "<table border='1'>";
    echo "<tr> <th> Nick </th> <th> Contraseña </th> <th> Tipo </th> <th> Nombre </th> <th> Apellidos </th> <th> Correo </th> <th> Eliminar </th> <th> Modificar </th></tr>";
    foreach ($usersList as $user) {
        if ($user->nombre == $data["nombreUsuarioLogueado"]) {
            echo "<tr> 
                                                            <td> " . $user->nombre . " </td>
                                                            <td> " . $user->pasword . " </td> 
                                                            <td> " . $user->tipo . " </td>
                                                            <td> " . $user->nombre_real . " </td>
                                                            <td> " . $user->apellidos . " </td>
                                                            <td> " . $user->correo . " </td>
                                                            <td>  </td>
                                                            <td> <a href='index.php?do=mostrar_usuario_modificar&usuario=" . $user->nombre . "'>Modificar</a> </td>
                                                    </tr>";
        } else {
            echo "<tr> 
                                                            <td> " . $user->nombre . " </td>
                                                            <td> " . $user->pasword . " </td> 
                                                            <td> " . $user->tipo . " </td>
                                                            <td> " . $user->nombre_real . " </td>
                                                            <td> " . $user->apellidos . " </td>
                                                            <td> " . $user->correo . " </td>
                                                            <td> <a href='index.php?do=eliminar_cuenta&usuario=" . $user->nombre . "'>Eliminar</a> </td>
                                                            <td> <a href='index.php?do=mostrar_usuario_modificar&usuario=" . $user->nombre . "'>Modificar</a> </td>
                                                    </tr>";
        }
    }
    echo "</table>";
    ?>
    <div id=admin>
        <form action="index.php" method="get">
            <br /> Nick del usuario:<br /> <input type='text' name='usuario'><br />
            <br /> Contraseña:<br /> <input type='password' name='contraseña'><br />
            <br />
            <p>Tipo:
                <input type="radio" name="tipo" value="1"> Usuario
                <input type="radio" name="tipo" value="0"> Administrador
            </p>
            <br /> Nombre: <br /> <input type='text' name='nombre'><br />
            <br /> Apellidos:<br /> <input type='text' name='apellidos'><br />
            <br /> Correo: <br /> <input type='text' name='correo'><br />
            <br /> <input type="submit" value="Añadir usuario">
            <br /> <input type="hidden" name="do" value="anadir_usuario"><br />
        </form>
    </div>
    <input type="button" name="do" value="Desconectar" onclick="window.location.href='index.php?do=Desconectar'">