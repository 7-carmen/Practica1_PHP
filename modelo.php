<?php
class Usuarios {
    private $conexdb;

    public function __construct(){ //Conecxion con la BD. 
        $this->conexdb = new mysqli('localhost', 'root', '', 'usuarios');
    }

    public function getForUsername($username, $pasword) {
        $result = $this->conexdb->query("SELECT * FROM usuarios WHERE nombre = '$username' AND pasword = '$pasword'");
        if ($result != false && $result->num_rows != 0) { 
            $fila = $result->fetch_object();
            $_SESSION["nombre"] = $fila->nombre;
            $_SESSION["tipo"] = $fila->tipo;
            echo $_SESSION["nombre"];
            echo $_SESSION["tipo"];
            $userOk = true;
        } else {
            $userOk = false;
        }
        return $userOk;
    }

    public function get($nombre) {
        return true;
    }

    public function getAll() {
        $result = $this->conexdb->query("SELECT * FROM usuarios");
        $usersList = array();
        while ($fila = $result->fetch_object()) {
            $usersList[] = $fila;
        }
        return $usersList;
    }

    public function getUsuarioAll($username) {
        $result = $this->conexdb->query("SELECT * FROM usuarios WHERE nombre = '$username'");
        $datosUsuario = array();
        while ($fila = $result->fetch_object()) {
            $datosUsuario[] = $fila;
        }
        return $datosUsuario;
    }

    public function insert($data) {
        $username =$data["usuario"];
        $pasword = $data["pasword"];
        $nombre = $data["nombre"];
        $apellidos = $data["apellidos"];
        $correo = $data["correo"];
        $sql = ("INSERT INTO usuarios VALUES ('$username', '$pasword', 1, '$nombre', '$apellidos', '$correo')");
        echo $sql;
        $this->conexdb->query($sql);
        if ($this->conexdb->affected_rows == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function insertAdmin($data) {
        $username =$data["usuario"];
        $pasword = $data["pasword"];
        $nombre = $data["nombre"];
        $apellidos = $data["apellidos"];
        $correo = $data["correo"];
        $tipo = $data["tipo"];
        $sql = ("INSERT INTO usuarios VALUES ('$username', '$pasword', '$tipo', '$nombre', '$apellidos', '$correo')");echo $sql;
        $this->conexdb->query($sql);
        if ($this->conexdb->affected_rows == 1) {
            return true;
        } else {
            return false;
        }

    }

    public function updateAdmin($data){
        $username =$data["usuario"];
        $pasword = $data["pasword"];
        $nombre = $data["nombre"];
        $apellidos = $data["apellidos"];
        $correo = $data["correo"];
        $tipo = $data["tipo"];
        $sql = ("UPDATE usuarios SET pasword = '$pasword', tipo = '$tipo', nombre_real= '$nombre', apellidos = '$apellidos', correo = '$correo' WHERE nombre = '$username'");
        $this->conexdb->query($sql);
        if ($this->conexdb->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    
    public function update($data){
        $username =$data["usuario"];
        $pasword = $data["pasword"];
        $nombre = $data["nombre"];
        $apellidos = $data["apellidos"];
        $correo = $data["correo"];
        $sql = ("UPDATE usuarios SET pasword = '$pasword', nombre_real= '$nombre', apellidos = '$apellidos', correo = '$correo' WHERE nombre = '$username'");
        $this->conexdb->query($sql);
        if ($this->conexdb->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($data){
        $username = $data["usuario"];
        $sql = ("DELETE FROM usuarios WHERE nombre = '$username'");
        $this->conexdb->query($sql);
        if ($this->conexdb->affected_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    
}

?>