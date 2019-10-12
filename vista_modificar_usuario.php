<?php
    if (isset($data["mensaje"]) && $data["mensaje"] != null) {
        echo "<div style='color:red'>" . $data["mensaje"] . "</div>";
    }
    $usersList = $data["datosUsuario"];
    foreach ($usersList as $user) {
        echo "<form>";
        echo "Nick de usuario:<br/><input type='text' name='usuario' value=$user->nombre readonly='readonly'><br/>";
        echo "<br />Contraseña del usuario:<br /> <input type='text' name='contraseña' value=$user->pasword><br />";
        echo "<br />Nombre:<br /> <input type='text' name='nombre' value=$user->nombre_real><br />";
        echo "<br /> Tipo usuario:<br/> <input type='text' name='tipo' value=$user->tipo><br />";
        echo "<br />Apellidos:<br /> <input type='text' name='apellidos' value=$user->apellidos><br />";
        echo "<br />Correo:<br /> <input type='text' name='correo' value=$user->correo><br />";
        echo "<br /><input type='submit' value='Modificar usuario'>";
        echo "<br /><input type='hidden' name='do' value='modificar_usuario'>";
        echo "</form>";
    }