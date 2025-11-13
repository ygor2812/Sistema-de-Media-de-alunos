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
function flash($message, $type= 'danger'){  //Serve pra salvar a mensagem na sessão
    $_SESSION['flash'] = [$message, 'type'=>$type];
}
function showFlash(){ //Essa função serve para exibir mensagens temporaria. -_-
    if(isset($_SESSION['flash'])){
        $message= htmlspecialchars($_SESSION['flash'][0]);
        $type= $_SESSION['flash'][1]??'danger';
        echo "<div class=\"alert alert-{$type} alert-dismissible fade show\" role=\"alert\">
                {$message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'</button>
              </div>";

        unset($_SESSION["flash"]);

    }
}
function NecessarioLogin(){ //Proteção de paginas. 0_o
    if(!Logado()){
        flash("Voce precisa estar logado pra acessar essa pagina","warning");
        Redirecionamento('../auth/login.php') ;
    }
}