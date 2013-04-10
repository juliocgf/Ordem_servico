<?php
include_once 'ObjetoBanco.class.php';
class funcionario extends ObjetoBanco {
    function __construct($campos = array())
    {
        parent::__construct();
        $this->tabela = 'funcionario';
        if (sizeof($campos) <= 0)
        {
            $this->campos_valores = array(
                "nome"          => NULL
            );
        }
        else
        {
            $this->campos_valores = $campos;
        }
        $this->chave = "nome";
    }
}

?>
