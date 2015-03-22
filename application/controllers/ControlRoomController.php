<?php

class ControlRoomController extends Zend_Controller_Action {

    public function init() {
        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity() && $this->_request->getActionName() != 'login') {
            $this->redirect("Users/login");
        }
//        $contextSwitch=$this->_helper->getHelper('contextSwitch');
//        $contextSwitch->addActionContext('admin','json')
//                                ->initContext();
        include_once 'uploadimg.php';
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

        $adduser = new Application_Form_AddUser();
        $edituser = new Application_Form_EditUser();
        $addtype = new Application_Form_AddType();
        $edittype = new Application_Form_EditType();
        $addcategory = new Application_Form_AddCategory();
        $editcategory = new Application_Form_EditCategory();
        $addcourse = new Application_Form_AddCourse();
        $editcourse = new Application_Form_EditCourse();



        if ($this->getRequest()->isPost()) {
            switch (@$_POST['search']) {
                case 'Courses' :
                    $data = $this->listCourses();

                    $list = array('decoration' => '<center><table  class="table-hover"  border="1" id="courses"><tr><th>id</th><th>Title</th><th>Description</th>'
                        . '<th>Start Date</th><th>Duration</th><th>Hidden</th><th width="400px">Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['title'] . '</td><td>' . $data[$i]['desc'] . '</td>'
                                . '<td>' . $data[$i]['startdate'] . '</td><td>' . $data[$i]['duration'] . ' weeks </td><td class="status">' . $data[$i]['hidden'] . '</td>'
                                . '<td><button class="btn-danger">Delete</button>&nbsp;<button class="btn-primary">Edit</button>'
                                . '&nbsp;<button class="myhide">Hide</button></td></tr>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];

                    break;
                case 'Users' :
                    $data = $this->listUsers();
                    $list = array('decoration' => '<center><table   class="table-hover" border="1" id="users"><tr><th>Username</th><th>Email</th>'
                        . '<th>Image</th><th>Active</th><th>Type</th><th>Gender</th><th>Country</th><th>Facebook ID</th>'
                        . '<th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['name'] . '</td><td >' . $data[$i]['email'] . '</td>'
                                . '<td><img width="100 px" height="100px"src="../../public/images/users/' . $data[$i]['image'] . '"></td><td class="active">' . $data[$i]['active'] . ' </td><td>' . $data[$i]['type'] . '</td>' . '<td>' . $data[$i]['gender'] . '</td>'
                                . '<td>' . $data[$i]['country'] . '</td>' . '<td>' . $data[$i]['facebookid'] . '</td>' . '<td><button class="btn-danger">Delete</button>&nbsp;&nbsp;<button class="btn-primary">Edit</button>'
                                . '&nbsp;&nbsp;<button class="btn-info">Ban</button></td></tr>';
                    }
                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];


                    break;
                case 'Materials' :
                    $data = $this->listMaterials();

                    $list = array('decoration' => '<center><table  class="table-hover"  border="1" id="materials"><tr><th>id</th><th>Name</th><th>Downloadable</th>'
                        . '<th>Path</th><th>Number of Downloads</th><th>hidden</th><th>Type</th><th>Course Name</th>'
                        . '<th width ="250px">Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['name'] . '</td><td  id="down">' . $data[$i]['downloadable'] . '</td>'
                                . '<td>' . $data[$i]['path'] . '</td><td>' . $data[$i]['no_downloads'] . '</td><td class="status">' . $data[$i]['hidden'] . '</td><td>' . $this->getMeTypeName($data[$i]['Type_Id']) . '</td><td>' . $this->getMeCourseName($data[$i]['Course_Id']) . '</td>'
                                . '<td><button class="btn-danger">Delete</button>'
                                . '<button class="myhide">Hide</button><button class="mylock">Lock</button></td></tr>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];

                    break;
                case 'Categories' :
                    $data = $this->listCategory();

                    $list = array('decoration' => '<center><table  class="table-hover" border="1" id="categories"><tr><th>id</th><th>Name</th><th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['name'] . '</td>'
                                . '<td><button class="btn-danger">Delete</button>&nbsp;&nbsp;<button class="btn-primary">Edit</button>';
                    }

                    $list['decoration'] = $list['decoration'] . '</table>';
                    echo $list['decoration'];
                    break;
                case 'Comments':
                    $data = $this->listCourseComments();

                    $list = array('decoration' => '<center><table  class="table-hover" border="1" id="comments"><tr><th>id</th><th>Body</th><th>User Name</th>'
                        . '<th>Course Name</th><th>Admin</th></tr>');

                    for ($i = 0; $i < count($data); $i++) {

                        $list['decoration'] = $list['decoration'] . '<tr id=' . $data[$i]['id'] . '><td>' . $data[$i]['id'] . '</td><td>' . $data[$i]['body'] . '</td>'
                                . '</td><td>' . $this->getMeUserName($data[$i]['User_Id']) . '</td><td>' . $this->getMeCourseName($data[$i]['Course_Id']) . '</td>'
                                . '<td><button class="btn-danger">Delete</button>&nbsp;&nbsp;<button class="btn-primary">Edit</button>';
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
        $this->view->addcategory = $addcategory;
        $this->view->editcategory = $editcategory;
        $this->view->addcourse = $addcourse;
        $this->view->editcourse = $editcourse;
        $this->view->addtype = $addtype;
        $this->view->edittype = $edittype;
        $this->view->adduser = $adduser;
        $this->view->edituser = $edituser;




        if (!empty($this->getRequest()->isPost())) {
            switch (@$_POST['process']) {
                //// Select Which Process To Preform
                //// del => Delete
                //// edit => Edit
                ////  ban => Ban user
                ////  hide => Hide Course

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

                            $this->redirect('admin');
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

$this->redirect('/admin');
                            break;

                        case 'materials' :
                             $delcomment = new Application_Model_Comments();
                            $_delcomment = $delcomment->deleteCommentByMaterialId($_POST['id']);

                            $delmat = new Application_Model_Materials();
                            $_delmat = $delmat->deleteMaterialById($_POST['id']);
                            
                            
$this->redirect('admin');
                            break;

                        case 'comments':

                            $delcomment = new Application_Model_Comments();
                            $_delcomment = $delcomment->deleteComment($_POST['id']);
$this->redirect('admin');
                            break;

                        case 'categories' :
                            $delcoursecategory = new Application_Model_CourseCategory();
                            $_delcoursecategory = $delcoursecategory->deleteCourseCategoryByCategoryId($_POST['id']);

                            $delcategory = new Application_Model_Categories();
                            $_delcategory = $delcategory->deleteCategory($_POST['id']);
       
$this->redirect('/control-room/admin');
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
                    $l_toggle = new Application_Model_Materials();
                    $result = $l_toggle->selectMaterialById($_POST['id']);
                    $rs = $result[0]['downloadable'];
                    $rs = 1 - $rs;
                    $_l_toggle = $l_toggle->updateMaterial($_POST['id'], array('downloadable' => $rs));

                    break;

                case 'ban':
                    $a_toggle = new Application_Model_Users();
                    $result = $a_toggle->getUserById($_POST['id']);
                    $rs = $result[0]['active'];
                    $rs = 1 - $rs;
                    $_a_toggle = $a_toggle->editUserBy($_POST['id'], array('active' => $rs));
                    break;

                case 'adduser':
//                   

                    if ($this->_request->isPost()) {
                        if ($adduser->isValid($this->_request->getParams())) {
                            $user_info = $adduser->getValues();
                            //insert in the database
                            $user_info['image'] = $_FILES['file']['name'];
                            $user_info['active'] = '1';
                            $user_model = new Application_Model_Users();
                            $user_model->addUser($user_info);
                        }
                    }

                    break;


                case 'addcourse':
                    if ($this->_request->isPost()) {
                        if ($addcourse->isValid($this->_request->getParams())) {

                            $newcourse = $addcourse->getValues();
                            $newcourse['startdate'] = $newcourse['day'] . '/' . $newcourse['month'] . '/' . $newcourse['year'];
                            $newcourse['hidden'] = '1';
                            unset($newcourse['year']);
                            unset($newcourse['day']);
                            unset($newcourse['month']);

                            $course = new Application_Model_Courses();
                            $result = $course->addCourse($newcourse);
                        }
                    }
                    break;


                case 'addcategory':
                    if ($this->_request->isPost()) {
                        if ($addcategory->isValid($this->_request->getParams())) {

                            $newcategory = $addcategory->getValues();
                            $category = new Application_Model_Categories();
                            $result = $category->addCategory($newcategory);
                        }
                    }
                    break;

//                
                case 'addtype':
                    if ($this->_request->isPost()) {
                        if ($addtype->isValid($this->_request->getParams())) {

                            $newtype = $addtype->getValues();
                            $type = new Application_Model_Types();
                            $result = $type->insertType($newtype);
                        }
                    }

                    break;


                case'editcomment':
                    $data = array(
                        'body' => $_POST['body'],
                        'id' => $_POST['id'],
                    );
                    $id = $_POST['id'];
                    $_updatecomment = new Application_Model_Comments();

                    if ($_POST['body'] !== '') {
                        $update = $_updatecomment->editComment($data);
                    } else {
                        $error = 'Fill Empty Fields';
                    }


                    break;
            }//////////////////////////////////////////////////////// **END OF PROCESS**//////////////////////////////////////////
        }
    }

//    public function editcourseAction() {
//        if (isset($_GET)) {
////            echo $_GET['id'];
//            $_course = new Application_Model_Courses();
//            $course = $_course->getCourseById($_GET['id']);
//            $mydate = explode(" ", $course[0]['startdate']);
//            $mydate = explode("-", $mydate[0]);
//            $list = array('decoration' => '<center><table  id="course" class="xyz" >'
//                . '<tr><td><label>Title:</label></td><td><input type="text"  name="title "id="title" value="' . $course[0]['title'] . '" required></td></tr>'
//                . '<tr><td><label>Description:</label></td><td><textarea  id="desc" name="desc"   required> ' . $course[0]['desc'] . '</textarea></td></tr>'
//                . '<tr><td><label>Start Date:</label></td><td><input type="date" id="date" name ="date" value="' . $mydate[0] . '-' . $mydate[1] . '-' . $mydate[2] . '" required></td></tr>'
//                . '<tr><td><label>Duration:</label></td><td><input type="text"  id="duration" name="duration" value="' . $course[0]['duration'] . '" required></td></tr>'
//                . '<tr><td><input type="submit" id=submit name="submit"></td></tr></table></center>');
//            echo $list['decoration'];
//        }
//    }
    public function editcourseAction() {
        if (isset($_GET)) {
            $form = new Application_Form_EditCourse();
            $_course = new Application_Model_Courses();

            $course = $_course->find($_GET['id'])->current();
            $mydate = explode('/', $course['startdate']);

            $form->populate($course->toArray());

            if ($this->_request->isPost()) {
                if ($form->isValid($this->_request->getParams())) {
                    $course_info = $form->getValues();
                    //insert in the database
                    $course_info['startdate'] = $course_info['year'] . '/' . $course_info['month'] . '/' . $course_info['day'];
                    $course_info['id'] = $_GET['id'];
                    unset($course_info['year']);
                    unset($course_info['month']);
                    unset($course_info['day']);
                    unset($course_info['process']);
                    $Course_model = new Application_Model_Courses();

                    $Course_model->editCourse($course_info);
                }
            }




            $this->view->form = $form;

//            $this->_helper->viewRenderer('control-room/admin', null, true);
        }
    }

    public function edituserAction() {
        if (isset($_GET)) {

            $form = new Application_Form_EditUser();
            $_user = new Application_Model_Users();

            $user = $_user->find($_GET['id'])->current();

            $form->populate($user->toArray());


            if ($this->_request->isPost()) {
                if ($form->isValid($this->_request->getParams())) {
                    $user_info = $form->getValues();
                    //insert in the database

                    unset($user_info['confirmpassword']);
                    unset($user_info['process']);
                    $user_model = new Application_Model_Users();

                    $user_model->editUser($user_info);
                }
            }




            $this->view->myform = $form;
        }
    }

    public function editmaterialAction() {
        // action body
    }

//    public function editcategoryAction() {
//        if (isset($_GET)) {
////            echo $_GET['id'];
//            $_category = new Application_Model_Categories();
//            $category = $_category->getCategoryById($_GET['id']);
//
//            $list = array('decoration' => '<center><table  id="category" class="xyz" >'
//                . '<tr><td><label>Category:</label></td><td><input type="text"  name="name "id="name" value="' . $category[0]['name'] . '" required></td></tr>'
//                . '<tr><td><input type="submit" id=submit name="submit"></td></tr></table></center>');
//            echo $list['decoration'];
//
////            echo $mydate[0].'/'.$mydate[1].'/'.$mydate[2];
//        }
//    }
    public function editcategoryAction() {
        if (isset($_GET)) {
            $form = new Application_Form_EditCategory();
            $_category = new Application_Model_Categories();

            $category = $_category->find($_GET['id'])->current();

            $form->populate($category->toArray());


            if ($this->_request->isPost()) {
                if ($form->isValid($this->_request->getParams())) {
                    $cat_info = $form->getValues();
                    //insert in the database

                    $cat_info['id'] = $_GET['id'];
                    unset($cat_info['process']);

                    $_category->editCategory($cat_info);
                }
            }

            $this->view->form = $form;
        }
    }

//    public function editcommentAction() {
//        if (isset($_GET)) {
////            echo $_GET['id'];
//            $_comment = new Application_Model_Comments();
//            $comment = $_comment->getCommentById($_GET['id']);
//
//            $list = array('decoration' => '<center><table  id="comments" class="xyz" >'
//                . '<tr><td><label>Body:</label></td><td><input type="text"  name="comment "id="comment" value="' . $comment[0]['body'] . '" required></td></tr>'
//                . '<tr><td><input type="submit" id=submit name="submit"></td></tr></table></center>');
//            echo $list['decoration'];
//        }
//    }
    public function editcommentAction() {
        if (isset($_GET)) {
            $form = new Application_Form_Editcomment();
            $_comment = new Application_Model_Comments();
            $comment = $_comment->find($_GET['id'])->current();
            $form->populate($comment->toArray());


            if ($this->_request->isPost()) {
                if ($form->isValid($this->_request->getParams())) {
                    $comm_info = $form->getValues();
                    //insert in the database

                    $comm_info['id'] = $_GET['id'];
                    unset($comm_info['process']);

                    $_comment->editComment($comm_info);
                }
            }

            $this->view->form = $form;
        }
    }

}
