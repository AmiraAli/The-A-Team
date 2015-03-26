<?php

class RequestsController extends Zend_Controller_Action
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
        $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();
          // Get object from form of Requests
          $form  = new Application_Form_Request();
       
       if($this->_request->isPost()){
           
           if($form->isValid($this->_request->getParams())){
               // Get value from  Post
               $request_info = $form->getValues();
               // User Id come from session Id of user
               $request_info['User_Id']=$sessionRead->id;
               // Get Object from Requests model
               $request_model = new Application_Model_Requests();
                // Calling add Request function to insert new Request
               $request_model->addRequest($request_info);
               // Redirect to list Request page 
                 $this->redirect("Requests/list");       
           }
       }
       // To send form to view
//	$this->view->form = $form;
       $this->redirect("Requests/list");

   
    }

    public function editAction()
    {  // get Id from URL 
         
        $id = $this->_request->getParam("id");
        
        // Get object from form Request
       $request_info=array();
               // Get value from Request POST
            $body = $this->_request->getParam("desc");
            // to send Id to database
           $request_info['id']=$id;
            $request_info['desc']=$body;
           // Get object from model Requests
         $request_model=new Application_Model_Requests();
         // Calling edit request function to edit data
          $request_model->editRequest($request_info);
          // redirect to list Request
                   // $this->redirect("Requests/list");

	 
          
        
    
    }

    public function deleteAction()
    {// Get id from url
        $id=$this->_request->getParam("id");
        if(!empty($id)){
            // Get object from Requests model
             $request_model=new Application_Model_Requests();
             // Calling delete function to delete request by id
          $request_model->deleteRequest($id);
    }
    // Redirct to list Request
        $this->redirect("Requests/list");
    }
    public function listAction()
    {

        $auth =Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead=$storage->read();

// Get Object from Requests model
       $request_model=new Application_Model_Requests();
       // Call list Requests method from Request model
        $allRequest=$request_model->listRequests();
        
        for($i=0;$i<count($allRequest);$i++){
         // Get object from User Model
         $user_info=new Application_Model_Users();
         // Get User row By Known User_Id
         $user_record=$user_info->getUserById($allRequest[$i]['User_Id']);
         // Relate user name to request so append them in request array
           $allRequest[$i]['username']= $user_record[0]['name'];
            // Get Image accroding to User
             $allRequest[$i]['image']= $user_record[0]['image']; 
        }
        // current user Id get from session Id
        $currentUser=$sessionRead->id;
        // send all request with user name and image to the view 
        $this->view->requests =  $allRequest;
        // send id of current user to view
         $this->view->user =  $currentUser;
         $form=new Application_Form_Request();
         $this->view->form=$form;
    }
    public function listrequestidAction()
    {
       //$id=4;
        // $request_model=new Application_Model_Requests();
        //$selectedRequestById=$request_model->getRequestById($id);
        //var_dump($selectedRequestById);
    }

    public function listrequestbyuserAction()
    {
        //$user_id='2';
        // $request_model=new Application_Model_Requests();
       //$selectedRequestByUser=$request_model->getRequestByUser($user_id);
        //var_dump($selectedRequestByUser);
    }


}













