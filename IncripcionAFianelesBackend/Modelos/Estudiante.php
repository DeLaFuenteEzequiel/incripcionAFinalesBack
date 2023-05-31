<?php  

        class Estudiante
        {
            public int $ID;
            public string $Nombre;
            public string $Apellido;
            public string $DNI;
           
        
            public function __construc(int $id,string $nombre,string $apellido,string $dni)
            {
                $this-> ID = $id;
                $this-> Nombre = $nombre;
                $this-> Apellido = $apellido;
                $this-> DNI = $dni;

            }


        }





?>