<?php  

        class PlanDeEstudio
        {
            public int $ID;
            public string $Nombre;
            
           
        
            public function __construc (int $id,string $nombre)
            {
                $this->ID = $id;
                $this->Nombre = $nombre;
            }
        }
?>