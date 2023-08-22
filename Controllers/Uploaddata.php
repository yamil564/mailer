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
class Uploaddata extends Controllers
{
    public function add_new()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $briefcase = $this->model->all_briefcase();
            $this->views->getView($this, "add_new", [$briefcase, ""]);
        }
    }

    public function see_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $response = $this->model->all_upload_data();
                $this->views->getView($this, "see_all", $response);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_upload_data()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $name = strClean($_POST['txtName']);
                $id_briefcase = strClean($_POST['cboBriefcase']);
                $type = strClean($_POST['cboMultimedia']);
                switch (true) {
                    case $type == 'image':
                        $url = upload_file($_FILES['btnImage'], 'Data');
                        break;
                    case $type == 'video':
                        $url = upload_file($_FILES['btnVideo'], 'Data');
                        break;
                    case $type == 'link':
                        $url = strClean($_POST['txtLink']);
                        break;
                    default:
                        $url = upload_file($_FILES['btnPdf'], 'Data');
                        break;
                }
                $response = $this->model->add_upload_data($id_briefcase, $name, $type, $url);
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

    public function delete_upload_data()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_upload_data = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_upload_data($id_upload_data);
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

    public function list_upload()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET') {
                header(HOME);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_briefcase = decrypted(end($url));
                $response = $this->model->list_upload($id_briefcase);
                if ($response) {
                    return $this->views->getView($this, "list_upload", $response);
                }
                return $this->views->getView($this, "list_upload", "Content upload not available");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
