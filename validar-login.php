<?php

// CRIAR SESSÃO PARA VARIÁVEL GLOBAL

session_start();

// VERIFICA SE ESTÁ VINDO CONFIGURAÇÕES PARA VALIDAÇÃO DE E-MAIL E SENHA

if ($_POST) {
    // VERIFICA SE FOI ENVIADO OS CAMPOS OBRIGATÓRIOS
    if (empty($_POST["email"]) || empty($_POST["senha"])) {
        $_SESSION["msg"] = "Por favor, preencha os campos obrigatórios!";
        $_SESSION["tipo"] = "warning";
        $_SESSION["title"] = "Ops!";

        header("Location: login.php");
        exit;
    } else {
        include('conexao-pdo.php');
        // RECUPERAR INFORMAÇÕES DO FORMULÁRIO LOGIN
        $email = trim($_POST["email"]);
        $senha = trim($_POST["senha"]);

        // MONTAR SINTAXE SQL PARA CONSULTAR NO BANCO DE DADOS
        $stmt = $conn->prepare("
        SELECT pk_usuario , nome
        FROM usuarios
        WHERE email LIKE :email
        AND senha LIKE :senha
        ");

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();

        // VERIFICAR SE ENCONTROU ALGUM REGISTRO NA TABELA
        if ($stmt->rowCount() > 0) {
            // ORGANIZA O DADOS DO BANCO COMO OBJETOS NA VARIÁVEL $ROW
            $row = $stmt->fetch(PDO::FETCH_OBJ);

            // DECLARO VARIÁVEL GLOBAL INFORMANDO QUE USUÁRIO ESTÁ AUTENTICADO CORRENTAMENTE
            $_SESSION["autenticado"] = true;
            $_SESSION["pk_usuario"] = $row->pk_usuario;
            $_SESSION["nome_usuario"] = $row->nome;
            $_SESSION["tempo_login"] = time();

            header('Location: ./');
            exit;
        } else {
            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] = 'E-mail e/ou senha inválidos!';
            $_SESSION["tipo"] = 'error';

            header('Location: login.php');
            exit;
        }
    }
} else {
    header('Location: login.php');
    exit;
}
