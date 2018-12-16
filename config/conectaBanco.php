<?php 

require_once "config.php";

try
{
    $conn = new PDO( 'mysql:host=' .DB_HOST. 
                    ';port=' .DB_PORT.
                    ';dbname=' .DB_NAME. 
                    ';chartset=' .DB_CHARSET, DB_USER, DB_PASS );
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o SGBD MySQL: ' . $e->getMessage();
}