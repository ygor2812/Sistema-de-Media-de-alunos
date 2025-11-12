<?php
require_once '../lib/header.php';
require_once '../auth/session.php';
?>
<h2 class="mb-4">Cadastrar alunos</h2>
<form method="POST" action="salvar.php" class="card p-4";>
    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nota 1</label>
         <input type="number" step="0.1" min="0" max="10" name="nota1" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nota 2</label>
         <input type="number" step="0.1" min="0" max="10" name="nota2" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="index.php" class="btn btn-warning">Voltar</a>
</form>
<?php require_once '../lib/footer.php';?>