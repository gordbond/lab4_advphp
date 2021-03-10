<?php

namespace App\Controllers;

class Members extends BaseController
{

    var $TPL;

    

    public function index()
    {
        $this->TPL['loggedin'] = $this->Userauth->loggedin('members');
        $this->TPL['active'] = array(
            'home' => false,
            'members' => true,
            'editors' => false,
            'admin' => false,
            'login' => false
        );
        $this->Template->show('members', $this->TPL);
    }
}
