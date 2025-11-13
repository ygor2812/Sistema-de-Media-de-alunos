<?php
session_start();
require_once '../lib/funções.php';
$paginaAtual = basename($_SERVER['PHP_SELF']);
if(in_array($paginaAtual,['login.php', 'registro.php', 'logout.php'])){
NecessarioLogin();
}
?>