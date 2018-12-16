<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset='utf-8' />
		<title>Agenda</title>
        <link href='css/bootstrap.min.css' rel='stylesheet'>
		<script src='js/jquery.min.js'></script>
        <script src='js/bootstrap.min.js'></script>
        <link rel="shortcut icon" type="image/png" href="favicon.ico" />
    </head>
    <body>
        <div class="container">
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
			?>
            <form class="form-horizontal" method="POST" action="logar.php">
                <div class="form-group">
                <label class="col-sm-6 control-label">Agenda de Compromissos </label>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">E-mail: </label>
                    <div class="col-sm-4">
                        <input type="text"  class="form-control" name="email" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Senha: </label>
                    <div class="col-sm-4">
                        <input type="password"  class="form-control" name="senha" id="senha">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <input type="submit" name="btnlogar" class="btn btn-primary" value="Logar">

                        &nbsp;&nbsp;&nbsp; <a href="novousuario.php"> Cadastra-se </a>
                    </div>
                    
                    
                </div>
            </form>
        </div> <!-- /container -->
    </body>
</html>

