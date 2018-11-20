<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8"></meta>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Usu&aacute;rio Wifi SEED</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />           
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/qunit-1.11.0.css" type="text/css" media="all"/>
        <script language="JavaScript" type="text/javascript" src="js/validacampo.js"></script>
        <script src="js/w3data.js"></script>  
    </head> 
    <body>
        <header class="cabecalho">
            <img class="seed" src="images/seed_colorida.svg"/>
        </header>
        <h2 class="titulo">
            <strong>Wifi SEED</strong>
        </h2>
        <fieldset class="container_portal">
            <legend>
                <h3>Cadastro</h3>
            </legend>
            <?php
            // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !

            $cpf = filter_input(INPUT_POST, 'cpf');             //atribuição do campo "cpf" vindo do formulário para variavel
            $passo = filter_input(INPUT_POST, 'passo');         //atribuição do nível de renovação "passo"  
            if ($cpf == "") {
                if ($passo == "") {
                    echo '<form id="login" name="login" method="post" action="" onsubmit="return validaesqueciminhasenha(); return false;"> <div class="geral"> '
                    . '<div class="campo">CPF: <span class="style1"> *</span><br>  <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf"> <input  name="passo" id="passo" value="0" hidden="" > </div> <br/>'
                    . ' <button class="botao_login" name="accept" type="submit" value="Continue">Prosseguir Cadastro >> </button><br /> <div/> </form>';
                }
            } else {
                if ($passo != "") {
                    include_once './classe/usuario.php';
                    //Inicializando Variaveis:
                    $usuario = new Usuario();
                    $resultado = $usuario->iniUsuario($cpf);
                    if ($resultado == "1") {
                        echo 'CPF Cadastrado na base de dados !!  <br/> Favor Renovar Senha<br/> '
                        . ' <form id="cadastro" name="cadastro" method="post" action="renovarsenha.php" onsubmit="return validaesqueciminhasenha(); return false;"> <div class="geral"> '
                        . ' <div class="campo">CPF: <span class="style1"> *</span><br>  <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" value="' . $cpf . '" readonly="" name="cpf" type="text" id="cpf"> <input  name="passo" id="passo" value="1" hidden="" > </div> <br/>'
                        . ' <button class="botao_login" name="accept" type="submit" value="Continue">Alterar Senha</button><br /><div/> </form>';
                    } else {
                        if ($passo == "0") {
                            echo ' <form id="cadastro" name="cadastro" method="post" action="" onsubmit="return validaCadastro(); return false;"> <div class="geral"> '
                            . ' <div class="campo">CPF: <br/> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" value="' . $cpf . '" readonly="" name="cpf" type="text" id="cpf"/> </div> <br/>'
                            . ' <div class="campo">Nome Completo usu&aacute;rio: <span class="style1">*</span><br/><input class="form-control campo-texto" name="nome" type="text" id="nome"> </div> <br/> '
                            . ' <div class="campo">Data de Nascimento: <span class="style1">*</span><br/> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="00/00/0000" data-mask-selectonfocus="true" name="nascimento" type="text" id="nascimento"/> </div> <br/>'
                            . ' <div class="campo"> Senha: <span class="style1">*</span><br/> <input class="form-control campo-texto" name="senha" type="password" id="senha" maxlength="20"/></div> <br/>'
                            . ' <div class="campo">Confirme a Senha: <span class="style1">*</span><br/><input class="form-control campo-texto" name="senha2" type="password" id="senha2" maxlength="20"/> </div> <br/> '
                            . ' <span class="style1">* Campos com * s&atilde;o obrigat&oacute;rios!</span><br/>'
                            . ' <div class="check"> <input name="termo" type="checkbox" id="termo" value="TRUE" /> <a href ="termocaptiveportal.html" target="_blank">Concordo com os termos de uso dos servi&ccedil;os de wifi da SEED.</a> <br/> </div> '
                            . ' <input  name="passo" id="passo" value="1" hidden="" >'
                            . ' <button class="botao" name="cadastrar" type="submit" id="cadastrar">Concluir meu Cadastro!</button><br/>'
                            . ' </form>';
                        } elseif ($passo == "1") {
                            $nome = filter_input(INPUT_POST, 'nome');      //atribuição do campo "nome" vindo do formulário para variavel	
                            $nascimento = filter_input(INPUT_POST, 'nascimento'); //atribuição do campo "nascimento" vindo do formulário para variavel
                            $termo = filter_input(INPUT_POST, 'termo');     //atribuição do campo "termo" vindo do formulário para variavel
                            $senha = filter_input(INPUT_POST, 'senha');     //atribuição do campo "senha" vindo do formulário para variavel
                            //  Gravando no banco de dados !
                            $teste = $usuario->gravaUsuarioNovo($cpf, $nome, $senha, $nascimento, $termo);
                            $usuario->iniUsuario($cpf);
                        }
                    }
                }
            }
            ?>
            <a type="button" class="botao_amarelo"  href="index.html">Voltar Tela Login!</a> <br />
            <div/>
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
