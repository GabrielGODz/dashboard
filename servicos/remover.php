<?php

include('../verificar-autenticidade.php');
include('../conexao-pdo.php');

if (empty($_GET["ref"])) {
    header("Location: ./");
    exit;
} else {
    $pk_servico = base64_decode($_GET["ref"]);

    $sql = "
    DELETE FROM servicos
    WHERE pk_servico = :pk_servico
    ";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':pk_servico', $pk_servico);
        $stmt->execute();

        $_SESSION["tipo"] = "success";
        $_SESSION["title"] = "Oba!";
        $_SESSION["msg"] = "Registro removido com sucesso!";

        header("Location: ./");
        exit;
    } catch (PDOException $ex) {
        $_SESSION["tipo"] = "error";
        $_SESSION["title"] = "Ops!";
        $_SESSION["msg"] = $ex->getMessage();

        // PERSONALIZA MENSAGEM SOBRE CONSTRAINT
        if($ex->getcode() == 23000) {
            
            $_SESSION["msg"] = "Não é possivel excluir este registro, pois ele está sendo utilizado em outro local";
        } else {
            $_SESSION["msg"] = $ex->getMessage();
        }

        header("Location: ./");
        exit;
    }
}
