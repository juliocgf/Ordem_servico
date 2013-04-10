<?php
class Aviso {
    var $tipo;
    var $conteudo;
    var $aviso;
    
    function __construct($tipo, $conteudo) {
        $this->tipo = $tipo;
        $this->conteudo = $conteudo;
        $this->aviso =  
                "<div class='notice {$this->tipo}' onclick=\"style.display = 'none';\">
                    <p>$this->conteudo</p>
                </div>";
        //$this->mostrar();
        //unset($this);
    }
    function mostrar()
    {
        echo $this->aviso;
    }
    
}

?>
