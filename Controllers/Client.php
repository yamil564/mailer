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

class Client extends Controllers
{
    public function newClient()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
            header(LOGIN_ADMIN);
            exit();
        } else {
            $this->views->getView($this, "addNewClient", '');
        }
    }

    public function addNewClient()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $firstName = strClean($_POST['txtFirstName']);
                $lastName = strClean($_POST['txtLastName']);
                $username = strClean($_POST['txtUser']);
                $password = encrypted($_POST['txtPassword']);
                $email = strClean($_POST['txtEmail']);
                $birthDate = strClean($_POST['txtBirthDate']);
                $gender = strClean($_POST['cboGender']);
                $phoneNumber = strClean($_POST['txtPhoneNumber']);
                $limitedBalance = strClean($_POST['txtLimitBalance']);
                $currentBalance = strClean($_POST['txtCurrentBalance']);
                $validate = $this->validateClient($username);
                if ($validate) {
                    $idClient = $this->model->addClient($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber);
                    if ($idClient) {
                        $resultLimitedAccount = $this->model->addLimitedAccount($idClient, $limitedBalance, 0.00);
                        $resultcurrentAccount = $this->model->addCurrentAccount($idClient, $currentBalance);
                        if ($resultLimitedAccount && $resultcurrentAccount) {
                            $data = ['route' => base_url() . 'Client/seeAllClient', 'message' => 'Successfully saved'];
                        }
                    } else {
                        $data = ['message' =>  'Unsuccessfully saved'];
                    }
                } else {
                    $data = ['message' => 'Username already exists'];
                }
                echo json_encode($data);
            }
        } catch (Exception $ex) {
            $data = ['message' => 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function validateClient($username)
    {
        $validate = $this->model->validateClient($username);
        return !empty($validate) ? false : true;
    }


    public function seeAllClient()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $lstClientsAccounts = $this->model->listClients();
                $this->views->getView($this, "seeAllClient", $lstClientsAccounts);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function seeAllMovementsLa()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idAccount = decrypted(end($url));
                $lstMovements = $this->model->listMovementsLa($idAccount);
                $this->views->getView($this, "seeAllMovementsLa", ['account' => $idAccount, 'movements' => $lstMovements]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function seeAllMovementsCa()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idAccount = decrypted(end($url));
                $lstMovements = $this->model->listMovementsCa($idAccount);
                $this->views->getView($this, "seeAllMovementsCa", ['account' => $idAccount, 'movements' => $lstMovements]);
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function searchClient()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'GET' || empty($_GET) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $url = explode('/', $_GET['url']);
                $idClient = decrypted(end($url));
                $client = $this->model->searchClient($idClient);
                $limitAccount = $this->model->searchLimitedAccount($idClient);
                $currentAccount = $this->model->searchCurrentAccount($idClient);
                if ($client && $limitAccount && $currentAccount) {
                    $this->views->getView($this, "updateClient", ['client' => $client, 'limitAccount' => $limitAccount, 'currentAccount' => $currentAccount]);
                }
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function updateClient()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $idClient = decrypted($_POST['client']);
                $firstName = strClean($_POST['txtFirstName']);
                $lastName = strClean($_POST['txtLastName']);
                $username = strClean($_POST['txtUser']);
                $password = encrypted($_POST['txtPassword']);
                $email = strClean($_POST['txtEmail']);
                $birthDate = strClean($_POST['txtBirthDate']);
                $gender = strClean($_POST['cboGender']);
                $phoneNumber = strClean($_POST['txtPhoneNumber']);
                $idLimitedAccount = decrypted($_POST['limitedAccount']);
                $limitedBalance = strClean($_POST['txtLimitedBalance']);
                $usedBalance = strClean($_POST['txtLimitedUsed']);
                $idCurrentAccount = decrypted($_POST['currentAccount']);
                $currentBalance = strClean($_POST['txtCurrentBalance']);
                $addBalance = strClean($_POST['txtAddBalance']);
                if ($limitedBalance < $usedBalance) {
                    $data = ['message' =>  'The limit balance cannot be less than the current balance'];
                } else {
                    $updateClient = $this->model->updateClient($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber, $idClient);
                    $updateLimitedAccount = $this->model->updateLimitedAccount($limitedBalance, $usedBalance, $idLimitedAccount);
                    $updateCurrentAccount = $this->model->updateCurrentAccount($currentBalance + $addBalance, $idCurrentAccount);
                    if ($updateClient && $updateLimitedAccount && $updateCurrentAccount) {
                        $data = ['route' => base_url() . 'Client/seeAllClient', 'message' => 'Successfully updated'];
                    } else {
                        $data = ['message' =>  'Unsuccessfully updated'];
                    }
                }
                echo json_encode($data);
            }
        } catch (Exception $ex) {
            $data = ['message' => 'Unexpected error, Contact administrator'];
            echo json_encode($data);
        }
    }

    public function deleteClient()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || empty($_SESSION['user'])) {
                header(LOGIN_ADMIN);
                exit();
            } else {
                $idClient = decrypted($_POST['clientAccount']);
                $resultClient = $this->model->deleteClient($idClient);
                if ($resultClient) {
                    echo 'Successfully removed';
                } else {
                    echo 'Unsuccessfully deleted';
                }
            }
        } catch (Exception $ex) {
            echo 'Unexpected error, Contact administrator';
        }
    }
}
