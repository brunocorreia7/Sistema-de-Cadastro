<?php
$servidor = "";  // é só colocar o nome do servidor (eu tirei)
$dbusuario = ""; // é só colocar o usuario do banco (eu tirei)
$dbsenha = ""; // é só colocar s senha do banco (eu tirei)
$dbname = ""; // é só colocar o nome do banco (eu tirei)
$conn = mysqli_connect($servidor, $dbusuario, $dbsenha, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
