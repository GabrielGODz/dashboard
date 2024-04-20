<?php

include("../verificar-autenticidade.php");
include("../conexao-pdo.php");

// VERIFICA SE ESTÁ VINDO INFORMAÇÕES VIA POST
if ($_POST) {
    // VERIFICA CAMPOS OBRIGATÓRIOS
    if (empty($_POST["nome"])) {
        $_SESSION["tipo"] = 'warning';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Por favor, preencha os campos obrigatórios.';
        header("Location: ./");
        exit;
    } else {
        // RECUPERA INFORMAÇÕES PREENCHIDAS PELO USUÁRIO
        $pk_cliente = trim($_POST["pk_cliente"]);
        $nome = trim($_POST["nome"]);

        try {
            if (empty($pk_cliente)) {
                $sql = "
                INSERT INTO clientes (nome) VALUES
                (:nome)
                ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
            } else {
                $sql = "
                UPDATE clientes SET
                nome = :nome
                WHERE pk_cliente = :pk_cliente
                ";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':pk_cliente', $pk_cliente);
                $stmt->bindParam(':nome', $nome);
            }
            // EXECUTA INSERT OU UPDATE ACIMA
            $stmt->execute();

            $_SESSION["tipo"] = 'success';
            $_SESSION["title"] = 'Oba!';
            $_SESSION["msg"] = 'Registro salvo com sucesso!';
            header("Location: ./");
            exit;
        } catch (PDOException $ex) {
            $_SESSION["tipo"] = 'error';
            $_SESSION["title"] = 'Ops!';
            $_SESSION["msg"] = $ex->getMessage();
            header("Location: ./");
            exit;
        }
    }
}
