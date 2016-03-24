<?php
/*  Users class
* + = public function/property
* - = private function/property
* x = proteced function/proptery
*
* The Usera class registers users, logs uses in, and establishes sessions
* and Cookies to maintain the user's logged in status
*
* The class contains nine properties: 
* - username - username
* - password - users password
* - first - users first name
* - last - users last name
* - birthdate - users birthdate
* - mobile - users mobile number
* - keepli - Boolean value to mark that cookie should be set
* to keep use logged in between sessions
* - email - users email
* - salt - value used to salt users password
*
* The class contains five methods:
* + _construct($data) - passed a group of values that is put into an array
* The array values are then used to populate the properties
* + storeFormValues( $params ) - calls the construct method and passes $params
* to it
* + userLogin() - queries the database to seeif user exists, if they do, establishes session
* and passes the $success variable to indicate that the user was found or not
* + register() - queries if user exists already, if not it inserts the user into the database and
* establishes the session
* - sessionEstablish() - creates a session and places a cookie
*/

class Users 
{
    //private $username = null;
    private $password = null;
    //private $first = null;
    //private $last = null;
    //private $birthdate = null;
    //private $mobile = null;
    private $keepli = null;
    private $email = null;
    private $valid = null;
    private $con = NULL;
    //private $salt = "Zo4HYTZ1YyKJAASY0PT6EUg7BBYduiuPaNLuxAwUjhT51ElzHv0Ri7EM6ihgf5w";
    
    public function __construct( $data = array() ) {
	    try {
	      //create our pdo object
        $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
        //set how pdo will handle errors
        $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      } catch (PDOException $e) {
            echo "Error creating PDO connection, at line " . __LINE__. " in file " . __FILE__ . "</br>";
            echo $e->getMessage() . "</br>";
            exit;
        }

        //if( isset( $data['username'] ) ) $this->username = stripslashes( strip_tags( $data['username'] ) );
        if( isset( $data['password'] ) ) $this->password = stripslashes( strip_tags( $data['password'] ) );
        //if( isset( $data['first'] ) ) $this->first = stripslashes( strip_tags( $data['first'] ) );
        //if( isset( $data['last'] ) ) $this->last = stripslashes( strip_tags( $data['last'] ) );
        //if( isset( $data['birthdate'] ) ) $this->birthdate = stripslashes( strip_tags( $data['birthdate'] ) );
        //if( isset( $data['mobile'] ) ) $this->mobile = stripslashes( strip_tags( $data['mobile'] ) );
        if( isset( $data['email'] ) ) $this->email = stripslashes( strip_tags( $data['email'] ) );
	      if( isset( $data['keepli'] ) ) $this->keepli = stripslashes( strip_tags( $data['keepli'] ) );
    }
    
    public function userLogin() 
	  {
        //success variable will be used to return if the login was successful or not.
        $success = FALSE;
        try {
            //this would be our query.
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            //prepare the statements
            $stmt = $this->con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
            //give value to named parameter :password
            //echo password_hash($this->password, PASSWORD_DEFAULT);
            //$stmt->bindValue( "password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR );
            $stmt->execute();
            $this->valid = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($this->valid) {
              $passVerify = password_verify($this->password, $this->valid['password']);
              if($passVerify) {
	              //valid is true so email exists and password is correct so success is set to true
                $this->sessionEstablish();
                $success = TRUE;
              } 
            }
            return $success;
        } catch (PDOException $e) {
            echo "Error in the Users object userLogin method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
            echo $e->getMessage() . "</br>";
            exit;
        }
    }
    
    public function register() 
	  {
        $this->userLogin();
        if($this->valid) {
            //need to fix so that when user userLogin() checked session isn't set
            session_unset();
            //need to adjust tojust session_start();check username
            return 2;
            exit;
        }
        try {
            $sql = "INSERT INTO users(password, email) VALUES(:password, :email)";
            
            $stmt = $this->con->prepare( $sql );
            //$stmt->bindValue( "username", $this->username, PDO::PARAM_STR );
            $stmt->bindValue( "password", password_hash($this->password, PASSWORD_DEFAULT), PDO::PARAM_STR );
            //$stmt->bindValue( "first", $this->first, PDO::PARAM_STR );
            //$stmt->bindValue( "last", $this->last, PDO::PARAM_STR );
            //$stmt->bindValue( "birthdate", $this->birthdate, PDO::PARAM_STR );
            //$stmt->bindValue( "mobile", $this->mobile, PDO::PARAM_INT );
            $stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
            $stmt->execute();
            $this->sessionEstablish();
            return 1;
        } catch( PDOException $e ) {
	          echo "Error in the Users object register method, at line " . __LINE__. " in file " . __FILE__ . "</br>";
            echo $e->getMessage() . "</br>";
            exit;
        }
    }

    private function sessionEstablish() 
	  {
        if (session_status()==1) session_start();
        // Store Session Data
        $_SESSION['login_user'] = $this->email;
        if ($this->keepli) {
            //setcookie for keeping user logged in between sessions
            setcookie('login_user', $this->email, time() + 3600);
        }
    }

    public static function getUserEmail($username) 
	  {
        //success variable will be used to return if the login was successful or not.
        $success = false;
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            //prepare the statements
            $stmt = $con->prepare( $sql );
            //give value to named parameter :username
            $stmt->bindValue( "username", $username, PDO::PARAM_STR );
            $stmt->execute();
            $email = $stmt->fetchColumn(7);
            $con = null;
            return $email;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return $success;
        }
    }
    public function getUserId() {
	    $userId = NULL;
	    $this->userLogin();
	    $userId = $this->valid['userId'];
	    return $userId;
    }
}