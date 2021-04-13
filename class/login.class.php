<?php
require_once 'DBConnection.class.php';
class Login extends DBConnection{
    private $username;
    private $studentNumber;
    private $pswd;
    private $repswd;
    public $getLogin;
    public $checking;
    public $add;

    public function username(){
        return $this->username;
    }
    public function studentNumber(){
        return $this->studentNumber;
    }
    public function pswd(){
        return $this->pswd;
    }
    public function repswd(){
        return $this->repswd;
    }
    public function setUsername($d){
        $this->username = $d;
    }
    public function setStudentNumber($m){
        $this->studentNumber = $m;
    }
    public function setPswd($p){
        $this->pswd = $p;
    }
    public function setRepswd($p){
        $this->repswd = $p;
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
    public function getLoginId($row, $studentNumber){
        try{
            $q = $this->connection->prepare("SELECT $row FROM loginp WHERE studentId = $studentNumber");
            $q->execute();

            while($donnees = $q->fetch()){
                $result = $donnees["$row"];
                $this->getLogin = $donnees["$row"];
                echo $result;
            }
            //// $this->closeConnection();
        }catch(Exception $e){
            die("loginp getLogin Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
        //var_dump($q);
        return $this->getLogin;
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

     public function addLogin(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
                
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            if( htmlspecialchars($_POST['pswd'])==htmlspecialchars($_POST['repswd']) ){
                try{
                    if(isset($_POST['login'])){
                        
                        $q = $this->connection->prepare('INSERT INTO loginP(username, pswd, repswd, studentId) 
                        VALUES(:username, :pswd, :repswd, :studentId)');
                        $q->execute(array(
                            ':username' => htmlspecialchars($_POST['username']),
                            ':pswd' => htmlspecialchars($_POST['pswd']),
                            ':repswd' => htmlspecialchars($_POST['repswd']),
                            ':studentId' => htmlspecialchars($_POST['studentId'])
                        ));
                        $this->add = TRUE;
                    }
                }
                catch(Exception $e){
                    die("Login Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
                }
            }
            else{
                $this->add = FALSE;
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Your Password and repassword must be same</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php    
            }
            
        }
        
    }
}
?>