<?php 
class MesaDeExamen 
 {
    public int $ID;
    public string  $Fecha ;
    public Materia $Materia;
    public Profesor $Profesor;

    public function _construct(int $id, DateTime $fecha ,Materia $materia ,Profesor $profesor)
    {
        $this->$ID =$id;
        $this->$Fecha =$fecha;
        $this->$Materia=$materia;
        $this->$Profesor=$profesor;

    }
 }

?>