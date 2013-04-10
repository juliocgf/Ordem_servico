<?php
include_once 'ObjetoBanco.class.php';
include_once 'Aviso.class.php';
class Usuario extends ObjetoBanco {
    function __construct($campos = array())
    {
        parent::__construct();
        $this->tabela = 'usuario';
        if (sizeof($campos) <= 0)
        {
            $this->campos_valores = array(
                "login"          => NULL,
                "senha"          => NULL,
                "local"          => NULL,
                "tipo"           => NULL
            );
        }
        else
        {
            $this->campos_valores = $campos;
        }
        $this->chave = "login";
    }
    
    function validar_login()
    {
        $this->filtros = "where login = '{$this->campos_valores['login']}' AND senha = '{$this->campos_valores['senha']}'";
        
        $this->selecionaTudo($this);
        
        if ($dados = $this->retornaDados())
        {
            session_start();
            $_SESSION['login'] = $dados->login;
            $_SESSION['local'] = $dados->local;
            $_SESSION['tipo'] = $dados->tipo;
            $_SESSION['logado'] = TRUE;
            header("Location: painel.php");
        }
        else
        {
            return $aviso = new Aviso('error', 'Usuário ou senha não conferem, tente novamente.');
        }
    }
}

?>