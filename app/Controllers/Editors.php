<?php

namespace App\Controllers;

class Editors extends BaseController
{
    var $TPL;

    public function index()
    {
        $this->TPL['loggedin'] = $this->Userauth->loggedin('editors');
        $this->TPL['active'] = array(
            'home' => false,
            'members' => false,
            'editors' => true,
            'admin' => false,
            'login' => false
        );
        
        $this->Template->show('editors', $this->TPL);
    }
}
