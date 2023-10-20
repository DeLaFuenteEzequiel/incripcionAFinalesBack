<?php
include "../Materia.php";
include "../PlanDeEstudio.php";

class MateriaPorPlan
{
    public int $ID ;
    public Materia $Materia;
    public PlanDeEstudio $Plan;

    public function _construct(int $id, Materia $materia,PlanDeEstudio $plan)
    {
        $this->ID = $id;
        $this->Materia =$materia;
        $this->Plan = $plan;

    }
}
?>