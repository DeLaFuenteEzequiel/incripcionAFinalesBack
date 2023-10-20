<?php 
 class Materia
 {
    public int $ID;
    public string $Nombre; 


    public function _construct(int $id , string $nombre)
    {
        $this-> ID = $id;
        $this-> Nombre=$nombre;

    }


 }

?>