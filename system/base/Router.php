<?php
/*
 * This is the Router and all routing happens from this class.
 * Routing URL Format - /controller/method/params
*/
class Router{

    protected $params = [];
    protected $controller = 'Home';
    protected $method = 'index';
    protected $url = [];


    public function __construct(){

        //Extract URL, Checks Controller File Exists, Method Exits
        if ( !$this->validURL() ){

            // Require the controller
            require_once '../app/controllers/Home.php';

            $this->controller = 'Home';
            //Instantiate the Controller Object
            $this->controller = new $this->controller;
            $this->method = 'index';

        }

        //Call the Controller/Method/Params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * @return bool
     */
    public function validURL() : bool{
        $validation = false;

        if(isset($_GET['url'])){

            //Controller/Method/Params
            //Split the URL into Array
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $count = count($url);

            //Array has 3 or more params
            if($count >= 1){

                //Capture the Params
                $this->url[0] = $url[0]; unset($url[0]);
                if( isset($url[1]) ) {
                    $this->url[1] = $url[1]; unset($url[1]);
                }else{
                    $this->url[1] = "index";
                }


                $this->url[2] =  $url ? array_values($url) : [];

                //Copy into the Class Properties
                $this->controller = ucwords($this->url[0]);
                $this->method = strtolower($this->url[1]);
                $this->params = $this->url[2];


                //If Controller file does not exists
                if(!file_exists('../app/controllers/' . $this->controller. '.php')){
                    return $validation;
                }

                // Require the controller
                require_once '../app/controllers/'. $this->controller . '.php';

                //Instantiate the Controller Object
                $this->controller = new $this->controller;

                //Check the Method exists in the Controller
                //If method does not exists then goto default index methods.
                if( !method_exists($this->controller , $this->method) ){
                    $this->method = 'index';
                }

                //All checks done and Validation is Success!
                $validation = true;
            }
        }
        return $validation;
    }
}
