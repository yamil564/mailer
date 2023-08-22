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
class SectionModel extends Mysql
{
    public function add_section($name, $description, $image)
    {
        $query = 'insert into sections(name,description,image) values(?,?,?)';
        $data = array($name, $description, $image);
        return $this->insert_data($query, $data);
    }

    public function all_sections()
    {
        $query = 'select id_section,name,description from sections where logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function search_section($id_section)
    {
        $query = "select id_section,name,description,image from sections where id_section=$id_section";
        return $this->select_data($query);
    }

    public function update_section($name, $description, $url, $id_section)
    {
        $query = "update sections set name=?, description=?, image=? where id_section=$id_section";
        $data = array($name, $description, $url);
        return $this->update_data($query, $data);
    }

    public function delete_section($id_action)
    {
        $query = "update sections set logical_delete=0 where id_section=$id_action";
        return $this->delete_data($query);
    }
}
