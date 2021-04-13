<?php
require_once 'DBConnection.class.php';
class Announcement extends DBConnection{
    private $dateAnnouncement;
    private $messageA;
    public $checking;
    public $add;
    public $update;

    public function dateAnnouncement(){
        return $this->dateAnnouncement;
    }
    public function messageA(){
        return $this->messageA;
    }
    public function setDateAnnouncement($d){
        $this->dateAnnouncement = $d;
    }
    public function setMessageA($m){
        $this->messageA = $m;
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
    
    public function addAnnouncement(array $donnees){
        $this->add = FALSE;
        //hydrate notre objet
        $this->hydrate($donnees);

        $this->check($donnees);
                    
        //if check($_POST) executed, and all field are no empty
        if($this->checking == TRUE) {
            try{
                if(isset($_POST['messageA'])){
                    
                    $q = $this->connection->prepare('INSERT INTO announcement(dateAnnouncement, messageA) VALUES(:dateAnnouncement, :messageA)');
                    $q->execute(array(
                        ':dateAnnouncement' => htmlspecialchars($_POST['dateAnnouncement']),
                        ':messageA' => htmlspecialchars($_POST['messageA'])
                    ));
                    $this->add = TRUE;
                }
            }
            catch(Exception $e){
                die("announcement Insertion Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->add;
    }
    public function getAnnouncement(){
        try{
            $q = $this->connection->prepare("SELECT * FROM announcement ORDER BY dateAnnouncement DESC");
            $q->execute();

            
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <tr class="success">
                            <th> N* </th>
                            <th>Date </th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                        <?php $i=1;
                        while($donnees=$q->fetch()){ ?>
                        <tr>
                            <td> <?php echo $i; $docid=$donnees['id']; ?> </td>
                            <td> <?php echo $donnees['dateAnnouncement'];?> </td>
                            <td> <?php echo $donnees['messageA'];?> </td>
                            <td><a href="announcement_edit.php?ph=<?php echo $docid;//$donnees['phoneNumber'];?>"><button  type="edit" class="btn btn-dark"><i class="fa fa-edit"></i></button></a>
                            <a href="announcement_delete.php?ph=<?php echo $docid;//$donnees['phoneNumber'];?>"><button  type="edit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                            </td>
                        </tr>
                        <?php $i++;   
                        } $q->closeCursor();?>
                    </table>
                </div>
            <?php    
            // $this->closeConnection();

        }catch(Exception $e){
            die("announcement Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function getAnnouncementId($row, $id){
        try{
            $q = $this->connection->prepare("SELECT $row FROM announcement WHERE id=$id ORDER BY $row DESC LIMIT 1");
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
    public function getAnnouncementCollipse(){
        try{
            $q = $this->connection->prepare("SELECT * FROM announcement ORDER BY dateAnnouncement DESC");
            $q->execute();
            while($donnees=$q->fetch()){
    ?>
                <div class="table-responsive">
                  <button type="button" class="collapsible">The announcement of <?php echo $donnees['dateAnnouncement'];?></button>
                  <div class="content">
                    <p> <?php echo $donnees['messageA'];?> </p>
                  </div>
                </div>&nbsp;
            <?php }?>
            <script>
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
            }
            </script>
    <?php
        }catch(Exception $e){
            die("announcement Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
        }
    }
    public function deleteAnnouncement($id){
        try{
            //$q = $this->connection->prepare("DELETE FROM announcement_appointment WHERE announcementId = :id");
            $q = $this->connection->prepare('DELETE FROM announcement WHERE id = :id');
            $q->execute(array(
                ':id' => $id
            ));
            // $this->closeConnection();
        }catch(Exception $e){
            die("Announcement Delete Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
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

                $q = $this->connection->prepare("UPDATE announcement SET dateAnnouncement=:dateAnnouncement, messageA=:messageA WHERE id=:phoneNumber1");//phoneNumber=:phoneNumber1
                $q->execute(array(
                    ':dateAnnouncement' => htmlspecialchars($_POST['dateAnnouncement']),
                    ':messageA' => htmlspecialchars($_POST['messageA']),
                    ':phoneNumber1' => $phoneNumber,
                ));
                // $this->closeConnection();
                $this->update = TRUE;
            }
            catch(Exception $e){
                die("announcement Update Failed :". $e->getMessage()."//<br/>". $e->getCode()."//<br/>". $e->getLine());
            }
        }
        return $this->update;
    }
}
?>