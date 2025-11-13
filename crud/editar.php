<?php
require_once '../lib/header.php';
require_once '../database.php';
require_once '../auth/session.php';

$id = $_GET['id']?? 0;
$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->prepare('SELECT * FROM alunos WHERE id = ?');
$stmt->execute([$id]);
$aluno = $stmt->fetch();

if(!$aluno){
    flash('Aluno nao encontrado', 'danger');
    Redirecionamento('index.php');

}
?>
<h2>Editar Aluno</h2>
<form method="POST" action="update.php" class="card p-4">
    <input type="hidden" name="id" value="<?= $aluno['id']?>">
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" value="?= htmlspecialchars($aluno['nome'])?>" required>
    </div>
    <div class="mb-3">
        <label>Nota 1</label>
         <input type="number" step="0.1" min="0" max="10" name="nota1" class="form-control" value="?= $aluno['nota1']?>" required>
    </div>
    <div class="mb-3">
        <label>Nota 2</label>
         <input type="number" step="0.1" min="0" max="10" name="nota2" class="form-control" value="?= $aluno['nota2']?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Atualizar</button>
    <a href="index.php" class="btn btn-warning">cancelar</a>
</form>
<?php require_once '../lib/footer.php';?>