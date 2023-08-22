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
class AdminModel extends Mysql
{
    public function type_user()
    {
        $query = "select * from type_user";
        return $this->select_all_data($query);
    }

    public function login_validate($user, $password, $type)
    {
        $query = "select id_user,name,first_name,last_name from user u inner join type_user t on 
        u.id_type_user=t.id_type_user where nickname = '$user' and password = '$password' and u.id_type_user = '$type'";
        return $this->select_data($query);
    }

    public function all_sections()
    {
        $query = 'select id_section,name from sections where logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function add_new_postcard($name, $price, $size, $path_front, $path_back, $number_images, $id_section)
    {
        $query = 'insert into postcard(name,price,size,path_front,path_back,number_images,id_section) values(?,?,?,?,?,?,?)';
        $data = array($name, $price, $size, $path_front, $path_back, $number_images, $id_section);
        return $this->insert_data($query, $data);
    }

    public function add_base_field($name, $id_postcard)
    {
        $query = 'insert into base_fields(name,id_postcard) values(?,?)';
        $data = array($name, $id_postcard);
        return $this->insert_data($query, $data);
    }

    public function add_content_field($content, $id_postcard)
    {
        $query = 'insert into content_fields(content,id_postcard) values(?,?)';
        $data = array($content, $id_postcard);
        return $this->insert_data($query, $data);
    }

    public function add_size_postcard($id_size, $id_postcard)
    {
        $query = 'insert into size_postcard(id_size,id_postcard) values(?,?)';
        $data = array($id_size, $id_postcard);
        return $this->insert_data($query, $data);
    }
}
