<?php

class CategoryController extends Zend_Controller_Action
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
        $cat_name=array("name"=>"category name 2",);
        $category_model= new Application_Model_Categories();
        $category_model->addCategory($cat_name);
    }

    public function editAction()
    {
        $cat_info=array("id"=>"1","name"=>"category name 1 edit");
        $category_model= new Application_Model_Categories();
        var_dump($category_model->editCategory($cat_info));
    }

    public function listAction()
    {
      $category_model= new Application_Model_Categories();
        var_dump($category_model->listCategories());
    }

    public function deleteAction()
    {
        $category_model= new Application_Model_Categories();
        $id=2;
        $category_model->deleteCategory($id);
    }

    public function openAction()
    {
        $category_model= new Application_Model_Categories();
        $id=1;
       var_dump( $category_model->getCategoryById($id));
    }

    public function searchAction()
    {
        $category_model= new Application_Model_Categories();
        $name="category name 1 edit";
       var_dump( $category_model->getCategoryByName(trim($name)));
    }


}















