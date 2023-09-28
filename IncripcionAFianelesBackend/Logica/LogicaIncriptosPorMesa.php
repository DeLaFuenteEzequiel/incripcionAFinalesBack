<?php 
    include "../Modelos/IncriptosPorMesas.php";
    include "../Datos/Db.php";
    include "../Utilidades/Utilidades.php";

    class LogicaInscriptosXMesa{

        private $base;
        private $conecBase;
    
        public function __construct()
        {
            $this->base = new DB();
            $this->conecBase = $this->base->conectar();
        }

        public function TraerIncriptoPorMesas(){                            
            //Mostrar los incriptos
            $sql = $this->conecBase->prepare("SELECT 
                                            I.ID as ID_Inscriptos, 
                                            M.FECHA,
                                            materias.Nombre as Materia,
                                            e.ID as ID_Estudiante
                                            e.Nombre as Nombre_Estudiante,
                                            e.Apellido as Apellido_Estudiante,
                                            e.DNI
                                           
                                            from inscriptospormesa as I
                                            inner join mesadeexamenes as M on M.ID = I.ID_MesaDeExamen
                                            inner join materias on materias.ID = M.ID_Materia
                                            inner join estudiantes as e on e.ID = I.ID_Estudiante");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function CrearIncriptosPorMesas(int $ID  ,int $ID_MesaDeExamen ,int $ID_Estudiante ){
            $input = $_POST;
            $sql = "INSERT INTO inscriptospormesa(ID,ID_MesaDeExamen,ID_Estudiante) VALUES ($ID,$ID_MesaDeExamen,$ID_Estudiante)";
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

        public function ModificarMesaDeExamnesDeIncriptoPorMesas(int $ID,INt $ID_MesaDeExamen){
            $input = $_POST;
            $sql = "UPDATE inscriptospormesa SET ID_MesaDeExamen=$ID_MesaDeExamen = $ID_MesaDeExamen WHERE ID=$ID";
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

        public function ModificarEstudianteDeIncriptoPorMesas(int $ID,INt $ID_Estudiante){
            $input = $_POST;
            $sql = "UPDATE inscriptospormesa SET ID_Estudiante=$ID_Estudiante = $ID_Estudiante WHERE ID=$ID";
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

        public function ModificarMesaDeexmanesYestudianteDeIncriptoPorMesas(int $ID,INt $ID_MesaDeExamen,int $ID_Estudiante ){
            $input = $_POST;
            $sql = "UPDATE inscriptospormesa SET ID_MesaDeExamen=$ID_MesaDeExamen WHERE ID=$ID";
            $sql = "UPDATE inscriptospormesa SET ID_Estudiante=$ID_Estudiante  WHERE ID=$ID";

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

        public function EliminarIncriptosPorMsa (int $ID_MesaDeExamen,int $ID_Estudiante){
            $input = $_POST;
            $sql = "DELETE FROM inscriptospormesa where (ID_MesaDeExamen=$ID_MesaDeExamen) and (ID_Estudiante = $ID_Estudiante)";  // nose si agarra bien los parentesis y si esta bien
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

        }
    }


?>