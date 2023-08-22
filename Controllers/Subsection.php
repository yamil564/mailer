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

class Subsection extends Controllers
{
    public function add_new()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $sections = $this->model->all_sections();
            $this->views->getView($this, "add_new", ['sections' => $sections]);
        }
    }

    public function see_all()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $response = $this->model->all_subsections();
                $this->views->getView($this, "see_all", $response);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function add_subsection()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_section = strClean($_POST['cboSection']);
                $name = strClean($_POST['txtName']);
                $description = strClean($_POST['txtDescription']);
                $type = strClean($_POST['cboType']);
                $url = upload_file($_FILES['btnFileSection'], 'Subsections');
                $response = $this->model->add_subsection($id_section, $name, formatEnterTextArea($description), $type, $url);
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

    public function search_subsection()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $id_subsection = decrypted(end($url));
                $subsection = $this->model->search_subsection($id_subsection);
                $sections = $this->model->all_sections();
                if ($subsection) {
                    $this->views->getView($this, "update_subsection", ['subsection' => $subsection, 'sections' => $sections]);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function update_subsection()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_section = strClean($_POST['cboSection']);
                $name = strClean($_POST['txtName']);
                $description = strClean($_POST['txtDescription']);
                $type = strClean($_POST['cboType']);
                $url = upload_file($_FILES['btnFileSection'], 'Subsections');
                $id_subsection = decrypted($_POST['subsection']);
                $img_old = $this->model->search_subsection($id_subsection);
                $url = !empty($url) ? $url : $img_old['image'];
                $response = $this->model->update_subsection($id_section, $name, formatEnterTextArea($description), $type, $url, $id_subsection);
                if ($response) {
                    $url != $img_old['image'] ? delete_old_file($img_old['image']) : "";
                    $data = [base_url() . 'Subsection/see_all', 'Successfully Updated'];
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

    public function delete_subsection()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $id_subsection = decrypted($_POST['btnDelete']);
                $response = $this->model->delete_subsection($id_subsection);
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

    public function listSubsections()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET) || empty($_SESSION['client'])) {
                header(HOME);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idSection = end($url);
                $resultSubsections = $this->model->listSubsections($idSection);
                $this->views->getView($this, 'listSubsections', $resultSubsections);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
