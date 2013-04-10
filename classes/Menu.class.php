<?php
class Menu {
    var $html;
    function __construct() {
        $this->html  = "<nav>\n\t<ul>\n";
    }
    
    function __destruct() {
        $this->html .= "\t</ul>\n</nav>";
        $this->show();
    }


    function addItem($nome, $link)
    {
        $this->html .= "\t\t<li><a href='$link'>$nome</a></li>\n";
    }
    
    function addSubmenu($nome, $subitens = array())
    {
        $this->html .= "\t\t<li><a href='#'>$nome</a>\n\t\t<ul>\n";
        foreach ($subitens as $titulo => $link)
        {
            $this->html .= "\t\t\t\t<li><a href='$link'>$titulo</a></li>\n";
        }
        $this->html .= "\t\t\t</ul></li>\n";
    }


    
    private function show()
    {
        echo $this->html;
    }
}

?>
