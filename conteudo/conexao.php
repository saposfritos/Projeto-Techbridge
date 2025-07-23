<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "test"; 

$mysqli = new mysqli($servidor, $usuario, $senha, $banco);

if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>