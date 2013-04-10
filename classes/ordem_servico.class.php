<?php
include_once 'ObjetoBanco.class.php';
class Ordem_servico extends ObjetoBanco {
    function __construct($campos = array())
    {
        parent::__construct();
        $this->tabela = 'ordem_servico';
        if (sizeof($campos) <= 0)
        {
            $this->campos_valores = array(
                "id"                => NULL,
                "valor"             => NULL,
                "servico"           => NULL,
                "cliente"           => NULL,
                "funcionario"       => NULL
                
            );
        }
        else
        {
            $this->campos_valores = $campos;
        }
        $this->chave = "id";
    }
}

?>
