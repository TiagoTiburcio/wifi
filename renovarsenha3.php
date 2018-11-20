<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alterar Senha</title>
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
        <legend><h3>Renova&ccedil;&atilde;o Senha</h3></legend>    
    <?php 
    include_once './classe/usuario.php';
    // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
    $cpf = $_POST ["cpf"];	//atribuição do campo "cpf" vindo do formulário para variavel
    $snome = $_POST ["nome"];        //atribuição do campo "nome" vindo do formulário para variavel
    //PREENCHA OS DADOS DE CONEXÃO A SEGUIR:

    $usuario = new Usuario();

    $resultado = $usuario->consultaParteNomeUsuario($cpf, $snome);

    if ($resultado == 1) {
        $usuario->iniUsuario($cpf);
    ?>
        <form id="renovesenha2" name="renovesenha2" method="post" action="gravanovasenha.php" onsubmit="return validaRenoveSenha2();return false;">
            <div class="geral">    
                <div class="campo">Nome Usu&aacute;rio:<br/> 
                    <input class="form-control campo-texto" name="nome" type="text" id="nome" value='<?= $usuario->getNome()?>' readonly />
                <div/>               
                <div class="campo">CPF:<br/>
                    <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value='<?= $usuario->getCpf() ?>' readonly />    
                <div/>
                <div class="campo">Data Nascimento:<br/>
                    <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="00/00/0000" data-mask-selectonfocus="true" name="nascimento" type="text" id="nascimento" value='<?= $usuario->getNascimento() ?>' readonly />
                <div/>
                <div class="campo">Senha: <span class="style1">*</span><br>
                    <input class="form-control campo-texto" name="senha" type="password" id="senha" maxlength="12" />
                <div/>
                <div class="campo">Confirme Senha: <span class="style1">*</span><br>
                    <input class="form-control campo-texto" name="senha2" type="password" id="senha2" maxlength="12" />                
                <div/>            
                    <input class="botao"name="cadastrar" type="submit" id="cadastrar" value="Alterar Senha!" /><br/>
                <p>&nbsp; </p>
            
        <form/>    
<?php
    } else {
        echo "N&atilde;o foi possivel renovar sua senha tente cadastrar novamente ou entre em contato com a<br/> CODIN/GEITEC - (79) 3194-3300<br/>";
?>
    <a type="button" class="botao"  href="cadastro.html">Cadastro</a>   <br />       
    
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