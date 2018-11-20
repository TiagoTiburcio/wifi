<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Confirma&ccedil;&atilde;o Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />           
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/qunit-1.11.0.css" type="text/css" media="all"/>
        <script language="JavaScript" type="text/javascript" src="js/validacampo.js"/>
        <script src="js/w3data.js"/>                    
    </head>

    <body>
        <header class="cabecalho"><img class="seed" src="images/seed_colorida.svg"/></header>
        <h2 class="titulo"><strong>Wifi SEED</strong></h2>
        <fieldset class="container_portal">
            <legend><h3>Cadastro</h3></legend>
            <?php
                include_once './classe/usuario.php';
                //Inicializando Variaveis:
                $usuario = new Usuario();

                // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !

                $nome = filter_input(INPUT_POST, 'nome');      //atribuição do campo "nome" vindo do formulário para variavel	
                $nascimento = filter_input(INPUT_POST, 'nascimento'); //atribuição do campo "nascimento" vindo do formulário para variavel
                $cpf = filter_input(INPUT_POST, 'cpf');       //atribuição do campo "cpf" vindo do formulário para variavel
                $termo = filter_input(INPUT_POST, 'termo');     //atribuição do campo "termo" vindo do formulário para variavel
                $senha = filter_input(INPUT_POST, 'senha');     //atribuição do campo "senha" vindo do formulário para variavel
                //Gravando no banco de dados !

                $teste = $usuario->gravaUsuarioNovo($cpf, $nome, $senha, $nascimento, $termo);
                $usuario->iniUsuario($cpf);
            ?>
            <form id="renove" name="renove" method="post" action="renovarsenha.php" onsubmit="return validaRenove(); return false;">
                <div class="geral">    
                    <div class="campo">CPF:<br>
                            <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" id="cpf" type="text" value='<?= $usuario->getCpf() ?>' readonly />                
                    </div> <br />
                    <?php if ($teste == "1") { ?>
                        <input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Renovar sua senha!" /><br/>
                    <?php } ?>
                    <p>&nbsp; </p>
                <div/>    
            <form/>
            <a type="button" class="botao_login"  href="index.html">Voltar Tela Login!</a>   <br />
        </fieldset>  
        <div w3-include-html="classe/footer.html"></div>    
    </body>
    <script> w3IncludeHTML();</script>
    <script type="text/javascript" src="js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="js/qunit-1.11.0.js"></script>
    <script type="text/javascript" src="js/sinon-1.10.3.js"></script>
    <script type="text/javascript" src="js/sinon-qunit-1.0.0.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.mask.test.js"></script>
</html>