<?php

class ControlRoomController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listUsers()
    {
        $users = new Application_Model_Users();
        $_myusers = $users->listUsers();
        var_dump($_myusers);
    }

    public function listCourses()
    {
        $Courses = new Application_Model_Courses();
        $_myCourses = $Courses->listCourses();
        var_dump($_myCourses);
    }

    public function listCategory()
    {
        $Category = new Application_Model_Categories();
        $_myCategory = $Category->listCategories();
        var_dump($_myCategory);
    }

    public function listMaterials()
    {
        $Materials = new Application_Model_Materials();
        $_Materials = $Materials->selectAllMatreials();
        var_dump($_Materials);
    }

    public function adminAction()
    {
        
        $request = $this->getRequest();
        $form = new Application_Form_Search();
        if ($this->getRequest()->isPost()) {
            switch ($_POST['search']){
                case 'Courses' :
                    $list=  json_encode($this->listCourses());
                    break;
                 case 'Users' :
                     $list=$this->listUsers();
                    break;
                 case 'Materials' :
                     $list=$this->listMaterials();
                    break;
                 case 'Categories' :
                     $list=$this->listCategory();
                    break;
                default :
                    $list="Please select Criteria";
                    break;
                
                
            }
            
        }

        $this->view->form = $form;
    }



}


