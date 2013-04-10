<?php
    include 'header.php';
    
    $tabela = new Tabela("Receitas");
    $tabela->addCabecalho(array('id', 'Valor', 'Descrição','Data'));
    
    $receita = new Receita();
    $receita->ExecutaSql("select
        *
        from receita ");
    while ($itens = $receita->retornaDados())
    {
        $dado = array($itens->id, $itens->valor, $itens->descricao,$itens->data);
        $tabela->addLinha($dado);
    }
    unset($tabela);
    
    include 'footer.php';
?>
