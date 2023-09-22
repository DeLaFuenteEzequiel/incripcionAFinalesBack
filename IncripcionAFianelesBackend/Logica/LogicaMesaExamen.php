<?php 
    include "../Modelos/MesaDeExamen.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

    class LogicaDetalleEstudiantes{

        private $base;
        private $conecBase;
    
        public function __construct()
        {
            $this->base = new DB();
            $this->conecBase = $this->base->conectar();
        }

        public function TraerMesasExamenes(){                            
            //Mostrar todos las mesas
            $sql = $this->conecBase->prepare(
                "SELECT Mesa.ID, 
                                            Mesa.FECHA,
                                            m.Nombre as Materia,
                                            p.ID as ID_Profesor
                                            p.Nombre as Profesor_nombre,
                                            p.Apellido as Profesor_apellido 
                                          
                                            from mesadeexamenes as Mesa
                                            inner join materias as m on m.ID = Mesa.ID_Materia
                                            inner join profesores as p on p.ID = Mesa.ID_Profesor");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function CrearMesaDeExamenes(int $ID ,DateTime $Fecha ,int $ID_Materia ,int $ID_Profesor ){
            $input = $_POST;
            $sql = "INSERT INTO mesadeexamenes(ID,Fecha,ID_Materia,ID_Profesor) VALUES ($ID,$Fecha,$ID_Materia,$ID_Profesor)";
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input); // nose que onda pero yo lo comento xD
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }
        }

            public function ModificarFechaMesaDeExamenes(int $ID,DateTime $Fecha){
                $input = $_POST;
                $sql = "UPDATE mesadeexamenes SET Fecha = $Fecha WHERE ID=$ID";
                $estado = $this->conecBase->prepare($sql);
                //bindAllValues($estado, $input);//nose x 32
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
            }
            public function ModificarMateriaMesaDeExamenes(int $ID,int $ID_Materia){
                $input = $_POST;
                $sql = "UPDATE mesadeexamenes SET ID_Materia = $ID_Materia WHERE ID=$ID";
                $estado = $this->conecBase->prepare($sql);
                //bindAllValues($estado, $input);//nose x 64
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
            }

            public function ModificarProfesorMesaDeExamenes(int $ID,int $ID_Profesor){
                $input = $_POST;
                $sql = "UPDATE mesadeexamenes SET ID_Profesor = $ID_Profesor WHERE ID=$ID";
                $estado = $this->conecBase->prepare($sql);
                //bindAllValues($estado, $input);//nose x 128
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
            }

            public function ModificarEProfesorMateriaFecha(int $ID,int $ID_Profesor,DateTime $Fecha,int $ID_Materia){
                $input = $_POST;
                $sql = "UPDATE mesadeexamenes SET Fecha = $Fecha WHERE ID=$ID";
                $sql = "UPDATE mesadeexamenes SET ID_Profesor = $ID_Profesor WHERE ID=$ID";
                $sql = "UPDATE mesadeexamenes SET ID_Materia = $ID_Materia WHERE ID=$ID";
                $estado = $this->conecBase->prepare($sql);
                //bindAllValues($estado, $input); x256 WTF
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
            }

          /*  public function EliminarMesaDeExamenes (int $ID_Materia ,int $ID_Profesor){
                $input = $_POST;
                $sql = "DELETE FROM mesadeexamenes where (ID_Materia = $ID_Materia)  and (ID_Profesor= $ID_Profesor)";  // nose si agarra bien los parentesis y si esta bien
                $estado = $this->conecBase->prepare($sql);
                //bindAllValues($estado, $input);// nose que onda pero yo lo comento xD Han pasado mil años
                $estado->execute();
                $postId=$this->conecBase->lastInsertId();
                if($postId){
                    $input['id']=$postId;
                    header("HTTP/1.1 200 OK");
                    echo json_encode($input);
                    exit();
                }
    
            }*/
            


    }