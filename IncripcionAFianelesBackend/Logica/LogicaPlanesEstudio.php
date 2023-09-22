<?php  
    include "../Modelos/PlanDeEstudio.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

        class PlanEstudio
        {
            private $base;
            private $conecBase;
        
            public function __construc ()
            {
                $this->base= new DB;
                $this->conecBase = $this->base->conectar();
            }

            public function TraerPlanDeEstudio(){                            
                //Mostrar todos los usuarios
                $sql = $this->conecBase->prepare("SELECT  
                                                p.ID as ID_PlanDeEstudio,
                                                p.Nombre,
                                                c.Nombre as nombre_carrera,
                                                from planesdeestudio as p 
                                                inner join carreras as c on c.ID=p.ID");
                $sql->execute();
                $sql->setFetchMode(PDO::FETCH_ASSOC);
                header("HTTP/1.1 200 OK");
                echo json_encode($sql->fetchAll());
                exit();                                 
            }

            public function CrearPlanDeEstudio( string $Nombre, int $Carrera)
            {

                $input=$_POST;
                $sql="INSERT INTO usuarios(Nombre,ID_Carrera) VALUES ($Nombre, $Carrera)";
                $estado=$this->conecBase->prepare($sql);
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }

            }
            public function ModificarPlanDeEstudio(int $id,string $nombre,int $ID_Carrera ){
                $input = $_POST;
                $sql = "UPDATE plandeestudio SET Nombre = $nombre, ID_Carrera=$ID_Carrera,  WHERE ID=$id";
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