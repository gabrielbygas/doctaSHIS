<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Student Health Information System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <title>Login</title>
</head>
<body class="login">
<style>
        .login {
            background-color: #F9FAFC !important;
        }
</style>
    <br>
<div class=" card-warning container text-center col-sm-4 ">
<div class="card card-info">
              <div class="card-header">
              <h3 class="card-title container text-center">Student Health Information System</h3>
              </div>
              <br>
              <!-- / .ciu logo -->
              <div class=" container text-center">
              <img src="https://sis.ciu.edu.tr/images/ciu-color-en.png " height ="75px">
              </div>
              <br>
              <!-- /.card-header -->
              <!-- form start -->
              <?php
                  require 'class/DBConnection.class.php';
                  require 'class/login.class.php';
                ?>
                <?php
                  //add
                  if( isset($_POST['login']) && $_POST['login']=="add" ){
                      $login = new Login;
                      $login->addLogin($_POST);
                      if($login->add == TRUE){
                        header("Location:index.php");
                        
                      }
                  }
                ?>
              <form class="form-horizontal" action="signup.php" method="POST">
                <div class="card-body">
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="text" name="username" class="form-control" id="inputEmail3" data-msg="Name & Surname are required"placeholder="Name & Surname">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input name="studentId" class="input form-control placeholder-no-fix valid" type="text" autocomplete="off" placeholder="Student number" data-msg="Student number is required" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="password" name="pswd" class="form-control" id="inputPassword3" data-msg="Password is required" placeholder="Password" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <input type="password" name="repswd" class="form-control" id="inputPassword3" data-msg="Repassword is required" placeholder="Repassword">
                    </div>
                  </div>
                    <input type="hidden" name="login" value="add">
                </div>
                <P> You can sign in by clicking/ <a href="index.php" class="text-left">HERE</a></p>
    
                <!-- /.card-body -->
                <div class="card-footer text-left">
                  <button type="submit" class="btn btn-info">Sign up</button>
                  <button type="reset" class="btn btn-danger float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
                <div class="copyright">
                <a style="text-decoration: none; color: #0c0c0c; cursor: zoom-in">Copyright © 2020 CIU - SHIS</a><br>
                </div>
                </form>
                </div>
                </div>

<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/bootstrap.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
