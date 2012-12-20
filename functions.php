<?php
    // Used at the welcome page > welcome.php
    function sayHello(){
        global $user_profile;
        if (isset($user_profile['first_name'])){
             $name = $user_profile['first_name'];
         }
         elseif (isset($_SESSION['username'])){
             $name = $_SESSION['username'];
         }
         else{
             $name = 'Dear guest';
         }
         echo $name;
    }
    
    // Used at the Sign in page > index.php
    function logIn($submit){
     
        global $resultQuery;
        if (isset($_POST[$submit]))
         {
            $where = array (
                     'email' => mysql_real_escape_string($_POST['useremail']),
                     'pass' => mysql_real_escape_string(md5($_POST['userpass']))
                            );
            $connect = new DB();
            $connect->selectWhere('users', $where);
            // Check username and password match
            #exit('Stop: ' . mysql_num_rows($resultQuery));
            if (mysql_num_rows($resultQuery) == 1) {
                      // Set user email session variable
                      $_SESSION['useremail'] = $_POST['useremail'];
                      // Call user's name and set it to session
                      $usname = mysql_fetch_array($resultQuery);
                      $_SESSION['username'] = $usname['namefirst'];
                      header('Location: welcome.php');
            }
            else {
                      echo "<div class=\"error\">The username or password you entered is incorrect</div>";
            }
          }  
    }
    
    // Used at the welcome page > welcome.php
    function logout(){
        
                if (isset($_GET['logout']))
                {
                    unset($_SESSION['useremail']);
                    unset($_SESSION['username']);
                    session_destroy();
                    header('Location: index.php');
                }
    }           
    
    // Used at the Register page > register.php
    function createAccount(){
                  if (isset($_POST['crtAcc']))
          {
                    $email = strtolower(mysql_real_escape_string($_POST['useremail']));
                    $pass = mysql_real_escape_string(md5($_POST['userpass'])); 
                    $nameF = mysql_real_escape_string($_POST['userFirstName']);
                    $nameL = mysql_real_escape_string($_POST['userLastName']);
                    
           if ( $email !="" && $pass != "" && $nameF != "" && $nameL != "" )
           {
               
             // Check email is exsit or not
             $connect = new DB();
             $connect->select('users', 'email');

             $match = isMatch('email',$email);

             switch ($match)
             {
               case true :
                    die('<div class="error">email address is aleady exist please try with another email address</div>');
                    break;
               
               // Register new user at the database
               case null :
                   $values = array ('email' => $email
                                    , 'pass' => $pass
                                    , 'namefirst' => $nameF
                                    , 'namelast' => $nameL
                                   );
                   
                    $connect->insert('users', $values);
                    // Set username session variable
                    $_SESSION['username'] = $nameF;
                    // Set user email session variable
                    $_SESSION['useremail'] = $_POST['useremail'];
                    // Jump to secured page
                    header('Location: welcome.php');                   
                    break;
             }
           }
           echo '<div class="error">Please fill the records completely</div>';
          }

    }
    
    // Check is the field match with the selected column's row or not
    function isMatch($column, $field){
            global $resultQuery;
            $match = null;    
            while ($row = mysql_fetch_array($resultQuery))
            {           
                      if ($row[$column] == $field){ $match = true; }
            }
            return $match; 
           }
    // Page title
    function pageTitle(&$subtitle){
            echo $subtitle = 'My Site &raquo ' . $subtitle; 
    }
    
    // Get registering form values
    function getValue($value){
        global $user_profile;
        (isset($user_profile[$value]))? $value = $user_profile[$value] : $value = '';
        echo $value;
    }
?>