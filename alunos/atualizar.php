<?php
require_once '../auth/session.php';
require_once '../database.php';

if(!$_POST){
    Redirecionamento('index.php');
}
$id = $_POST['id']?? 0; 
$nome = trim($_POST['nome']?? '');
$nota1=$_POST['nota1']?? '';
$nota2=$_POST['nota2']?? '';
if(!$id||empty($nome)||$nota1=== ''||$nota2=== ''){
    flash('Preencha todos os campos por favor!','danger');
    Redirecionamento('editar.php?id= $id');
}
if(!is_numeric($nota1) ||!is_numeric($nota2)||$nota1 <0||$nota1>10|| $nota2<0|| $nota2> 10){
        flash('As notas precisam ser numeros de 0 ate 10','danger');
        Redirecionamento("editar.php?id=$id");
    }
    try{
        $pdo = Database::getInstance()->getConnection();
        $media = ($nota1+$nota2)/2;
        $stmt = $pdo->prepare("UPDATE alunos SET nome= ?, nota1=?, nota2=?, media=? WHERE id=?");
        $stmt->execute([$nome,$nota1,$nota2, $media, $id]);
        flash("Aluno atualizado com sucesso","success");
    }catch(PDOException $e){
        flash("ERRO". $e->getMessage(),"danger");
    }
    Redirecionamento("index.php");
?>