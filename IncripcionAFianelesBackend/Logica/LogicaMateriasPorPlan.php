<?php 
    include "../Modelos/MateriasPorPlan.php";
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


        public function TraerMateriaPorPlan(){                            
            //Mostrar los incriptos
            $sql = $this->conecBase->prepare("SELECT 
                                            materia.ID as ID_Plan, 
                                            materias.Nombre as Materia,
                                            plan.nombre as Plan  
                                           
                                            from materiasporplan as Materia
                                            inner join materias on materias.ID = Materia.ID_Materia
                                            inner join plandeestudio as plan on plan.ID = Materia.ID_PlanDeEstudio");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit();                                 
        }

        public function CrearMateriasPorPlan(int $ID  ,int $ID_Materia ,int $ID_PlanDeestudio ){
            $input = $_POST;
            $sql = "INSERT INTO materiasporplan(ID,ID_Materia,ID_PlanDeestudio) VALUES ($ID,$ID_Materia,$ID_PlanDeestudio)";
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


        public function ModificarMateriaPorPlan(int $ID,INt $ID_Materia,int $ID_PlanDeestudio ){
            $input = $_POST;
            $sql = "UPDATE materiasporplan SET ID_Materia=$ID_Materia  WHERE ID=$ID";
            $sql = "UPDATE materiasporplan SET ID_$ID_PlanDeestudio=$ID_PlanDeestudio  WHERE ID=$ID";

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

        public function EliminarMateriasPorPlan (int $ID_Materia,int $ID_PlanDeEstudio){
            $input = $_POST;
            $sql = "DELETE FROM materiasporplan where  ( (ID_Materia=$ID_Materia) and (ID_PlanDeEstudio =$ID_PlanDeEstudio ))";  // nose si agarra bien los parentesis y si esta bien
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
?>
