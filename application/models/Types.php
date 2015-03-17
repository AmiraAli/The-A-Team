<?php

class Application_Model_Types extends Zend_Db_Table_Abstract
{
    protected $_name='Types';
    
    function insertType($data){
        $row=$this->createRow();
        $row->name=$data['name'];
        return $row->save();
        
    }
    
    function deleteTypeById($where){
        return $this->deleteType('id='.$where);
    }
    function deleteTypeByName($where){
        return $this->deleteType("name= '$where'");
    }

    function selectAllTypes(){
        return $this->fetchAll()->toArray();
    }
    
    function selectTypeById($where){
    return $this->fetchAll('id='.$where)->toArray();
    }
    
    function selectTypeByName($where){
    return $this->fetchAll("name= '$where'")->toArray();
    }
}

