<?php

class UsersController extends Zend_Controller_Action
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
//$user_info=array('name'=>'aya','email'=>'yoyo_tok@yahoo.com','password'=>'411','image'=>'test1.jpg','active'=>'0','type'=>'Admin','gender'=>'male','country'=>'alex','facebookid'=>'2');
  //      $user_model=new Application_Model_Users();
    //     $user_model->addUser($user_info);
         
         
        $form  = new Application_Form_User();
        
        if($this->_request->isPost()){
           if($form->isValid($this->_request->getParams())){
               $user_info = $form->getValues();
               $user_info['type']='Student';
               $user_info['active']='1';
               $user_model = new Application_Model_Users();
               unset($user_info['confirmpassword']);
               $user_model->addUser($user_info);
                       
           }
       }
       
	$this->view->form = $form;
         
         
    }

    public function editAction()
    {
        
        $id=2;
        // Get user Id from Url 
        //$id = $this->_request->getParam("id");
        // Get Object from User form 
        $form  = new Application_Form_User();
        //$form->getElement("password")->setRequired(false);
      $form->getElement("email")->removeValidator(Zend_Validate_Db_NoRecordExists);

        // Check if data is posted 
        if($this->_request->isPost()){
            // Check is Data is valid
           if($form->isValid($this->_request->getParams())){
               
               // To take value from the Form is valid 
               $user_info = $form->getValues();
               // Get object from Users Model
               
               $user_model = new Application_Model_Users();
               unset($user_info['confirmpassword']);
               $user_info['id']=$id;
               // call Edit user function from the model to update the data 
               
               $user_model->editUser($user_info);
               
                       
           }
        }
        // If the id is exit
        if(!empty($id)){
            // Get object from users model
            $user_model = new Application_Model_Users();
            // Get user data from id
            $user = $user_model->getUserById($id);
           
            // fill the form with user data 
            $form->populate($user[0]);
           
        } //else
          //  $this->redirect("user/list");
        
        
       
        $this->view->form = $form;
	$this->render('add');
        
    }

    public function deleteAction()
    {
$id=1;
        if(!empty($id)){
            $user_model = new Application_Model_Users();
            $user_model->deleteUser($id);
        }
    }

    public function listAction()
    {
        $user_model = new Application_Model_Users();
        $allUser=$user_model->listUsers();
        var_dump($allUser);
    }

    public function listuseridAction()
    {
        $id=4;// will get id from session
        // open object from Users model
        $user_model = new Application_Model_Users();
        // Select User By Id
        $selectedUserById=$user_model->getUserById($id);
        // Send the data of selected User to the view 
        $this->view->user = $user_model->getUserById($id);
        //open object from UserCourse model
        $usercourse_model = new Application_Model_UserCourse();
        // Select cource By User Id
        $selectedUserCourseByUserId=$usercourse_model->selectUserCourseByUserId($id);
        // This is empty array to save the data about the course 
        $selectedCourse=array();
        
        
        for($i=0;$i<count($selectedUserCourseByUserId) ;$i++){
            // Get object from Courses model
        $course_model = new Application_Model_Courses();
        // Get data about the course from course Id related to user_id
        $selectedCourseById=$course_model->getCourseById($selectedUserCourseByUserId[$i]['Course_Id']);
         
        if($selectedCourseById[0]['hidden']=='0')
            // To append data about the non hidden course to the array 
         $selectedCourse[]=  $selectedCourseById;  
        }
        
        
        // Send SElected Course to view
        $this->view->usercourse = $selectedCourse;

       
    }

    public function listusertypeAction()
    {
        $type="Admin";
        $user_model = new Application_Model_Users();
       $selectedUserByType=$user_model->getUserByType($type);
        var_dump($selectedUserByType);
    }


}













