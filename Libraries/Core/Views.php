<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Views
 *
 * @author User
 */
class Views {
    //put your code here
    function getView($controller,$view,$data){
        $controller = get_class($controller);
        if($controller == "Home" ){
            $view = "Views/".$view.".php";
        }else{
            $view = "Views/".$controller."/".$view.".php";
        }
        require_once($view);
        return $data;
    }
}
