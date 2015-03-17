<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
// Test Insert
//        $data=array(
//            'name'=>'mac',
//            
//        );
//        $tag = new Application_Model_Tags();
//        $result=$tag->insertTag($data);
//        
//  /////////////////////////////////////////////// ////////////////////////////////////////////////////     
// Test Delete
//        $where=array(
//            'id'=>'3',
//        );
//        $tag = new Application_Model_Tags();
//        $result=$tag->deleteTag($where);
////////////////////////////////////////////////////////////////////////////////////////////////////////
//Test Select all
//       $tag = new Application_Model_Tags();
//       $result=$tag->selectAllTags();
//
//        foreach ($result as $value) {
//            echo $value;
//        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////////       
//        //Test select Tag
//        $where='6';
//        $tag = new Application_Model_Tags();
//        $result=$tag->selectTag($where);
//         foreach ($result as  $value) {
//             foreach ($value as $k) {
//                 echo $k.'<br   />'; 
//                 
//                 
//             }
//         }
//         
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
    }

    public function teadsstAction() {
        
    }

    public function testAction() {
        // TEST  updateMaterial
//         $where='1';
//         $data=array(
//             'name'=>'malek',
//             'downloadable'=>'1',
//             'path'=>'123456789',
//             'no_downloads'=>'160',
//             'Type_Id'=>'1',
//             'Course_Id'=>'1'
//         );
//         $conn= new Application_Model_Materials();
//         $conn->updateMaterial($where, $data);
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Test select all materials
//        $conn = new Application_Model_Materials();
//        $result = $conn->selectAllMatreials();
//        var_dump($result);
        
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $conn = new Application_Model_Materials();
        $where='mat1';
         $result = $conn->selectMaterialByName($where);
        var_dump($result);
        
    }

}
