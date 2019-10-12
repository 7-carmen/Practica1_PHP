    <?php
    $usersList = $data["datosUsuario"];
    echo "<h1> Login realizado con éxito. </h1>";
    foreach ($usersList as $user) {
        echo "<form>";
        echo "Nick de usuario:<br/><input type='text' name='usuario' value=$user->nombre readonly='readonly'><br/>";
        echo "<br />Contraseña del usuario:<br /> <input type='text' name='contraseña' value=$user->pasword><br />";
        echo "<br />Nombre:<br /> <input type='text' name='nombre' value=$user->nombre_real><br />";
        echo "<br />Apellidos:<br /> <input type='text' name='apellidos' value=$user->apellidos><br />";
        echo "<br />Correo:<br /> <input type='text' name='correo' value=$user->correo><br />";
        echo "<br /><input type='submit' value='Midificar datos'>";
        echo "<input type='hidden' name='do' value='modificara_datos'>";
        echo "</form>";
        echo "<form>";
        echo "<input type='submit' value='Eliminar cuenta'>";
        echo "<input type='hidden' name='do' value='eliminar_cuenta'>";
        echo "</form>";
    }
    if (isset($data["mensaje"]) && $data["mensaje"] != null) {
        echo "<div style='color:red'>" . $data["mensaje"] . "</div>";
    }
    ?>
    <input type="button" name="do" value="Desconectar" onclick="window.location.href='index.php?do=Desconectar'">
