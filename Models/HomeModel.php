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
class HomeModel extends Mysql
{
    public function validateClient($username, $password)
    {
        $query = "select c.id_client,first_name,last_name,user_name,email,date_birth,gender,phone_number,l.id_limited_account,l.limit_balance,l.used_balance,
        a.id_current_account,a.current_balance from client c inner join limited_account l on c.id_client = l.id_client inner join current_account a on c.id_client =
        a.id_client where c.user_name = '$username' and c.password = '$password' and c.logical_delete = 1";
        return $this->select_data($query);
    }

    public function all_upload_data()
    {
        $query = 'select id_upload_data,nameFile,description from upload_data where logicalDelete=1';
        return $this->select_all_data($query);
    }
    
    public function listSections()
    {
        $query = 'select id_section,name,image from sections where logical_delete = 1';
        return $this->select_all_data($query);
    }
}
