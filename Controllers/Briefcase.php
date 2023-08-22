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
class Briefcase extends Controllers
{
    public function add_new()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $this->views->getView($this, 'add_new', '');
        }
    }

    public function see_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $response = $this->model->all_briefcase();
                $this->views->getView($this, 'see_all', $response);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_briefcase()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $code = strClean($_POST['txtName']);
                $value = strClean($_POST['txtDescription']);
                $image = upload_file($_FILES['btnFileBriefcase'], 'Briefcase');
                $response = $this->model->add_briefcase($code, $value, $image);
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

    public function search_briefcase()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_briefcase = decrypted(end($url));
                $briefcase = $this->model->search_briefcase($id_briefcase);
                if ($briefcase) {
                    $this->views->getView($this, "update_briefcase", $briefcase);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_briefcase()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $code = strClean($_POST['txtName']);
                $description = strClean($_POST['txtDescription']);
                $image = upload_file($_FILES['btnFileBriefcase'], 'Briefcase');
                $id_briefcase = decrypted($_POST['briefcase']);
                $img_old = $this->model->search_briefcase($id_briefcase);
                $image = !empty($image) ? $image : $img_old['image'];
                $response = $this->model->update_briefcase($code, $description, $image , $id_briefcase);
                if ($response) {
                    $image != $img_old['image'] ? delete_old_file($img_old['image']) : "";
                    $data = [BASE_URL . 'Briefcase/see_all', 'Successfully Updated'];
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

    public function delete_briefcase()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_briefcase = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_briefcase($id_briefcase);
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

    public function list_briefcase()
    {
        try {
            $response = $this->model->all_briefcase();
            if ($response) {
                return $this->views->getView($this, 'list_briefcase', $response);
            } 
            return $this->views->getView($this, 'list_briefcase', "Briefcase not avaible");
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
