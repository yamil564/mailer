<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of homeModel
 *
 * @author User
 */
class ClientModel extends Mysql
{
    public function validateClient($username)
    {
        $query = "select * from client where user_name='$username'";
        return $this->select_all_data($query);
    }

    public function addClient($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber)
    {
        $query = 'insert into client(first_name,last_name,user_name,password,email,date_birth,gender,phone_number) values(?,?,?,?,?,?,?,?)';
        $data = array($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber);
        return $this->insert_data($query, $data);
    }

    public function addLimitedAccount($idClient, $limitedBalance, $usedBalance)
    {
        $query = 'insert into limited_account(id_client,limit_balance,used_balance) values(?,?,?)';
        $data = array($idClient, $limitedBalance, $usedBalance);
        return $this->insert_data($query, $data);
    }

    public function addCurrentAccount($idClient, $currentBalance)
    {
        $query = 'insert into current_account(id_client,current_balance) values(?,?)';
        $data = array($idClient, $currentBalance);
        return $this->insert_data($query, $data);
    }

    public function listClients()
    {
        $query = 'select c.id_client,l.id_limited_account,a.id_current_account,first_name,last_name,user_name,email from client c
        inner join limited_account l on c.id_client = l.id_client inner join current_account a on c.id_client = a.id_client where
        c.logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function listMovementsLa($idAccount)
    {
        $query = "select id_order,total,limited_balance,used_balance,current_used_balance,movement_date from movements where id_limited_account = $idAccount";
        return $this->select_all_data($query);
    }

    public function listMovementsCa($idAccount)
    {
        $query = "select id_order,total,current_balance,available_balance,movement_date from movements_ca where id_current_account = $idAccount";
        return $this->select_all_data($query);
    }

    public function searchClient($idClient)
    {
        $query = "select id_client,first_name,last_name,user_name,password,email,date_birth,gender,phone_number from client where id_client=$idClient";
        return $this->select_data($query);
    }

    public function searchLimitedAccount($idClient)
    {
        $query = "select id_limited_account,limit_balance,used_balance from limited_account where id_client=$idClient";
        return $this->select_data($query);
    }

    public function searchCurrentAccount($idClient)
    {
        $query = "select id_current_account,current_balance from current_account where id_client=$idClient";
        return $this->select_data($query);
    }

    public function updateClient($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber, $idClient)
    {
        $query = "update client set first_name=?,last_name=?,user_name=?,password=?,email=?,date_birth=?,gender=?,phone_number=? where id_client=$idClient";
        $data = array($firstName, $lastName, $username, $password, $email, $birthDate, $gender, $phoneNumber);
        return $this->update_data($query, $data);
    }

    public function updateLimitedAccount($limitedBalance, $usedBalance, $idAccount)
    {
        $query = "update limited_account set limit_balance=?,used_balance=? where id_limited_account=$idAccount";
        $data = array($limitedBalance, $usedBalance);
        return $this->update_data($query, $data);
    }

    public function updateCurrentAccount($currentBalance, $idAccount)
    {
        $query = "update current_account set current_balance=? where id_current_account=$idAccount";
        $data = array($currentBalance);
        return $this->update_data($query, $data);
    }

    public function deleteClient($idClient)
    {
        $query = "update client set logical_delete=0 where id_client=$idClient";
        return $this->delete_data($query);
    }
}
