<?php 
/**
 *
 *  This template library can be used to automatically build
 *    views with a header, navigation and footer
 *
 *
 *    Usage: $this->template->show('view', $args);
 *    Note: make sure to include in autoload.php
 *
 *
 */

namespace App\Libraries;

class Template
{
    function show($view, $args)
    {
       
        echo view('header', $args);
        echo view('navigation', $args);
        echo view($view, $args);
        echo view('footer', $args);
    }
}
