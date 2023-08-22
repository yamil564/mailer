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
class BriefcaseModel extends Mysql
{
    public function add_briefcase($name, $description, $image)
    {
        $query = 'insert into briefcase(name,description,image) values(?,?,?)';
        $data = array($name, $description, $image);
        return $this->insert_data($query, $data);
    }

    public function all_briefcase()
    {
        $query = 'select id_briefcase,name,description,image from briefcase where logical_delete=1';
        return $this->select_all_data($query);
    }

    public function search_briefcase($id_briefcase)
    {
        $query = "select id_briefcase,name,description,image from briefcase where id_briefcase=$id_briefcase";
        return $this->select_data($query);
    }

    public function update_briefcase($name, $description, $image, $id_briefcase)
    {
        $query = "update briefcase set name=?, description=?, image=? where id_briefcase=$id_briefcase";
        $data = array($name, $description, $image);
        return $this->update_data($query, $data);
    }

    public function delete_briefcase($id_briefcase)
    {
        $query = "update briefcase set logical_delete=0 where id_briefcase=$id_briefcase";
        return $this->delete_data($query);
    }
}
