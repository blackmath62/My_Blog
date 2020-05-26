<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>JPochet</title>

  <!-- Font Awesome Icons -->
  <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="public/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="public/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS - Includes Bootstrap -->
  <link href="public/css/creative.min.css" rel="stylesheet">
  <link href="public/css/style.css" rel="stylesheet" type="text/css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="public/vendor/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

</head>
<body id="page-top" class="index">
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <?php include_once 'Header.php'; ?>
    <!-- Main Content -->
    <div id="content">
      <?= $content ?>
      <?php include_once 'Footer.php' ?>

      <!-- End of Content Wrapper -->
    </div>
  </div>

  <!-- End of Page Wrapper -->
  <!-- jQuery -->

 <!-- Bootstrap core JavaScript -->
 <script src="public/vendor/jquery/jquery.min.js"></script>
  <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="public/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="public/js/creative.min.js"></script>

<!-- jQuery Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

<script src="public/vendor/datatables/jquery.dataTables.js"></script>
<script src="public/vendor/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="public/vendor/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="public/vendor/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

</body>

</html>