<?php
require_once '../lib/header.php';
require_once '../database.php';

if($_POST){
    $email =trim($_POST['email']??'');
    $senha = $_POST['senha']??'';

    if (empty($email)||empty($senha)){
        flash("Preencha os campos em branco!");
} else{
    try{
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if($user && password_verify($senha, $user["senha"])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            Redirecionamento('../alunos');
        }else{
            flash('EMAIL ou SENHA incorretos.');
        } 
    }catch(Exception $e){
        flash('ERRO'. $e->getMessage());
    }
  }
}
?>
<h2 class="mb-4">Login</h2>

<form method="POST" class="card p-4">
    <div class="mb-3">
        <label class = "form-label">Email</label>
        <input type = "email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
    <a href="registro.php" class="btn btn-link">Criar conta</a>
</form>
<?php require_once'../lib/footer.php';?>