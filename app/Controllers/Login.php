<?php

namespace App\Controllers;

helper('form');
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends BaseController
{

    var $TPL;
    var $request;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
 		parent::initController($request, $response, $logger);

        $this->TPL['loggedin'] = false;
        $this->TPL['active'] = array(
            'home' => false,
            'members' => false,
            'editors' => false,
            'admin' => false,
            'login' => true
        );
        
    }

    public function index()
    {
        $this->Template->show('login', $this->TPL);
    }

    public function loginuser()
    {
        $this->TPL['msg'] =
            $this->Userauth->login(
                $_POST["username"],
                $_POST["password"],
            );
            

        $this->Template->show('login', $this->TPL);
    }

    public function logout()
    {
        $this->Userauth->logout();
        //$this->Template->show('login', $this->TPL);
    }
}
