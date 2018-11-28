<?php
require_once 'database.php';
require_once 'personclass.php';
class adminClass extends personClass{

    public function __construct()
    {
        $DB = new Database();
        $DB->Connect();
    }
    public function addDentist(dentistClass $dentist)
    {
        $Data['email']     = $dentist->email;
        $Data['fullname']  = $dentist->fullname;
        $Data['gender']    = $dentist->gender;
        $Data['telephone'] = $dentist->telephone;
        $Data['state']     = $dentist->state;
        $Data['type']      = $dentist->type;
        $Data['username']  = $dentist->username;
        $Data['password']  = $dentist->password;
        $Data['photo']     = $dentist->photo;
        $DB = new Database();
        $check = $DB->Add('users',$Data);
        if($check)
            return TRUE;  
    }


    public function deleteUser(personClass $person)
    {
     $DB = new Database();
     $where = array(id=>$person->id);
     $user  = $DB->Select('users','',$where);
     if($user[0]['photo'] != "images/users/profile.jpg")
     {
      unlink($user[0]['photo']);   
     }
     $check = $DB->Delete('users',$person->id);
     if($check)
         return true;
    }


    public function stateUser(personClass $person)
    {
        $DB = new Database();
        $check = $DB->Activation($person->id,$person->state,'users');
        if($check)
            return true;
    }



    public function updateClinic(clinicClass $clinic)
    {
        $Data['aboutUs']     = $clinic->aboutUs;
        $Data['telephone']   = $clinic->telephone;
        $Data['title']       = $clinic->title;
        $Data['email']       = $clinic->email;
        $Data['facebook']    = $clinic->facebook;
        $Data['instagram']   = $clinic->instagram;
        $Data['twitter']     = $clinic->title;
        $Data['copyright']   = $clinic->copyright;
        $Data['address']     = $clinic->address;
        $Data['logo']        = $clinic->logo;
        $DB = new Database();
        $check = $DB->Update('aboutsite',$Data,$clinic->clinicId);
        if($check)
            return true;
    }
    
}
