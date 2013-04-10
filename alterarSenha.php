<?php
    include 'header.php';
    $form = new Formulario("Alterar Senha ( {$_SESSION['login']} )");
    if ($form->requisicaoFeita())
    {

        $dados = $form->capturaDados();
        
        $usuario = new Usuario(array('local'=>$_SESSION['local'], 'login'=>"{$_SESSION['login']}"));
        $usuario->filtros = "where login = '{$_SESSION['login']}'";
        $usuario->selecionaTudo($usuario);
        $user = $usuario->retornaDados('array');
        if ($dados['senhaAntiga'] == $user['senha'])
        {
            $usuario->setValor('senha', $dados['senhaNova']);
            $usuario->valorChave = $usuario->getValor('login');
            $usuario->atualizar($usuario);
            
            $aviso = new Aviso('success', 'Senha alterada com sucesso.');
            
        }
        else
        {
            $aviso = new Aviso('error', 'Senha antiga não confere.');
        }
    }
    $form->start();
    if (isset($aviso))
    {
        $form->content($aviso->aviso);
    }
    
    $form->input('password', 'senhaAntiga', 'Senha Atual', 'Insira sua senha atual...', '', true);
    $form->input('password', 'senhaNova', 'Nova Senha', 'Insira sua nova senha...', '', true);
    
    $form->back('Cancelar');
    $form->submit('Alterar');
    $form->end();
    
    $form->show();
    
    include 'footer.php';

?>