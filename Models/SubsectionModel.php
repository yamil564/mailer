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
class SubsectionModel extends Mysql
{
    public function all_sections()
    {
        $query = 'select id_section,name from sections where logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function add_subsection($id_section, $name, $description, $type, $image)
    {
        $query = 'insert into subsections(id_section,name,description,type,image) values(?,?,?,?,?)';
        $data = array($id_section, $name, $description, $type, $image);
        return $this->insert_data($query, $data);
    }

    public function all_subsections()
    {
        $query = 'select s.id_subsection,s.name,s.type,e.name as section from subsections s inner join sections e on s.id_section=e.id_section where s.logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function search_subsection($id_subsection)
    {
        $query = "select id_subsection,id_section,name,description,type,image from subsections where id_subsection=$id_subsection";
        return $this->select_data($query);
    }

    public function update_subsection($id_section, $name, $description, $type, $url, $id_subsection)
    {
        $query = "update subsections set id_section=?, name=?, description=?, type=?, image=? where id_subsection=$id_subsection";
        $data = array($id_section, $name, $description, $type, $url);
        return $this->update_data($query, $data);
    }

    public function delete_subsection($id_subsection)
    {
        $query = "update subsections set logical_delete=0 where id_subsection=$id_subsection";
        return $this->delete_data($query);
    }

    public function listSubsections($idSection)
    {
        $query = "select id_subsection,type,name,image from subsections where id_section=$idSection and logical_delete=1";
        return $this->select_all_data($query);
    }
}
