<?php

    //Obtener parametros para el update
    function traerParametros($input){
        $filtrarParametros = [];
        foreach($input as $param=>$value){
            $filtrarParametros[] = "$param =:$param";
        }
        return implode(", ", $filtrarParametros);
    }

    //Asociar todos los parametros a un sql
    function bindAllValues($estado, $parametros){
        foreach($parametros as $param => $value){
            $estado->bindValue(':'.$param, $value);
        }
        return $estado;
    }
?>