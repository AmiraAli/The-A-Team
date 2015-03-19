<?php

class Application_Model_Categories extends Zend_Db_Table_Abstract
{
    //table name
    protected $_name = "Category";
    
    // add category
    function addCategory($data){
        $row = $this->createRow();
        $row->name = $data['name'];
        return $row->save();
    }
    
    // list all Categories
    function listCategories(){
        
        return $this->fetchAll()->toArray();
    }
    
    // get Category by id
    function getCategoryById($id){
        return $this->find($id)->toArray();
    }
    
    // get Category by name
    function getCategoryByName($name){

        $select=$this->select()->where(" name = ?",$name);
        return $this->fetchAll($select)->toArray();
    }
    
    // edit Category data
    function editCategory($data){
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
    // delete course by id of category
    function deleteCategory($id){
        return $this->delete("id=$id");
    }

 

}

