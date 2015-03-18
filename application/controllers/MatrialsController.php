<?php

class MatrialsController extends Zend_Controller_Action
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
        $form  = new Application_Form_Matrial();
        if($this->_request->isPost()){
           if($form->isValid($this->_request->getParams())){
               
           }
        }
        $this->view->form = $form;
    }


}



