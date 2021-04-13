<?php
require_once 'DBConnection.class.php';
class Message extends DBConnection{
    private $dateMessage;
    private $question;
    public $answer;
    public $studentNumber;
    public $statusE;
    public $add;
    public $checking;
    public $update;

    public function dateMessage(){
        return $this->dateMessage;
    }
    public function question(){
        return $this->question;
    }
    public function answer(){
        return $this->answer;
    }
    public function statusE(){
        return $this->statusE;
    }
    public function studentNumber(){
        return $this->studentNumber;
    }
    public function setDateMessage($d){
        $this->dateMessage = $d;
    }
    public function setQuestion($m){
        $this->question = $m;
    }
    public function setAnswer($m){
        $this->answer = $m;
    }
    public function setStatusE($m){
        $this->statusE = $m;
    }
    public function setStudentNumber($m){
        $this->studentNumber = $m;
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
    
    public function addEnquiry(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
                    
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                if(isset($_POST['question'])){
                    $st = 0;
                    $q = $this->connection->prepare('INSERT INTO enquiry(dateMessage, question, statusE, studentNumber) VALUES(:dateMessage, :question, :statusE, :studentNumber)');
                    $q->execute(array(
                        ':dateMessage' => htmlspecialchars($_POST['dateMessage']),
                        ':question' => htmlspecialchars($_POST['question']),
                        ':statusE' => $st,
                        ':studentNumber' => htmlspecialchars($_POST['studentNumber'])
                    ));
                    $this->add = TRUE;
                }
            }
            catch(Exception $e){
                die("Enquiry Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->add;
    }
    public function getEnquiry(){
        try{
            $q = $this->connection->prepare("SELECT * FROM enquiry WHERE statusE=0 ORDER BY dateMessage DESC ");
            $q->execute();
        ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tr class="success">
                    <th> No </th>
                    <th>Date </th>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
                <?php $i=1;
                while($donnees=$q->fetch()){ ?>
                <tr>
                <form action="repplypage.php" method="POST">
                    <td> <input type="hidden" name="id" value="<?php echo $donnees['id'];?>"/> <?php echo $i; $docid=$donnees['id']; ?> </td>
                    <td>  <?php echo $donnees['dateMessage'];?> </td>
                    <td> <?php echo $donnees['question'];?> </td>
                    <td> <?php echo $donnees['answer'];?>  
                        <textarea name="answer" maxlength="1000" id="" rows="5" class="form-control m-input"></textarea><br/>
                        <input type="hidden" name="message" value="update"/>
                        <button type="submit" class="btn btn-primary">Answer</button> 
                    </td>
                </form>
                </tr>
        <?php
                  $i++;   
                } $q->closeCursor(); 
        ?>
            </table> 
          </div>
        <?php         
        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
   public function getEnquiryId($id){
        try{
            $q = $this->connection->prepare("SELECT * FROM enquiry WHERE studentNumber=$id ORDER BY dateMessage DESC");
            $q->execute();
        ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tr class="success">
                    <th> No </th>
                    <th>Date </th>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
                <?php $i=1;
                while($donnees=$q->fetch()){ ?>
                 <tr>
                    <td> <?php echo $i; $docid=$donnees['id']; ?> </td>
                    <td> <?php echo $donnees['dateMessage'];?> </td>
                    <td> <?php echo $donnees['question'];?> </td>
                    <td><?php echo $donnees['answer'];?></td>
                </tr>
        <?php
                  $i++;   
                } $q->closeCursor();
        ?>
            </table> 
          </div>
        <?php         
        }catch(Exception $e){
            die("Schedule Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
   
    public function deleteEnquiry($id){
        try{
            //$q = $this->connection->prepare("DELETE FROM Message_appointment WHERE MessageId = :id");
            $q = $this->connection->prepare('DELETE FROM enquiry WHERE id = :id');
            $q->execute(array(
                ':id' => $id
            ));
            // $this->closeConnection();
        }catch(Exception $e){
            die("Message Delete Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }    
    }
    public function updateEnquiry(array $donnees, $id){
        $this->update = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
        if($this->checking == TRUE) {
            $st = 1;
            try{

                $q = $this->connection->prepare("UPDATE enquiry SET answer=:answer, statusE=:statusE WHERE id=:id");//phoneNumber=:phoneNumber1
                $q->execute(array(
                  ':answer' => htmlspecialchars($_POST['answer']),
                  ':statusE' => $st,
                  ':id' => $id
                ));
                // $this->closeConnection();
                $this->update = TRUE;
            }
            catch(Exception $e){
                die("Enquiry Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->update;
    }
}
?>