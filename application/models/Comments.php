<?php

class Application_Model_Comments extends Zend_Db_Table_Abstract
{
protected $_name = "Comments";
    
    
    function addComment($data){
        $row = $this->createRow();
        $row->body = $data['body'];
        
      
        $row->User_Id = $data['User_Id'];
        $row->Course_Id = $data['Course_Id'];
        
        return $row->save();
    }
    function listComments(){
        
        return $this->fetchAll()->toArray();
    }
   
    function getCommentById($id){
        return $this->find($id)->toArray();
    }
    
    function getCommentByUser($User_Id){
        $select =$this->select()->where('User_Id = ?', $User_Id);
        return $this->fetchAll($select)->toArray();
    }
    function getCommentOnCourse($Course_Id){
        $select =$this->select()->where('Course_Id = ?', $Course_Id);
        return $this->fetchAll($select)->toArray();
    }
    
    function getCommentOnMaterial($Material_Id){
        $select =$this->select()->where('Material_Id = ?', $Material_Id);
        return $this->fetchAll($select)->toArray();
    }
   
    function editComment($data){
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
   
    function deleteComment($id){
        return $this->delete("id=$id");
    }
    
    function deleteCommentByUserId($id){
        return $this->delete("User_Id=$id");
    }
    function deleteCommentByCourseId($id){
        return $this->delete("Course_Id=$id");
    }
    
    function deleteCommentByMaterialId($id){
        return $this->delete("Material_Id=$id");
    }

}

