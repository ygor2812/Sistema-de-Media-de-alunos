<?php
include_once "../auth/session.php";
include_once "../database.php";

$id = $_GET ["id"]??0;
if(!$id|| !is_numeric($id)){
    flash("ID invalido","danger");
    Redirecionamento("index.php");
}
try{
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare ("DELETE FROM alunos WHERE id = ?");
    $stmt->execute([$id]);
    flash("Aluno foi excluido com sucesso.","success");
}catch(PDOException $e){
    flash("ERRO" . $e->getMessage(),"danger");
}
Redirecionamento("index.php");
?>