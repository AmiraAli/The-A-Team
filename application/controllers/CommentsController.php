<?php

class CommentsController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function editAction() {

         //get the body and the id of comment from the post
        $id = $this->_request->getParam("id");
        $body = $this->_request->getParam("body");
        $material_id=$this->_request->getParam("materialid");
        $comment_model = new Application_Model_Comments();
        
        //select the comment info and change it`s body only
        $comment_info=$comment_model->getCommentById($id);
        
        $comment_info_updated=array('id'=>$id,'body'=>$body,'User_Id'=>$comment_info[0]['User_Id'],
                                     'Course_Id'=>$comment_info[0]['Course_Id'],'Material_Id'=>$comment_info[0]['Material_Id']);
        

        $comment_model->editComment($comment_info_updated);
//        $this->redirect("Courses/show/id/$material_id");
    }

    /**
     * this function to remove comment on material
     */
    public function deleteAction() {
        $id = $this->_request->getParam("id");
        $material_id = $this->_request->getParam("materialid");
        if (!empty($id)) {
            $comment_model = new Application_Model_Comments();
            $comment_model->deleteComment($id);
            $this->redirect("Courses/show/id/$material_id");
        }
    }

}
