<?php
Class template {
    private $registry;
    private $vars = [];
    private $title = APP_TITLE;

    function __construct($registry){
        $this->registry = $registry;

    }

    public function __set($index, $value){
        $this->vars[$index] = $value;
    }

    public function show($name, $error = null){
    	//SET SETTINGS
    	$SETTINGS = $this->registry->db->getAllSettings();
    	$_SETTINGS = [];
    	foreach($SETTINGS as $setting){
    		$_SETTINGS[$setting['attribute']] = $setting['value'];
    	}
    	unset($SETTINGS);

        $controller = debug_backtrace()[0]['object']->registry->vars['router']->controller;
        $action = debug_backtrace()[1]['function'];

        $header = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'header.php';
        $footer = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'footer.php';

        if($error == null){
            $pathView = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$name.'.php';
            $pathJS = __SITE_PATH.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$action.'.js';
            $pathCSS = __SITE_PATH.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.$controller.DIRECTORY_SEPARATOR.$action.'.css';
        }else{
            $pathView = __SITE_PATH.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.php';
            $pathJS = __SITE_PATH.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.js';
            $pathCSS = __SITE_PATH.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'error'.DIRECTORY_SEPARATOR.$name.'.css';
        }

        if(file_exists($pathView) == false){
            throw new Exception('View not found in '. $pathView);
            return false;
        }
        if(file_exists($pathCSS) == false){
            throw new Exception('CSS not found in '. $pathCSS);
            return false;
        }
        if(file_exists($pathJS) == false){
            throw new Exception('JS not found in '. $pathJS);
            return false;
        }

        // Load variables
        foreach($this->vars as $key => $value){
            $$key = $value;
        }

        $this->title .= ' - '.$controller.' > '.$action;

        include($header);

        echo '<style>';
        include($pathCSS);
        echo '</style>';

        include($pathView);

        echo '<script>';
        include($pathJS);
        if(isset($error) && $name != '404' && $name != '403'){
            echo $this->displayError($error);
        }
        if(isset($message)){
            echo $this->displayMessage($message);
        }
        if(isset($warning)){
            echo $this->displayWarning($warning);
        }
        echo '</script>';


        include($footer);
    }

    public function getTitle(){
        return $this->title;   
    }

    private function displayError($e){
        return "
            $(document).ready(function(){
                Materialize.toast('".addslashes($e)."', 4000, 'red')
            });
        ";
    }

    private function displayMessage($m){
        return "
            $(document).ready(function(){
                Materialize.toast('".addslashes($m)."', 4000)
            });
        ";
    }

    private function displayWarning($m){
        return "
            $(document).ready(function(){
                Materialize.toast('".addslashes($m)."', 4000, 'yellow')
            });
        ";
    }
}