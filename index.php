<?php
include('./verificar-autenticidade.php');
include('./conexao-pdo.php');
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
  <link rel="stylesheet" href="dist/plugins/fontawesome-free/css/all.min.css">
  <!-- Boostrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("nav.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("aside.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="row mt-3">
                        <div class="col">
                            <form action="salvar.php" method="post">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Lista de clientes</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <label for="pk_cliente" class="form-label">Cód</label>
                                                <input readonly type="text" class="form-control" id="pk_cliente" name="pk_cliente" value="">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="nome" class="form-label">CPF</label>
                                                <input required type="text" class="form-control" id="nome" name="nome" value="">
                                            </div>
                                        </div>
                                        <div class="col mb-3">
                                            <div class="col">
                                                <label for="cpf" class="form-label">Data O.S.</label>
                                                <input value="<?php echo $cpf ?>" type="text" id="cpf" name="cpf" class="form-control" data-mask="000.000.000-00" minlength="14" required>
                                            </div>
                                            <div class="col">
                                                <label for="whatsapp" class="form-label">Data Inicio</label>
                                                <input  value="" type="date" id="" name="" class="form-control">
                                            </div>
                                            <div class="col">
                                                <label for="email" class="form-label">Data Fim</label>
                                                <input value="" type="date" id="" name="e" class="form-control">
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
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Footer -->
    <?php include("footer.php"); ?>
    <!-- /. Footer -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="dist/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="dist/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="dist/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- ChartJS -->
  <script src="dist/plugins/chart.js/Chart.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>

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

      var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Digital Goods',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          },
          {
            label: 'Electronics',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 81, 56, 55, 40]
          },
        ]
      }

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })
  </script>
</body>

</html>