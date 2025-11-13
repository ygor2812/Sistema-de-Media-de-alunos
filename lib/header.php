<?php
session_start();
require_once ('../lib/funções.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"> 
</head>
<body class="bg-white"> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <?php if(isset($_SESSION['user_id'])) : ?>
            <a class="navbar-brand fw-bold" href="../alunos/index.php">Sistema de Alunos</a>
            <?php else : ?>
             <a class="navbar-brand fw-bold" href="../auth/login.php">Sistema de Alunos</a>
             <?php endif; ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                 aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegacao">
                 <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ms-auto"> 
                    <?php if (Logado()): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-white-3">
                                Ola, <?=htmlspecialchars($_SESSION['user_nome']) ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="../auth/logout.php">Sair</a> 
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="../auth/login.php">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="../auth/registro.php">Registro</a>
                        </li>
                    <?php endif?>        
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= showFlash(); ?>

