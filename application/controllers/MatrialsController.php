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
               $matrial_info=$form->getValues();
 
               $matrial_info['Course_Id']="16";
               $matrial_info['downloadable']="0";
               $matrial_info['path']=$matrial_info['file'];
               $matrial_info['no_downloads']="0";
               
               //get the id of type of material by type matrial name
               $type_name=$matrial_info["matrialtype"];
               
               $type_model=new Application_Model_Types();
               $type_info=$type_model->selectTypeByName($type_name);

               $type_id=$type_info[0]['id'];      
               $matrial_info['Type_Id']=$type_id;

               //insert in the database
               $material_model=new Application_Model_Materials();
               $material_model->insertMaterial($matrial_info);
           }
        }
        $this->view->form = $form;
    }


}



