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
class UploaddataModel extends Mysql
{
    public function all_briefcase()
    {
        $query = 'select id_briefcase,name,description from briefcase where logical_delete=1';
        return $this->select_all_data($query);
    }

    public function all_upload_data()
    {
        $query = 'select up.id_upload_data,pf.name as briefcase,up.name,up.type,up.url from upload_data up inner join briefcase pf on up.id_briefcase=pf.id_briefcase where up.logical_delete=1';
        return $this->select_all_data($query);
    }

    public function add_upload_data($id_briefcase, $name, $type, $url)
    {
        $query = 'insert into upload_data(id_briefcase,name,type,url) values(?,?,?,?)';
        $data = array($id_briefcase, $name, $type, $url);
        return $this->insert_data($query, $data);
    }

    public function delete_upload_data($id_upload_data)
    {
        $query = "update upload_data set logical_delete=0 where id_upload_data=$id_upload_data";
        return $this->delete_data($query);
    }

    public function list_upload($id_briefcase)
    {
        $query = "select u.id_upload_data,b.name as briefcase,u.name,u.type,u.url from upload_data u inner join briefcase b on u.id_briefcase=b.id_briefcase where u.logical_delete=1 and u.id_briefcase=$id_briefcase";
        return $this->select_all_data($query);
    }
}
