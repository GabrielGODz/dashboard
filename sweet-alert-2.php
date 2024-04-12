<?php

session_start();

// ISSET = VERIFICA SE AS VARIÁVEIS FORMA CRIADAS
if (isset($_SESSION["tipo"]) && isset($_SESSION["title"]) && isset($_SESSION["msg"])) {
    echo "
    <script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        Toast.fire({
            icon: '" . $_SESSION["tipo"] . "',
            title: '" . $_SESSION["title"] . "',
            text: '" . $_SESSION["msg"] . "'
        });
    });
    </script>
    ";

    // APÓS EXIBIR A MENSAGEM, LIMPA AS VARIÁVEIS DE SESSÃO
    unset($_SESSION["tipo"]);
    unset($_SESSION["msg"]);
    unset($_SESSION["title"]);
}
