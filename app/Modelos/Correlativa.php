<?php
    class Correlativa{
        public int $ID;
        public Materia $Materia;
        public Materia $Correlativa;

        public function __construct(int $id, Materia $materia, Materia $correlativa){
            $this->ID = $id;
            $this->Materia = $materia;
            $this->Correlativa = $correlativa;
        }
    }
?>