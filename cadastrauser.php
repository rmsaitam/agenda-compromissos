<?php 
session_start();

    require_once 'config/conectaBanco.php';
    
    $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome  = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if(!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($senha)) {
        
        if(verificaEmailExiste($conn, $email)) {
            $_SESSION['nome'] = $nome;
            $_SESSION['sobrenome'] = $sobrenome;
            $_SESSION['email'] = $email;
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Esse e-mail já foi cadastrado.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
            </div>";
            header('Location: novousuario.php');
            exit;
        }

        $query_insere = "INSERT INTO usuarios(nome, sobrenome, email, senha)
                    VALUES(:nome, :sobrenome, :email, :senha)";
    
        $stmt = $conn->prepare($query_insere);
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":sobrenome", $sobrenome);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", password_hash($senha, PASSWORD_DEFAULT));
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $_SESSION['id_usuario'] = $conn->lastInsertId();
            $_SESSION['nome'] = $nome;
            $_SESSION['sobrenome'] = $sobrenome;
            $_SESSION['email'] = $email;
            header('Location: agenda.php');
        }

        else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Houve algum problema no cadastro de usuário
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
            </div>";
            header('Location: novousuario.php');
        }

    }
    else {
        $_SESSION['nome'] = $nome;
        $_SESSION['sobrenome'] = $sobrenome;
        $_SESSION['email'] = $email;
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Todos os campos são obrigatórios.
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
        </div>";
            header('Location: novousuario.php');
    }

    function verificaEmailExiste($conn, $email) {
        $query = "SELECT id, nome, sobrenome FROM usuarios
                WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if(count($user) == 1) {
            return true;
        }
    }