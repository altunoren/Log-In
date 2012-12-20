<?php

// Database class

class DB {
  
  private $host;
  private $user;
  private $pass;
  private $db;
  private $table = null;
  private $c = null;
  private $query = null;

    // sets up the connection to the mysql server and selects the database
  public function __construct($db = 'mysite', $host = 'localhost', $user = 'root', $pass = ''){
        
      $this->host = $host;
      $this->user = $user;
      $this->pass = $pass;
      $this->db = $db;
      
      $this->get_connection();
      
  }
  private function get_connection(){
      try
      {
          if(empty($this->c))
          {     
              // Connect to the server
              $this->c = mysql_connect($this->host, $this->user, $this->pass);
              if(empty($this->c))
              {
                throw new Exception('Sorry, we couldn&prime;t connect to Server, Please try again later',404);
              }
              // Select the database
              if(!mysql_select_db($this->db, $this->c))
              {
                  throw new Exception('Sorry, we couldn&prime;t access to the database, Please try again later',404);
              }
          }
          else
          {
            throw new Exception('DB connection error',404);
          }
      }
      catch (Exception $e)
      {
        switch ($e->getCode())
        {
            case 404:
                echo $e->getMessage();
                exit();
                // ...
            break;
            default :
                exit($e->getMessage());
        }
      }
  }
  
  // closes the connection
  public function __destruct(){
   
         return @$this->_close();

  }

  // SELECT one or all specific column(s)
  public function select($tabel, $column = array("*")){
      
      $this->get_columns($column);
      $this->query = "SELECT " . $column . " FROM " . $this->table = $tabel;
      $this->query();

  }
  
  // SELECT one or all specific column(s) WHERE is or are something exist
  public function selectWhere($tabel, $where,  $column = array("*")){
      $this->get_columns($column);
      $this->get_where($where);
      $this->query = "SELECT " . $column . " FROM " . $this->table = $tabel . " WHERE (" . $where . ")";
      $this->query();
  }
  
  // INSERT
  public function insert($table, $values){
      $this->get_values($values);
      $this->query = "INSERT INTO " . $this->table = $table . "(" . $values . ")";
      $this->query();
  }

  // Make string variable of value(s)
  private function get_values(&$values){
      
        if (is_array($values))
        {
            $c = null;
            $v = null;
            foreach ($values as $key => $value)
            {
                $c .= $key . ', ';
                $v .= "'" . $value . "', ";

            }            
            return $values = substr($c,0,-2) . ") VALUE (" . substr($v,0,-2);
        }
  }

  // Make string variable of WHERE parameter(s)
  private function get_where(&$where){
      
        if (is_array($where))
        {
            $str = null;
            foreach ($where as $key => $value)
            {
                $str .= $key . " = '" . $value . "' and ";
            }            
            return $where = substr($str,0,-5);
        }
  }


  // Make string variable of column(s) name
  private function get_columns(&$column){
      
      if (is_array($column))
         {
             $str = null;
             foreach ($column as $value)
             {
                  $str .= $value . ', ';
             }

             return $column = substr($str,0,-2);
         }
  }
  
  // MySQL Query
  private function query(){

      global $resultQuery;
      $resultQuery = mysql_query($this->query,  $this->c) or $this->error();
      
  }
  
  // MySQL Error
  private function error(){
      
      exit('Database Error: ' .  mysql_error());

  }
  
}

?>