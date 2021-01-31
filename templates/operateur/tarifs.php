<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Tables</title>

    <!-- Bootstrap core CSS-->
    <link href="./../../publics/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="./../../publics/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="./../../publics/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./../../publics/admin/css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

  <?php include('_admin_nav.php');?>
    <div id="wrapper">

      <!-- Sidebar -->
      <?php include('_admin_siderbar.php');?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/admin">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">tarifs</li>
          </ol>

          <!-- les tarifs -->
            <center><h2> List des tarifs </h2></center>
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Montant</th>
                    <th scope="col">Frais de commission</th>
                    <th scope="col" colspan="2"><center>Actions</center> </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Du 1000 FCFA à 7000 FCFA</th>
                    <td scope="row">500 FCFA</td>
                    <td><button type="button" class="btn btn-danger">Supprimer</button></td>
                    <td><button type="button" class="btn btn-primary">modifier</button></td>
                    </tr>
                    <tr>
                    <th scope="row">Du 1000 FCFA à 7000 FCFA</th>
                    <td scope="row"> 1 000 FCFA</td>
                    <td><button type="button" class="btn btn-danger">Supprimer</button></td>
                    <td><button type="button" class="btn btn-primary">modifier</button></td>
                    </tr>
                    <tr>
                    <th scope="row">Du 1000 FCFA à 7000 FCFA</th>
                    <td scope="row">2 000 FCFA</td>
                    <td><button type="button" class="btn btn-danger">Supprimer</button></td>
                    <td><button type="button" class="btn btn-primary">modifier</button></td>
                    </tr>
                </tbody>
            </table>
            <center><button type="button" class="btn btn-success">Ajouter</button></center>
         
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./../../publics/admin/vendor/jquery/jquery.min.js"></script>
    <script src="./../../publics/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./../../publics/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="./../../publics/admin/vendor/datatables/jquery.dataTables.js"></script>
    <script src="./../../publics/admin/vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./../../publics/admin/js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="./../../publics/admin/js/demo/datatables-demo.js"></script>

  </body>

</html>
