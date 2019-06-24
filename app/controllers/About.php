<?php


class About extends Controller
{
    public function __construct(){
        $this->aboutModel = $this->loadModel('AboutModel');
    }

    public function index(){

        $data = $this->aboutModel->getDetails();
        $this->render('about', $data);
    }
}