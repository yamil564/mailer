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
class OrderModel extends Mysql
{
    public function listOrder()
    {
        $query = "select o.id_order,p.title as 'postcard',m.title as 'model',concat(c.first_name,' ',c.last_name) as 'fullname',(select code from promotional_code
        where id_promotional_code=o.id_promotional_code) as 'promotional_code',o.total,duetoday,order_date from mailerdb.order o inner join client c on o.id_client = c.id_client
        left join postcard p on o.id_postcard=p.id_postcard left join models m on o.id_model=m.id_model where o.logical_delete = 1 order by order_date DESC";
        return $this->select_all_data($query);
    }

    public function searchOrder($idOrder)
    {
        $query = "select o.id_order,o.id_client,o.id_postcard,o.id_model,m.type,o.mls,o.special_request,sales_tax,type_services,processing,id_promotional_code,
        sub_total,total,duetoday,agent,order_date from mailerdb.order o left join postcard p on o.id_postcard=p.id_postcard left join models m on o.id_model=m.id_model
        where id_order=$idOrder";
        return $this->select_data($query);
    }

    public function searchCustomBaseFields($idOrder)
    {
        $query = "select id_base_fields,value from order_base where id_order=$idOrder and logical_delete = 1";
        return $this->select_all_data($query);
    }

    public function searchCustomContentFields($idOrder)
    {
        $query = "select id_content_fields,replace_content from order_content where id_order=$idOrder and logical_delete = 1";
        return $this->select_all_data($query);
    }

    public function searchCustomMultimedia($idOrder)
    {
        $query = "select id_order_multimedia,url from order_multimedia where id_order=$idOrder and logical_delete = 1";
        return $this->select_all_data($query);
    }

    public function searchTargeting($idOrder)
    {
        $query = "select number_target,type,bedrooms,square_footage,year_built,year_last,last_sold,location,polygon,excel from target where id_order=$idOrder and logical_delete = 1";
        return $this->select_all_data($query);
    }

    public function deleteMultimedia($idMultimedia)
    {
        $query = "update order_multimedia set logical_delete=0 where id_order_multimedia=$idMultimedia";
        return $this->delete_data($query);
    }

    public function searchProduct($idSubsection)
    {
        $query = "select s.name as product, sb.name as subsection FROM subsections sb inner join sections s on sb.id_section=s.id_section where id_subsection=$idSubsection";
        return $this->select_data($query);
    }

    public function searchPostcard($idPostcard)
    {
        $query = "select id_postcard,id_subsection,mls,picture,title,quantity from postcard where id_postcard=$idPostcard";
        return $this->select_data($query);
    }

    public function searchModel($idModel)
    {
        $query = "select id_model,id_subsection,mls,picture,title,type,quantity from models where id_model=$idModel";
        return $this->select_data($query);
    }

    public function searchInstruccionsFields($campUsed, $searchValue)
    {
        $query = "select id_instructions,message from instructions where $campUsed=$searchValue";
        return $this->select_all_data($query);
    }

    public function searchBaseFields($campUsed, $searchValue)
    {
        $query = "select id_base_fields,name,required from base_fields where $campUsed=$searchValue";
        return $this->select_all_data($query);
    }

    public function searchMultimediaFiles($campUsed, $searchValue)
    {
        $query = "select id_multimedia,url from multimedia where $campUsed=$searchValue";
        return $this->select_all_data($query);
    }

    public function searchContentFields($idMultimedia)
    {
        $query = "select id_content_fields,content from content_fields where id_multimedia=$idMultimedia";
        return $this->select_all_data($query);
    }

    public function searchSizeFields($idSize)
    {
        $query = "select idsize,price from size where idsize=$idSize";
        return $this->select_all_data($query);
    }

    public function searchPromotionalCode($code)
    {
        $query = "select id_promotional_code from promotional_code where code='$code' and logical_delete=1";
        return $this->select_data($query);
    }

    public function addNewOrder($idClient, $type_order, $id_type, $mls, $request, $salesTax, $type_services, $processing, $id_promotional_code, $subtotal, $total, $duetoday, $agent, $orderDate)
    {
        $query = "insert into mailerdb.order(id_client,$type_order,mls,special_request,sales_tax,type_services,processing,id_promotional_code,sub_total,total,duetoday,agent,order_date) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $data = array($idClient, $id_type, $mls, $request, $salesTax, $type_services, $processing, $id_promotional_code, $subtotal, $total, $duetoday, $agent, $orderDate);
        return $this->insert_data($query, $data);
    }

    public function addOrderBaseFields($idOrder, $idBase, $value)
    {
        $query = 'insert into order_base (id_order, id_base_fields, value) values (?,?,?)';
        $data = array($idOrder, $idBase, $value);
        return $this->insert_data($query, $data);
    }

    public function addOrderMultimediaFiles($idOrder, $url)
    {
        $query = 'insert into order_multimedia (id_order, url) values (?,?)';
        $data = array($idOrder, $url);
        return $this->insert_data($query, $data);
    }

    public function addOrderContentFields($idOrder, $idContentFields, $replaceContent)
    {
        $query = 'insert into order_content ( id_order, id_content_fields, replace_content) values (?,?,?)';
        $data = array($idOrder, $idContentFields, $replaceContent);
        return $this->insert_data($query, $data);
    }

    public function addTargetFields($id_order, $number_target, $type, $bedrooms, $square_footage, $year_built, $year_last, $last_sold, $location, $polygon, $excel)
    {
        $query = 'insert into target(id_order,number_target,type,bedrooms,square_footage,year_built,year_last,last_sold,location,polygon,excel) values (?,?,?,?,?,?,?,?,?,?,?)';
        $data = array($id_order, $number_target, $type, $bedrooms, $square_footage, $year_built, $year_last, $last_sold, $location, $polygon, $excel);
        return $this->insert_data($query, $data);
    }

    public function addMovementsLa($idAccount, $idOrder, $total, $limitedBalance, $usedBalance, $currentUsedBalance, $date)
    {
        $query = 'insert into movements(id_limited_account,id_order,total,limited_balance,used_balance,current_used_balance,movement_date) values (?,?,?,?,?,?,?)';
        $data = array($idAccount, $idOrder, $total, $limitedBalance, $usedBalance, $currentUsedBalance, $date);
        return $this->insert_data($query, $data);
    }

    public function addMovementsCa($idAccount, $idOrder, $total, $currentBalance, $availableBalance, $date)
    {
        $query = 'insert into movements_ca(id_current_account,id_order,total,current_balance,available_balance,movement_date) values (?,?,?,?,?,?)';
        $data = array($idAccount, $idOrder, $total, $currentBalance, $availableBalance, $date);
        return $this->insert_data($query, $data);
    }

    public function getOrderDate($idOrder)
    {
        $query = "select order_date from mailerdb.order where id_order='$idOrder'";
        return $this->select_data($query);
    }

    public function updateLimitedAccount($usedBalance, $idAccount)
    {
        $query = "update limited_account set used_balance=? where id_limited_account = $idAccount";
        $data = array($usedBalance);
        return $this->update_data($query, $data);
    }

    public function updateCurrentAccount($currentBalance, $idAccount)
    {
        $query = "update current_account set current_balance=? where id_current_account = $idAccount";
        $data = array($currentBalance);
        return $this->update_data($query, $data);
    }

    public function updateSessionClient($idClient)
    {
        $query = "select c.id_client,first_name,last_name,user_name,email,date_birth,gender,phone_number,l.id_limited_account,l.limit_balance,l.used_balance,
        a.id_current_account,a.current_balance from client c inner join limited_account l on c.id_client = l.id_client inner join current_account a on c.id_client =
        a.id_client where c.id_client = '$idClient'";
        return $this->select_data($query);
    }
}
