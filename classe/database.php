<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author tiagoc
 */
abstract class Database {

    private static $host = "10.24.0.59";
    private static $user = "pfsense";
    private static $password = "74123698pfsense";
    private static $db = "radius";

    /* Metodos que trazem o conteudo da variavel desejada
      @return   $xxx = conteudo da variavel solicitada */

    private function getHost() {
        return self::$host;
    }

    private function getUser() {
        return self::$user;
    }

    private function getPassword() {
        return self::$password;
    }

    private function getDB() {
        return self::$db;
    }

    function connect() {
        $conexao = mysqli_connect($this->getHost(), $this->getUser(), $this->getPassword(), $this->getDB());
        if (mysqli_connect_errno()) {
            echo "Falha na conex�o: " . mysqli_connect_errno();
        }
        if (!mysqli_set_charset($conexao, "utf8")) {
            printf("Error loading character set utf8: %s\n", mysqli_error($conexao));
            exit();
        } else {
            mysqli_character_set_name($conexao);
        }
        return $conexao;
    }

    function testeConexao() {
        $mysqli = new mysqli($this->getHost(), $this->getUser(), $this->getPassword(), $this->getDB());

        /* check connection */
        if ($mysqli->connect_errno) {
            return 1;
            exit();
        } else {
            return 0;
        }

        /* close connection */
        $mysqli->close();
    }

    function close() {
        
    }

}
