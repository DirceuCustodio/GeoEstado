<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "federativo";

    if (mysqli_connect($server, $user, $pass, $bd)) {
        $conn = mysqli_connect($server, $user, $pass, $bd);
       // echo "Conectado!";
    }else 
        "Erro!";
?>