<?php

class CoursesController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {

        $course_info=array(
                            "title"=>"course title 1",
                            "desc"=>"course desc 1",
                            "startdate"=>"2015-01-03 00:00:00",
                            "duration"=>"7",
                            "hidden"=>"0",            
                        );
       $courses_model = new Application_Model_Courses();
       $courses_model->addCourse($course_info);
       
    }

    public function listAction()
    {
        $courses_model = new Application_Model_Courses();
        var_dump($courses_model->listCourses()) ;
    }

    public function editAction()
    {
        $course_info=array(
                            "id"=>"13",
                            "title"=>"course title 1 edit",
                            "desc"=>"course desc 1 edit",
                            "startdate"=>"2015-01-03 00:00:00",
                            "duration"=>"7",
                            "hidden"=>"0",            
                        );
        $courses_model = new Application_Model_Courses();
        var_dump($courses_model->editCourse($course_info)) ;
    }

    public function openAction()
    {
        $courses_model = new Application_Model_Courses();
        $id=13;
        var_dump($courses_model->getCourseById(($id)));
    }

    public function deleteAction()
    {
        $courses_model = new Application_Model_Courses();
        $id=14;
        $courses_model->deleteCourse($id);
    }

    //select function to make select with hidden condition
    public function selectAction()
    {
        $courses_model = new Application_Model_Courses();
        $hidden="0";
       var_dump($courses_model->getCourseByHiddenOption($hidden));
    }


}













