<?php 
session_start();
if(empty($_SESSION['id_usuario'])) {
	header('Location: index.php');
}
require_once 'config/conectaBanco.php';

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_STRING);
$inicial = filter_input(INPUT_POST, 'inicial', FILTER_SANITIZE_STRING);
$final = filter_input(INPUT_POST, 'final', FILTER_SANITIZE_STRING);

if(!empty($nome) && !empty($cor) && !empty($inicial) && !empty($final)) {
    //Converter a data e hora do formato brasileiro para o formato do Banco de Dados
	$data = explode(" ", $inicial);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
    $inicial_sem_barra = $data_sem_barra . " " . $hora;
	
	$data = explode(" ", $final);
	list($date, $hora) = $data;
	$data_sem_barra = array_reverse(explode("/", $date));
	$data_sem_barra = implode("-", $data_sem_barra);
    $final_sem_barra = $data_sem_barra . " " . $hora;
    
    $query_insere = "INSERT INTO agenda(nome, cor, data_hora_inicial, data_hora_final, id_usuario)
                    VALUES(:nome, :cor, :inicial, :final, :id_usuario)";
    
    $stmt = $conn->prepare($query_insere);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":cor", $cor);
    $stmt->bindParam(":inicial", $inicial_sem_barra);
    $stmt->bindParam(":final", $final_sem_barra);
    $stmt->bindParam(":id_usuario", $_SESSION['id_usuario']);
    $stmt->execute();

    if($stmt->rowCount() > 0){ 
        $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Evento cadastrado com sucesso
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        </div>";
        header("Location: agenda.php");
    }
    else {
        $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Houve algum problema no cadastro
		<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</spam></button>
		</div>";
		header("Location: agenda.php");
    }
}