<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
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
    $cpf	= $_POST ["cpf"];	//atribuição do campo "cpf" vindo do formulário para variavel
    $nascimento	= $_POST ["nascimento"];	//atribuição do campo "nascimento" vindo do formulário para variavel

    //PREENCHA OS DADOS DE CONEXÃO A SEGUIR:
    $usuario = new Usuario();

    $resultado = $usuario->iniUsuario($cpf);

    if ($resultado == 1 and $nascimento == $usuario->getNascimento())
        {   
    ?>
        <form id="renovesenha2" name="renovesenha2" method="post" action="gravanovasenha.php" onsubmit="return validaRenoveSenha2();return false;">
            <div class="geral">
                <div class="campo">Nome Usu&aacute;rio:<br/> <input class="form-control campo-texto" name="nome" type="text" id="nome" value='<?= $usuario->getNome()?>' readonly /> </div>
                <div class="campo">CPF:<br/><input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value='<?= $usuario->getCpf() ?>' readonly /> </div>
                <div class="campo">Data Nascimento:<br/> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="00/00/0000" data-mask-selectonfocus="true" name="nascimento" type="text" id="nascimento" value='<?= $usuario->getNascimento() ?>' readonly /> </div>
                <div class="campo">Senha:<span class="style1">*</span> <br/><input class="form-control campo-texto" name="senha" type="password" id="senha" maxlength="20" /> </div>
                <div class="campo">Confirme Senha: <span class="style1">*</span><br><input class="form-control campo-texto" name="senha2" type="password" id="senha2" maxlength="20" /> </div> <br/>
                <input class="botao"name="cadastrar" type="submit" id="cadastrar" value="Alterar Senha!" /><br/>  <p>&nbsp; </p>
            </div>
        </form>
            <?php
                } else {
                    echo "A data de nascimento informada, n&atilde;o confere com a cadastrada na base de dados!<br>";
            ?>
        <form id="dataincorreta" name="dataincorreta" method="post" action="renovarsenha3.php" onsubmit="return validaDataIncorreta();return false;">
            <div class="campo">CPF:<br>
                <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value='<?=$cpf?>' readonly />
            <div/>
            <div class="campo">Informe seu primeiro nome: <span class="style1">*</span><br>
                <input class="form-control campo-texto" name="nome" type="text" id="nome" maxlength="60" />                
            <div/>
            <input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Validar com Primeiro Nome!" /><br/>
            <p>&nbsp; </p>
        <form/>    
            <?php           
                }
            ?>            
            <a type="button" class="botao_login"  href="index.html">Voltar para realizar Login!</a>   <br />
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