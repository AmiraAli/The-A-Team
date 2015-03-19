<?php

class CoursesController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function addAction() {

        $course_info = array(
            "title" => "course title 1",
            "desc" => "course desc 1",
            "startdate" => "2015-01-03 00:00:00",
            "duration" => "7",
            "hidden" => "0",
        );
        $courses_model = new Application_Model_Courses();
        $courses_model->addCourse($course_info);
    }

    public function listAction() {
        $courses_model = new Application_Model_Courses();
        var_dump($courses_model->listCourses());
    }

    public function editAction() {
        $course_info = array(
            "id" => "13",
            "title" => "course title 1 edit",
            "desc" => "course desc 1 edit",
            "startdate" => "2015-01-03 00:00:00",
            "duration" => "7",
            "hidden" => "0",
        );
        $courses_model = new Application_Model_Courses();
        var_dump($courses_model->editCourse($course_info));
    }

    /**
     * This function used to open the page of sepecific course 
     */
    public function openAction() {
        /**
         * information of course
         */
        $courses_model = new Application_Model_Courses();
        //check if the id of course get from request or not
        if( $this->_request->getParam("id")){

            $id=$this->_request->getParam("id");
        }else{
        $id = 16;
        }
        //get the info of the course in array
        $course_info = $courses_model->getCourseById(($id));

        //send information of course opend to view
        $this->view->title = $course_info[0]['title'];
        $this->view->startdate = $course_info[0]['startdate'];
        $this->view->duration = $course_info[0]['duration'];
        $this->view->desc = $course_info[0]['desc'];
        $this->view->course_id = $course_info[0]['id'];

        /**
         * Course Material
         */
        //get all material of this course
        $material_model = new Application_Model_Materials();
        $material_info = $material_model->selectMaterialByCourseId($id);
        $this->view->material_info = $material_info;

        //get all types of the materials and save the id of types in array
        $arr_types_id = array();


        for ($j = 0; $j < count($material_info); $j++) {
            if (!in_array($material_info[$j]['Type_Id'], $arr_types_id)) {
                $arr_types_id[] = $material_info[$j]['Type_Id'];
            }
        }

        //send array of all types id to the view
        $this->view->arr_types_id = $arr_types_id;

        /**
         * Instractor Information
         */
        //select from UserCourse table all useres of this Course
        $UserCourse_model = new Application_Model_UserCourse();
        $all_users = $UserCourse_model->selectUserCourseByCourseId($id);


        //get the information of Instructor user

        $user_model = new Application_Model_Users();

        //get the id of Instructor of user
        for ($i = 0; $i < count($all_users); $i++) {

            $user_id = $all_users[$i]['User_Id'];

            $user_info = $user_model->getUserById($user_id);

            if ($user_info [0]['type'] == "Instructor") {

                $this->view->user_name = $user_info[0]['name'];
                $this->view->user_image = $user_info[0]['image'];
            }
        }


        /**
         * related courses
         */
        //get all tags of the course and save it in the array
        $arr_tags_id = array();

        $courseTag_model = new Application_Model_CourseTag();
        $courseTag_info = $courseTag_model->getCourseTagByCourseId($id);
        for ($i = 0; $i < count($courseTag_info); $i++) {
            if (!in_array($courseTag_info[$i]['tagid'], $arr_tags_id)) {
                $arr_tags_id[] = $courseTag_info[$i]['tagid'];
            }
        }

        $this->view->arr_tags_id = $arr_tags_id;
    }

    public function deleteAction() {
        $courses_model = new Application_Model_Courses();
        $id = 14;
        $courses_model->deleteCourse($id);
    }

    //select function to make select with hidden condition
    public function selectAction() {
        $courses_model = new Application_Model_Courses();
        $hidden = "0";
        var_dump($courses_model->getCourseByHiddenOption($hidden));
    }

}
