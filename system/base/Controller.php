<?php


class Controller
{

    // Load model
    public function loadModel($model){
        // Require model file
        require_once '../app/models/' . $model . '.php';

        // Instatiate model
        return new $model();
    }

    // Load view
    public function render($view, $data = []){
        // Check for view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            // View does not exist
            die('View does not exist');
        }
    }
}