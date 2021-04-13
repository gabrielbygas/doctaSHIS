<?php
  session_start();
  if(!isset($_SESSION['studentNumber'])){
    header("Location:index.php");
  }
  if ($_SESSION['studentNumber']>1){
    header("Location:index.php");
  }
    require 'class/DBConnection.class.php';
    require 'class/announcement.class.php';
    $announcement = new Announcement;
    $phone = $_GET['ph'];
?>
<!DOCTYPE html>
<html>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="reception.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
            <img src="https://intranet.ciu.edu.tr/srs/img/ciu-white-en.png" style="width: 74px">  
      <!--  <span class="brand-text font-weight-light ">CIU SHIS</span> -->
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
   
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active"> &nbsp;
            <i class="fas fa-calendar-check"></i> &nbsp; &nbsp;
              <p>
                Appointment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="addappointment.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Appointment</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="appointmentrep_table.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Appointments </p>
                </a>
              </li>
              </ul>
                              
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"> &nbsp;
            <i class="fas fa-user-nurse"></i> &nbsp;&nbsp;
              <p>
                announcements
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="announcementform.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add announcement</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="announcementlist_table.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View announcements</p>
                </a>
              </li>
              </ul>
              
              <li class="nav-item has-treeview">
            <a href="announcements.php" class="nav-link"> &nbsp;
            <i class="fa fa-microphone"></i>&nbsp;&nbsp;
              <p>
                Announcements
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <li class="nav-item has-treeview">
                <a href="viewannouncementtab.php" class="nav-link"> &nbsp;
                <i class="ionicons ion-ios-eye"></i>&nbsp;&nbsp;
                <p>
                View of Announcements
                <span class="badge badge-info right"></span>
                
              </p>
            </a>
            </li>
              <li class="nav-item has-treeview">
                    <a href="#" class="nav-link"> &nbsp;
                        <i class="fas fa-user-circle Left"></i>&nbsp; &nbsp;
                      <p>
                        My Account
                        
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right"></span>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                          <i class="fas fa-sign-out-alt"></i>
                          <p>Logout</p>
                        </a>
                      </li>
                    </ul>
                            
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cancel Appointment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Cancel  Appointment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">  
                 <i class="fas fa-window-close"></i> &nbsp; &nbsp;
                  <h3 class="card-title">CANCEL APPOINTMENT</h3>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <!-- <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>                         
                  </div> -->
                              <div class="row">
                                    <div class="col-md-12">  

                                    
                                    <?php
                                        //delete
                                        if( isset($_POST['announcement']) && $_POST['announcement']=="delete" ){
                                            
                                            $announcement->deleteAnnouncement($phone);
                                        ?>
                                            <br/> <br/>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Announcement is deleted</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                        <?php
                                            
                                        }
                                    ?>
                                            
                                            <!-- Flexbox container for aligning the toasts -->
                                            <div id="element">
                                        Do you really want to delete announcement ? <br/>

                                            <br/> <br/>
                                                <!-- Button trigger modal -->
                                                <center><button type="button" class="btn btn-danger " data-toggle="modal" data-target="#exampleModal">
                                                        DELETE
                                                    </button></center>
                                                    
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Cancel</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            Are you wishing to delete announcement?
                                                            </div>
                                                            <div class="modal-footer">
                                                              <form action="announcement_delete.php?ph=<?php echo $phone = $_GET['ph'];?>" method="POST"> 
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" name="no" value="no">NO, Close</button>
                                                                <input type="submit" name="yes" value="Yes, Delete"   class="btn btn-danger">

                                                               <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal" name="no" value="no">NO, Close</button>
                                                                <button type="submit" class="btn btn-primary" data-dismiss="modal" name="yes" value="yes">YES, Cancel</button>
                                                                -->
                                                                <input type="hidden" name="announcement" value="delete">
                                                              </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    
                                            </div>
                                </div>
                            </div>
                 
                </div>
              </div><!-- /.card-body -->
            </div>
           
              <!-- /.card-footer-->
            </div>
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer"> <center>2020 © Cyprus International University </center></footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

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
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
</body>
</html>
