<?php

  class connexionDB {

    private $host    = 'localhost';
    private $name    = '';
    private $user    = '';
    private $pass    = '';
    private $connexion;

    

    function __construct($host = null, $name = null, $user = null, $pass = null){

      if($host != null){
        $this->host = $host;           
        $this->name = $name;           
        $this->user = $user;          
        $this->pass = $pass;
      }

      try{
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
        $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8MB4', 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

      }//Fin try
      catch (PDOException $e){
        echo 'Erreur : Impossible de se connecter  à la BDD !';
        die();
      }//Fin catch
    }//fin __construct

    public function DB() {
        return $this->connexion;
    }
}


$DBB = new connexionDB();
$DB = $DBB->DB();
?>