<?php 
header("Content-Type: application/json");
include('conexao.php'); 

$result = $mysqli->query("SELECT * FROM cursos");

$cursos = [];

while ($row = $result->fetch_assoc()) {
    $cursos[] = [
        "id" => $row["id"],
        "title" => $row["titulo"],
        "description" => $row["descricao"],
        "category" => $row["categoria"],
        "image" => $row["url_imagem"],
        "instructor" => $row["instructor"]
    ];
}

echo json_encode($cursos);
?>