<?php

class AnswersController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
         $authorization =Zend_Auth::getInstance();
    if(!$authorization->hasIdentity() && $this->_request->getActionName()!='login'){
         $this->redirect("Users/login");
    }
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
         
    }

    public function editAction()
    {
       $id = $this->_request->getParam("id");
        // to get current date
           $date = new Zend_Date();
        // Get object from form Answer
       $answer_info=array();
               // Get value from Answer POST
            $body = $this->_request->getParam("body");
            // to send Id to database
           $answer_info['id']=$id;
            $answer_info['body']=$body;
             $answer_info['date']=$date;
           // Get object from model Answer
         $answer_model=new Application_Model_Answers();
         // Calling edit answer function to edit data
          $answer_model->editAnswer($answer_info);
    }

    public function deleteAction()
    {
        $id=$this->_request->getParam("id");
        if(!empty($id)){
            
              $answer_row=new Application_Model_Answers();
             // Calling delete function to delete Answer by id
          $record=$answer_row->getAnswerById($id);
          $QuestionId=$record[0]['QuestionId'];
            // Get object from Answer model
             $answer_model=new Application_Model_Answers();
             // Calling delete function to delete Answer by id
          $answer_model->deleteAnswer($id);
          
        
         
    }
    // Redirct to list Answer
        $this->redirect("Questions/listquestionid/id/$QuestionId");
   
    }

    public function listAction()
    {
        $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();

// Get Object from Answers model
       $answer_model=new Application_Model_Answers();
       // Call list answer method from Answer model
        $allanswer=$answer_model->listAnswers();
        
        for($i=0;$i<count($allanswer);$i++){
         // Get object from User Model
         $user_info=new Application_Model_Users();
         // Get User row By Known User_Id
         $user_record=$user_info->getUserById($allquestion[$i]['UserId']);
         // Relate user name to request so append them in request array
           $allquestion[$i]['username']= $user_record[0]['name'];
            // Get Image accroding to User
             $allquestion[$i]['image']= $user_record[0]['image']; 
        }
        // current user Id get from session Id
        $currentUser=$sessionRead->id;
        // send all question with user name and image to the view 
        $this->view->questions =  $allquestion;
        // send id of current user to view
         $this->view->user =  $currentUser;
         $form=new Application_Form_Question();
         $this->view->form=$form;
    }


}









