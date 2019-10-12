<?php
//Controlador: esta aplicación solo realiza una accion
include("modelo.php");
include("vista.php");
    class Controlador{
        protected $user;

        public function __construct(){
            $this->user = new Usuarios();
        }

        //Inicia la conexion, todas las peticiones pasan por aqui. 
        public function iniciar_conexon(){
            session_start();
        if (isset($_REQUEST["do"])) {   // La variable "do" controla el estado de la aplicación
            $do = $_REQUEST["do"];
        } else {
            $do = "mostrar_formulario";      // Estado por defecto
        }
        $this->$do();   // Ejecuta la función con el nombre $do. 
                        // P. ej: si $do vale "showFormLogin", ejecuta $this->showFormLogin()
        }

        //Muestra la página de inicio con el login y el registrarse.
        public function mostrar_formulario(){
            $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
             View::show("vista_principal", $data);
        }

        public function logearse(){
            $username = $_REQUEST["usuario"];
            $pasword = $_REQUEST["contraseña"];
            $userOk = $this->user->getForUsername($username, $pasword);
            if ($userOk) {
               View::redirect("mostrar_datos");
            } else {
                $data["mensaje"] = "Nombre de usuario o contraseña incorrecto";
               View::show("vista_principal", $data);
            }
        }

        public function mostrar_datos(){
            if (isset($_SESSION["nombre"]) && $_SESSION["tipo"] == "0") {
                // Tipo de usuario 0 (administador)
                $data["usersList"] = $this->user->getAll();
                $data["nombreUsuarioLogueado"] = $_SESSION["nombre"];
                View::show("vista_administrador", $data);
            } else if (isset($_SESSION["nombre"]) && $_SESSION["tipo"] == "1") {
                // Tipo de usuario 1 (usuario normal)
                $usurname = $_SESSION["nombre"];
                $data["datosUsuario"] = $this->user->getUsuarioAll($usurname);
                View::show("vista_usuario", $data);
            } else {
                // Tipo de usuario desconocido O no se ha hecho login
                $data["mensaje"] = "No tienes permiso para hacer esto";
                View::redirect("mostrar_formulario", $data);
            }
        }

        public function registrarse(){
            $data['usuario'] = $_REQUEST['usuario'];
            $data['pasword'] = $_REQUEST['contraseña'];
            $data['nombre'] = $_REQUEST['nombre'];
            $data['apellidos'] = $_REQUEST['apellidos'];
            $data['correo'] = $_REQUEST['correo'];
            $userOk = $this->user->getUsuarioAll( $data['usuario']);
            if($userOk){
                $data["mensaje"] = "Nombre de usuario ya creado, elija otro.";
                View::redirect("mostrar_formulario", $data);
            }else {
            $resultInsert = $this->user->insert($data);
            if ($resultInsert == 1) {
                $data["mensaje"] = "Usuario creado con éxito";
                View::redirect("mostrar_formulario", $data);
            } else {
    
                $data["mensaje"] = "Error, no se puedo crear el usuario";
                View::redirect("mostrar_formulario", $data);
            }
        }
        }

        public function anadir_usuario(){
            $data['usuario'] = $_REQUEST['usuario'];
            $data['pasword'] = $_REQUEST['contraseña'];
            $data["tipo"] = $_REQUEST["tipo"];
            $data['nombre'] = $_REQUEST['nombre'];
            $data['apellidos'] = $_REQUEST['apellidos'];
            $data['correo'] = $_REQUEST['correo'];
            $resultInsert = $this->user->insertAdmin($data);
            $data = null;
            if ($resultInsert == 1) {
                $data["mensaje"] = "Usuario creado con éxito";
                View::redirect("mostrar_datos", $data);
            } else {
    
                $data["mensaje"] = "Error, no se puedo crear el usuario";
                View::redirect("mostrar_datos", $data);
            }
        }

        public function mostrar_usuario_modificar(){
            $usurname = $_REQUEST["usuario"];
            $data["datosUsuario"] = $this->user->getUsuarioAll($usurname);
            $data["mensaje"] = (isset($_REQUEST["mensaje"]) ? $_REQUEST["mensaje"] : null);
            View::show("vista_modificar_usuario", $data);
        }

        public function modificar_usuario(){
            $data['usuario'] = $_REQUEST['usuario'];
            $data['pasword'] = $_REQUEST['contraseña'];
            $data['nombre'] = $_REQUEST['nombre'];
            $data['apellidos'] = $_REQUEST['apellidos'];
            $data['correo'] = $_REQUEST['correo'];
            $data["tipo"] = $_REQUEST["tipo"];
            $resultInsert = $this->user->updateAdmin($data);
            $data = null;
            if ($resultInsert == 1) {
                $data["mensaje"] = "Usuario modificado con éxito";
                View::redirect("mostrar_datos", $data);
            } else {
    
                $data["mensaje"] = "Error, no se puedo modificar el usuario";
                View::redirect("mostrar_datos", $data);
            }
        }

        public function desconectar(){
            session_destroy();
            header("Location: index.php");
        }

        public function modificara_datos(){
            $data['usuario'] = $_REQUEST['usuario'];
            $data['pasword'] = $_REQUEST['contraseña'];
            $data['nombre'] = $_REQUEST['nombre'];
            $data['apellidos'] = $_REQUEST['apellidos'];
            $data['correo'] = $_REQUEST['correo'];
            $resultInsert = $this->user->update($data);
            $data = null;
            if ($resultInsert == 1) {
                $data["mensaje"] = "Usuario modificado con éxito";
                View::redirect("mostrar_datos", $data);
            } else {
    
                $data["mensaje"] = "Error, no se puedo modificar los datos";
                View::redirect("mostrar_datos", $data);
            }
        }

        public function eliminar_cuenta(){
            if($_SESSION["tipo"]== 0){
                $data["usuario"]=$_REQUEST["usuario"];
                $resultInsert = $this->user->delete($data);
                if($resultInsert){
                    $data["mensaje"] = "Usuario eliminado con exito";
                }else {
                    $data["mensaje"] = "No se pudo borrar al usuario";
                }
                View::redirect("mostrar_datos", $data);
            }else{
                $data["usuario"] = $_SESSION["nombre"];
                $resultInsert = $this->user->delete($data);
                if($resultInsert){
                    $data["mensaje"] = "Usuario eliminado con exito";
                     View::redirect("mostrar_formulario", $data);
                }else {
                $data["mensaje"] = "Error al borrar";
                View::redirect("mostrar_datos", $data);
            }
        }
        }
    }
