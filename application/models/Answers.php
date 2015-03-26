<?php

class Application_Model_Answers extends Zend_Db_Table_Abstract
{
 protected $_name = "Answers";
    
    
    function addAnswer($data){
        $row = $this->createRow();
        $row->QuestionId = $data['QuestionId'];
        $row->UserId = $data['UserId'];
      
        //$row->date = $data['date'];
       $row->body = $data['body'];
        
        return $row->save();
    }
    function listAnswers(){
        
        return $this->fetchAll()->toArray();
    }
   
    function getAnswerById($id){
        return $this->find($id)->toArray();
    }
    
    function getAnswerByQuestion($QuestionId){
        $select =$this->select()->where('QuestionId = ?', $QuestionId);
        return $this->fetchAll($select)->toArray();
    }
    
   
    function editAnswer($data){
        
            
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
   
    function deleteAnswer($id){
        return $this->delete("id=$id");
    }
    function deleteAnswerByQuestion($id){
        return $this->delete("QuestionId=$id");
    }

}

