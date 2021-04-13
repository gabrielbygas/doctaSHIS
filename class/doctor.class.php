<?php
require_once 'DBConnection.class.php';
require_once 'login.class.php';
class Doctor extends DBConnection{
    private $nameD;
    private $imageD;
    private $email;
    private $dateOfBirth;
    private $phoneNumber;
    private $country;
    private $sex;
    public $checking;
    public $add;
    public $update;

    public function nameD(){
         return $this->name;
    }
    public function setNameD($d){
        $this->name = $d;
    }
    public function imageD(){
        return $this->image;
    }
    public function setImageD($d){
        $this->image =$d;
    }
    public function email(){
        return $this->email;
    }

    public function setEmail($d){
        $this->email =$d;
    }
    public function dateOfBirth(){
        return $this->dateOfBirth;
    }

    public function setDateOfBirth($d){
        $this->dateOfBirth =$d;
    }
    public function phoneNumber(){
        return $this->phoneNumber;
    }

    public function setPhoneNumber($d){
        $this->phoneNumber = $d;
    }
    public function country(){
        return $this->country;
    }

    public function setCountry($d){
         $this->country =$d;
    }
    public function sex(){
        return $this->sex;
    }

    public function setSex($d){
        $this->sex = $d;
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

    public function addDoctor(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);
        
        $this->check($donnees);
         
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                if(isset($_POST['nameD'])){
                    $q = $this->connection->prepare('INSERT INTO doctor(imageD, nameD, dateOfBirth, email, phoneNumber, country, sex, code) 
                    VALUES(:imageD, :nameD, :dateOfBirth, :email, :phoneNumber, :country, :sex, :code)');
                    $q->execute(array(
                        ':imageD' => htmlspecialchars($_POST['imageD']),
                        ':nameD' => htmlspecialchars($_POST['nameD']),
                        ':dateOfBirth' => htmlspecialchars($_POST['dateOfBirth']),
                        ':email' => htmlspecialchars($_POST['email']),
                        ':phoneNumber' => htmlspecialchars($_POST['phoneNumber']),
                        ':country' => htmlspecialchars($_POST['country']),
                        ':sex' => htmlspecialchars($_POST['sex']),
                        ':code' => htmlspecialchars($_POST['studentId'])
                    ));
                    $this->add = TRUE;
                }
                // ici ajouter directement le nouveau medecin creer dans la table Login
                $login = new Login();
                $login->addLogin($_POST);
            }
            catch(Exception $e){
                die("Doctor Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
            
        }
    }
    public function deleteDoctor($id){
        try{
            //$q = $this->connection->prepare("DELETE FROM Doctor_appointment WHERE DoctorId = :id");
            $q = $this->connection->prepare('DELETE FROM doctor WHERE id = :id');
            $q->execute(array(
                ':id' => $id
            ));
            // $this->closeConnection();
        }catch(Exception $e){
            die("Doctor Delete Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }    
    }
    public function update(array $donnees, $phoneNumber){
        $this->update = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
        if($this->checking == TRUE) {
            try{
                //formater la date
                //$d = $_POST['image'].' 00:00:00'; imageD=:imageD,
                //':imageD' => htmlspecialchars($_POST['imageD']),

                $q = $this->connection->prepare("UPDATE doctor SET nameD=:nameD, dateOfBirth=:dateOfBirth, email=:email, phoneNumber=:phoneNumber, country=:country, sex=:sex WHERE id=:phoneNumber1");//phoneNumber=:phoneNumber1
                $q->execute(array(
                    ':nameD' => htmlspecialchars($_POST['nameD']),
                    ':dateOfBirth' => htmlspecialchars($_POST['dateOfBirth']),
                    'email' => htmlspecialchars($_POST['email']),
                    ':phoneNumber' => htmlspecialchars($_POST['phoneNumber']),
                    ':country' => htmlspecialchars($_POST['country']),
                    ':sex' => htmlspecialchars($_POST['sex']),
                    ':phoneNumber1' => $phoneNumber,
                ));
                // $this->closeConnection();
                $this->update = TRUE;
            }
            catch(Exception $e){
                die("Doctor Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->update;
    }
    public function getDoctor(){
        try{
            $q = $this->connection->prepare("SELECT * FROM doctor ORDER BY nameD");
            $q->execute();

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Doctor Name</th>
                            <th>Code </th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Country</th>
                            <th>sex</th>
                            <th>ACTION</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i; $docid=$donnees['id']; ?> </td>
                            <td> <?php echo $donnees['nameD'];?> </td>
                            <td> <?php echo $donnees['code'];?> </td>
                            <td> <?php echo $donnees['dateOfBirth'];?> </td>
                            <td> <?php echo $donnees['email'];?> </td>
                            <td> <?php echo $donnees['phoneNumber'];?> </td>
                            <td> <?php echo $donnees['country'];?> </td>
                            <td> <?php echo $donnees['sex'];?> </td>
                            <td><a href="doctorform_update.php?ph=<?php echo $docid;//$donnees['phoneNumber'];?>"><button  type="edit" class="btn btn-dark"><i class="fa fa-edit"></i></button></a>
                            <a href="doctorform_delete.php?ph=<?php echo $docid;//$donnees['phoneNumber'];?>"><button  type="edit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                            </td>
                        </tr>
                        <?php $i++;   
                        } $q->closeCursor();?>
                    </table>
                </div>
            <?php    
            // $this->closeConnection();

        }catch(Exception $e){
            die("Doctor Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function getDoctorId($row, $phoneNumber){
        try{
            $result="";
            $q = $this->connection->prepare("SELECT $row FROM doctor WHERE id = $phoneNumber OR code = $phoneNumber");//phoneNumber = $phoneNumber
            $q->execute();

            while($donnees = $q->fetch()){
                $result = $donnees["$row"];
                echo $result;
            }
            //// $this->closeConnection();
        }catch(Exception $e){
            die("Doctor Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
        return $result;
        var_dump($result);
    }
    public function getDoctorName(){
        try{
            $q = $this->connection->prepare("SELECT nameD FROM doctor ");//phoneNumber = $phoneNumber
            $q->execute();
    ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Select Doctor </label>
                <select class="form-control" id="Select1" name="doctorName" required>
                    <option>Select doctor's name</option>
    <?php
            while($donnees = $q->fetch()){
    ?>
                    <option value="<?php echo $donnees["nameD"]; ?>"><?php echo $donnees["nameD"]; ?></option>
    <?php   } ?>
                </select>
            </div>
    <?php 
            
            //// $this->closeConnection();
        }catch(Exception $e){
            die("Get Doctor Name Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function closeConnection(){
        if($this->status==true){
            $this->connection = null;
            $this->status = false ;
        }
    }

}

?>