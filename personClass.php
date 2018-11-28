<?php
require_once 'database.php';

class personClass {
    public $id;
    public $fullname;
    public $telephone;
    public $email;
    public $gender;
    public $username;
    public $password;
    public $photo;
    public $state;
    public $type;
    
    public function __construct() {
        $DB = new Database();
        $DB->Connect();
    }


    public function login()
    {
        $DB = new Database();
        $check = $DB->Login($this->username,$this->password);
        if($check)
            return true;
    }



    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:index.php");
    }




    public function editProfile()
    {
        $Data['email']     = $this->email;
        $Data['fullname']  = $this->fullname;
        $Data['gender']    = $this->gender;
        $Data['telephone'] = $this->telephone;
        $Data['username']  = $this->username;
        $Data['password']  = $this->password;
        $Data['photo']     = $this->photo;
        $DB = new Database();
        $check = $DB->Update('users',$Data,$this->id);
        if($check)
            return TRUE;  
    }
    
}
