<?php

class QuestionsController extends Zend_Controller_Action
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
        // Get object from form Question
       $question_info=array();
               // Get value from Question POST
            $body = $this->_request->getParam("body");
            $title = $this->_request->getParam("title");
            // to send Id to database
           $question_info['id']=$id;
            $question_info['body']=$body;
            //$question_info['date']=$date;
            $question_info['title']=$title;
           // Get object from model Questions
         $question_model=new Application_Model_Questions();
         // Calling edit question function to edit data
          $question_model->editQuestion($question_info);
        
    }

    public function deleteAction()
    {
       $id=$this->_request->getParam("id");
        if(!empty($id)){
            // Get object from Question model
             $question_model=new Application_Model_Questions();
             // Calling delete function to delete question by id
          $question_model->deleteQuestion($id);
    }
    // Redirct to list Question
    $this->redirect("Questions/listquestionid/id/$id");
        
    }

    public function listAction()
    {
        
    }

    public function listquestionidAction()
    {   $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();
      // to Get Question Id
       $QuestionId=$this->_request->getParam("id");
       $question_info=new Application_Model_Questions();
       $questions=$question_info->getQuestionById($QuestionId);
       for($i=0;$i<count($questions);$i++){
       $user_info=new Application_Model_Users();
         // Get User row By Known User_Id
         $user_record=$user_info->getUserById($questions[$i]['UserId']);
         // Relate user name to request so append them in request array
           $questions[$i]['username']= $user_record[0]['name'];
            // Get Image accroding to User
             $questions[$i]['image']= $user_record[0]['image']; 
       }
       $this->view->questions=$questions;
       $this->view->courseid=$questions[0]['CourseId'];
       
       $answer_info=new Application_Model_Answers();
        $question_answer=$answer_info->getAnswerByQuestion($QuestionId);
        for($i=0;$i<count($question_answer);$i++){
       $user_info=new Application_Model_Users();
         // Get User row By Known User_Id
         $user_record=$user_info->getUserById($question_answer[$i]['UserId']);
         // Relate user name to request so append them in request array
           $question_answer[$i]['username']= $user_record[0]['name'];
            // Get Image accroding to User
             $question_answer[$i]['image']= $user_record[0]['image']; 
       }
       $this->view->answer=$question_answer;
       $form_answer=new Application_Form_Answer();
       $this->view->addanswer=$form_answer;
        // current user Id get from session Id
        $currentUser=$sessionRead->id;
        // send id of current user to view
         $this->view->user =  $currentUser;
         
         //$id = $this->_request->getParam("id");
        $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();
          // Get object from form of Answer
          $form  = new Application_Form_Answer();
          // to get current date
           $date = new Zend_Date();
     
    // Output of the current timestamp
    
       if($this->_request->isPost()){
           
           if($form->isValid($this->_request->getParams())){
               // Get value from  Post
               $answer_info = $form->getValues();
               // Course Id come from Url 
               $answer_info['QuestionId']=$QuestionId;
                // to store date
               // $answer_info['date']=$date;
                 $answer_info['UserId']=$sessionRead->id;
               // Get Object from answers model
               $answer_model = new Application_Model_Answers();
                // Calling add Answer function to insert new Answer
               $answer_model->addAnswer($answer_info);
               // Redirect to list Answer page 
                 $this->redirect("Questions/listquestionid/id/$QuestionId");       
           }
       }
       
    }

    public function listquestionbycourseAction()
    { // to Get Course Id
       $CourseId=$this->_request->getParam("id");
       $question_info=new Application_Model_Questions();
       $course_questions=$question_info->getQuestionByCourse($CourseId);
       $this->view->questions=$course_questions;
       $form=new Application_Form_Question();
       $this->view->form=$form;
       $this->view->courseid=$CourseId;
       
       
       
       
//$id = $this->_request->getParam("id");
        $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();
          // Get object from form of Question
          $form  = new Application_Form_Question();
          // to get current date
           $date = new Zend_Date();
     
    // Output of the current timestamp
    
       if($this->_request->isPost()){
           
           if($form->isValid($this->_request->getParams())){
               // Get value from  Post
               $question_info = $form->getValues();
               // User Id come from session Id of user
               $question_info['UserId']=$sessionRead->id;
                // to store date
               // $question_info['date']=$date;
                 $question_info['CourseId']=$CourseId;
               // Get Object from Questions model
               $question_model = new Application_Model_Questions();
                // Calling add Question function to insert new Question
               $question_model->addQuestion($question_info);
               // Redirect to list Question page 
                 $this->redirect("Questions/listquestionbycourse/id/$CourseId");       
           }
       }       
       
       
    }


}













