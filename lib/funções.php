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
function flash($message, $type= 'danger'){
    $_SESSION['flash'] = [$message, 'type'=>$type];
}
function showFlash(){
    if(isset($_SESSION['flash'])){
        $f = $_SESSION['flash'];
        echo "div class='alert alert-{$f['type']} alert-dismissible fade show'>
    {$f['message']}
    <button type='button'class='btn-close' data-bs-dismiss='alert'></button>
    </div>";
    unset($_SESSION["flash"]);
    }
}
