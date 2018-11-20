<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Confirma&ccedil;&atilde;o Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/estilo.css" />           
        <link rel="stylesheet" href="css/bootstrap.min.css">	
        <script language="JavaScript" type="text/javascript" src="js/validacampo.js"/>
        <script src="js/w3data.js"/>        
    <head/>
<body>
   <header class="cabecalho"><img class="seed" src="images/seed_colorida.svg"/></header>
    <h2 class="titulo"><strong>Wifi SEED</strong></h2>
    <fieldset class="container_portal">
        <legend><h3>Renova&ccedil;&atilde;o Senha</h3></legend> 
        <?php 
            include_once './classe/usuario.php'; 
            // RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
            $cpf	= filter_input(INPUT_POST, 'cpf');	//atribuição do campo "cpf" vindo do formulário para variavel
            $senha	= filter_input(INPUT_POST,'senha');	//atribuição do campo "senha" vindo do formulário para variavel
            $usuario->gravaNovaSenha($cpf, $senha); 
            $usuario = new Usuario();

            $resultado = $usuario->iniUsuario($cpf);

            if ($resultado == 1){
                $usuario->gravaNovaSenha($cpf, $senha);    
            }
        ?> 
        <a type="button" class="botao_login"  href="index.html">Voltar para realizar Login!</a>   <br />
    </fieldset>
    <div w3-include-html="classe/footer.html"></div>        
    </body>
    <script> w3IncludeHTML();</script>
</html>


