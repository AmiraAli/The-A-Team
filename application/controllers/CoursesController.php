<?php

class CoursesController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */

        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity() && $this->_request->getActionName() != 'login') {
            $this->redirect("Users/login");
        }
    }

    public function indexAction() {
        // action body
    }

    /**
     * This function used to open the page of sepecific course 
     */
    public function openAction() {
        /**
         * information of course
         */
        $courses_model = new Application_Model_Courses();




        //get the id of course from the request
        $id = $this->_request->getParam("id");


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

        /**
         * send form of add material 
         */
        $addMaterial_form = new Application_Form_Matrial();
        $this->view->addMaterial_form = $addMaterial_form;

        /**
         * Submit Add material from the form
         */
        if ($this->_request->isPost()) {
            if ($addMaterial_form->isValid($this->_request->getParams())) {
                $matrial_info = $addMaterial_form->getValues();

                $matrial_info['Course_Id'] = $id;
                $matrial_info['downloadable'] = "1";
                $matrial_info['path'] = $matrial_info['file'];
                $matrial_info['no_downloads'] = "0";

                //get the id of type of material by type matrial name
                $type_name = $matrial_info["matrialtype"];

                $type_model = new Application_Model_Types();
                $type_info = $type_model->selectTypeByName($type_name);

                $type_id = $type_info[0]['id'];
                $matrial_info['Type_Id'] = $type_id;

                //insert in the database
                $material_model = new Application_Model_Materials();
                $material_model->insertMaterial($matrial_info);
                
                
            }
        }
    }

    /**
     * This function to show /download this material
     */
    public function showAction() {

        //get the id of the material and find it`s type
        $material_id = $this->_request->getParam("id");

        $material_model = new Application_Model_Materials();
        $material_info = $material_model->selectMaterialById($material_id);

        $ext = explode('.', $material_info[0]['path']);

        $ext = end($ext);

        if ($ext === "mp3" || $ext === "mp4") {
            $type = "vidio";
        } else {
            $type = "nonvidio";
        }

        $this->view->type = $type;
        $this->view->name = $material_info[0]['name'];
        $this->view->path = $material_info[0]['path'];
        $this->view->materialid = $material_info[0]['id'];
        $this->view->downloadable = $material_info[0]['downloadable'];
        $this->view->courseid = $material_info[0]['Course_Id'];

        //if the file downloadable
        //increase no of dowanloads when show the material
        if ($material_info[0]['downloadable']) {
            $no_downloads = intval($material_info[0]['no_downloads']);
            $no_downloads+=1;

            $matrial_data = array('id' => $material_info[0]['id'], 'name' => $material_info[0]['name']
                , 'downloadable' => $material_info[0]['downloadable']
                , 'path' => $material_info[0]['path'], 'no_downloads' => $no_downloads
                , 'Type_Id' => $material_info[0]['Type_Id'], 'Course_Id' => $material_info[0]['Course_Id']
                , 'hidden' => $material_info[0]['hidden']);
            $material_model->editMaterial($matrial_data);
        }

        /**
         * get all comments on the material
         */
        $comment_model = new Application_Model_Comments();
        $comment_info = $comment_model->getCommentOnMaterial($material_id);

        $this->view->comments = $comment_info;

        $comment_form = new Application_Form_Comment();
        $this->view->comment_form = $comment_form;


        /**
         * Submit Add comment on material
         */
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();
        $type = $sessionRead->type;
        if ($type == "Instructor" || $type == "Student") {

            $user_id = $sessionRead->id;
        }
        $course_id = $material_info[0]['Course_Id'];

        if ($this->_request->isPost()) {
            if ($comment_form->isValid($this->_request->getParams())) {
                $comment_info = $comment_form->getValues();
                $comment_info['User_Id'] = $user_id;
                $comment_info['Course_Id'] = $course_id;
                $comment_info['Material_Id'] = $material_id;

                $comment_model->insert($comment_info);
                $this->redirect("Courses/show/id/$material_id");
            }
        }
    }

    /**
     * this function to delete the material
     */
    public function deleteAction() {

        //get the id of the material and delete it
        $material_id = $this->_request->getParam("id");

        $material_model = new Application_Model_Materials();
        $material_info = $material_model->selectMaterialById($material_id);
        $material_model->deleteMaterialById($material_id);
        $file = trim($material_info[0]['path']);
        unlink("/var/www/html/The-A-Team/public/materials/$file");

        $course_id = $this->_request->getParam("courseid");
        $this->redirect("Courses/open/id/$course_id");
    }

    /**
     * this function to join course
     */
    public function joinAction() {

        $user_id = $this->_request->getParam("userid");
        $course_id = $this->_request->getParam("courseid");

        $courseUser_model = new Application_Model_UserCourse();

        $data = array('User_Id' => $user_id, 'Course_Id' => $course_id);
        $courseUser_model->InsertUserCourse($data);
    }

    /**
     * this function to unjoin course
     */
    public function unjoinAction() {

        $user_id = $this->_request->getParam("userid");
        $course_id = $this->_request->getParam("courseid");

        $courseUser_model = new Application_Model_UserCourse();

        $courseUser_model->deleteUserCourseByUserId_Course_Id($user_id, $course_id);
    }

}
