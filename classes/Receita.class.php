<?php
include_once 'ObjetoBanco.class.php';
class Receita extends ObjetoBanco {
    function __construct($campos = array())
    {
        parent::__construct();
        $this->tabela = 'receita';
        if (sizeof($campos) <= 0)
        {
            $this->campos_valores = array(
                "id"          => NULL,
                "valor"          => NULL,
                "descricao"          => NULL,
                "data"          => NULL
                
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
