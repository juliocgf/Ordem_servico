<?php
    include 'header.php';
    
    $form = new Formulario('Ordem de serviço');
    

    if ($form->requisicaoFeita())
    {

        $os = new ordem_servico($form->capturaDados());
        $os->inserir($os);

        $aviso = new Aviso('success', 'Notebook cadastrado com sucesso!');
    }
    $form->start();
    if (isset($aviso))
    {
        $form->content($aviso->aviso);
    }
    
    $form->input('text', 'valor', 'Valor', 'Insira o valor do serviço', '', true);
    $form->textarea('servico','Serviço', 'Descreva o serviço', '', true);
    $form->input('text', 'Cliente', 'Insira o nome do cliente');
    $form->selectObjeto($funcionario = new Funcionario(), 'funcionario', 'Funcionario');
    unset($funcionario);
    
    $form->back('Cancelar');
    $form->submit('Cadastrar');
    $form->end();
    
    $form->show();
    
    include 'footer.php';

?>