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

class User extends Controllers
{
    public function add_new()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $type = $this->model->type_user();
            $this->views->getView($this, "add_new", [$type, ""]);
        }
    }

    public function see_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $response = $this->model->all_users();
                if ($response) {
                    $this->views->getView($this, "see_all", $response);
                } else {
                    $this->views->getView($this, "see_all", "No users available");
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_user()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $first_name = strClean($_POST['txtFirstname']);
                $last_name = strClean($_POST['txtLastname']);
                $email = strClean($_POST['txtEmail']);
                $phone_number = strClean($_POST['txtPhone']);
                $nickname = strClean($_POST['txtNickname']);
                $password = $_POST['txtPassword'];
                $type_user = strClean($_POST['cboType']);
                $response = $this->model->add_user($first_name, $last_name, $email, $phone_number, $nickname, encrypted($password), $type_user);
                if ($response) {
                    echo 'Successfully saved';
                } else {
                    echo 'Unsuccessfully saved';
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function search_user()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_user = decrypted(end($url));
                $type = $this->model->type_user();
                $user = $this->model->search_user($id_user);
                if (count($user) > 0) {
                    $this->views->getView($this, "update_user", [$user, $type]);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_user()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $first_name = strClean($_POST['txtFirstname']);
                $last_name = strClean($_POST['txtLastname']);
                $email = strClean($_POST['txtEmail']);
                $phone_number = strClean($_POST['txtPhone']);
                $nickname = strClean($_POST['txtNickname']);
                $password = $_POST['txtPassword'];
                $type_user = strClean($_POST['cboType']);
                $id_user = decrypted($_POST['user']);
                $response = $this->model->update_user($first_name, $last_name, $email, $phone_number, $nickname, encrypted($password), $type_user, $id_user);
                if ($response) {
                    $data = [BASE_URL . 'User/see_all', 'Successfully Updated'];
                    echo json_encode($data);
                } else {
                    $data = ["", 'Unsuccessfully updated'];
                    echo json_encode($data);
                }
            }
        } catch (Exception $ex) {
            echo json_encode(["", $ex->getMessage()]);
        }
    }

    public function delete_user()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_user = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_user($id_user);
                if ($response) {
                    echo 'Successfully removed';
                } else {
                    echo 'Unsuccessfully deleted';
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
