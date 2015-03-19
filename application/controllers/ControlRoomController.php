<?php

class ControlRoomController extends Zend_Controller_Action {

    public function init() {
//        $contextSwitch=$this->_helper->getHelper('contextSwitch');
//        $contextSwitch->addActionContext('admin','json')
//                                ->initContext();
    }

    public function indexAction() {
        // action body
    }

    public function listUsers() {
        $users = new Application_Model_Users();
        $_myusers = $users->listUsers();
        return $_myusers;
    }

    public function listCourses() {
        $Courses = new Application_Model_Courses();
        $_myCourses = $Courses->listCourses();
        return $_myCourses;
    }

    public function listCategory() {
        $Category = new Application_Model_Categories();
        $_myCategory = $Category->listCategories();
        return $_myCategory;
    }

    public function listMaterials() {
        $Materials = new Application_Model_Materials();
        $_Materials = $Materials->selectAllMatreials();
        return $_Materials;
    }

    public function listCourseComments() {
        $Comments = new Application_Model_Comments();
        $_Comments = $Comments->listComments();
        return $_Comments;
    }

    public function listMaterialsTypes($where) {
        $LMT = new Application_Model_Types();
        $_LMT = $LMT->selectTypeById($where);
        return $_LMT;
    }

    public function getMeTypeName($where) {
        $type = $this->listMaterialsTypes($where);
        return $type[0]['name'];
    }

    public function getMeCourseName($where) {
        $name = new Application_Model_Courses();
        $_name = $name->getCourseById($where);
        return $_name[0]['title'];
    }

    public function getMeUserName($where) {
        $uname = new Application_Model_Users();
        $_uname = $uname->getUserById($where);
        return $_uname[0]['name'];
    }

