<?php 
 session_start();
 if(!isset($_SESSION['studentNumber'])){
    header("Location:index.php");
}
if ($_SESSION['studentNumber']<10000000) {
  header("Location:index.php");
}
 require 'class/DBConnection.class.php';
 require 'class/schedule.class.php';
 require 'class/login.class.php';
 require 'class/doctor.class.php';
 
 
 $schedule = new Schedule;
 $login = new Login;
 $doctor = new Doctor;
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
        <a href="home.php" class="nav-link">Home</a>
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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <p class=""> <?php $schedule->getScheduleId('patientName',$_SESSION['studentNumber'])?> </p>
  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index.php" class="brand-link">  
    <img src="https://intranet.ciu.edu.tr/srs/img/ciu-white-en.png" style="width: 74px"> 
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
                <i class="fas fa-user-nurse"></i> &nbsp;&nbsp;
              <p>
                Doctor Appointment
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="schedule.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Schedule Appointment</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reschedule.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reschedule Appointment</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="cancel.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cancel Appointment</p>
                </a>
              </li>
            </ul>
                    
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Health Reports
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="medrepot_table.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Medical Reports</p>
                </a>
            </li>
            </ul>  

          <!--  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">&nbsp; 
                        <i class="fas fa-clinic-medical"></i>&nbsp; &nbsp;
                      <p>
                        Pharmacy
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right"></span>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="medprescrip_table.php" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Medical Prescriptions</p>
                        </a>
                      </li>
                    </ul> -->
    
                    <li class="nav-item has-treeview">
                        <a href="appointment_history.php" class="nav-link"> &nbsp;
                            <i class="fas fa-calendar-check"></i> &nbsp; &nbsp;
                          <p>
                            Appointment History
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-info right"></span>
                          </p>
                        </a>

                        <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-copy"></i>
                                  <p>
                                    Ask Questions
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right"></span>
                                  </p>
                                </a>
                    
                                <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                    <a href="chat.php" class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Enquiry</p>
                                    </a>
                                  </li>
                                </ul> 
    
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
            <h1 class="m-0 text-dark">Schedule Appointment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Schedule Appointment</li>
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
                 <i class="fas fa-user-md"></i> &nbsp; &nbsp;
                  <h3 class="card-title">DOCTOR APPOINTMENT</h3>
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">

                <?php
                  //add
                  // si le schedule exist and  schedule vaut add
                  if( isset($_POST['schedule']) && $_POST['schedule']=="add" ){
                      
                      // verifie si la date du jour est inferieur ala date du appointment
                      // si NON (dateDujour <= dateAppointment), impossible d'ajouter un nouveau appointment et affiche un message
                      $schedule->checkDate($_SESSION['studentNumber']);

                      if($schedule->checkDate == TRUE){ //si oui (dateDuJour > dateAppointment)

                          $schedule->addSchedule($_POST);
                          if($schedule->add == TRUE){ //send to database
                  ?>
                          <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Appointment is booked.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div> 
                  <?php
                          }
                      }
                      else{ // si non (dateDujour <= dateAppointment)
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>You have already an Appointment. You can not get another one.</strong><br/>
                          <span> you have a possiblity to modify it <a href="reschedule.php"> HERE</a>. <span>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                      <?php
                      }
                  }
                ?>
                  
                              <div class="row">
                                    <div class="col-md-12">  
                                    <form action="schedule.php" method="POST">
                                      <?php $doctor->getDoctorName();?>                                      

                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Appointment Date</label>
                                        <input type="date" class="form-control" id="appointmentDate" name="appointmentDate"  placeholder="Appointment Date">
                                      </div>

                                      <div class="form-group">
                                        <label for="exampleFormControlSelect1">Time</label>
                                        <select class="form-control" id="time" name="timeSchedule" required> <!-- name="timeSchedule" -->
                                        <option selected="">Pick the Time</option>
                                        <option value="09h30 - 10h30">09h30 - 10h30</option>
                                        <option value="10h45 - 11h45">10h45 - 11h45</option>
                                        <option value="11h55 - 12h55">11h55 - 12h55</option>
                                        <option value="13h00 - 14h00">13h00 - 14h00</option>
                                        <option value="14h10 - 15h10">14h10 - 15h10</option>
                                        <option value="15h20 - 16h20">15h20 - 16h20</option>
                                      </select>
                                      </div>
                          
                                      <div class="divider"> <h5 class="text-dark"> Patient details </h5> <hr class="hr-text">  </div>
                                      
                                      <div class="form-group">
                                            <label for="exampleFormControlSelect2"> Patient Name</label>
                                            <input type="text" class="form-control " disabled placeholder="<?php $login->getLoginId('username',$_SESSION['studentNumber']);?>">
                                            <input type="hidden" class="form-control " name="patientName" id="name" value="<?php echo $login->getLogin ;?>">
                                      </div>
                                      <div class="form-group">
                                            <label for="exampleInputPassword1">Date of Birth</label>
                                            <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" placeholder="Date of Birth">
                                          </div>

                                      <div class="form-group">
                                        <label for="exampleFormControlSelect2"> Student Number</label>
                                        <input type="number"  class="form-control" disabled placeholder="<?php echo $_SESSION['studentNumber']?>">
                                        <input type="hidden" class="form-control" name="studentNumber" id="studentNumber" value="<?php echo $_SESSION['studentNumber']?>">
                                      </div>
                                      <div class="form-group">
                                            <label for="exampleFormControlSelect2">Patient Mobile</label>
                                            <input type="number" class="form-control" id="patientMobile" name="patientMobile" placeholder="Patient Mobile">
                                          </div>

                                      <div class="form-group">
                                            <label for="exampleInputEmail1">Country </label>
                                            <select class="form-control" name="country" size="1">
                                            <option selected="">Select Country Name</option>                                    
                                                <option value='Ascension Island'>Ascension Island</option>
                                                <option value='Andorra'>Andorra</option>
                                                <option value='United Arab Emirates'>United Arab Emirates</option>
                                                <option value='Afghanistan'>Afghanistan</option>
                                                <option value='Antigua And Barbuda'>Antigua And Barbuda</option>
                                                <option value='Anguilla'>Anguilla</option>
                                                <option value='Albania'>Albania</option>
                                                <option value='Armenia'>Armenia</option>
                                                <option value='Angola'>Angola</option>
                                                <option value='Antarctica'>Antarctica</option>
                                                <option value='Argentina'>Argentina</option>
                                                <option value='American Samoa'>American Samoa</option>
                                                <option value='Austria'>Austria</option>
                                                <option value='Australia'>Australia</option>
                                                <option value='Aruba'>Aruba</option>
                                                <option value='Åland Islands'>Åland Islands</option>
                                                <option value='Azerbaijan'>Azerbaijan</option>
                                                <option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>
                                                <option value='Barbados'>Barbados</option>
                                                <option value='Bangladesh'>Bangladesh</option>
                                                <option value='Belgium'>Belgium</option>
                                                <option value='Burkina Faso'>Burkina Faso</option>
                                                <option value='Bulgaria'>Bulgaria</option>
                                                <option value='Bahrain'>Bahrain</option>
                                                <option value='Burundi'>Burundi</option>
                                                <option value='Benin'>Benin</option>
                                                <option value='Saint Barthélemy'>Saint Barthélemy</option>
                                                <option value='Bermuda'>Bermuda</option>
                                                <option value='Brunei Darussalam'>Brunei Darussalam</option>
                                                <option value='Bolivia, Plurinational State Of'>Bolivia, Plurinational State Of</option>
                                                <option value='Bonaire, Saint Eustatius And Saba'>Bonaire, Saint Eustatius And Saba</option>
                                                <option value='Brazil'>Brazil</option>
                                                <option value='Bahamas'>Bahamas</option>
                                                <option value='Bhutan'>Bhutan</option>
                                                <option value='Bouvet Island'>Bouvet Island</option>
                                                <option value='Botswana'>Botswana</option>
                                                <option value='Belarus'>Belarus</option>
                                                <option value='Belize'>Belize</option>
                                                <option value='Canada'>Canada</option>
                                                <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
                                                <option value='Democratic Republic Of Congo'>Democratic Republic Of Congo</option>
                                                <option value='Central African Republic'>Central African Republic</option>
                                                <option value='Republic Of Congo'>Republic Of Congo</option>
                                                <option value='Switzerland'>Switzerland</option>
                                                <option value='Cote d'Ivoire'>Cote d'Ivoire</option>
                                                <option value='Cook Islands'>Cook Islands</option>
                                                <option value='Chile'>Chile</option>
                                                <option value='Cameroon'>Cameroon</option>
                                                <option value='China'>China</option>
                                                <option value='Colombia'>Colombia</option>
                                                <option value='Clipperton Island'>Clipperton Island</option>
                                                <option value='Costa Rica'>Costa Rica</option>
                                                <option value='Cuba'>Cuba</option>
                                                <option value='Cabo Verde'>Cabo Verde</option>
                                                <option value='Curacao'>Curacao</option>
                                                <option value='Christmas Island'>Christmas Island</option>
                                                <option value='Cyprus'>Cyprus</option>
                                                <option value='Czech Republic'>Czech Republic</option>
                                                <option value='Germany'>Germany</option>
                                                <option value='Diego Garcia'>Diego Garcia</option>
                                                <option value='Djibouti'>Djibouti</option>
                                                <option value='Denmark'>Denmark</option>
                                                <option value='Dominica'>Dominica</option>
                                                <option value='Dominican Republic'>Dominican Republic</option>
                                                <option value='Algeria'>Algeria</option>
                                                <option value='Ceuta, Mulilla'>Ceuta, Mulilla</option>
                                                <option value='Ecuador'>Ecuador</option>
                                                <option value='Estonia'>Estonia</option>
                                                <option value='Egypt'>Egypt</option>
                                                <option value='Western Sahara'>Western Sahara</option>
                                                <option value='Eritrea'>Eritrea</option>
                                                <option value='Spain'>Spain</option>
                                                <option value='Ethiopia'>Ethiopia</option>
                                                <option value='European Union'>European Union</option>
                                                <option value='Finland'>Finland</option>
                                                <option value='Fiji'>Fiji</option>
                                                <option value='Falkland Islands'>Falkland Islands</option>
                                                <option value='Micronesia, Federated States Of'>Micronesia, Federated States Of</option>
                                                <option value='Faroe Islands'>Faroe Islands</option>
                                                <option value='France'>France</option>
                                                <option value='France, Metropolitan'>France, Metropolitan</option>
                                                <option value='Gabon'>Gabon</option>
                                                <option value='United Kingdom'>United Kingdom</option>
                                                <option value='Grenada'>Grenada</option>
                                                <option value='Georgia'>Georgia</option>
                                                <option value='French Guiana'>French Guiana</option>
                                                <option value='Guernsey'>Guernsey</option>
                                                <option value='Ghana'>Ghana</option>
                                                <option value='Gibraltar'>Gibraltar</option>
                                                <option value='Greenland'>Greenland</option>
                                                <option value='Gambia'>Gambia</option>
                                                <option value='Guinea'>Guinea</option>
                                                <option value='Guadeloupe'>Guadeloupe</option>
                                                <option value='Equatorial Guinea'>Equatorial Guinea</option>
                                                <option value='Greece'>Greece</option>
                                                <option value='South Georgia And The South Sandwich Islands'>South Georgia And The South Sandwich Islands</option>
                                                <option value='Guatemala'>Guatemala</option>
                                                <option value='Guam'>Guam</option>
                                                <option value='Guinea-bissau'>Guinea-bissau</option>
                                                <option value='Guyana'>Guyana</option>
                                                <option value='Hong Kong'>Hong Kong</option>
                                                <option value='Heard Island And McDonald Islands'>Heard Island And McDonald Islands</option>
                                                <option value='Honduras'>Honduras</option>
                                                <option value='Croatia'>Croatia</option>
                                                <option value='Haiti'>Haiti</option>
                                                <option value='Hungary'>Hungary</option>
                                                <option value='Canary Islands'>Canary Islands</option>
                                                <option value='Indonesia'>Indonesia</option>
                                                <option value='Ireland'>Ireland</option>
                                                <option value='Israel'>Israel</option>
                                                <option value='Isle Of Man'>Isle Of Man</option>
                                                <option value='India'>India</option>
                                                <option value='British Indian Ocean Territory'>British Indian Ocean Territory</option>
                                                <option value='Iraq'>Iraq</option>
                                                <option value='Iran, Islamic Republic Of'>Iran, Islamic Republic Of</option>
                                                <option value='Iceland'>Iceland</option>
                                                <option value='Italy'>Italy</option>
                                                <option value='Jersey'>Jersey</option>
                                                <option value='Jamaica'>Jamaica</option>
                                                <option value='Jordan'>Jordan</option>
                                                <option value='Japan'>Japan</option>
                                                <option value='Kenya'>Kenya</option>
                                                <option value='Kyrgyzstan'>Kyrgyzstan</option>
                                                <option value='Cambodia'>Cambodia</option>
                                                <option value='Kiribati'>Kiribati</option>
                                                <option value='Comoros'>Comoros</option>
                                                <option value='Saint Kitts And Nevis'>Saint Kitts And Nevis</option>
                                                <option value='Korea, Democratic People's Republic Of'>Korea, Democratic People's Republic Of</option>
                                                <option value='Korea, Republic Of'>Korea, Republic Of</option>
                                                <option value='Kuwait'>Kuwait</option>
                                                <option value='Cayman Islands'>Cayman Islands</option>
                                                <option value='Kazakhstan'>Kazakhstan</option>
                                                <option value='Lao People's Democratic Republic'>Lao People's Democratic Republic</option>
                                                <option value='Lebanon'>Lebanon</option>
                                                <option value='Saint Lucia'>Saint Lucia</option>
                                                <option value='Liechtenstein'>Liechtenstein</option>
                                                <option value='Sri Lanka'>Sri Lanka</option>
                                                <option value='Liberia'>Liberia</option>
                                                <option value='Lesotho'>Lesotho</option>
                                                <option value='Lithuania'>Lithuania</option>
                                                <option value='Luxembourg'>Luxembourg</option>
                                                <option value='Latvia'>Latvia</option>
                                                <option value='Libya'>Libya</option>
                                                <option value='Morocco'>Morocco</option>
                                                <option value='Monaco'>Monaco</option>
                                                <option value='Moldova'>Moldova</option>
                                                <option value='Montenegro'>Montenegro</option>
                                                <option value='Saint Martin'>Saint Martin</option>
                                                <option value='Madagascar'>Madagascar</option>
                                                <option value='Marshall Islands'>Marshall Islands</option>
                                                <option value='Macedonia, The Former Yugoslav Republic Of'>Macedonia, The Former Yugoslav Republic Of</option>
                                                <option value='Mali'>Mali</option>
                                                <option value='Myanmar'>Myanmar</option>
                                                <option value='Mongolia'>Mongolia</option>
                                                <option value='Macao'>Macao</option>
                                                <option value='Northern Mariana Islands'>Northern Mariana Islands</option>
                                                <option value='Martinique'>Martinique</option>
                                                <option value='Mauritania'>Mauritania</option>
                                                <option value='Montserrat'>Montserrat</option>
                                                <option value='Malta'>Malta</option>
                                                <option value='Mauritius'>Mauritius</option>
                                                <option value='Maldives'>Maldives</option>
                                                <option value='Malawi'>Malawi</option>
                                                <option value='Mexico'>Mexico</option>
                                                <option value='Malaysia'>Malaysia</option>
                                                <option value='Mozambique'>Mozambique</option>
                                                <option value='Namibia'>Namibia</option>
                                                <option value='New Caledonia'>New Caledonia</option>
                                                <option value='Niger'>Niger</option>
                                                <option value='Norfolk Island'>Norfolk Island</option>
                                                <option value='Nigeria'>Nigeria</option>
                                                <option value='Nicaragua'>Nicaragua</option>
                                                <option value='Netherlands'>Netherlands</option>
                                                <option value='Norway'>Norway</option>
                                                <option value='Nepal'>Nepal</option>
                                                <option value='Nauru'>Nauru</option>
                                                <option value='Niue'>Niue</option>
                                                <option value='New Zealand'>New Zealand</option>
                                                <option value='Oman'>Oman</option>
                                                <option value='Panama'>Panama</option>
                                                <option value='Peru'>Peru</option>
                                                <option value='French Polynesia'>French Polynesia</option>
                                                <option value='Papua New Guinea'>Papua New Guinea</option>
                                                <option value='Philippines'>Philippines</option>
                                                <option value='Pakistan'>Pakistan</option>
                                                <option value='Poland'>Poland</option>
                                                <option value='Saint Pierre And Miquelon'>Saint Pierre And Miquelon</option>
                                                <option value='Pitcairn'>Pitcairn</option>
                                                <option value='Puerto Rico'>Puerto Rico</option>
                                                <option value='Palestinian Territory, Occupied'>Palestinian Territory, Occupied</option>
                                                <option value='Portugal'>Portugal</option>
                                                <option value='Palau'>Palau</option>
                                                <option value='Paraguay'>Paraguay</option>
                                                <option value='Qatar'>Qatar</option>
                                                <option value='Reunion'>Reunion</option>
                                                <option value='Romania'>Romania</option>
                                                <option value='Serbia'>Serbia</option>
                                                <option value='Russian Federation'>Russian Federation</option>
                                                <option value='Rwanda'>Rwanda</option>
                                                <option value='Saudi Arabia'>Saudi Arabia</option>
                                                <option value='Solomon Islands'>Solomon Islands</option>
                                                <option value='Seychelles'>Seychelles</option>
                                                <option value='Sudan'>Sudan</option>
                                                <option value='Sweden'>Sweden</option>
                                                <option value='Singapore'>Singapore</option>
                                                <option value='Saint Helena, Ascension And Tristan Da Cunha'>Saint Helena, Ascension And Tristan Da Cunha</option>
                                                <option value='Slovenia'>Slovenia</option>
                                                <option value='Svalbard And Jan Mayen'>Svalbard And Jan Mayen</option>
                                                <option value='Slovakia'>Slovakia</option>
                                                <option value='Sierra Leone'>Sierra Leone</option>
                                                <option value='San Marino'>San Marino</option>
                                                <option value='Senegal'>Senegal</option>
                                                <option value='Somalia'>Somalia</option>
                                                <option value='Suriname'>Suriname</option>
                                                <option value='South Sudan'>South Sudan</option>
                                                <option value='São Tomé and Príncipe'>São Tomé and Príncipe</option>
                                                <option value='USSR'>USSR</option>
                                                <option value='El Salvador'>El Salvador</option>
                                                <option value='Sint Maarten'>Sint Maarten</option>
                                                <option value='Syrian Arab Republic'>Syrian Arab Republic</option>
                                                <option value='Swaziland'>Swaziland</option>
                                                <option value='Tristan de Cunha'>Tristan de Cunha</option>
                                                <option value='Turks And Caicos Islands'>Turks And Caicos Islands</option>
                                                <option value='Chad'>Chad</option>
                                                <option value='French Southern Territories'>French Southern Territories</option>
                                                <option value='Togo'>Togo</option>
                                                <option value='Thailand'>Thailand</option>
                                                <option value='Tajikistan'>Tajikistan</option>
                                                <option value='Tokelau'>Tokelau</option>
                                                <option value='Timor-Leste, Democratic Republic of'>Timor-Leste, Democratic Republic of</option>
                                                <option value='Turkmenistan'>Turkmenistan</option>
                                                <option value='Tunisia'>Tunisia</option>
                                                <option value='Tonga'>Tonga</option>
                                                <option value='Turkey'>Turkey</option>
                                                <option value='Trinidad And Tobago'>Trinidad And Tobago</option>
                                                <option value='Tuvalu'>Tuvalu</option>
                                                <option value='Taiwan'>Taiwan</option>
                                                <option value='Tanzania, United Republic Of'>Tanzania, United Republic Of</option>
                                                <option value='Ukraine'>Ukraine</option>
                                                <option value='Uganda'>Uganda</option>
                                                <option value='United Kingdom'>United Kingdom</option>
                                                <option value='United States Minor Outlying Islands'>United States Minor Outlying Islands</option>
                                                <option value='United States'>United States</option>
                                                <option value='Uruguay'>Uruguay</option>
                                                <option value='Uzbekistan'>Uzbekistan</option>
                                                <option value='Vatican City State'>Vatican City State</option>
                                                <option value='Saint Vincent And The Grenadines'>Saint Vincent And The Grenadines</option>
                                                <option value='Venezuela, Bolivarian Republic Of'>Venezuela, Bolivarian Republic Of</option>
                                                <option value='Virgin Islands (British)'>Virgin Islands (British)</option>
                                                <option value='Virgin Islands (US)'>Virgin Islands (US)</option>
                                                <option value='Viet Nam'>Viet Nam</option>
                                                <option value='Vanuatu'>Vanuatu</option>
                                                <option value='Wallis And Futuna'>Wallis And Futuna</option>
                                                <option value='Samoa'>Samoa</option>
                                                <option value='Yemen'>Yemen</option>
                                                <option value='Mayotte'>Mayotte</option>
                                                <option value='South Africa'>South Africa</option>
                                                <option value='Zambia'>Zambia</option>
                                                <option value='Zimbabwe'>Zimbabwe</option>    
                                            </select>
                                                                                   
                                            </div>
                                      <div class="form-group">
                                        <label for="exampleInputEmail1">Department </label>
                                        <select class="form-control" name="department" size="1">
                                          <option selected="">Select Department</option>
                                          <option>Computer Technologies and Programming</option>
                                          <option>Construction Technology</option>
                                          <option>First and Emergency Aid</option>
                                          <option>Public Relations and Advertising</option>
                                          <option>Radio &amp; Tv Programming</option>
                                          <option>Plant Production and Technologies</option>
                                          <option>Molecular Biology &amp; Genetics</option>
                                          <option>Psychology</option>
                                          <option>Translation Science</option>
                                          <option>Advertising and Public Relations</option>
                                          <option>Journalism</option>
                                          <option>Radio and Television</option>
                                          <option>Visual Communication Design</option>
                                          <option>Accounting and Finance</option>
                                          <option>Business Administration</option>
                                          <option>Digital Media and Marketing</option>
                                          <option>Economics</option>
                                          <option>International Relations</option>
                                          <option>English Language Teaching</option>
                                          <option>Pre-school Teaching</option>
                                          <option>Bioengineering</option>
                                          <option>Biomedical Engineering</option>
                                          <option>Biomedical Engineering</option>
                                          <option>Computer Engineering</option>
                                          <option>Electrical and Electronics Engineering</option>
                                          <option>Energy Systems Engineering</option>
                                          <option>Environmental Engineering</option>
                                          <option>Industrial Engineering</option>
                                          <option>Information Systems Engineering</option>
                                          <option>Mechanical Engineering</option>
                                          <option>Mechatronics Engineering</option>
                                          <option>Medical Engineering</option>
                                          <option>Petroleum &amp; Natural Gas Engineering</option>
                                          <option>Software Engineering</option>
                                          <option>Architecture</option>
                                          <option>Graphic Design</option>
                                          <option>Interior Design</option>
                                          <option>Social Work</option>
                                          <option>Nursing</option>
                                          <option>Physiotherapy and Rehabilitation</option>
                                          <option>International Law</option>
                                          <option>Medicine</option>
                                          <option>Dentistry</option>
                                          <option>Pharmacy</option>
                                          <option>Information Technologies</option>
                                          <option>Management Information Systems</option>
                                          <option>Computer Technologies and Programming (Technician)</option>
                                          <option>Midwifery</option>
                                          <option>Tourism and Hotel Management</option>
                                          <option>Gastronomy and Culinary Arts</option>
                                          <option>Accounting and Finance</option>
                                          <option>Bioengineering (</option>
                                          <option>Chemistry</option>
                                          <option>Communication and Media Studies</option>
                                          <option>Engineering Management</option>
                                          <option>English Language and Literature</option>
                                          <option>English Language Teaching</option>
                                          <option>Environmental Sciences</option>
                                          <option>Graphic Design</option>
                                          <option>Health Care Organizations Management</option>
                                          <option>Pharmacognosy</option>
                                          <option>International Banking and Finance</option>
                                          <option>Plant Sciences and Technologies</option>
                                          <option>Tourism and Hospitality Management</option>
                                          <option>Tourism Management</option>
                                        </select>
                                      </div>
                          
                                      <div class="form-check">
                                        <div class="row">
                          
                                          <div class="col-md-6">
                                          <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="male" checked="">
                                          <label class="form-check-label" for="exampleRadios1">
                                            Male
                                          </label>
                                          </div>
                          
                                          <div class="col-md-6">
                                            <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="female">
                                            <label class="form-check-label" for="exampleRadios2">
                                              Female
                                            </label>
                                          </div>

                                            <input class="" type="hidden" name="schedule" value="add">
                          
                                        </div>
                                      </div> 
                                    <br/>
                                    <button type="submit" class="btn btn-primary">Book Appointment</button>  
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                    &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                    &nbsp; &nbsp;  &nbsp;  &nbsp;  
                                  
                                    <button type="reset" class="btn btn-danger"> Reset </button>
                                    
                                  </form>
                                  
                                </div>
                            </div>
                 
                </div>
              </div><!-- /.card-body -->
            </div>
           
              <!-- /.card-footer-->
            </div>
          </section>

          <section class="col-lg-5">
            
          </section>
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
<script src="dist/js/util.js">
  $('.alert').alert();
</script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
