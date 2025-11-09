<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../lib/header.php';
require_once '../database.php';

$pdo =Database::getInstance()->getConnection();

if($_POST){
    $nome= trim($_POST['nome']?? '');
    $email= trim($_POST['email']?? '');
    $senha= $_POST['senha']??'';

    if(empty($nome)||empty($email)||empty($senha)){
        flash('Preencha todos os campos!!','danger');
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        flash('Email incorreto','danger');
    }
    elseif(strlen($senha)< 8){
        flash('A senha tem um minimo de 8 caracteres, por favor refaça','danger');
    }
    else{
        try{
            $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if($stmt->fetch()){
                flash('O email ja foi cadastrado! Por favor tente outro','danger');
        }
        else{
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)');
            $stmt->execute([$nome,$email,$hash]);
            flash('Cadastro concluido! voce sera redirecionado para a tela de login','success');
            Redirecionamento('login.php');
        }
        }catch(PDOException $e){
            flash('ERRO no banco:'. $e->getMessage(),'danger');
        }
    }
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cadastro Usuario</h4>
                </div>
                <div class="card-body">
                    <?= showFlash() ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="login.php" class="text-decoration-none">ja tem conta ? Faca login aqui</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once'../lib/footer.php'; ?>