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
class ModelsModel extends Mysql
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

    public function addNewModel($idSubsection, $mls, $picture, $title, $type, $quantity)
    {
        $query = 'insert into models(id_subsection,mls,picture,title,type,quantity) values(?,?,?,?,?,?)';
        $data = array($idSubsection, $mls, $picture, $title, $type, $quantity);
        return $this->insert_data($query, $data);
    }

    public function addIntruccionsFields($idModel, $message)
    {
        $query = 'insert into instructions(id_model,message) values(?,?)';
        $data = array($idModel, $message);
        return $this->insert_data($query, $data);
    }

    public function addBaseFields($idModel, $name, $required)
    {
        $query = 'insert into base_fields(id_model,name,required) values(?,?,?)';
        $data = array($idModel, $name, $required);
        return $this->insert_data($query, $data);
    }

    public function addMultimediaFiles($idModel, $url)
    {
        $query = 'insert into multimedia(id_model,url) values(?,?)';
        $data = array($idModel, $url);
        return $this->insert_data($query, $data);
    }

    public function addContentFields($idMultimedia, $content)
    {
        $query = 'insert into content_fields(id_multimedia,content) values(?,?)';
        $data = array($idMultimedia, $content);
        return $this->insert_data($query, $data);
    }

    public function addSizesFields($idModel, $description, $price)
    {
        $query = 'insert into size(id_model,description,price) values(?,?,?)';
        $data = array($idModel, $description, $price);
        return $this->insert_data($query, $data);
    }

    public function listModels()
    {
        $query = 'select distinct m.id_model,m.title,e.name as section,s.name as subsections,m.type from models m inner join subsections s on m.id_subsection=s.id_subsection
        inner join sections e on s.id_section=e.id_section where m.logical_delete=1 order by m.id_model;';
        return $this->select_all_data($query);
    }

    public function searchModel($idModel)
    {
        $query = "select id_model,mls,picture,title,c.id_section,s.id_subsection,m.type,quantity from models m inner join subsections s
        on m.id_subsection=s.id_subsection inner join sections c on s.id_section=c.id_section where m.id_model=$idModel";
        return $this->select_data($query);
    }

    public function searchInstruccionsFields($idModel)
    {
        $query = "select id_instructions,message from instructions where id_model=$idModel";
        return $this->select_all_data($query);
    }

    public function searchBaseFields($idModel)
    {
        $query = "select id_base_fields,name,required from base_fields where id_model=$idModel";
        return $this->select_all_data($query);
    }

    public function searchMultimediaFiles($idModel)
    {
        $query = "select id_multimedia,url from multimedia where id_model=$idModel";
        return $this->select_all_data($query);
    }

    public function searchContentFields($idMultimedia)
    {
        $query = "select id_content_fields,content from content_fields where id_multimedia=$idMultimedia";
        return $this->select_all_data($query);
    }

    public function searchSizeFields($idModel)
    {
        $query = "select idsize,description,price from size where id_model=$idModel";
        return $this->select_all_data($query);
    }

    public function updateModel($idSubsection, $mls, $picture, $title, $type, $quantity, $idModel)
    {
        $query = "update models set id_subsection=?, mls=?, picture=?, title=?, type=?, quantity=? where id_model=$idModel";
        $data = array($idSubsection, $mls, $picture, $title, $type, $quantity);
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

    public function updateMultimediaFiles($routeFile, $idMultimediaFile)
    {
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

    public function deleteModel($idModel)
    {
        $query = "update models set logical_delete=0 where id_model=$idModel";
        return $this->delete_data($query);
    }

    public function listModel($idSubsection)
    {
        $query = "select id_model,title,type from models where id_subsection=$idSubsection and logical_delete=1";
        return $this->select_all_data($query);
    }

    public function listSizeperModel($idModel)
    {
        $query = "select idsize,id_model,description,price from size where id_model=$idModel and logical_delete=1";
        return $this->select_all_data($query);
    }
}
