<?php

if (session_status()=== PHP_SESSION_NONE){
    session_start();
}

function Redirecionamento($url){
    header("Location:$url");
    exit;
}
function Logado(){
    return isset($_SESSION['user_id']);
}
function NaoLogado(){
    if(!Logado()){
        Redirecionamento('../auth/login.php');
    }
}

?>