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
class Admin extends Controllers
{
    public function login_admin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET') {
            header(LOGIN_ADMIN);
            exit();
        }
        session_destroy();
        $type = $this->model->type_user();
        $this->views->getView($this, "login", [$type,""]);
    }

    public function login_validate()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                header(LOGIN_ADMIN);
                exit();
            }
            if (count($_POST) != count(array_filter($_POST))) {
                $type = $this->model->type_user();
                $this->views->getView($this, "login", [$type,"The data is incorrect"]);
                exit();
            } else {
                $user = strClean($_POST['txtUser']);
                $password = strClean($_POST['txtPassword']);
                $type = strClean($_POST['cboType']);
                $response = $this->model->login_validate($user, encrypted($password), $type);
                if ($response) {
                    $_SESSION['user'] = $response;
                    $data = [BASE_URL.'Admin/home_admin','Signed in successfully'];
                    echo json_encode($data);
                } else {
                    $data = ["","Failed access: user or password incorrect"];
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            echo json_encode($ex->getMessage());
        }
    }

    public function home_admin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $this->views->getView($this, "home", "");
        }
    }
}