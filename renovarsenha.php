<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Wifi SEED</title>
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
                <h3>Renova&ccedil;&atilde;o Senha</h3>
            </legend>
            <?php
            include_once './classe/usuario.php';
            // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
            $cpf = filter_input(INPUT_POST, 'cpf');                 //atribuição do campo "cpf" vindo do formulário para variavel
            $nascimento = filter_input(INPUT_POST, 'nascimento');   //atribuição do campo "nascimento" vindo do formulário para variavel
            $snome = filter_input(INPUT_POST, 'nome');   //atribuição do campo "nascimento" vindo do formulário para variavel
            $passo = filter_input(INPUT_POST, 'passo');             //atribuição do nível de renovação "passo"  
            $usuario = new Usuario();
            if ($cpf == "") {
                $resultado = 1;
            } else {
                $resultado = $usuario->iniUsuario($cpf);
            }
            if ($resultado == 1) {
                if ($passo == "") {
                    echo '<form id="login" name="login" method="post" action="" onsubmit="return validaesqueciminhasenha(); return false;"> <div class="geral"> '
                    . '<div class="campo">CPF: <span class="style1"> *</span><br>  <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf"> <input  name="passo" id="passo" value="0" hidden="" > </div> <br/>'
                    . ' <button class="botao_login" name="accept" type="submit" value="Continue">Alterar Senha</button><br /> <a type="button" class="botao"  href="cadastro.html">Cadastro</a><br /> <div/> </form>';
                } elseif ($passo == "0") {
                    echo '<form id="login" name="login" method="post" action="renovarsenha.php" onsubmit="return validaRenove(); return false;">' .
                    '<div class="campo">CPF:<br> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" id="cpf" type="text" value=' . $usuario->getCpf() .
                    ' readonly /> <input  name="passo" id="passo" value="1" hidden="" > </div> <br /><input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Renovar sua senha!" /><br/><p>&nbsp;</p><div/> <form/>';
                } elseif ($passo == "1") {
                    echo ' <form id="login" name="login" method="post" action="" onsubmit="return validaTesterenove(); return false;"> '
                    . ' <div class="campo">CPF:<br><input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value='
                    . $usuario->getCpf() . ' readonly /></div> <br /> <div class="campo">Data Nascimento: <span class="style1">*</span><br/><input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="00/00/0000" data-mask-selectonfocus="true" name="nascimento" type="text" id="nascimento"/> <input  name="passo" id="passo" value="2" hidden="" > '
                    . '</div> <br /> <input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Validar Data Nascimento!" /><br/><p>&nbsp; </p> </form>';
                } elseif ($passo == "2" && ($nascimento == $usuario->getNascimento() || ($usuario->consultaParteNomeUsuario($cpf, $snome) == 1 && $snome != "") )) {
                    echo ' <form id="login" name="login" method="post" action="" onsubmit="return validaRenoveSenha2();return false;"> '
                    . ' <div class="geral"> '
                    . ' <div class="campo">Nome Usu&aacute;rio:<br/> <input class="form-control campo-texto" name="nome" type="text" id="nome" value=' . $usuario->getNome() . ' readonly /> </div> '
                    . ' <div class="campo">CPF:<br/><input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value=' . $usuario->getCpf() . ' readonly /> </div>'
                    . ' <div class="campo">Data Nascimento:<br/> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="00/00/0000" data-mask-selectonfocus="true" name="nascimento" type="text" id="nascimento" value=' . $usuario->getNascimento() . ' readonly /> </div>'
                    . ' <div class="campo">Senha:<span class="style1">*</span> <br/><input class="form-control campo-texto" name="senha" type="password" id="senha" maxlength="20" /> </div> <div class="campo">Confirme Senha: <span class="style1">*</span><br><input class="form-control campo-texto" name="senha2" type="password" id="senha2" maxlength="20" /> </div> <br/> <input  name="passo" id="passo" value="3" hidden="" >'
                    . ' <input class="botao"name="cadastrar" type="submit" id="cadastrar" value="Alterar Senha!" /><br/>  <p>&nbsp; </p> </div> </form>';
                } elseif ($passo == "2" && $nascimento != $usuario->getNascimento() && $snome == "") {
                    echo "A data de nascimento informada, n&atilde;o confere com a cadastrada na base de dados!<br>";
                    echo '<form id="login" name="login" method="post" action="" onsubmit="return validaDataIncorreta();return false;">'
                    . '<div class="campo">CPF:<br/> <input class="simple-field-data-mask-selectonfocus form-control campo-texto " data-mask="000.000.000-00" data-mask-selectonfocus="true" name="cpf" type="text" id="cpf" value=' . $cpf . ' readonly /></div>'
                    . '<div class="campo">Informe seu primeiro nome: <span class="style1">*</span><br/><input class="form-control campo-texto" name="nome" type="text" id="nome" maxlength="60" /> <input name="passo" id="passo" value="2" hidden="" > </div>'
                    . '<input class="botao" name="cadastrar" type="submit" id="cadastrar" value="Validar com Primeiro Nome!" /><br/><p>&nbsp; </p> <form/>';
                } elseif ($passo == "2" && $usuario->consultaParteNomeUsuario($cpf, $snome) != 1) {
                    echo "N&atilde;o foi possivel renovar sua senha tente cadastrar ou entre em contato com a<br/> CODIN/GEITEC - (79) 3194-3300<br/>"
                    . '<a type="button" class="botao"  href="cadastro.html">Cadastro</a>   <br />';
                } elseif ($passo == "3") {
                    $senha = filter_input(INPUT_POST, 'senha'); //atribuição do campo "senha" vindo do formulário para variavel
                    $usuario->gravaNovaSenha($cpf, $senha);
                }
            } else {
                echo 'CPF não Cadastrado na base de dados !!  <br/> Favor cadastrar clicando no botão abaixo <br/> '
                . '<a type="button" class="botao"  href="cadastro.html">Cadastro</a>   <br />';
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


