<?php

class Application_Model_Questions extends Zend_Db_Table_Abstract
{
 protected $_name = "Questions";
    
    
    function addQuestion($data){
        $row = $this->createRow();
        $row->CourseId = $data['CourseId'];
        
      
        $row->UserId = $data['UserId'];
        //$row->date = $data['date'];
        $row->title = $data['title'];
      
        $row->body = $data['body'];
       
        
        return $row->save();
    }
    function listQuestions(){
        
        return $this->fetchAll()->toArray();
    }
   
    function getQuestionById($id){
        return $this->find($id)->toArray();
    }
    
    function getQuestionByUser($UserId){
        $select =$this->select()->where('UserId = ?', $UserId);
        return $this->fetchAll($select)->toArray();
    }
    function getQuestionByCourse($CourseId){
        $select =$this->select()->where('CourseId = ?', $CourseId);
        return $this->fetchAll($select)->toArray();
    }
    
   
    function editQuestion($data){
        
            
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
   
    function deleteQuestion($id){
        return $this->delete("id=$id");
    }
    function deleteQuestionByUser($id){
        return $this->delete("UserId=$id");
    }

}

