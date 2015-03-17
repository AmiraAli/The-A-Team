<?php

class Application_Model_UserCourse extends Zend_Db_Table_Abstract
{
    protected $_name='UserCourse';
    
    function InsertUserCourse($data){
        
        $row = $this->createRow();
        $row->User_Id = $data['User_Id'];
        $row->Course_Id = $data['Course_Id'];
        return $row->save();
    
    }
    
    function deleteUserCourseByUserId($where){
        return $this->delete("User_Id=$where");
    }
    
     function deleteUserCourseByCourseId($where){
        return $this->delete("Course_Id=$where");
    }
    
    function selectUserCourseByUserId($where){
        return $this->fetchAll("User_Id=$where")->toArray();
    }
    
     function selectUserCourseByCourseId($where){
        return $this->fetchAll("Course_Id=$where")->toArray();
    }
    function selectUserCourse(){
        return $this->fetchAll()->toArray();
    }
}

