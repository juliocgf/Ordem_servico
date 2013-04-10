<?php
    include 'header.php';
    
    $form = new Formulario('Despesa');
    

    if ($form->requisicaoFeita())
    {

        $despesa = new Despesa($form->capturaDados());
        $despesa->inserir($despesa);

        $aviso = new Aviso('success', 'Despesa cadastrada com sucesso!');
    }
    $form->start();
    if (isset($aviso))
    {
        $form->content($aviso->aviso);
    }
    
    $form->input('text', 'valor', 'Valor', 'Insira o valor da despesa', '', true);
    $form->textarea('descricao', 'Descrição');
    $form->input('date', 'data', 'Data');
    
    
    $form->back('Cancelar');
    $form->submit('Cadastrar');
    $form->end();
    
    $form->show();
    
    include 'footer.php';

?>