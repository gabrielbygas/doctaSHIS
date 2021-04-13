<?php
require_once 'DBConnection.class.php';
class Schedule extends DBConnection{
    private $doctorName;
    private $appointmentDate;
    private $timeSchedule;
    private $patientName;
    private $dateOfBirth;
    private $studentNumber;
    private $patientMobile;
    private $country;
    private $department;
    private $gender;
    public $checking;
    public $add;
    public $update;
    public $result;
    public $checkDate;

    public function doctorName(){
         return $this->doctorName;
    }
    public function setDoctorName($d){
        $this->doctorName = $d;
    }
    public function appointmentDate(){
        return $this->appointmentDate;
    }
    public function setAppointmentDate($d){
        $this->appointmentDate =$d;
    }
    public function timeSchedule(){
        return $this->timeSchedule;
    }
    public function setTimeSchedule($d){
        $this->timeSchedule =$d;
    }
    public function patientName(){
        return $this->patientName;
    }
    public function setPatientName($d){
        $this->patientName =$d;
    }
    public function dateOfBirth(){
        return $this->dateOfBirth;
    }
    public function setDateOfBirth($d){
        $this->dateOfBirth =$d;
    }
    public function studentNumber(){
        return $this->studentNumber;
    }
    public function setStudentNumber($d){
        $this->studentNumber = $d;
    }
    public function patientMobile(){
        return $this->patientMobile;
    }
    public function setPatientMobile($d){
        $this->patientMobile = $d;
    }
    public function country(){
        return $this->country;
    }
    public function setCountry($d){
         $this->country =$d;
    }
    public function department(){
        return $this->department;
    }
    public function setDepartment($d){
        $this->department = $d;
    }
    public function gender(){
        return $this->gender;
    }
    public function setGender($d){
        $this->gender =$d;
    }

    public function hydrate(array $donnees){
        foreach($donnees as $key => $value){
            //on recupere le nom du setter correspoondant
            $method = 'set'.ucfirst($key);

            //si le setter correspondant existe
            if(method_exists($this,$method)){
                //on appelle le setter
                $this->$method($value);
            }
        }
    }

    public function check(array $donnees){
       $this->checking = TRUE; 
       // var_dump($donnees); echo '/////////<br/>';

        foreach($donnees as $key => $value){
            //if the varaible doesnt exist or the variable is null
            if(empty($value)== TRUE){ 
    ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Please try to fill the " <?php echo $key;?> " field</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    <?php    
               // var_dump($key);
               $this->checking = FALSE;    
            }
        }
        return $this->checking;
    }

