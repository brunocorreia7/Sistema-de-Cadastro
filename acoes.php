<?php
session_start();
require 'conexao.php';

// Criar item
if (isset($_POST['create_usuario'])) {
    $descrição = mysqli_real_escape_string($conn, trim($_POST['descrição']));
    $quantidade = mysqli_real_escape_string($conn, trim($_POST['quantidade']));
    $preço = mysqli_real_escape_string($conn, trim($_POST['preço']));

    $sql = "INSERT INTO cadastro (descrição, quantidade, preço) VALUES ('$descrição', '$quantidade', '$preço')";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Item cadastrado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao cadastrar item: ' . mysqli_error($conn);
    }

    header('Location: index.php');
    exit;
}

// Atualizar item
if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $descrição = mysqli_real_escape_string($conn, trim($_POST['descrição']));
    $quantidade = mysqli_real_escape_string($conn, trim($_POST['quantidade']));
    $preço = str_replace(',', '.', str_replace('.', '', mysqli_real_escape_string($conn, trim($_POST['preço']))));



    $sql = "UPDATE cadastro SET descrição = '$descrição', quantidade = '$quantidade', preço = '$preço' WHERE id = '$usuario_id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Item atualizado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar item: ' . mysqli_error($conn);
    }

    header('Location: index.php');
    exit;
}

// deletar item



if (isset($_POST['delete_usuario'])) {
    $usuario_id = $_POST['delete_usuario'];

    if (!empty($usuario_id)) {
        // Proteger contra SQL Injection
        $usuario_id = mysqli_real_escape_string($conn, $usuario_id);

        // Atualizar o campo 'ativo' para 0 (desativado)
        $sql = "UPDATE cadastro SET ativo = 0 WHERE id = '$usuario_id'";

        // Depuração: Mostrar a consulta gerada
        // echo $sql;

        if (mysqli_query($conn, $sql)) {
            $_SESSION['mensagem'] = 'Item deletado com sucesso';
        } else {
            $_SESSION['mensagem'] = 'Erro ao desativar item: ' . mysqli_error($conn);
        }
    } else {
        $_SESSION['mensagem'] = 'Nenhum ID fornecido para desativação.';
    }

    // Redirecionar após o processamento
    header('Location: index.php');
    exit;
} else {
    echo "Nenhum dado recebido.";
}



