<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author tiagoc
 */
include_once './classe/database.php';

class Usuario extends database {

    private $cpf;
    private $nome;
    private $senha;
    private $termo;
    private $nascimento;
    public static $nro_usr_online = 0;

    function __construct() {
        Usuario::alterarNroUsrOnline(+1);
    }

    static function alterarNroUsrOnline($add_remove = 0) {
        Usuario::$nro_usr_online += $add_remove;
    }

    function setCpf($_cpf) {
        $this->cpf = $_cpf;
    }

    function getCpf() {
        return $this->cpf;
    }

    private function setNome($_nome) {
        $this->nome = $_nome;
    }

    function getNome() {
        return $this->nome;
    }

    private function setNascimento($_nascimento) {
        $this->nascimento = $_nascimento;
    }

    function getNascimento() {
        return $this->nascimento;
    }

    private function setTermo($_termo) {
        $this->termo = $_termo;
    }

    function getTermo() {
        return $this->termo;
    }

    private function setSenha($_senha) {
        $this->senha = $_senha;
    }

    function getSenha() {
        return $this->senha;
    }

    private function testeUsuarioGravado($_cpf) {
        $consulta = "select count(cpf) as cont from `usuariowifi` where `cpf` = '$_cpf'";
        $resultado_consulta = mysqli_query($this->connect(), $consulta);
        foreach ($resultado_consulta as $tabela) {
            return $tabela['cont'];
        }
    }

    function consultaParteNomeUsuario($_cpf, $_nome) {
        $consulta = "select * , count(`termo`) as cont from `radius`.`usuariowifi` where `cpf` = '$_cpf' and `nome` like '%$_nome%'";
        $resultado_consulta = mysqli_query($this->connect(), $consulta);
        foreach ($resultado_consulta as $tabela) {
            return $tabela['cont'];
        }
    }

    //Retorno (== 1 - inicializado com sucesso | == 0 - cpf não gravado na base de dados
    function iniUsuario($_cpf) {
        $resultado = $this->testeUsuarioGravado($_cpf);
        if ($resultado == 1) {
            $consulta = "select * from `usuariowifi` where `cpf` = '$_cpf'";
            $resultado_consulta = mysqli_query($this->connect(), $consulta);
            foreach ($resultado_consulta as $tabela) {
                $this->setCpf($tabela['cpf']);
                $this->setNome($tabela['nome']);
                $this->setNascimento($tabela['nascimento']);
                $this->setSenha($tabela['senha']);
                $this->setTermo($tabela['termo']);
            }
            return $resultado;
        } else {
            return $resultado;
        }       
    }

    function gravaUsuarioNovo($_cpf, $_nome, $_senha, $_nascimento, $_termo) {
        $resultado = $this->testeUsuarioGravado($_cpf);
        $senhaCodificada = sha1($_senha);
        if ($resultado == 0) {
            $query = "INSERT INTO `usuariowifi`(`nome`,`nascimento`,`cpf`,`termo`,`senha`)VALUES('$_nome','$_nascimento','$_cpf','$_termo','$senhaCodificada')";
            $query2 = "INSERT INTO `radcheck`(`username`,`attribute`,`op`,`value`)VALUES('$_cpf','Cleartext-Password',':=','$senhaCodificada')";
            $query3 = "INSERT INTO `radusergroup`(`username`,`groupname`,`priority`)VALUES('$_cpf','redeseed','1')";
            mysqli_query($this->connect(), $query);
            mysqli_query($this->connect(), $query2);
            mysqli_query($this->connect(), $query3);
            $retorno = $this->iniUsuario($_cpf);
            if ($retorno == 1 and $this->getCpf() == $_cpf and $this->getNascimento() == $_nascimento and $this->getNome() == $_nome and $this->getSenha() == $senhaCodificada and $this->getTermo() == $_termo) {
                return $resultado;
            } else {
                return "1";
            }
        } else {
            return $resultado;
        }
    }

    function senhaAtual($_cpf) {
        $consulta = "select `value` from `radcheck` where `username` = '$_cpf'";
        $resultado_consulta = mysqli_query($this->connect(), $consulta);
        foreach ($resultado_consulta as $tabela) {
            return $tabela['value'];
        }
    }

    //Retorno (== 1 - nova senha gravada com sucesso | == 0 - erro gravar nova senha na base de dados
    function gravaNovaSenha($_cpf, $_NovaSenha) {
        $resultado = $this->testeUsuarioGravado($_cpf);
        if ($resultado == 1) {
            $query = "UPDATE `usuariowifi` SET `senha`='$_NovaSenha' WHERE `cpf`='$_cpf'";
            $query2 = "UPDATE `radcheck` SET `value`='$_NovaSenha' WHERE `username`='$_cpf'";
            mysqli_query($this->connect(), $query);
            mysqli_query($this->connect(), $query2);
            $this->iniUsuario($_cpf);
            $resultado2 = $this->senhaAtual($_cpf);
            if ($this->getCpf() == $_cpf and $this->getSenha() == $_NovaSenha and $_NovaSenha == $resultado2) {
                echo "<br>A senha de " . $this->getNome() . " renovada com sucesso!!!<br/>";
                return $resultado;
            } else {
                echo "Erro ao Renovar senha do usuario: " . $this->getNome();
                return "0";
            }
        } else {
            echo "Erro ao Renovar senha do usuario: " . $_cpf . " Não encontrado na Base de dados!!";
            return $resultado;
        }
    }

    function __destruct() {
        
    }

}
