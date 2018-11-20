<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="ISO-8859-1">
        <title></title>
    </head>
    <body>
        <?php
            $string = 'O rato reu a ropa do rei de Roma';
            $codificada = base64_encode($string);
            echo "Resultado da codificação usando base64: " . $codificada;
            // TyByYXRvIHJldSBhIHJvcGEgZG8gcmVpIGRlIFJvbWE=
            echo "<br/>";
            $original = base64_decode($codificada);
            echo "Resultado da decodificação usando base64: " . $original;
            echo "<br/>";
            $string = 'O rato reu a ropa do rei de Roma';
            $codificada = sha1($string);
            echo "Resultado da codificação usando sha1: " . $codificada;
            // b186b709f7cf5a1d98d413379a66e511df8d59a4
        ?>
    </body>
</html>
