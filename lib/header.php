<?php
session_start();
require_once('../lib/funções.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-1g navbar dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="../alunos/">Sistema de Alunos</a>
            <div class="navbar-nav ms-auto">
                <?php if (Logado()): ?>
                    <span class="navbar-text-me-3">Ola, <?=htmlspecialchars($_SESSION['user_nome'])?></span>
                    <a class="nav-link" href="../auth/logout.php">Sair</a>
                <?php else: ?>
                    <a class="nav-link" href="../auth/login.php">Login</a>
                    <a class="nav-link" href="../auth/registro.php">Registro</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= showFlash() ?>

