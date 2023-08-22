<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba
 *
 * @author User
 */
class Home extends Controllers
{
    public function index()
    {
        if (empty($_SESSION['client'])) {
            $this->views->getView($this, 'login', '');
        } else {
            $resultSections = $this->model->listSections();
            $this->views->getView($this, 'home', $resultSections);
        }
    }

    public function signIn()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                header(HOME);
                exit();
            } else {
                $username = strClean($_POST['txtUsername']);
                $password = encrypted($_POST['txtAccountPassword']);
                $resultValidate = $this->model->validateClient($username, $password);
                if ($resultValidate) {
                    $_SESSION['client'] = $resultValidate;
                    $data = ['message' => 'Signed in successfully', 'route' => base_url() ];
                    echo json_encode($data);
                } else {
                    $data = ['message' => 'Failed access: user or password incorrect'];
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function signOut()
    {
        $_SESSION['client'] = array();
        $this->views->getView($this, 'login', '');
    }
}
