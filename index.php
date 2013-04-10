<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Ordem de Serviço - SERGRAF</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
    <link href="" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/index.css" media="all" />
    <style type="text/css">
        
    </style>
</head>
<body>
    <div id="logo"></div>
    <?php
        function __autoload($classe)
        {
            include_once "classes/{$classe}.class.php";
        }
        
        session_start();
        
        if (isset($_SESSION['logado']))
        {
            if ($_SESSION['logado'] == TRUE)
            {
                header("Location: painel.php");
            }
        }
         
        
        $form = new Formulario('Sistema de Ordem de Serviço - SERGRAF');
        if ($form->requisicaoFeita())
        {
            $usuario = new Usuario($form->capturaDados());
            $aviso = $usuario->validar_login();
        }
        
        $form->start();
        
        if (isset($aviso))
        {
            $form->content($aviso->aviso);
        }
        
        $form->input('text', 'login', 'Nome de Usuário', '', '', true);
        $form->input('password', 'senha', 'Senha', '', '', TRUE);
        
        $form->back('Cancelar');
        $form->submit('Entrar');
        
        $form->end();
        
        $form->show();
        
        include 'footer.php';
?>