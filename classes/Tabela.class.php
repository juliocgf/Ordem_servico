<?php
    class Tabela {
        private $html;
        private $classe;
        private $id;
        function __construct($titulo) {
            $this->html = "\n<div class='table'><h2 class='tableTitle'>$titulo</h2>\n<table cellpadding='0' cellspacing='0' border='0' class='display' id='example'>\n";
        }
        
        function addCabecalho($itens = array())
        {
            $this->html .= "\t<thead>\n\t\t<tr>\n";
            
            foreach ($itens as $valor) {
                $this->html .= "\t\t\t<th>$valor</th>\n";
            }
            
            $this->html .= "\t\t</tr>\n\t</thead>\n\t<tbody>";
            
        }
        
        function addLinha($itens = array())
        {
            $this->html .= "\n\t\t<tr>\n";
            
            foreach ($itens as $valor) {
                $this->html .= "\t\t\t<td>$valor</td>\n";
            }
            
            $this->html .= "\t\t</tr>";
        }
        
        function addLinhaObjeto ($objeto)
        {
            while ($itens = $objeto->retornaDados())
            {
                $this->html .= "\n\t\t<tr>\n";

                foreach ($itens as $valor) {
                    $this->html .= "\t\t\t<td>$valor</td>\n";
                }

                $this->html .= "\t\t</tr>";
            }
        }
        function addLinhaObjetoOpcao ($objeto, $opcoes)
        {   
            $campo_chave = $objeto->chave;
            $menu = "";
            $a = explode('/', $_SERVER['SCRIPT_NAME']);
            $a = explode('.', $a[3]);
            $a = $a[0];
            $a = substr($a, 5);
            while ($itens = $objeto->retornaDados())
            {
                $this->html .= "\n\t\t<tr>\n";

                foreach ($itens as $valor) {
                    $this->html .= "\t\t\t<td>$valor</td>\n";
                }
                foreach ($opcoes as $opcao)
                {
                    $menu .="<a href='{$opcao}.php?id={$itens->$campo_chave}&tipo={$a}'><img src='../img/{$opcao}.png' title='$opcao' /></a>";
                }
                $this->html .= "\t\t\t<td><div class='opcoes'>$menu</div></td>\n";
                $menu = "";
                $this->html .= "\t\t</tr>";
            }
        }
        
        function __destruct() {
            $this->html .= "\n\t</tbody>\n</table>\n</div>\n";
            $this->show();
        }
        
        function show()
        {
            echo $this->html;
        }
        
    }

?>
