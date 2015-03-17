<?php

class Application_Model_Courses extends Zend_Db_Table_Abstract
{
    //table name
    protected $_name = "Courses";
    
    // add course
    function addCourse($data){
        $row = $this->createRow();
        $row->title = $data['title'];
        $row->desc = $data['desc'];
        $row->startdate = $data['startdate'] ;
        $row->duration=$data['duration'];
        $row->hidden = $data['hidden'] ;
        return $row->save();
    }
    
    // list all courses
    function listCourses(){
        
        return $this->fetchAll()->toArray();
    }
    
    // get course by id
    function getCourseById($id){
        return $this->find($id)->toArray();
    }
    
    // get course by hidden condition
    function getCourseByHiddenOption($hidden){

        $select=$this->select()->where(" hidden = ?",$hidden);
        return $this->fetchAll($select)->toArray();
    }
    
    // edit course data
    function editCourse($data){
        $this->update($data, "id=".$data['id']);
        return $this->fetchAll()->toArray();
    }
    
    // delete course by id of course
    function deleteCourse($id){
        return $this->delete("id=$id");
    }

    
}
