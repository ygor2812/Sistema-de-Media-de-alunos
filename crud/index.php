<?php
require_once '../lib/header.php';
require_once '../auth/session.php';
require_once '../database.php';

@$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->query('SELECT * FROM alunos ORDER BY nome');
$alunos = $stmt->fetchAll();
?>
<h2 class="mb-4">Lista de Alunos</h2>
<a href="create.php" class="btn btn-success mb-3">Novo Aluno</a>

<table class="table table-stripped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Media</th>
            <th>acao</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($alunos as $a): ?>
            <?php $media = ($a['nota1'] + $a['nota2'])/2; ?>
            <tr>
                <td><?= htmlspecialchars($a['$nome'])?></td>
                <td><?= $a['nota1']?></td>
                <td><?= $a['nota1']?></td>
                <td><strong><?= $media?></strong></td>
                <td>
                    <a href="editar.php? id= <?=$a['id']?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="deletar.php? id= <?=$a['id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Realmente ira excluir o aluno ?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach;?>
    </tbody>
</table>
<?php require_once '../lib/footer.php'; ?>
