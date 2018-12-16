<?php 
    session_start();
    if(empty($_SESSION['id_usuario'])) {
        header('Location: index.php');
        exit;
    }

    unset($_SESSION['id_usuario'], $_SESSION['nome'], $_SESSION['sobrenome'], $_SESSION['email']);
    
    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Deslogado com sucesso.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";

    header('Location: index.php');
