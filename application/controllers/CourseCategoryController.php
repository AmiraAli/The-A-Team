<?php

class CourseCategoryController extends Zend_Controller_Action
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
        $CourseCategory_info=array("courseid"=>"15","categoryid"=>"5");
        $CourseCategory_model= new Application_Model_CourseCategory();
        $CourseCategory_model->addCourseCategory($CourseCategory_info);
    }

    public function listAction()
    {
        $CourseCategory_model= new Application_Model_CourseCategory();
        var_dump($CourseCategory_model->listCourseCategory());
    }

    public function searchByCourseidAction()
    {
        $CourseCategory_model= new Application_Model_CourseCategory();
        $courseid="13";
        var_dump($CourseCategory_model->getCourseCategoryByCourseId($courseid));
    }

    public function searchByCategoryidAction()
    {
$CourseCategory_model= new Application_Model_CourseCategory();
        $categoryid="5";
        var_dump($CourseCategory_model->getCourseCategoryByCourseId($categoryid));
    }

    public function deleteByCategoryidAction()
    {
        $CourseCategory_model= new Application_Model_CourseCategory();
        $categoryid="5";
        var_dump($CourseCategory_model->deleteCourseCategoryByCategoryId($categoryid));
    }

    public function deleteByCourseidAction()
    {
        $CourseCategory_model= new Application_Model_CourseCategory();
        $courseid="13";
        var_dump($CourseCategory_model->deleteCourseCategoryByCourseId($courseid));
    }

    public function deleteAction()
    {
        $CourseCategory_model= new Application_Model_CourseCategory();
        $courseid="15";
        $categoryid="1";
        var_dump($CourseCategory_model->deleteCourseCategory($courseid, $categoryid));
    }


}















