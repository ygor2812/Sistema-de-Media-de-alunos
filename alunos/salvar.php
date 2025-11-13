<?php
require_once '../auth/session.php';
require_once '../database.php';

if($_POST){
    $nome = trim($_POST['nome']?? '');
    $nota1=$_POST['nota1']?? '';
    $nota2=$_POST['nota2']?? '';

    if(empty($nome)||$nota1===0||$nota2===0){
        flash('Preencha os campos','danger');
    }elseif(!is_numeric($nota1) ||!is_numeric($nota2)||$nota1 <0||$nota1>10|| $nota2<0|| $nota2> 10){
        flash('As notas precisam ser numeros de 0 ate 10','danger');
    }else{
        try{
            $pdo = Database::getInstance()->getConnection();
            $media = ($nota1+$nota2)/2;
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, nota1, nota2, media) VALUES (?, ?, ?, ?)");
            $stmt-> execute([$nome,$nota1,$nota2, $media]);
            flash("Aluno cadastrado com sucesso","success");
        } catch(PDOException $e){
            flash("erro:". $e->getMessage(),"danger");
        }
    }
}
Redirecionamento('index.php');
?>