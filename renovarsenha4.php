<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirma&ccedil;&atilde;o Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/estilo.css" />           
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/qunit-1.11.0.css" type="text/css" media="all">
    <script language="JavaScript" type="text/javascript" src="js/validacampo.js"></script>
    <script src="js/w3data.js"></script>  
</head>
 
<body>
    <header class="cabecalho"><img class="seed" src="images/seed_colorida.svg"/></header>
    <h2 class="titulo"><strong>Wifi SEED</strong></h2>
    <fieldset class="container_portal">
    <legend><h3>Cadastro</h3></legend>
<?php 
include_once './classe/usuario.php';

$cpf	= $_POST ["cpf"];	//atribuição do campo "cpf" vindo do formulário para variavel
        
$usuario = new Usuario();

$resultado = $usuario->iniUsuario($cpf);

if ($resultado == 1)
    {
    echo "Deseja realmente Alterar a senha do CPF informado.<br>";
?>
    <form id="renove" name="renove" method="post" action="renovarsenha.php" onsubmit="return validaRenove(); return false;">
        <div class="geral">    
            <div class="campo">CPF:<br>
                    <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" id="cpf" type="text" value='<?= $usuario->getCpf() ?>' readonly />                
            </div> <br />
            <input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Renovar sua senha!" /><br/>            
            <p>&nbsp; </p>
        <div/>    
    <form/>        
<?php    
    } else {
        ?> 
        <div class="campo">O CPF informado n&atilde;o possui cadastro!<br>
        <a type="button" class="botao"  href="cadastro.html">Cadastro</a> <br /> </div> 
        <?php
    }
?> 
    <a type="button" class="botao_login"  href="index.html">Voltar Tela Login!</a>   <br />
    </fieldset>
    <div w3-include-html="classe/footer.html"></div>
    <script> w3IncludeHTML();</script>
    <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="js/qunit-1.11.0.js"></script>  
    <script type="text/javascript" src="js/sinon-1.10.3.js"></script>
    <script type="text/javascript" src="js/sinon-qunit-1.0.0.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.mask.test.js"></script>
</body>
</html>


