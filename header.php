<!DOCTYPE html>
<?php
    function __autoload($classe)
    {
        include_once "classes/{$classe}.class.php";
    }
    
    session_start();
    
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] != TRUE || $_SESSION['tipo'] != 'user')
    {
        header("Location: index.php");
    }
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
        <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
        <?php
            $a = explode('/', $_SERVER['SCRIPT_NAME']);
            $a = explode('.', $a[2]);
            $a = $a[0];
            $b = substr($a, 0, 5);
            
            if ($b == 'lista')
            {
                
                $a = substr($a, 5);
                                
                $data_a = date('d/m/Y h:i:s');
                $data_b  = date('dmYhis');
                
                $a = "Usuário: {$_SESSION['login']} | Relatório: Lista de {$a} | Data: {$data_a}";
        ?>
        <link href="css/smoothness/jquery-ui-1.9.1.custom.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/TableTools_JUI.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/demo_table_jui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="css/TableTools.css.css" media="all" />
        <script src="js/jquery-1.8.2.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
        <script type="text/javascript" language="javascript" src="js/TableTools.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				oTable = $('#example').dataTable({
                    "oLanguage": {"sUrl": "add/datatables.Portuguese.txt"},
					
					"sPaginationType": "full_numbers",
                    
                    "bJQueryUI": true,
                    
                    "sDom": '<"H"Tfr>t<"F"ip>',
                    
                    "oTableTools": {
                        "aButtons": [
                            "xls", 
                            {
                                "sExtends": "pdf",
                                "sPdfOrientation": "landscape",
                                "sButtonText": "PDF",
                                "sPdfMessage": "<?php echo $a; ?>"
                            }
                        ],
                        "sSwfPath": "add/copy_csv_xls_pdf.swf"
                    }
                    
                    
				});
                
			} );
		</script>
        <?php
            }
            else
            {
                $data_b = "Todos os direitos reservados";
            }
        ?>
        <title>Sistema de Ordem de Serviço <?php echo $data_b; ?></title>
    </head>
    <body>
<?php
    
    $menu = new Menu();
    $menu->addItem('Home', 'painel.php');
    $menu->addSubmenu('Ordem de serviço',
            array(
                'Ordem de serviço' =>'ordem_servico.php'
                
    ));
    
    $menu->addSubmenu('Receita',
            array(
                'Receita' =>'receita.php'
    ));
      $menu->addSubmenu('Despesa',
            array(
                'Despesa' =>'despesa.php'
    ));
      
    $menu->addSubmenu('Listar',
            array(
                'Receita' =>'listaReceita.php', 
                'Despesa'  =>'listaDespesa.php', 
                'Ordens'    =>'listaOs.php'
    ));
     
    $menu->addSubmenu("Configurações",
            array(
                'Alterar Senha' =>'alterarSenha.php', 
                'Sair'        =>'sair.php'
    ));
    unset($menu);
?>