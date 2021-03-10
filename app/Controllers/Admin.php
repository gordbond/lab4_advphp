<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Admin extends BaseController
{

    var $TPL;
    

    public function index()
    {

        $usersModel = new UsersModel();
        $this->TPL['loggedin'] = $this->Userauth->loggedin('admin');
        $this->TPL['active'] = array(
            'home' => false,
            'members' => false,
            'editors' => false,
            'admin' => true,
            'login' => false
        );
        $this->TPL['allUsers'] = $usersModel->findAll();
        $this->Template->show('admin', $this->TPL);
    }

    //-------------------------------
    //      DELETE A USER
    //-------------------------------
    public function DeleteUser($id)
    {

        //Model
        $usersModel = new UsersModel();

        $this->TPL['loggedin'] = $this->Userauth->loggedin('admin');

        $this->TPL['active'] = array(
            'home' => false,
            'members' => false,
            'editors' => false,
            'admin' => true,
            'login' => false
        );

        //All of the questions and associated data
        $TPL["allUsers"] = $usersModel->findAll();

        //delete question
        $deleted = $usersModel->delete($id);

        //display view
        if ($deleted) {
            $this->Template->show('admin', $this->TPL);
        } else {
            echo "Error deleting.";
        }
    }

}