    public function addSchedule(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        //foreach($donnees as $key => $value){
            //var_dump($_POST);
            //echo '***********************';
            //var_dump($key);
            //var_dump($value);
            //echo '***********************';
        
        $this->check($donnees);
                    
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                if(isset($_POST['doctorName'])){
                    $scheduleId = $_POST['studentNumber'].'-'.date('y-m-d-h:i:s');
                    
                    $q = $this->connection->prepare('INSERT INTO schedule_appointment(scheduleId, doctorName, appointmentDate, timeSchedule, patientName, dateOfBirth, studentNumber, patientMobile, country, department, gender) 
                    VALUES(:scheduleId, :doctorName, :appointmentDate, :timeSchedule, :patientName, :dateOfBirth, :studentNumber, :patientMobile, :country, :department, :gender)');
                    $q->execute(array(
                        ':scheduleId' => $scheduleId,
                        ':doctorName' => htmlspecialchars($_POST['doctorName']),
                        ':appointmentDate' => htmlspecialchars($_POST['appointmentDate']),
                        ':timeSchedule' => htmlspecialchars($_POST['timeSchedule']),
                        ':patientName' => htmlspecialchars($_POST['patientName']),
                        ':dateOfBirth' => htmlspecialchars($_POST['dateOfBirth']),
                        ':studentNumber' => htmlspecialchars($_POST['studentNumber']),
                        ':patientMobile' => htmlspecialchars($_POST['patientMobile']),
                        ':country' => htmlspecialchars($_POST['country']),
                        ':department' => htmlspecialchars($_POST['department']),
                        ':gender' => htmlspecialchars($_POST['gender'])
                    ));
                    $this->add = TRUE;
                }
                //// $this->closeConnection();
            }
            catch(Exception $e){
                die("Schedule Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        //}
        return $this->add;
    }
    public function deleteSchedule($id){
        try{
            //$q = $this->connection->prepare("DELETE FROM schedule_appointment WHERE scheduleId = :id");
            $q = $this->connection->prepare("DELETE FROM schedule_appointment WHERE studentNumber = :id");
            $q->execute(array(
                ':id' => $id
            ));
            // $this->closeConnection();
        }catch(Exception $e){
            die("Schedule Delete Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }    
    }
    public function update(array $donnees){
        $this->update = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
                    
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                //formater la date
                $d = $_POST['appointmentDate'].' 00:00:00';

                $q = $this->connection->prepare('UPDATE schedule_appointment SET appointmentDate=:appointmentDate, timeSchedule=:timeSchedule WHERE studentNumber=:studentNumber');
                $q->execute(array(
                    ':studentNumber' => htmlspecialchars($_POST['studentNumber']),
                    ':appointmentDate' => htmlspecialchars($d),
                    ':timeSchedule' => htmlspecialchars($_POST['timeSchedule']),
                ));
                // $this->closeConnection();
                $this->update = TRUE;
            }
            catch(Exception $e){
                die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->update;
    }
    public function updateAll(array $donnees){
        $this->update = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
                    
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                //formater la date
                $d = $_POST['appointmentDate'].' 00:00:00';

                $q = $this->connection->prepare('UPDATE schedule_appointment SET doctorName=:doctorName, appointmentDate=:appointmentDate, timeSchedule=:timeSchedule, patientName=:patientName, dateOfBirth=:dateOfBirth, studentNumber=:studentNumber, patientMobile=:patientMobile, country=:country, department=:department, gender=:gender WHERE studentNumber=:studentNumber1');
                $q->execute(array(
                    ':studentNumber1' => htmlspecialchars($_POST['studentNumber']),
                    'doctorName' => htmlspecialchars($_POST['doctorName']),
                    ':appointmentDate' => htmlspecialchars($d),
                    ':timeSchedule' => htmlspecialchars($_POST['timeSchedule']),
                    ':patientName' => htmlspecialchars($_POST['patientName']),
                    'dateOfBirth' => htmlspecialchars($_POST['dateOfBirth']),
                    'studentNumber' => htmlspecialchars($_POST['studentNumber']),
                    'patientMobile' => htmlspecialchars($_POST['patientMobile']),
                    'country' => htmlspecialchars($_POST['country']),
                    'department' => htmlspecialchars($_POST['department']),
                    'gender' => htmlspecialchars($_POST['gender']),
                ));
                // $this->closeConnection();
                $this->update = TRUE;
            }
            catch(Exception $e){
                die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
    }
    public function getSchedule(){
        try{
            $q = $this->connection->prepare('SELECT * FROM schedule_appointment ORDER BY appointmentDate DESC');
            $q->execute();

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Doctor Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Patient Name</th>
                            <th>Date of Birth</th>
                            <th>Student Number</th>
                            <th>Patient Mobile</th>
                            <th>Country</th>
                            <th>Department</th>
                            <th>Gender</th>
                            <th>ACTION</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i;?> </td>
                            <td> <?php echo $donnees['doctorName'];?> </td>
                            <td> <?php echo $donnees['appointmentDate'];?> </td>
                            <td> <?php echo $donnees['timeSchedule'];?> </td>
                            <td> <?php echo $donnees['patientName'];?> </td>
                            <td> <?php echo $donnees['dateOfBirth'];?> </td>
                            <td> <?php echo $donnees['studentNumber'];?> </td>
                            <td> <?php echo $donnees['patientMobile'];?> </td>
                            <td> <?php echo $donnees['country'];?> </td>
                            <td> <?php echo $donnees['department'];?> </td>
                            <td> <?php echo $donnees['gender'];?> </td>
                            <td> <a href="edit_form.php?st=<?php echo $donnees['studentNumber'];?>"><button  type="edit" class="btn btn-dark"><i class="fa fa-edit"></i></button></a>
                                <a href="delete.php?st=<?php echo $donnees['studentNumber'];?>"><button  type="edit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                            </td>
                        </tr>
                        <?php $i++;   
                        } $q->closeCursor();?>
                    </table>
                </div>
            <?php    
            // $this->closeConnection();

        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function getScheduleId($row, $studentNumber){
        try{
            $q = $this->connection->prepare("SELECT $row FROM schedule_appointment WHERE studentNumber = $studentNumber ORDER BY $row DESC LIMIT 1");
            $q->execute();

            while($donnees = $q->fetch()){
                $rst = $donnees["$row"];
                $this->result = $donnees["$row"];
                echo $rst;
            }
            //// $this->closeConnection();
        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
        //var_dump($q);
        return $this->result;
    }
    public function getSchedulePatient($studentNumber){
        try{
            $q = $this->connection->prepare("SELECT * FROM schedule_appointment WHERE studentNumber = $studentNumber ORDER BY appointmentDate DESC");
            $q->execute();

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Doctor Name</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i;?> </td>
                            <td> <?php echo $donnees['doctorName'];?> </td>
                            <td> <?php echo $donnees['appointmentDate'];?> </td>
                            <td> <?php echo $donnees['timeSchedule'];?> </td>
                        </tr>
                        <?php $i++;   
                        } $q->closeCursor();?>
                    </table>
                </div>
            <?php    
            // $this->closeConnection();

        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function checkDate($studentNumber){
        $this->checkDate = FALSE;
        $dateRDV = '2000-01-01 00:00:00';
        try{
            $q = $this->connection->prepare("SELECT appointmentDate FROM schedule_appointment WHERE studentNumber = $studentNumber ORDER BY appointmentDate DESC LIMIT 1");
            $q->execute();

            while($donnees = $q->fetch()){
                $dateRDV = $donnees["appointmentDate"];
            }

            $dateToday = date('yy-m-d h:i:s');

            if($dateToday <= $dateRDV){
                $this->checkDate = FALSE;
            }
            else{
                $this->checkDate = TRUE;
            }
            
        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
        return $this->checkDate;
    }
    public function closeConnection(){
        if($this->status==true){
            $this->connection = null;
            $this->status = false ;
        }
    }

}

?>