    public function adminAction() {

        $request = $this->getRequest();
        $search = new Application_Form_Search();
        $addcategory = new Application_Form_AddCategory();
        if ($this->getRequest()->isPost()) {
            switch ($_POST['search']) {
                case 'Courses' :
                    $data = $this->listCourses();

                    $list = array('decoration' => '<table class="table-hover"  border="1" id="courses"><tr><th>id</th><th>Title</th><th>Description</th>'
                        . '<th>Start Date</th><th>Duration</th><th>Hidden</th><th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['title'] . '</td><td>' . $data[$i]['desc'] . '</td>'
                                . '<td>' . $data[$i]['startdate'] . '</td><td>' . $data[$i]['duration'] . ' weeks </td><td class="status">' . $data[$i]['hidden'] . '</td>'
                                . '<td><button class="delete">Delete</button><button class="edit">Edit</button>'
                                . '<button class="myhide">Hide</button></td></tr>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];

                    break;
                case 'Users' :
                    $data = $this->listUsers();
                    $list = array('decoration' => '<table  class="table-hover" border="1" id="users"><tr><th>id</th><th>Email</th>'
                        . '<th>Image</th><th>Active</th><th>Type</th><th>Gender</th><th>Country</th><th>Facebook ID</th>'
                        . '<th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td >' . $data[$i]['email'] . '</td>'
                                . '<td>' . $data[$i]['image'] . '</td><td class="active">' . $data[$i]['active'] . ' </td><td>' . $data[$i]['type'] . '</td>' . '<td>' . $data[$i]['gender'] . '</td>'
                                . '<td>' . $data[$i]['country'] . '</td>' . '<td>' . $data[$i]['facebookid'] . '</td>' . '<td><button class="delete">Delete</button><button class="edit">Edit</button>'
                                . '<button class="ban">Ban</button></td></tr>';
                    }
                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];


                    break;
                case 'Materials' :
                    $data = $this->listMaterials();

                    $list = array('decoration' => '<table class="table-hover"  border="1" id="materials"><tr><th>id</th><th>Name</th><th>Downloadable</th>'
                        . '<th>Path</th><th>Number of Downloads</th><th>hidden</th><th>Type</th><th>Course Name</th>'
                        . '<th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['name'] . '</td><td  id="down">' . $data[$i]['downloadable'] . '</td>'
                                . '<td>' . $data[$i]['path'] . '</td><td>' . $data[$i]['no_downloads'] . '</td><td class="status">' . $data[$i]['hidden'] . '</td><td>' . $this->getMeTypeName($data[$i]['Type_Id']) . '</td><td>' . $this->getMeCourseName($data[$i]['Course_Id']) . '</td>'
                                . '<td><button class="delete">Delete</button><button class="edit">Edit</button>'
                                . '<button class="myhide">Hide</button><button class="mylock">Lock</button></td></tr>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];

                    break;
                case 'Categories' :
                    $data = $this->listCategory();

                    $list = array('decoration' => '<table class="table-hover" border="1" id="categories"><tr><th>id</th><th>Name</th><th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['name'] . '</td>'
                                . '<td><button class="delete">Delete</button><button class="edit">Edit</button>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];
                    break;
                case 'Comments':
                    $data = $this->listCourseComments();

                    $list = array('decoration' => '<table class="table-hover" border="1" id="comments"><tr><th>id</th><th>Body</th><th>User Name</th>'
                        . '<th>Course Name</th><th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['body'] . '</td>'
                                . '</td><td>' . $this->getMeUserName($data[$i]['User_Id']) . '</td><td>' . $this->getMeCourseName($data[$i]['Course_Id']) . '</td>'
                                . '<td><button class="delete">Delete</button><button class="edit">Edit</button>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];
                    break;
                default :
                    $data = "Please select Criteria";
                    break;
            }
        }

        $this->view->search = $search;
        $this->view->addcategory=$addcategory;

        if ($this->getRequest()->isPost()) {
            switch (@$_POST['process']) {
                //// Select Which Process To Preform
                //// del => Delete
                //// edit => Edit
                /// ban => Ban user
                /// hide => Hide Course

                case 'del':

                    switch ($_POST['table']) {

                        case 'users' :
                            /// delete user comments 
                            $delcomment = new Application_Model_Comments();
                            $_delcomment = $delcomment->deleteCommentByUserId($_POST['id']);
                            /// delete requests of user 
                            $delreq = new Application_Model_Requests();
                            $_delreq = $delreq->deleteRequestByUser($_POST['id']);
                            /// delete user id from user course
                            $deluc = new Application_Model_UserCourse();
                            $_deluc = $deluc->deleteUserCourseByUserId($_POST['id']);
                            // delete user
                            $delu = new Application_Model_Users();
                            $_delu = $delu->deleteUser($_POST['id']);

//                            $this->render('admin');
                            break;

                        case 'courses' :

                            $delmat = new Application_Model_Materials();
                            $_delmat = $delmat->deleteMaterialByCourseId($_POST['id']);

                            $delcoursecategory = new Application_Model_CourseCategory();
                            $_delcoursecategory = $delcoursecategory->deleteCourseCategoryByCourseId($_POST['id']);

                            $delcoursecategory = new Application_Model_CourseTag();
                            $_delcoursecategory = $delcoursecategory->deleteCourseTagByCourseId($_POST['id']);

                            $deluc = new Application_Model_UserCourse();
                            $_deluc = $deluc->deleteUserCourseByCourseId($_POST['id']);

                            $delcomment = new Application_Model_Comments();
                            $_delcomment = $delcomment->deleteCommentByCourseId($_POST['id']);

                            $delcourse = new Application_Model_Courses();
                            $_delcourse = $delcourse->deleteCourse($_POST['id']);


                            break;

                        case 'materials' :
                            $delmat = new Application_Model_Materials();
                            $_delmat = $delmat->deleteMaterialById($_POST['id']);

                            break;

                        case 'comments':

                            $delcomment = new Application_Model_Comments();
                            $_delcomment = $delcomment->deleteComment($_POST['id']);

                            break;

                        case 'categories' :
                            $delcoursecategory = new Application_Model_CourseCategory();
                            $_delcoursecategory = $delcoursecategory->deleteCourseCategoryByCategoryId($_POST['id']);

                            $delcategory = new Application_Model_Categories();
                            $_delcategory = $delcategory->deleteCategory($_POST['id']);

                            break;
                    } // end switch del
                    break;

                case 'hide':
                    switch ($_POST['table']) {
                        case 'materials':
                            $h_toggle = new Application_Model_Materials();
                            $result = $h_toggle->selectMaterialById($_POST[id]);
                            $rs = $result[0]['hidden'];
                            $rs = 1 - $rs;
                            $_h_toggle = $h_toggle->updateMaterial($_POST['id'], array('hidden' => $rs));
                            break;
                        case 'courses':
                            $h_toggle = new Application_Model_Courses();
                            $result = $h_toggle->getCourseById($_POST[id]);
                            $rs = $result[0]['hidden'];
                            $rs = 1 - $rs;
                            $_h_toggle = $h_toggle->updateCourseBy($_POST['id'], array('hidden' => $rs));
                            break;
                    }// end switch hide
                    break;

                case 'lock':
                    $l_toggle=new Application_Model_Materials();
                    $result=$l_toggle->selectMaterialById($_POST['id']);
                    $rs=$result[0]['downloadable'];
                    $rs = 1 - $rs;
                    $_l_toggle = $l_toggle->updateMaterial($_POST['id'], array('downloadable' => $rs));
                    
                    break;

                case 'ban':
                    $a_toggle=new Application_Model_Users();
                    $result=$a_toggle->getUserById($_POST['id']);
                    $rs=$result[0]['active'];
                    $rs = 1 - $rs;
                    $_a_toggle = $a_toggle->editUserBy($_POST['id'], array('active' => $rs));
                    break;
            }
        }
    }

}

//
//switch ($_GET['table']){
//                
//                case 'users' :
//                   
//                    break;
//                
//                case 'courses' :
//                    break;
//                
//                case 'materials' :
//                    break;
//                
//                case 'comments':
//                    break;
//                
//                case 'categories' :
//                    break;
//                    
//            }