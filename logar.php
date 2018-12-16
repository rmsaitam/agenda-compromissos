<?php 

session_start();
require_once "config/conectaBanco.php";

$btnlogar = filter_input(INPUT_POST, 'btnlogar', FILTER_SANITIZE_STRING);

if($btnlogar) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if(empty($email) || empty($senha)) {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Os campos e-mail e senha são obrigatórios.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
            </div>";
        header('Location: index.php');
    }

    else {
        $query_users = "SELECT id, nome, sobrenome, email, senha FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $conn->prepare($query_users);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if(password_verify($senha, $user[0]['senha'])) {
            $_SESSION['id_usuario'] = $user[0]['id'];
            $_SESSION['nome'] = $user[0]['nome'];
            $_SESSION['sobrenome'] = $user[0]['sobrenome'];
            $_SESSION['email'] = $user[0]['email'];
            header('Location: agenda.php');
        }
        else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>E-mail ou senha incorreto.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
            </div>";
        header('Location: index.php');
        }
    }
}
else {
    header('Location: index.php');
}

