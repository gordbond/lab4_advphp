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
        

        //delete question
        $deleted = $usersModel->delete($id);

        $this->TPL["allUsers"] = $usersModel->findAll();
        //display view
        
        
        if ($deleted) {
            $this->Template->show('admin', $this->TPL);
        } else {
            echo "Error deleting.";
        }
    }

    //-------------------------------
    //      TOGGLE FROZEN ACCOUNT
    //-------------------------------
    public function toggleFrozen($id, $frozen){

        //Model
        $usersModel = new UsersModel();

        $frozenForDB = ($frozen == 'N') ? 'Y' : 'N';

        $dataForDb = [
            'frozen' => $frozenForDB
        ];

        $usersModel->update($id, $dataForDb);

        $this->TPL['loggedin'] = $this->Userauth->loggedin('admin');

        $this->TPL["allUsers"] = $usersModel->findAll();
        
        $this->TPL['active'] = array(
            'home' => false,
            'members' => false,
            'editors' => false,
            'admin' => true,
            'login' => false
        );

        $this->Template->show('admin', $this->TPL);

    }

    //-------------------------------
    //      CREATE A USER
    //-------------------------------
    public function createUser(){
        //Model
        $usersModel = new UsersModel();

        //validate library
        $validation =  \Config\Services::validation();

        //All of the questions and associated data
        $TPL["allUsers"] = $usersModel->findAll();


        $dataForDb = [

            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'accesslevel' => $_POST['accesslevel'],
            'frozen' => "N"
 
        ];

        

        if ($this->request->getMethod() === 'post') {
            $valid = $this->validate(
                [
                    'username' => 'required|is_unique[userslab4.username]',
                    'password' => 'required',
                    'accesslevel' => 'regex_match[/admin|editor|member/i]',
                ],
                [   //Custom Error Messages
                    'username' => [
                        'required' => 'The Password field is required.',
                        'is_unique' => 'A user with that username already exists!'
                    ],
                    'password' => [
                        'required' => 'The Password field is required.'
                    ],
                    'accesslevel' => [
                        'regex_match' => 'Access level must be either member, editor or admin.'
                    ]
                ]
            );

            //Retrieve errors for failed Tests
            $this->TPL["errors"] = $validation->getErrors();

            //If validation fails
            if ($valid) {
                //Update the model
                $usersModel->insert($dataForDb);
            }
            $this->TPL['active'] = array(
                'home' => false,
                'members' => false,
                'editors' => false,
                'admin' => true,
                'login' => false
            );
            $this->TPL['loggedin'] = $this->Userauth->loggedin('admin');
            $this->TPL["allUsers"] = $usersModel->findAll();
            $this->Template->show('admin', $this->TPL);

        }

    }

}