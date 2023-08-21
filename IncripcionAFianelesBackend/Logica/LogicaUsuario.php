<?php
    include "../Modelos/Usuario.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

    class LogicaUsuario{

        private $base;
        private $conecBase;

        public function __construct()
        {
            $this->base = new DB();
            $this->conecBase = $this->base->conectar();
        }

        public function TraerUsuarios(){                            
            //Mostrar todos los usuarios
            $sql = $this->conecBase->prepare("SELECT * FROM usuarios");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function TraerUsuarioPorID(int $id){
            //Mostrar un usuario
            $sql = $this->conecBase->prepare("SELECT * FROM usuarios WHERE id=$id");
            $sql->execute();
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
            exit();
        }

        public function CrearUsuario(string $nombre,string $contra, string $email, int $rol){
            $input = $_POST;
            $sql = "INSERT INTO usuarios(Nombre, Contraseña, Email, ID_Rol) VALUES ($nombre, $contra, $email, $rol)";
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        }

        public function ModificarUsuario(int $id,string $nombre,string $contra, string $email, int $rol){
            $input = $_POST;
            $sql = "UPDATE usuarios SET Nombre = $nombre, Contraseña=$contra, Email=$email, ID_Rol=$rol WHERE id=$id";
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        }
        
        public function IniciarSesion(string $nombre, string $clave){
            $sql = $this->conecBase->prepare("SELECT * FROM usuarios WHERE Nombre=$nombre AND Contra=$clave");
            $sql->execute();
            $user = $sql->fetch(PDO::FETCH_ASSOC);
            if($user){
                $notFound= "Datos incorrectos";
                echo json_encode($notFound);
            }else{
                header("HTTP/1.1 200 OK");
                echo json_encode($user);
                exit();
            }
            
        }
        
    }
?>