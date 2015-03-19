<?php

class Application_Model_Requests extends Zend_Db_Table_Abstract
{
    protected $_name = "Requests";
    
    
    function addRequest($data){
        $row = $this->createRow();
        $row->desc = $data['desc'];
        
      
        $row->User_Id = $data['User_Id'];
       
        
        return $row->save();
    }
    function listRequests(){
        
        return $this->fetchAll()->toArray();
    }
   
    function getRequestById($id){
        return $this->find($id)->toArray();
    }
    
    function getRequestByUser($User_Id){
        $select =$this->select()->where('User_Id = ?', $User_Id);
        return $this->fetchAll($select)->toArray();
    }
    
   
    function editRequest($data){
        
            
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
   
    function deleteRequest($id){
        return $this->delete("id=$id");
    }
    function deleteRequestByUser($id){
        return $this->delete("User_Id=$id");
    }

}

