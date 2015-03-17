<?php

class CommentsController extends Zend_Controller_Action
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
        $comment_info=array('body'=>'this is first comment','User_Id'=>4,'Course_Id'=>1);
       
         $comment_model=new Application_Model_Comments();
          $comment_model->addComment($comment_info);
    }

    public function editAction()
    {
        $comment_info=array('id'=>1,'body'=>'noo','User_Id'=> 4,'Course_Id'=>1);
       
         $comment_model=new Application_Model_Comments();
          $comment_model->editComment($comment_info);
    }

    public function deleteAction()
    {
       $id=1;
        if(!empty($id)){
             $comment_model=new Application_Model_Comments();
          $comment_model->deleteComment($id);
    }
    }

    public function listAction()
    {
        $comment_model=new Application_Model_Comments();
        $allComments=$comment_model->listComments();
        var_dump($allComments);
    }

    public function listcommentoncourseAction()
    {
        $id=1;
         $comment_model=new Application_Model_Comments();
        $selectedCommentOnCourse=$comment_model->getCommentOnCourse($id);
        var_dump($selectedCommentOnCourse);
    }

    public function listcommentbyuserAction()
    {
        $id=4;
         $comment_model=new Application_Model_Comments();
        $selectedCommentByUser=$comment_model->getCommentByUser($id);
        var_dump($selectedCommentByUser);
    }

    public function listcommentbyidAction()
    {
        $id=1;
         $comment_model=new Application_Model_Comments();
        $selectedCommentById=$comment_model->getCommentById($id);
        var_dump($selectedCommentById);
    }


}















