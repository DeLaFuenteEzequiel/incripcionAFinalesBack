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
            $sql = "INSERT INTO usuarios (Nombre, Contra, Email, ID_Rol) VALUES (:nombre, :contra, :email, :rol)";
            $result= $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);
            $result->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $result->bindParam(':contra', $contra, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':rol', $rol, PDO::PARAM_INT);
            $result->execute();            
            $postId=$this->conecBase->lastInsertId();            
            $input['id']=$postId;
            $input['DATOS'] = $result->errorInfo();
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();        
        }

        public function ModificarUsuario(int $id,string $nombre,string $contra, string $email, int $rol){
            $sql = "UPDATE usuarios SET Nombre = :nombre, Contra= :contra, Email= :email, ID_Rol= :rol WHERE id= :id";
            $result = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);
            $result->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $result->bindParam(':contra', $contra, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':rol', $rol, PDO::PARAM_INT);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();            
            $input['Respuesta']="Exito";
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
            
        }

        public function IniciarSesion(string $nombre, string $clave){
            $sql = $this->conecBase->prepare("SELECT * FROM usuarios WHERE Nombre = :nombre AND Contra = :clave");
            $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $sql->bindParam(':clave', $clave, PDO::PARAM_STR);
            
            if ($sql->execute()) {
                $user = $sql->fetch(PDO::FETCH_ASSOC);
                echo json_encode($user);
            } else {
                header("HTTP/1.1 404 Not Found");
                // Manejar el error de consulta aquí si es necesario.
                echo json_encode(array('error' => 'Error en la consulta.'));
            }
        }
        
        /*public function IniciarSesion(string $nombre, string $clave){
            $sql = $this->conecBase->prepare("SELECT * FROM usuarios WHERE Nombre=$nombre AND Contra=$clave");
            $sql->execute();
            //$user = $sql->fetch(PDO::FETCH_ASSOC);   
            echo json_encode($sql->fetch(PDO::FETCH_ASSOC));         
            
            
        }*/

        /*if($user){
                header("HTTP/1.1 404 Not Found");
                $notFound= "Datos incorrectos";
                echo json_encode($notFound);
                exit();
            }else{
                header("HTTP/1.1 200 OK");
                echo json_encode($user);
                exit();
            }*/
        
    }
?>