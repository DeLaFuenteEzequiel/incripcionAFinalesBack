<?php 

class IncriptoPorMesa
{
    public int $ID;
    public MesaDeExamen $Mesa;
    public Estudiante $Estudiante;

    public function _construct(int $id, MesaDeExamen $mesa,Estudiante $estudiante)
    {
        $this->ID = $id;
        $this->Mesa = $mesa;
        $this->Estudiante = $estudiante;

    }
}

?>