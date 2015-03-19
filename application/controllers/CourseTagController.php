<?php

class CourseTagController extends Zend_Controller_Action
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
        $CourseTag_info=array("courseid"=>"13","tagid"=>"2");
        $CourseTag_model= new Application_Model_CourseTag();
        $CourseTag_model->addCourseTag($CourseTag_info);
    }

    public function listAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        var_dump($CourseTag_model->listCourseTag());
    }

    public function searchByCourseidAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        $courseid="15";
        var_dump($CourseTag_model->getCourseTagByCourseId($courseid));
    }

    public function searchByTagidAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        $tagid="1";
        var_dump($CourseTag_model->getCourseTagByTagId($tagid));
    }

    public function deleteByTagidAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        $tagid="1";
        var_dump($CourseTag_model->deleteCourseTagByTagId($tagid));
    }

    public function deleteByCourseidAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        $courseid="15";
        var_dump($CourseTag_model->deleteCourseTagByCourseId($courseid));
    }

    public function deleteAction()
    {
        $CourseTag_model= new Application_Model_CourseTag();
        $courseid="17";
         $tagid="2";
        var_dump($CourseTag_model->deleteCourseCategory($courseid, $tagid));
    }


}















