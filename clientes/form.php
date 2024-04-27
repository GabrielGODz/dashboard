<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');

$pagina_ativa = 'clientes';

// VERIFICA SE NÃO ESTÁ VINDO ID NA URL
if (empty($_GET["ref"])) {
    $pk_cliente = "";
    $nome = "";
    $cpf = "";
    $whatsapp = "";
    $email = "";
} else {
    $pk_cliente = base64_decode(trim($_GET["ref"]));
    // MONTA A SINTAXE SQL PARA ENVIAR AO MYSQL
    $sql = "
    SELECT nome, cpf, whatsapp, email
    FROM clientes
    WHERE pk_cliente = :pk_cliente
    ";
    // PREPARA A SINTAXE
    $stmt = $conn->prepare($sql);
    // SUBSTITUI A STRING :PK_SERVICO PELA VARIÁVEL $PK_SERVICO
    $stmt->bindParam(':pk_cliente', $pk_cliente);
    // EXECUTA A SINTAXE FINAL NO MYSQL
    $stmt->execute();
    // VERIFICAR SE ENCONTROU ALGUM REGISTRO NO BANCO DE DADOS
    if ($stmt->rowCount() > 0) {
        $dado = $stmt->fetch(PDO::FETCH_OBJ);
        $nome = $dado->nome;
        $cpf = $dado->cpf;
        $whatsapp = $dado->whatsapp;
        $email = $dado->email;
    } else {
        $_SESSION["tipo"] = 'error';
        $_SESSION["title"] = 'Ops!';
        $_SESSION["msg"] = 'Registro não encontrado.';
        header("Location: ./");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SSS | Senac System Service</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../dist/plugins/fontawesome-free/css/all.min.css">
    <!-- Boostrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("../nav.php") ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("../aside.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- /.row -->

                    <div class="row mt-3">
                        <div class="col">
                            <form action="salvar.php" method="post">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Lista de clientes</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="pk_cliente" class="form-label">Cód</label>
                                                <input readonly type="text" class="form-control" id="pk_cliente" name="pk_cliente" value="<?php echo $pk_cliente; ?>">
                                            </div>
                                            <div class="col">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input required type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <input value="<?php echo $cpf ?>" type="text" id="cpf" name="cpf" class="form-control" data-mask="000.000.000-00" minlength="14" required>
                                            </div>
                                            <div class="col">
                                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                                <input required value="<?php echo $whatsapp ?>" type="text" id="whatsapp" name="whatsapp" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input value="<?php echo $email ?>" type="email" id="email" name="email" class="form-control" required>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer text-right">
                                            <a href="./" class="btn btn-outline-danger rounded-circle">
                                                <i class="bi bi-arrow-left"></i>
                                            </a>
                                            <button type="submit" class="btn btn-primary rounded-circle">
                                                <i class="bi bi-floppy"></i>
                                            </button>
                                        </div>
                                        <!-- /.card-footer -->
                                    </div>
                            </form>
                            <!-- /.card -->

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <?php include("../footer.php"); ?>
        <!-- /. Footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../dist/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../dist/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="../dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <script>
        $(function() {

            $("#theme-mode").click(function() {
                // pegar atributo class do objeto
                var classMode = $("#theme-mode").attr("class")
                if (classMode == "fas fa-sun") {
                    $("body").removeClass("dark-mode");
                    $("#theme-mode").attr("class", "fas fa-moon");
                    $("#navTopo").attr("class", "main-header navbar navbar-expand navbar-white navbar-light");
                    $("#asideMenu").attr("class", "main-sidebar sidebar-light-primary elevation-4");
                } else {
                    $("body").addClass("dark-mode");
                    $("#theme-mode").attr("class", "fas fa-sun");
                    $("#navTopo").attr("class", "main-header navbar navbar-expand navbar-black navbar-dark");
                    $("#asideMenu").attr("class", "main-sidebar sidebar-dark-primary elevation-4");
                }
            });
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // INÍCIO -- FORMATAR MÁSCARA DO WHATSAPP
        var options = {
            onKeyPress: function(whatsapp, e, field, options) {
                var masks = ['(00) 0000-000#', '(00) 00000-0000'];
                var mask = (whatsapp.length > 14) ? masks[1] : masks[0];
                $('#whatsapp').mask(mask, options);
            }

        };
        $('#whatsapp').mask('(00) 0000-000#', options);
        // FIM -- FORMATAR MÁSCARA DO WHATSAPP
    </script>
</body>

</html>