<?php
    abstract class Banco
    {
        public $user = "root"; // Usuário do banco de dados
        public $senha = ""; // Senha do banco de dados
        public $bd = "os"; // Nome do Banco de dados MySQL
        public $server = "localhost"; //host – servidor
        public $con;
        public $dataset = NULL;

        // Construtor
        public function __construct()
        {
            $this->con = mysql_connect($this->server, $this->user, $this->senha) or exit ("Falha ao conectar com o banco de dados: ".  mysql_error());
            mysql_select_db($this->bd, $this->con);
        }
        //Encerra a conexão
        public function __destruct()
        {
            //mysql_close($this->con);
        }
        public function inserir(ObjetoBanco $objeto)
        {
            $sql = "insert into ".$objeto->tabela." (";
            for ($i = 0;$i < count($objeto->campos_valores);$i++)
            {
                $sql .= key($objeto->campos_valores);
                if ($i < (count($objeto->campos_valores)-1))
                {
                    $sql .= ", ";
                }
                else
                {
                    $sql .= ") ";
                }
                next($objeto->campos_valores);
            }
            reset($objeto->campos_valores);
            $sql .= "values (";
            for ($i = 0;$i < count($objeto->campos_valores);$i++)
            {
                $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                    $objeto->campos_valores[key($objeto->campos_valores)]:
                    "'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
                if ($i < (count($objeto->campos_valores)-1))
                {
                    $sql .= ", ";
                }
                else
                {
                    $sql .= ") ";
                }
                next($objeto->campos_valores);
            }
            return $this->ExecutaSql($sql);
        }
        public function atualizar(ObjetoBanco $objeto)
        {
            $sql = "update ".$objeto->tabela." set ";
            for ($i = 0;$i < count($objeto->campos_valores);$i++)
            {
                $sql .= key($objeto->campos_valores)."=";
                $sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                    $objeto->campos_valores[key($objeto->campos_valores)]:
                    "'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
                if ($i < (count($objeto->campos_valores)-1))
                {
                    $sql .= ", ";
                }
                else
                {
                    $sql .= " ";
                }
                next($objeto->campos_valores);
            }
            $sql .= " where ".$objeto->chave."=";
            $sql .= is_numeric($objeto->valorChave) ? $objeto->valorChave : "'".$objeto->valorChave."'";
            reset($objeto->campos_valores);
            return $this->ExecutaSql($sql);
            
        }
        
        public function deletar(ObjetoBanco $objeto)
        {
            $sql = "delete from ".$objeto->tabela." where ".$objeto->chave."=";
            $sql .= is_numeric($objeto->valorChave) ? $objeto->valorChave : "'".$objeto->valorChave."'";
            return $this->ExecutaSql($sql);
        }
        public function selecionaTudo(ObjetoBanco $objeto)
        {
            $sql = "select * from ".$objeto->tabela;
            if ($objeto->filtros != NULL)
            {
                $sql .= " ".$objeto->filtros;
            }
            return $this->ExecutaSql($sql);
        }

        public function ExecutaSql($sql = NULL)
        {
            if ($sql != NULL)
            {
                $query = mysql_query($sql) or exit ("Erro ao Executar SQL: ".mysql_error());
                if (substr(trim(strtolower($sql)), 0,6) == 'select')
                {
                    $this->dataset = $query;
                    return $query;
                }
                else
                {
                    return NULL;
                }
            }
        }
        public function retornaDados($tipo = NULL)
        {
            switch (strtolower($tipo))
            {
                case "array":
                    return mysql_fetch_array($this->dataset);
                    break;
                case "assoc":
                    return mysql_fetch_assoc($this->dataset);
                    break;
                case "object":
                    return mysql_fetch_object($this->dataset);
                    break;
                case "array":
                    return mysql_fetch_array($this->dataset);
                    break;
                default :
                    return mysql_fetch_object($this->dataset);
                    break;
            }
        }
    }
?>
