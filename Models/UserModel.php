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
class UserModel extends Mysql
{
    public function type_user()
    {
        $query = "select id_type_user,name from type_user";
        return $this->select_all_data($query);
    }

    public function add_user($first_name, $last_name, $email, $phone_number, $nickname, $password, $type_user)
    {
        $query = 'insert into user(first_name,last_name,email,phone_number,nickname,password,id_type_user) values(?,?,?,?,?,?,?)';
        $data = array($first_name, $last_name, $email, $phone_number, $nickname, $password, $type_user);
        return $this->insert_data($query, $data);
    }

    public function all_users()
    {
        $query = 'select id_user,first_name,last_name,email,phone_number,nickname, t.name from user u inner join type_user t on t.id_type_user=u.id_type_user where u.logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function search_user($id_user)
    {
        $query = "select id_user,first_name,last_name,email,phone_number,nickname,password from user where id_user=$id_user";
        return $this->select_data($query);
    }

    public function update_user($first_name, $last_name, $email, $phone_number, $nickname, $password, $type_user, $id_user)
    {
        $query = "update user set first_name=?,last_name=?,email=?,phone_number=?,nickname=?,password=?,id_type_user=? where id_user=$id_user";
        $data = array($first_name, $last_name, $email, $phone_number, $nickname, $password, $type_user);
        return $this->update_data($query, $data);
    }

    public function delete_user($id_user)
    {
        $query = "update user set logical_delete=0 where id_user=$id_user";
        return $this->delete_data($query);
    }
}
