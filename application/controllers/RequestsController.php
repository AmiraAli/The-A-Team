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
        $request_info=array('desc'=>'this is aya','User_Id'=>4);
       
         $request_model=new Application_Model_Requests();
          $request_model->addRequest($request_info);
    }

    public function editAction()
    {
        $request_info=array('id'=>1,desc=>'noo','User_Id'=> '4');
       
         $request_model=new Application_Model_Requests();
          $request_model->editRequest($request_info);
            
    }

    public function deleteAction()
    {
        $id=1;
        if(!empty($id)){
             $request_model=new Application_Model_Requests();
          $request_model->deleteRequest($id);
    }
    }
    public function listAction()
    {
       $request_model=new Application_Model_Requests();
        $allRequest=$request_model->listRequests();
        var_dump($allRequest);
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













