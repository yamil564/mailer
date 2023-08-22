<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Error
 *
 * @author User
 */
class Errors extends Controllers{
    
    public function notFound() {
        $this->views->getView($this,"Error",'');
    }
    
}

$notFound = new Errors();
$notFound->notFound();