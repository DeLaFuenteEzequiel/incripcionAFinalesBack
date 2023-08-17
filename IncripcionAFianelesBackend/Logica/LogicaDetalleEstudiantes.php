<?php 
    include "../Modelos/DetalleEstudiantes.php";
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

        public function TraerDetalleEstudiantes(){                            
            //Mostrar todos los detalles
            $sql = $this->conecBase->prepare(
                "      SELECT 
                                                  mesa.ID as ID_Mesa, 
	                                              mesa.Fecha,
                                                  m.Nombre as Materia,
                                                  e.ID as ID_Estudiante   
                                                  e.Nombre,
                                                  e.Apellido,
                                                  e.DNI,
                                                 
                                                  from mesadeexamenes as mesa
                                                  inner join materias as m on m.ID = mesa.ID_Materia
                                                  inner join estudiantes as e on e.ID = mesa.ID_Estudiante";
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function CrearDetalleEstudiante(string $Estado,int $ID_Estudiante ,int $ID_Materia ){
            $input = $_POST;
            $sql = "INSERT INTO detallesestudiante(ID_Estudiante,ID_Materia,Estado) VALUES ($ID_estudiante,$ID_Materia,$Estado)";
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
        public function ModificarEstadoDetalleEstudiante(int $ID,string $Estado){
            $input = $_POST;
            $sql = "UPDATE detalleestudiante SET Estado = $Estado WHERE ID=$ID";
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
        public function ModificarMateriaDetalleEstudiante(int $ID,int $ID_Materia){
            $input = $_POST;
            $sql = "UPDATE detalleestudiante SET ID_Materia = $ID_Materia WHERE ID=$ID";
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

        public function ModificarEstudianteEstadoDetalleEstudiante(int $ID,int $ID_Estudiante){
            $input = $_POST;
            $sql = "UPDATE detalleestudiante SET ID_Estudiante = $ID_Estudiante WHERE ID=$ID";
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

        public function ModificarEstadoMateriaYestudianteDetalleEstudiante(int $ID,string $Estado,int $ID_Estudiante,int $ID_Materia){
            $input = $_POST;
            $sql = "UPDATE detalleestudiante SET Estado = $Estado WHERE ID=$ID";
            $sql = "UPDATE detalleestudiante SET ID_Estudiante = $ID_Estudiante WHERE ID=$ID";
            $sql = "UPDATE detalleestudiante SET ID_Materia = $ID_Materia WHERE ID=$ID";
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


        public function EliminarDetalleEstudiante ( int $ID_Detalle,int $ID_Materia){
            $input = $_POST;
            $sql = "DELETE FROM detalleestudiante where (ID=$ID_Detalle) and (ID_Materia = $ID_Materia)";  // nose si agarra bien los parentesis y si esta bien
            $estado = $this->conecBase->prepare($sql);
            //bindAllValues($estado, $input);// nose que onda pero yo lo comento xD x2
            $estado->execute();
            $postId=$this->conecBase->lastInsertId();
            if($postId){
                $input['id']=$postId;
                header("HTTP/1.1 200 OK");
                echo json_encode($input);
                exit();
            }

        }

        

        ?>