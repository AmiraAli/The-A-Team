<?php

class HomeController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
    
    /**
     * this function to visit the home page
     */
    public function homeAction()
    {
        //select all categories and render it to the view
        $categories_model=new Application_Model_Categories();
        $categories_info=$categories_model->listCategories();
        
        $this->view->categories_info=$categories_info;
        
        
        //select 4 categories only
        $categories_limited=$categories_model->listLimitedCategories(4);
        $this->view->categories_limited=$categories_limited;
        
      
    }


}

