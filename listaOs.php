<?php
    include 'header.php';
    
    $tabela = new Tabela("Ordens de Serviços");
    $tabela->addCabecalho(array('id', 'Valor', 'Serviço', 'Cliente', 'Funcionario'));
    
    $ordem_servico = new ordem_servico();
    $ordem_servico->ExecutaSql("select
        ordem_servico.id,
        ordem_servico.valor,
        ordem_servico.servico, 
        ordem_servico.cliente,
        ordem_servico.funcionario
        from ordem_servico");
    while ($itens = $ordem_servico->retornaDados())
    {
        $dado = array($itens->id, $itens->valor, $itens->servico, $itens->cliente, $itens->funcionario);
        $tabela->addLinha($dado);
    }
    unset($tabela);
    
    include 'footer.php';
?>
