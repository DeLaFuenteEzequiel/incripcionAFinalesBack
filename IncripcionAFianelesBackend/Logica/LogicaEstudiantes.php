<?php  
    include "../Modelos/Estudiantes.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

        class Estudiante
        {
            private $base;
            private $conecBase;
        
            public function __construc(){
                $this->base = new DB;
                $this->conecBase = $this->base->conectar();
            }
            
            public function TraerEstudiantes(){                            
                //Mostrar todos los usuarios
                $sql = $this->conecBase->prepare("SELECT  
                                                e.ID as ID_Estudiantes,
                                                e.Nombre,
                                                e.Apellido,
                                                e.DNI,
                                                e.Activo,
                                                u.Nombre as nombre_usuario,
                                                p.Nombre as nomplandeestudio,
                                                from estudiantes as e 
                                                inner join usuarios as u on u.ID=e.ID 
                                                inner join planesdeestudio as p on p.ID=e.ID");
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetchAll());
                exit();                                 
            }
            
            public function CrearEstudiante(string $Nombre,string $Apellido,string $DNI,int $Activo,int $ID_Usuario,int $ID_Plan)
            {
                $input = $_POST;
                $sql = "INSERT INTO estudiantes (Nombre,Apellido,DNI,Activo,ID_Usuario,ID_Plan) VALUES ($Nombre, $Apellido, $DNI, $Activo,$ID_Usuario,$ID_Plan)";
                $estado = $this->conecBase->prepare($sql);
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
            }
            public function ModificarEstudiantes(int $id,string $nombre,string $Apellido, string $DNI,int $ID_Plan ){
                $input = $_POST;
                $sql = "UPDATE estudiantes SET Nombre = $nombre, Apellido=$Apellido, DNI=$DNI, ID_Plan=$ID_Plan  WHERE ID=$id";
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
    }
?>