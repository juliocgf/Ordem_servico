<?php
include_once 'ObjetoBanco.class.php';
class Despesa extends ObjetoBanco {
    function __construct($campos = array())
    {
        parent::__construct();
        $this->tabela = 'despesa';
        if (sizeof($campos) <= 0)
        {
            $this->campos_valores = array(
                "id"          => NULL,
                "valor"          => NULL,
                "descricao"      => NULL,
                "data"           => NULL
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
