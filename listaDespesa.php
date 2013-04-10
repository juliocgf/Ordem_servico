<?php
    include 'header.php';
    
    $tabela = new Tabela("Despesas");
    $tabela->addCabecalho(array('id', 'Valor', 'Descrição', 'Data'));
    
    $despesa = new Despesa();
    $despesa->ExecutaSql("select
        *
        from despesa");
    while ($itens = $despesa->retornaDados())
    {
        $dado = array($itens->id, $itens->valor, $itens->descricao, $itens->data);
        $tabela->addLinha($dado);
    }
    unset($tabela);
    
    include 'footer.php';
?>
