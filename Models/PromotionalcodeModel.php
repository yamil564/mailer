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
class PromotionalcodeModel extends Mysql
{
    public function add_promotional_code($code, $value)
    {
        $query = 'insert into promotional_code(code,value) values(?,?)';
        $data = array($code, $value);
        return $this->insert_data($query, $data);
    }

    public function all_promotional_code()
    {
        $query = 'select id_promotional_code,code,value from promotional_code where logical_delete=1';
        return $this->select_all_data($query);
    }

    public function search_promotional_code($id_promotional_code)
    {
        $query = "select id_promotional_code,code,value from promotional_code where id_promotional_code=$id_promotional_code";
        return $this->select_data($query);
    }

    public function update_promotional_code($code, $value, $id_promotional_code)
    {
        $query = "update promotional_code set code=?, value=? where id_promotional_code=$id_promotional_code";
        $data = array($code, $value);
        return $this->update_data($query, $data);
    }

    public function delete_promotional_code($id_promotional_code)
    {
        $query = "update promotional_code set logical_delete=0 where id_promotional_code=$id_promotional_code";
        return $this->delete_data($query);
    }

    public function validate_promotional_code($code)
    {
        $query = "select id_promotional_code,value from promotional_code where code='$code' and logical_delete=1";
        return $this->select_data($query);
    }
}
