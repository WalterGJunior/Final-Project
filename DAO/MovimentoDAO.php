<?php

class MovimentoDAO{

    public function RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs){

        if($tipo == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == '' || $conta == '' ){
            return 0;   
        }

    }

}