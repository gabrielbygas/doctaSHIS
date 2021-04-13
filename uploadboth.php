<?php 
 session_start();
 if(!isset($_SESSION['studentNumber'])){
    header("Location:index.php");
}
if ($_SESSION['studentNumber']==001){
  header("Location:index.php");
}
else if($_SESSION['studentNumber']>9999){
  header("location:index.php");
}

 require 'class/DBConnection.class.php';
 require 'class/medical.class.php';
 
 $medical = new Medical;
 if(isset($_GET['st'])){
  $st = $_GET['st'];
 }
 else{
   $st = $_POST['studentNumber'];
 }

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
        <a href="doctor.php" class="nav-link">Home</a>
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

    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fa fa-envelope"></i>
          <span class="badge badge-danger navbar-badge">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="repplypage.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
             
              <div class="media-body">
                <h3 class="dropdown-item-title">
                 Harmick Makiese
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="repplypage.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
             
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Harmick Vangu
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="repplypage.php" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
             
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Harmick Yaya
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
        </div>
      </li> 
      
    </ul>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
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
                View Appointment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="appointmentlist_table.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Appointment List</p>
                      </a>
                    </li>
                    </ul>  
                    <li class="nav-item has-treeview">
                    <a href="repplypage.php" class="nav-link"> &nbsp;
                    <i class="fa fa-reply"></i> &nbsp; &nbsp;
                       <p>
                          Reply
                       <i class="right fas fa-angle-left"></i>
                       </p>
                   </a>

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
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

            
                        <div class=" col-md-8 modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bold" id="agentUpdate">
                                       UPLOAD DOCUMENTS
                                    </h5>
                                    
                                </div>
                                 
                                <div class="modal-body">
                                    <form action="uploadboth.php?st=<?php echo $st;?>" method="POST" class="m-form" id="">
                                        
                                        <div class="col-lg-12">
                                                               
                                            

                                                <p>
                                                       <center> <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Upload Medical Report</a></center>
                                                        <!-- &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                                                          &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Upload Medical Prescription</button> -->
                                                      
                                                      </p>
                                                      <div class="row">
                                                        <div class="col">
                                                          <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                           


                                                                <div class=" col-md-12 modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title font-weight-bold" id="agentUpdate">
                                                                           UPLOAD A MEDICAL REPORT
                                                                        </h5>
                                                                        
                                                                    </div>
                                                                     
                                                                    <div class="modal-body">
                                                                        <form action="uploadboth.php#agent_auth_form" method="POST" class="m-form" id="agent_auth_form">
                           
                                                                            <?php
                                                                          //add
                                                                          if( isset($_POST['medical']) && $_POST['medical']=="add" ){
                                                                          
                                                                              $medical->addMedical($_POST);
                                                                              if($medical->add == TRUE){
                                                                          ?>
                                                                              <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                                                <strong>Medical Report saved.</strong>
                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                          <?php
                                                                              }
                                                                          }
                                                                        ?>
                                                                            <div class="col-lg-12">
                                                                                
                                                                                <input type="hidden" class="form-control" name="appointmentDate" value="<?php echo date('yy-m-d h:i:s');?>" id="appointmentDate">
                                                                                    
                                            
                                                                                <div class="form-group m-form__group row">
                                                                                    <label class="col-lg-2 col-form-label">Temperature:</label>
                                                                                    <div class="col-lg-10">
                                                                                    <input type="text" class="form-control" name="temperature" placeholder="Temperature">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-group m-form__group row">
                                                                                    <label class="col-lg-2 col-form-label">Blood Pressure:</label>
                                                                                    <div class="col-lg-10">
                                                                                    <input type="text" class="form-control" name="bloodPressure" placeholder="Blood Pressure">
                                                                                    </div>
                                                                                </div>
                                            
                                                                                <div class="form-group m-form__group row has-success">
                                                                                    <label class="col-lg-2 col-form-label">Comments:</label>
                                                                                    <div class="col-lg-10">
                                                                                  <textarea name="comments" id="" cols="58" rows="2"></textarea>
                                                                                </div>  
                                                                                </div> 
                                                                                <input type="hidden" name="studentNumber" value="<?php echo $st; ?>"/>
                                            
                                                                                <div class="form-group m-form__group row">
                                                                                     <label for="exampleFormControlSelect2" class="col-lg-2 col-form-label">Upload:</label>
                                                                                        <input type="file" name="downloadFile" multiple> 
                                                                                    </div>
                                                                                    
                                                                                  </div>
                                                                     
                                                                                </br>
                                                                              <div>

                                                                              <input type="hidden" name="medical" value="add">
                                                                                                                               
                                                                               <button type="submit" class="btn btn-primary btn-md btn-block">Submit</button>
                                                                               <button type="cancel" class="btn btn-secondary btn-md btn-block">Cancel</button>
                                                                               
                                                                              </div>  
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            
                                           
                                                </div> 
                                               

                                                        <!-- <div class="col">
                                                          <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                           
                                                                <div class=" col-md-12 modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title font-weight-bold" id="agentUpdate">
                                                                           UPLOAD A MEDICAL PRESCRIPTION
                                                                        </h5>
                                                                        
                                                                    </div>
                                                                     
                                                                    <div class="modal-body">
                                                                        <form action="/action_page.php"  class="m-form" id="agent_auth_form">
                                                                            
                                                                            <div class="col-lg-12">
                                                                                
                                                                                <div class="form-group m-form__group row">
                                                                                    <label class="col-lg-2 col-form-label">Date:</label>
                                                                                    <div class="col-lg-10">
                                                                                    <input type="date" class="form-control" id="appointmentDate" placeholder="Appointment Date">
                                                                                    </div>
                                                                                </div>
                                            
                                                                                <div class="form-group m-form__group row">
                                                                                    <label class="col-lg-2 col-form-label">Dosage:</label>
                                                                                    <div class="col-lg-10">
                                                                                    <input type="name" class="form-control"  placeholder="How many times a day. Ex: 1-0-1 or 1-1-1">
                                                                                    </div>
                                                                                </div>
                                    
                                                                                <div class="form-group m-form__group row">
                                                                                        <label class="col-lg-2 col-form-label">Dosage Note</label>
                                                                                        <div class="col-lg-10">
                                                                                        <input type="name" class="form-control"  placeholder="Ex: Before Lunch or After Lunch">
                                                                                        </div>
                                                                                    </div>
                                    
                                                                                    <div class="form-group m-form__group row">
                                                                                            <label class="col-lg-2 col-form-label">Quantity</label>
                                                                                            <div class="col-lg-10">
                                                                                            <input type="name" class="form-control"  placeholder="Quantity of tablets">
                                                                                            </div>
                                                                                        </div>
                                                
                                               
                                                                                <div class="form-group m-form__group row">
                                                                                     <label for="exampleFormControlSelect2" class="col-lg-2 col-form-label">Upload:</label>
                                                                                        <input type="file" name="myFile" multiple> 
                                                                                    </div>
                                                                                    
                                                                                  </div>
                                                                     
                                                                                </br>
                                                                              <div>
                                                                                                                               
                                                                               <button type="submit" class="btn btn-primary btn-md btn-block">Submit</button>
                                                                               <button type="cancel" class="btn btn-secondary btn-md btn-block">Cancel</button>
                                                                               
                                                                              </div>  
                                                                        </form>
                                                                   </div>
                                                            </div>
                                           


                                                             
                                                            </div>
                                                          </div>
                                                        </div> -->
                                                      </div>
                                         
                                          </div>  
                                    </form>
                                </div>
                            </div>
                        </div>
       
            </div> 
           



              <!-- /.card-footer-->
            </div>
          </div>
      </div>
    
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
