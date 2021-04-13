<?php
Class DBConnection{
    private $host="localhost";
    private $dbname = "shis";
    private $user = "root";
    private $password="";
    public $status=false;
    public $connection;

    public function __construct(){
        try{ //connection DB
            if($this->status==false){
                $this->connection = new PDO('mysql:dbname='.$this->dbname.';host='.$this->host.'',''.$this->user.'',''.$this->password.'');
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->status = true;
                return $this->connection;
            }
            
        }
        catch(Exception $e){
            die("Error Database connexion :".$e->getMessage());
        }
    }

    public function closeDBConnection(){
        if($this->status==true){
            $this->connection = null;
            $this->status = false ;
        }
    }
}
?>