<?php
include('../verificar-autenticidade.php');
include('../conexao-pdo.php');

// VERIFICA SE NÃO ESTÁ VINDO ID NA URL
if (empty($_GET["ref"])) {
    $pk_ordem_servico = "";
    $cpf = "";
    $nome = "";
    $data_ordem_servico = "";
    $data_inicio = "";
    $data_fim = "";
} else {
    $pk_ordem_servico = base64_decode(trim($_GET["ref"]));
    // MONTA A SINTAXE SQL PARA ENVIAR AO MYSQL
    $sql = "
    SELECT pk_ordem_servico, data_ordem_servico, data_inicio, data_fim,
    cpf,nome
    FROM ordens_servicos
    JOIN clientes ON pk_cliente = fk_cliente
    WHERE pk_ordem_servico = :pk_ordem_servico
    ";
    // PREPARA A SINTAXE
    $stmt = $conn->prepare($sql);
    // SUBSTITUI A STRING :PK_SERVICO PELA VARIÁVEL $PK_SERVICO
    $stmt->bindParam(':pk_ordem_servico', $pk_ordem_servico);
    // EXECUTA A SINTAXE FINAL NO MYSQL
    $stmt->execute();
    // VERIFICAR SE ENCONTROU ALGUM REGISTRO NO BANCO DE DADOS
    if ($stmt->rowCount() > 0) {
        $dado = $stmt->fetch(PDO::FETCH_OBJ);
        $data_ordem_servico = $dado->data_ordem_servico;
        $data_inicio = $dado->data_inicio;
        $data_fim = $dado->data_fim;
        $cpf = $dado->cpf;
        $nome = $dado->nome;
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
                                        <h3 class="card-title">Lista de O.S.</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="pk_servico" class="form-label">Cód</label>
                                                <input readonly type="text" class="form-control" id="pk_ordem_servico" name="pk_ordem_servico" value="<?php echo $pk_ordem_servico; ?>">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="cpf" class="form-label">CPF</label>
                                                <input required type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf; ?>" data-mask="000.000.000-00" minlength="14">
                                            </div>
                                            <div class="col-md">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input readonly type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="data_ordem_servico" class="form-label">Data O.S.</label>
                                                <input readonly type="date" class="form-control" id="data_ordem_servico" name="data_ordem_servico" value="<?php echo $data_ordem_servico; ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="data_inicio" class="form-label">Data Início</label>
                                                <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="<?php echo $data_inicio; ?>">
                                            </div>
                                            <div class="col-4">
                                                <label for="data_fim" class="form-label">Data Fim</label>
                                                <input type="date" class="form-control" id="data_fim" name="data_fim" value="<?php echo $data_fim; ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="card card-warning card-outline">
                                                    <div class="card-header">
                                                        Titulo
                                                        <a href="./form.php" class="btn btn-sm btn-primary rounded-circle float-right">
                                                            <i class="bi bi-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>SERVIÇO</th>
                                                                    <th>VALOR</th>
                                                                    <th>OPÇÔES</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <select class="form-control">
                                                                            <?php

                                                                            $sql = "
                                                                            SELECT pk_servico, servico
                                                                            FROM servicos
                                                                            ORDER BY servico
                                                                            ";

                                                                            try {
                                                                                $stmt = $conn->prepare($sql);
                                                                                $stmt->execute();

                                                                                $dados = $stmt->fetchAll(PDO::FETCH_OBJ);

                                                                                foreach ($dados as $key => $row) {
                                                                                    echo '<option value="'.$row->pk_servico.'">'.$row->servico.'</option>';
                                                                                }

                                                                            } catch (Exception) {
                                                                                $_SESSION["tipo"] = "error";
                                                                                $_SESSION["title"] = "Ops!";
                                                                                $_SESSION["msg"] = $ex->getMessage();

                                                                                header("Location: ./");
                                                                                exit;
                                                                            }

                                                                            ?>
                                                                            <option selected>--Selecione--</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input class="form-control" type="number">
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-default" type="button" data-toggle="">
                                                                                <a class="" href="./remover.php?ref=' . base64_encode($row->pk_os) . '">
                                                                                    <i class="bi bi-trash"></i></a>
                                                                                </a>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
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
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- /.content -->

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {

            $("#cpf").blur(function() {
                // LIMPAR INPUT DE NOME
                $("#nome").val("");
                // FAZ A REQUISIÇÂO PARA O ARQUIVO "CONSULTAR_CPF.PHP"
                $.getJSON(
                    'consultar_cpf.php',
                    function(data) {
                        console.log(data)
                    }
                )
                
            });
        

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

</body>

</html>