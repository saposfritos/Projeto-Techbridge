<?php
include('conexao.php');

$id = intval($_GET['id']);

$result = $mysqli->query("SELECT url_conteudo FROM cursos WHERE id = $id");

if ($result && $row = $result->fetch_assoc()) {
    echo json_encode(["url_conteudo" => $row['url_conteudo']]);
} else {
    echo json_encode(["error" => "Curso não encontrado."]);
}

$mysqli->close();
?>