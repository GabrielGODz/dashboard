<?php
// INICIAR SESSÃO PARA TER ACESSO A VARIÁVEIS GLOBAIS
session_start();

// CAMINHO FIXO DO SOFTWARE WEB
define("caminhoURL", "http://localhost/gabriel/dashboard");

// VERIFICA SE O USUÁRIO NÃO ESTÁ CONECTADO
if ($_SESSION["autenticado"] != true) {
    // DESTRUIR QUALQUER SESSÃO EXISTENTE
    session_destroy();

    header("Location: ./login.php");
    exit;
} else {

    $tempo_limite = 30000000000000; // SEGUNDOS
    $tempo_atual = time();

    // VERIFICAR TEMPO INATIVO DO USUÁRIO
    if (($tempo_atual - $_SESSION["tempo_login"]) > $tempo_limite) {
        $_SESSION["title"] = "Ops!";
        $_SESSION["tipo"] = "warning";
        $_SESSION["msg"] = "Tempo de sessão esgotado!";

        header ("Location: ./login.php");

        exit;
    } else {
        $_SESSION["tempo_login"] = time();
    }
}
