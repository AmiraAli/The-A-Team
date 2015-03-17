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
$user_info=array('name'=>'aya','email'=>'yoyo_tok@yahoo.com','password'=>'411','image'=>'test1.jpg','active'=>'0','type'=>'Admin','gender'=>'male','country'=>'alex','facebookid'=>'2');
        $user_model=new Application_Model_Users();
         $user_model->addUser($user_info);
    }

    public function editAction()
    {
        $user_info=array('id'=>2,'name'=>'esraa','email'=>'yoyo@yahoo.com','password'=>'11','image'=>'test.jpg','active'=>'0','type'=>'Student','gender'=>'male','country'=>'alex','facebookid'=>'1');
           $user_model=new Application_Model_Users();
         $user_model->editUser($user_info);
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
        $id=4;
        $user_model = new Application_Model_Users();
        $selectedUserById=$user_model->getUserById($id);
        var_dump($selectedUserById);
    }

    public function listusertypeAction()
    {
        $type="Admin";
        $user_model = new Application_Model_Users();
       $selectedUserByType=$user_model->getUserByType($type);
        var_dump($selectedUserByType);
    }


}













