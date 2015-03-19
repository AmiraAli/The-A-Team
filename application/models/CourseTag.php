<?php

class Application_Model_CourseTag extends Zend_Db_Table_Abstract
{
    //table name
    protected $_name = "CourseTag";
    
    // add CourseTag
    function addCourseTag($data){
        $row = $this->createRow();
        $row->courseid = $data['courseid'];
        $row->tagid = $data['tagid'];
        return $row->save();
    }
    
    // list all CourseTag
    function listCourseTag(){
        
        return $this->fetchAll()->toArray();
    }
    
    // get CourseTag by id of course
    function getCourseTagByCourseId($id){
        $select=$this->select()->where(" courseid = ?",$id);
        return $this->fetchAll($select)->toArray();
    }
    
    // get CourseTag by id of tag
    function getCourseTagByTagId($id){

       $select=$this->select()->where(" tagid = ?",$id);
        return $this->fetchAll($select)->toArray();
    }
    
    // delete CourseTag by id of course 
    function deleteCourseTagByCourseId($CourseId){
        return $this->delete("courseid=$CourseId ");
    }
    
    // delete CourseTag by id of Tag
    function deleteCourseTagByTagId($tagid){
        return $this->delete("tagid=$tagid");
    }
   
    
    // delete CourseCategory by id of course and id of tag
    function deleteCourseCategory($CourseId,$TagId){
        return $this->delete(array("CourseId = ?"=>$CourseId ,"TagId = ?"=>$TagId));
    }

 

}




