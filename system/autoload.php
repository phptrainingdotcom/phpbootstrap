<?php

// Load Helpers
require_once 'helpers/url_helper.php';


// Autoload Base Libraries
spl_autoload_register(function($className){
    if( file_exists(dirname(__FILE__) .  '/base/' . $className . '.php') ){
        require_once 'base/' . $className . '.php';
    }

});