<?php
session_start();
if(!isset($_SESSION['studentNumber'])){
    header("Location:index.php");
}

if ($_SESSION['studentNumber']>1){
  header("Location:index.php");
}
require 'class/DBConnection.class.php';
require 'class/doctor.class.php';
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
                Doctors
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="doctorform.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Doctor</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="doctorlist_table.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Doctors</p>
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
            </li>
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
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
   
  
        <!-- Main row -->
        
          <!-- Left col -->
         
               

                    <section class="content">
                            <div class="container-fluid">
                      
                                            <!-- Main row -->
                                            <div class="row">
                                              <!-- Left col -->
                                              <section class="col-lg-7 connectedSortable">
                                                <!-- Custom tabs (Charts with tabs)-->
                                                <div class="card card-primary">
                                                  <div class="card-header">
                                                    <h3 class="card-title">
                                                     <i class="fas fa-user-md"></i> &nbsp; &nbsp;
                                                      <h3 class="card-title">DOCTOR FORM</h3>
                                                    </h3>
                                                    
                                                  </div><!-- /.card-header -->
                              
                                          <div class="card-body">
                                                  <div class="tab-content p-0">
                                                    
                                                                <div class="row">
                                                                      <div class="col-md-12">  
                                                                      <form action="doctorform.php" method="POST">
                                                                      

                                                                        <?php
                                                                          //add
                                                                          if( isset($_POST['doctor']) && $_POST['doctor']=="add" ){
                                                                              $doctor = new Doctor;
                                                                             $_POST['username'] = $_POST['nameD']; 
                                                                             $doctor->addDoctor($_POST);
                                                                              if($doctor->add == TRUE){


                                                                          ?>
                                                                              <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                                                <strong>Doctor saved.</strong>
                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                          <?php
                                                                              }
                                                                          }
                                                                        ?>
                                                                                                                                                           
                                                                      <div class="form-group">
                                                                          <label for="exampleInputPassword1">Upload Image</label>
                                                                             
                                                                         <div class="custom-file">
                                                                          <input type="file" class="custom-file-input" id="exampleInputFile" name="imageD" multiple>
                                                                          <label class="custom-file-label" for="customFile">Choose file</label>
                                                                          </div> 
                                                                             <br>       
                                                                        <div class="form-group">
                                                                          <label for="exampleInputPassword1">Name</label>
                                                                          <input type="name" class="form-control" name="nameD" id="name" placeholder="Doctor Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label for="exampleInputPassword1">Date of Birth</label>
                                                                                <input type="date" class="form-control" name="dateOfBirth" id="appointmentDate" placeholder="Appointment Date">
                                                                              </div>
                                                                        
                                                                        <div class="form-group">
                                                                              <label for="exampleFormControlSelect2"> E-mail</label>
                                                                              <input type="email" class="form-control" name="email" id="email" placeholder="E-mail address">
                                                                        </div>
                                                                       
                                  
                                                                        <div class="form-group">
                                                                          <label for="exampleFormControlSelect2"> Phone Number</label>
                                                                          <input type="number" class="form-control" name="phoneNumber" id="telephone" placeholder="Phone Number">
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
                                                                              <option value='??land Islands'>??land Islands</option>
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
                                                                              <option value='Saint Barth??lemy'>Saint Barth??lemy</option>
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
                                                                              <option value='S??o Tom?? and Pr??ncipe'>S??o Tom?? and Pr??ncipe</option>
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
                                                                        
                                                            
                                                                        <div class="form-check">
                                                                          <div class="row">
                                                            
                                                                            <div class="col-md-6">
                                                                            <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="male" checked="">
                                                                            <label class="form-check-label" for="exampleRadios1">
                                                                              Male
                                                                            </label>
                                                                            </div>
                                                            
                                                                            <div class="col-md-6">
                                                                              <input class="form-check-input" type="radio" name="sex" id="exampleRadios2" value="female">
                                                                              <label class="form-check-label" for="exampleRadios2">
                                                                                Female
                                                                              </label>
                                                                            </div>

                                                                            <input class="form-check-input" type="hidden" name="doctor" id="exampleRadios1" value="add">

                                                                          </div>
                                                                        </div>
                                                                        <?php $c1 = mt_rand(1111,9999);?>

                                                                        <input type="hidden" name="pswd" value="<?php echo $c1;?>">
                                                                        <input type="hidden" name="repswd" value="<?php echo $c1;?>">
                                                                        <input type="hidden" name="studentId" value="<?php echo $c1;?>">
                                                                        <input type="hidden" name="login" value="add">

                                                                        
                                                                        <br/>
                                                                      <button type="submit" class="btn btn-primary">Save</button>  
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
                                                                      &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; 
                                                                        
                                                                     
                                                                      
                                                                      <button type="reset" class="btn btn-danger"> Reset </button>
                                                                      
                                                                    </form>
                                                                  </div>
                                                              </div>
                                                              
                                                   
                                                  </div>
                                                </div><!-- /.card-body -->
                                              </div>
                                  </div>
                                  </div><!-- /.card-body -->
                                 
                                 
                                    <!-- /.card-footer-->
                                                                 
                            </div>
                         
                
                

            </div>
            </div><!-- /.card-body -->
            </div> 
           
              <!-- /.card-footer-->
            </div>
          </div>
      </div>
   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer"> <center>2020 ?? Cyprus International University </center></footer>

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
