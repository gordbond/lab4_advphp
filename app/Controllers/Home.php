<?php

namespace App\Controllers;

// use CodeIgniter\HTTP\RequestInterface;
// use CodeIgniter\HTTP\ResponseInterface;
// use Psr\Log\LoggerInterface;
// helper("asset");

class Home extends BaseController
{
  var $TPL;

  public function index()
  {

	$this->TPL['loggedin'] = $this->Userauth->validSessionExists();
	$this->TPL['active'] = array(
		'home' => true,
		'members' => false,
		'editors' => false,
		'admin' => false,
		'login' => false
	);
    $this->Template->show('home', $this->TPL);
  }

}
