<?php
    class Formulario
    {
        public $html;
        public $method;
        public $action;
        public $legend;
        public $dados;

        function __construct($legend = NULL, $method = NULL, $action = NULL)
        {    
            if ($method == NULL)
            {
                $this->method = "post";
            }
            else
            {
                $this->method = $method;
            }
            if ($action == NULL)
            {
                $this->action = "";
            }
            else
            {
                $this->action = $action;
            }
            if ($legend == NULL)
            {
                $this->legend = "Formulário de dados";
            }
            else
            {
                $this->legend = $legend;
            }
        }
        
        function __destruct() {
            
        }


        function start()
        {
            $this->html .= "<form method='$this->method' action='$this->action'>\n";
            $this->html .= "<div class='fieldset'><h2 class='fieldsetTitle'>$this->legend</h2>\n";
        }
        
        function subTitle($subtitle)
        {
            $this->html .= "<h3 class='fieldsetSubTitle'>$subtitle</h3>\n";
        }
        
        function end() {
            $this->html .= "</div>\n</form>\n";
        }        
        function input($type, $nome, $label, $placeholder = NULL, $value = NULL, $required = NULL, $disabled = NULL)
        {
            if ($required == true) $required = 'required';
            if ($disabled == true) $disabled = 'disabled';
            $this->html .= "<label for='$nome'>$label</label><input type='$type' id='$nome' name='$nome' placeholder='$placeholder' $required $disabled value='$value' />\n";
        }
        function hidden($nome, $value)
        {
            $this->html .= "<input type='hidden' name='$nome' id='$nome' value='$value' />";
        }
        function textarea($nome, $label, $placeholder = NULL, $value = NULL, $required = NULL, $disabled = NULL)
        {
            $this->html .= "<label for='$nome'>$label</label><textarea id='$nome' name='$nome' placeholder='$placeholder' $required $disabled value='$value' ></textarea>";
        }
        function range($nome, $label, $min, $max, $step = NULL, $required=NULL, $disabled = NULL)
        {
            if ($step == NULL) $step = 1;
            if ($disabled == true) $disabled = 'disabled';
            $this->html .= "<label for='$nome'>$label</label><input type='range' id='$nome' name='$nome' min='$min' value='$min' max='$max' step='$step' $required $disabled onchange='value$nome.value=value' />\n";
            $this->html .= "<output class='rangeValue' id='value$nome'>$min</output>";
        }
        
        function separator()
        {
            $this->html .= "<div class='separator'></div>";
        }

        function select($nome, $valores, $label, $selecionado = null, $disabled = NULL)
        {
            if ($disabled == true) $disabled = 'disabled';
            $select = "";
            foreach($valores as $chave => $valor)
            {
                if($valor == $selecionado) $select .="<option value='$chave' selected='selected' >".$valor."</option>\n";
                else                     $select .="<option value='$chave' >".$valor."</option>\n";
            }
            $select = "<label for='$nome'>$label</label><select id='$nome' name='$nome' $disabled >$select</select><br>\n";

            $this->html .= $select;

        }
        function radio($nome, $values, $check, $label, $separation = null, $disabled = NULL)
        {
            $radio = "<label for='$nome'>$label</label>\n<div class='radioBox'>\n";
            if ($disabled == true) $disabled = 'disabled';
            if ($separation == NULL) $separation = '<br />';
            foreach($values as $valor)
            {
                if($valor == $check) $radio .="<label class='radioLabel'><input type='radio' name='$nome' value='$valor' checked $disabled /> $valor</label>$separation\n";
                else               $radio .="<label class='radioLabel'><input type='radio' name='$nome' value='$valor' $disabled /> $valor</label>$separation\n";
            }
            $radio .= "</div>\n";
            $this->html .= $radio;
        }
        
        function selectObjeto(ObjetoBanco $objeto, $nome, $label, $selecionado=NULL)
        {
            
            $objeto->selecionaTudo($objeto);
            $chave = $objeto->chave;
            while ($r = $objeto->retornaDados())
            {
                $res[$r->$chave] = $r->nome;
            }
            
            $this->html .= $this->select($nome, $res, $label, $selecionado);
        }
        
        
        function reset($label)
        {
            $this->html .= "<input type='reset' value='$label' name='reset' />\n";
        }
        function submit($label)
        {
            $this->html .= "<input type='submit' value='$label' name='acao' />\n";
        }
        function back($label)
        {
            $this->html .= "<input type='button' value='$label' onClick='javascript: history.go(-1)' />\n";
        }
        function content($texto)
        {
            $this->html .= $texto."<br>";
        }
        function show()
        {
            echo $this->html;
        }
        
        function capturaDados()
        {
            if ($this->method == 'get')
            {
                $dados  = $_GET;
            }
            else if ($this->method == 'post')
            {
                $dados  = $_POST;
            }
            array_pop($dados);
            return $dados;
        }
        function requisicaoFeita()
        {
            return ($this->method = 'post')?isset($_POST['acao']):isset($_GET['acao']);
        }
        

    }
?>