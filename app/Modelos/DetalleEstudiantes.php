<?php 

    class DetalleEstudiante{
        public int $ID;
        public Estudiante $Estudiante;
        public Materia $Materia;
        public string $Estado;
        public function _construct(int $id, Estudiante $estudiante,Materia $materias ,string $estado)
        {
            $this->ID =$id;
            $this->Estudiante = $estudiante;
            $this->Materia = $materias;
            $this->Estado = $estado;
        }
    }
?>