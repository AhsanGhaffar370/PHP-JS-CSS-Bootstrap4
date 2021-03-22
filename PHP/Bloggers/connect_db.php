<?php
class database{
  private $host = "localhost";
  private $db_name = "blogger";
  private $username = "root";
  private $password = "";
  private $conn;

  // connect database using MYSQLI
  function connect_mysqli(){

    //used to caught mysqli error in catch statement
    // mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL); 
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

    try{
      $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
      return $this->conn;
    }
    catch (mysqli_sql_exception $ex){
      echo "Connection Error -->> ",$ex->getMessage();
      echo "<br>Error Code -->> ",$ex->getCode();
      echo "<br>Error occur in File -->> ",$ex->getFile();
      echo "<br>Error occur on Line no -->> ",$ex->getLine();

      $this->conn->close(); // close connection in Mysqli
      // OR
      //die('Connection error:   ' . mysqli_connect_error());
    }
 
    // if ($this->conn->connect_errno )
    //   die("Connection Error:<br>" . $this->conn->connect_error);
    
  }


  // connect database using PDO
  function connect_pdo(){
    
    try{
      $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);

      return $this->conn;
    }
    catch(PDOException $ex){
      echo "Connection Error -->> ",$ex->getMessage();
      echo "<br>Error Code -->> ",$ex->getCode();
      echo "<br>Error occur in File -->> ",$ex->getFile();
      echo "<br>Error occur on Line no -->> ",$ex->getLine();

      $this->conn = null; // close connection in PDO
    }

  }
  

}//end of class



?>