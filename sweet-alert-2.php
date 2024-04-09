<?php

session_start();

// ISSET = VERIFICA SE AS VARIÁVEIS FORMA CRIADAS
if (isset($_SESSION["tipo"]) && isset($_SESSION["msg"])) {
    echo "
    <script>
    $(function() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmBotton: false,
            timer: 5000
        });


        Toast.fire({
            icon: 'info',
            title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
        });

    });
    </script>
    ";
}
