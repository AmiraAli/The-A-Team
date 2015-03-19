<?php

class Application_Model_CourseCategory extends Zend_Db_Table_Abstract
{
    //table name
    protected $_name = "CourseCategory";
    
    // add CourseCategory
    function addCourseCategory($data){
        $row = $this->createRow();
        $row->courseid = $data['courseid'];
        $row->categoryid = $data['categoryid'];
        return $row->save();
    }
    
    // list all CourseCategory
    function listCourseCategory(){
        
        return $this->fetchAll()->toArray();
    }
    
    // get CourseCategory by id of course
    function getCourseCategoryByCourseId($id){
        $select=$this->select()->where(" courseid = ?",$id);
        return $this->fetchAll($select)->toArray();
    }
    
    // get CourseCategory by id of category
    function getCourseCategoryByCategoryId($id){

       $select=$this->select()->where(" categoryid = ?",$id);
        return $this->fetchAll($select)->toArray();
    }
    
    // delete CourseCategory by id of course 
    function deleteCourseCategoryByCourseId($CourseId){
        return $this->delete("CourseId=$CourseId ");
    }
    
    // delete CourseCategory by id of category
    function deleteCourseCategoryByCategoryId($CategoryId){
        return $this->delete("CategoryId=$CategoryId");
    }
   
    
    // delete CourseCategory by id of course and id of category
    function deleteCourseCategory($CourseId,$CategoryId){
        return $this->delete(array("CourseId = ?"=>$CourseId ,"CategoryId = ?"=>$CategoryId));
    }

 

}


