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

class Section extends Controllers
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
                $response = $this->model->all_sections();
                $this->views->getView($this, "see_all", $response);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_section()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $name = strClean($_POST['txtName']);
                $description = strClean($_POST['txtDescription']);
                $url = upload_file($_FILES['btnFileSection'], 'Sections');
                $response = $this->model->add_section($name, formatEnterTextArea($description), $url);
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

    public function search_section()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_section = decrypted(end($url));
                $section = $this->model->search_section($id_section);
                if ($section) {
                    $this->views->getView($this, "update_section", $section);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_section()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $name = strClean($_POST['txtName']);
                $description = strClean($_POST['txtDescription']);
                $url = upload_file($_FILES['btnFileSection'], 'Sections');
                $id_section = decrypted($_POST['section']);
                $img_old = $this->model->search_section($id_section);
                $url = !empty($url) ? $url : $img_old['image'];
                $response = $this->model->update_section($name, formatEnterTextArea($description), $url, $id_section);
                if ($response) {
                    $url != $img_old['image'] ? delete_old_file($img_old['image']) : "";
                    $data = [base_url() . 'Section/see_all', 'Successfully Updated'];
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

    public function delete_section()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_section = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_section($id_section);
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
