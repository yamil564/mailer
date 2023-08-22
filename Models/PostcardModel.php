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
class PostcardModel extends Mysql
{
    public function listSections()
    {
        $query = 'select id_section,name from sections where logical_delete = 1';
        return $this->select_all_data($query);
    }

    public function listSubsections($idSection)
    {
        $query = "select id_subsection,name from subsections where id_section=$idSection and logical_delete=1";
        return $this->select_all_data($query);
    }

    public function addNewPostcard($idSubsection, $mls, $picture, $title, $quantity)
    {
        $query = 'insert into postcard(id_subsection,mls,picture,title,quantity) values(?,?,?,?,?)';
        $data = array($idSubsection, $mls, $picture, $title, $quantity);
        return $this->insert_data($query, $data);
    }

    public function addIntruccionsFields($idPostcard, $message)
    {
        $query = 'insert into instructions(id_postcard,message) values(?,?)';
        $data = array($idPostcard, $message);
        return $this->insert_data($query, $data);
    }

    public function addBaseFields($idPostcard, $name, $required)
    {
        $query = 'insert into base_fields(id_postcard,name,required) values(?,?,?)';
        $data = array($idPostcard, $name, $required);
        return $this->insert_data($query, $data);
    }

    public function addMultimediaFiles($idPostcard, $url)
    {
        $query = 'insert into multimedia(id_postcard,url) values(?,?)';
        $data = array($idPostcard, $url);
        return $this->insert_data($query, $data);
    }

    public function addContentFields($idMultimedia, $content)
    {
        $query = 'insert into content_fields(id_multimedia,content) values(?,?)';
        $data = array($idMultimedia, $content);
        return $this->insert_data($query, $data);
    }

    public function addSizesFields($idPostcard, $description, $price)
    {
        $query = 'insert into size(id_postcard,description,price) values(?,?,?)';
        $data = array($idPostcard, $description, $price);
        return $this->insert_data($query, $data);
    }

    public function listPostcard()
    {
        $query = 'select p.id_postcard,p.title,c.name as section,s.name as subsection from postcard p inner join subsections s
        on p.id_subsection=s.id_subsection inner join sections c on s.id_section=c.id_section where p.logical_delete = 1;';
        return $this->select_all_data($query);
    }

    public function searchPostcard($idPostcard)
    {
        $query = "select id_postcard,mls,picture,title,c.id_section,s.id_subsection,quantity
        from postcard p inner join subsections s on p.id_subsection=s.id_subsection inner join sections c
        on s.id_section=c.id_section where p.id_postcard=$idPostcard";
        return $this->select_data($query);
    }

    public function searchInstruccionsFields($idPostcard)
    {
        $query = "select id_instructions,message from instructions where id_postcard=$idPostcard";
        return $this->select_all_data($query);
    }

    public function searchBaseFields($idPostcard)
    {
        $query = "select id_base_fields,name,required from base_fields where id_postcard=$idPostcard";
        return $this->select_all_data($query);
    }

    public function searchMultimediaFiles($idPostcard)
    {
        $query = "select id_multimedia,url from multimedia where id_postcard=$idPostcard";
        return $this->select_all_data($query);
    }

    public function searchContentFields($idMultimedia)
    {
        $query = "select id_content_fields,content from content_fields where id_multimedia=$idMultimedia";
        return $this->select_all_data($query);
    }

    public function searchSizeFields($idPostcard)
    {
        $query = "select idsize,description,price from size where id_postcard=$idPostcard";
        return $this->select_all_data($query);
    }

    public function updatePostcard($idSubsection, $mls, $picture, $title, $quantity, $idPostcard)
    {
        $query = "update postcard set id_subsection=?, mls=?, picture=?, title=?, quantity=? where id_postcard=$idPostcard";
        $data = array($idSubsection, $mls, $picture, $title, $quantity);
        return $this->update_data($query, $data);
    }

    public function updateInstructionsFields($message, $idInstruction)
    {
        $query = "update instructions set message=? where id_instructions=$idInstruction";
        $data = array($message);
        return $this->update_data($query, $data);
    }

    public function updateBaseFields($name, $required, $idBase)
    {
        $query = "update base_fields set name=?, required=? where id_base_fields=$idBase";
        $data = array($name, $required);
        return $this->update_data($query, $data);
    }

    public function updateMultimediaFiles($routeFile ,$idMultimediaFile){
        $query = "update multimedia set url=? where id_multimedia=$idMultimediaFile";
        $data = array($routeFile);
        return $this->update_data($query, $data);
    }

    public function updateContentFields($content, $idContent)
    {
        $query = "update content_fields set content=? where id_content_fields=$idContent";
        $data = array($content);
        return $this->update_data($query, $data);
    }

    public function updateSizeFields($description, $price, $idSize)
    {
        $query = "update size set description=?, price=? where idsize=$idSize";
        $data = array($description, $price);
        return $this->update_data($query, $data);
    }

    public function deletePostcard($idPostcard)
    {
        $query = "update postcard set logical_delete=0 where id_postcard=$idPostcard";
        return $this->delete_data($query);
    }

    public function listPostcards($idSubsection)
    {
        $query = "select id_postcard,title from postcard where id_subsection=$idSubsection and logical_delete=1";
        return $this->select_all_data($query);
    }

    public function listSizeperPostcard($idPostcard)
    {
        $query = "select idsize,id_model,description,price from size where id_postcard=$idPostcard and logical_delete=1";
        return $this->select_all_data($query);
    }
}
