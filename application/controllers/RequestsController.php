<?php

class RequestsController extends Zend_Controller_Action
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
        
          
          $form  = new Application_Form_Request();
       
       if($this->_request->isPost()){
           if($form->isValid($this->_request->getParams())){
               $request_info = $form->getValues();
               //$request_info['User_Id']=2;
               $request_model = new Application_Model_Requests();
               $request_model->addRequest($request_info);
                 $this->redirect("Requests/list");       
           }
       }
       
	$this->view->form = $form;

   
    }

    public function editAction()
    {
        $id = $this->_request->getParam("id");
       $form  = new Application_Form_Request();
        if($this->_request->isPost()){
           if($form->isValid($this->_request->getParams())){
            $request_info = $form->getValues();    
           $request_info['id']=$id;
         $request_model=new Application_Model_Requests();
          $request_model->editRequest($request_info);
                    $this->redirect("Requests/list");

	 
           }
        }
           if(!empty($id)){
            $request_model = new Application_Model_Requests();
            $request = $request_model->getRequestById($id);
            
            
            $form->populate($request[0]);
        } else
       
        $this->redirect("Requests/list");
        
       $this->view->form = $form;
      $this->render('add');  
        
    
    }

    public function deleteAction()
    {
        $id=$this->_request->getParam("id");
        if(!empty($id)){
             $request_model=new Application_Model_Requests();
          $request_model->deleteRequest($id);
    }
        $this->redirect("Requests/list");
    }
    public function listAction()
    {
       $request_model=new Application_Model_Requests();
        $allRequest=$request_model->listRequests();
        $this->view->requests = $request_model->listRequests();
    }

    public function listrequestidAction()
    {
       $id=4;
         $request_model=new Application_Model_Requests();
        $selectedRequestById=$request_model->getRequestById($id);
        var_dump($selectedRequestById);
    }

    public function listrequestbyuserAction()
    {
        $user_id='2';
         $request_model=new Application_Model_Requests();
       $selectedRequestByUser=$request_model->getRequestByUser($user_id);
        var_dump($selectedRequestByUser);
    }


}













