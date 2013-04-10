<?
include_once 'Banco.class.php';
abstract class ObjetoBanco extends Banco {
    public $tabela     = "";
    public $campos_valores     = array();
    public $chave      = NULL;
    public $valorChave = NULL;
    public $filtros    = NULL;
        
    function addCampo($campo = NULL, $valor = NULL)
    {
        if ($campo != NULL)
        {
            $this->campos_valores[$campo] = $valor;
        }
    }
    
    function delCampo($campo)
    {
        if (array_key_exists($campo, $this->campos_valores))
        {
            unset($this->campos_valores[$campo]);
        }
    }
    
    function setValor($campo = NULL, $valor = NULL)
    {
        if ($campo != NULL && $valor != NULL)
        {
            $this->campos_valores[$campo] = $valor;
        }
    }
    
    function getValor($campo = NULL)
    {
        if ($campo != NULL && array_key_exists($campo, $this->campos_valores))
        {
            return $this->campos_valores[$campo];
        }
        else
        {
            return FALSE;
        }
    }
}
?>
