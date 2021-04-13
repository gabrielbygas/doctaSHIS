<?php
require_once 'DBConnection.class.php';
class Medical extends DBConnection{
    public $appointmentDate;
    public $temperature;
    public $bloodPressure;
    public $comments;
    public $downloadFile;
    public $checking;
    public $add;
    public $update;

    public function appointmentDate(){
        return $this->appointmentDate;
    }
    public function temperature(){
        return $this->temperature;
    }
    public function bloodPressure(){
        return $this->bloodPressure;
    }
    public function comments(){
        return $this->comments;
    }
    public function downloadFile(){
        return $this->downloadFile;
    }
    public function setAppointmentDate($d){
        $this->appointmentDate = $d;
    }
    public function setTemperature($d){
        $this->temperature = $d;
    }
    public function setBloodPressure($d){
        $this->bloodPressure = $d;
    }
    public function setComments($d){
        $this->comments = $d;
    }
    public function setDownloadFile($d){
        $this->downloadFile = $d;
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

    public function addMedical(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);
        
        $this->check($donnees);
                
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                if(isset($_POST['medical'])){
                    
                    $q = $this->connection->prepare('INSERT INTO medical_report (appointmentDate, comments, temperature, bloodPressure, downloadFile, studentNumber) 
                    VALUES (:appointmentDate, :comments, :temperature, :bloodPressure, :downloadFile, :studentNumber)');
                    $q->execute(array(
                        ':appointmentDate' => htmlspecialchars($_POST['appointmentDate']),
                        ':comments' => htmlspecialchars($_POST['comments']),
                        ':temperature' => htmlspecialchars($_POST['temperature']),
                        ':bloodPressure' => htmlspecialchars($_POST['bloodPressure']),
                        ':downloadFile' => htmlspecialchars($_POST['downloadFile']),
                        ':studentNumber' => htmlspecialchars($_POST['studentNumber'])
                    ));
                    $this->add = TRUE;
                }
            }
            catch(Exception $e){
                die("Doctor Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
            
        }
    }

    public function getPatient($d){
        try{
            $q = $this->connection->prepare('SELECT patientName,appointmentDate,gender,studentNumber,nameD FROM schedule_appointment as S, doctor as D 
            WHERE S.doctorName = D.nameD AND D.nameD = :doctor1 
            ORDER BY S.appointmentDate ASC');
            $q->execute(array(
                ':doctor1' => $d
            ));

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Patient Name</th>
                            <th>Appointment Date</th>
                            <th>Gender</th>
                            <th>Student Number</th>
                            <th>Doctor Name</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i;?> </td>
                            <td> <a href="uploadboth.php?st=<?php echo $donnees['studentNumber'];?>">
                                    <?php echo $donnees['patientName'];?>
                                </a>
                            </td>
                            <td> <?php echo $donnees['appointmentDate'];?> </td>
                            <td> <?php echo $donnees['gender'];?> </td>
                            <td> <?php echo $donnees['studentNumber'];?> </td>
                            <td> <?php echo $donnees['nameD'];?> </td>
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
    public function getMedicalId($d){
        try{
            $q = $this->connection->prepare("SELECT appointmentDate, temperature, bloodPressure, comments, downloadFile, studentNumber FROM medical_report WHERE studentNumber = $d ORDER BY appointmentDate DESC");
            $q->execute();

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Appointment Date</th>
                            <th>Temperature</th>
                            <th>Blood Pressure</th>
                            <th>comments</th>
                            <th>Download File</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i;?> </td>
                            <td> <?php echo $donnees['appointmentDate'];?></td>
                            <td> <?php echo $donnees['temperature'];?> </td>
                            <td> <?php echo $donnees['bloodPressure'];?> </td>
                            <td> <?php echo $donnees['comments'];?> </td>
                            <td><a href = "" download><?php echo $donnees['downloadFile'];?></a> </td>
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

}