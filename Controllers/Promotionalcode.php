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
class Promotionalcode extends Controllers
{
    public function add_new()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $this->views->getView($this, "add_new", "");
        }
    }

    public function see_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $response = $this->model->all_promotional_code();
                $this->views->getView($this, "see_all", $response);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_promotional_code()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $code = strClean($_POST['txtCode']);
                $value = strClean($_POST['txtValue']);
                $response = $this->model->add_promotional_code($code, $value);
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

    public function search_promotional_code()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_promocional_code = decrypted(end($url));
                $promocional_code = $this->model->search_promotional_code($id_promocional_code);
                if (count($promocional_code) > 0) {
                    $this->views->getView($this, "update_code", $promocional_code);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_promotional_code()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $code = strClean($_POST['txtCode']);
                $value = strClean($_POST['txtValue']);
                $id_promocional_code = decrypted($_POST['promotional_code']);
                $response = $this->model->update_promotional_code($code, $value, $id_promocional_code);
                if ($response) {
                    $data = [BASE_URL . 'Promotionalcode/see_all', 'Successfully Updated'];
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

    public function delete_promotional_code()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_promocional_code = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_promotional_code($id_promocional_code);
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

    public function validate_promotional_code()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                header(HOME);
                exit();
            } else {
                $code = strClean($_POST['txtCode']);
                $response = $this->model->validate_promotional_code($code);
                if ($response) {
                    echo $response['value'];
                } else {
                    echo 'Invalid promotional code';
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
