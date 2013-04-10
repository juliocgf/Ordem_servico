<?php
    include 'header.php';
    
    $form = new Formulario('Receita');
    

    if ($form->requisicaoFeita())
    {

        $receita = new Receita($form->capturaDados());
        $receita->inserir($receita);

        $aviso = new Aviso('success', 'Receita cadastrada com sucesso!');
    }
    $form->start();
    if (isset($aviso))
    {
        $form->content($aviso->aviso);
    }
    
    $form->input('text', 'valor', 'Valor', 'Insira o valor da receita', '', true);
    $form->textarea('descricao', 'Descrição');
    $form->input('date', 'data', 'Insira a data');
   
    
    $form->back('Cancelar');
    $form->submit('Cadastrar');
    $form->end();
    
    $form->show();
    
    include 'footer.php';

?>