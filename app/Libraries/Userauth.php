<?php

//TO-DO:
// - Password check
// - CRUD OPERATIONS

namespace App\Libraries;

use App\Models\UsersModel;

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $username;
    private $password;
    private $usersModel;
    private $accessLevel;
    private $user;

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "/Login";
      $this->logout_page = base_url() . "/Home";
      $this->usersModel = new UsersModel();
    // Get shared instance with config function

      //Access Control List
      $this->acl = config('AclConfig')->acl['members']['member'];
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($username,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage']);
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($username, $password) == false)
      {
         return "Username/password fields cannot be blank!";
      }
        
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase() == false)
      {
        return 'Invalid username/password!';
      }
      else if ($this->validPassword() == false)
      {
        return 'Invalid user/password!';
      } 
      else if ($this->accountFrozen()) 
      {
        return 'Account Frozen';
      }
      else
      { 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
        $this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin($page) 
    {

      session_start();     
   
      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }

      $acl = config('AclConfig')->acl;

      if(!$acl[strval($page)][strval($_SESSION['accesslevel'])]){
        $this->redirect($_SESSION['basepage']);
      }
  
      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
      $this->redirect($this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['username']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($username, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($username) == false) && (empty($password) == false) )
      {
        $this->username = $username;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify username and password with MySQL database.
    */
    public function userIsInDatabase() 
    {

      //Look for a user with the username entered by user
      $user = $this->usersModel->where('username', $this->username)->first();

      if($user){
        $this->accessLevel = $user['accesslevel'];
        return true;
      }else{
        return false;
      }
    }

    public function validPassword(){
      $passwordFromDB = $this->usersModel->where('username', $this->username)->first()['password'];
      if($this->password == $passwordFromDB)
      {
        return true;
      }
      else{
        return false;
      }
    }

    public function accountFrozen(){
    $isFrozen = $this->usersModel->where('username', $this->username)->first()['frozen'];
    if ($isFrozen == 'Y' ) {
      return true;
    } else {
      return false;
    }
    }
    
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write username and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accesslevel'] = $this->accessLevel;
        $_SESSION['basepage'] = $this->getBasePage();
        
    }


	
    /**
    * @return string
    * @desc Username getter, not necessary 
    */
    public function getUsername() 
    {
        return $_SESSION['username'];
    }
     
    /**
     * Gets the url for the page associated with the user's access level
     */
    public function getBasePage()
    {
      switch($this->accessLevel){
        case "member":
          return base_url() . "/Members";
          break;
        case "editor":
          base_url() . "/Editors";
          break;
        case "admin":
          return base_url() . "/Admin";
          break;
        default:
          return base_url() . "/Home";
          break;
      }
    }
}

