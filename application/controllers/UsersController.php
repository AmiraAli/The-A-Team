<?php

class UsersController extends Zend_Controller_Action {

    public function init() {


        $authorization = Zend_Auth::getInstance();
        if (!$authorization->hasIdentity() && $this->_request->getActionName() != 'login' && $this->_request->getActionName() != 'add' && $this->_request->getActionName() != 'listusertype') {
            $this->redirect("Users/login");
        }
    }

    public function indexAction() {
        
    }

    public function logoutAction() {
        $autho = zend_Auth::getInstance();
        $autho->clearIdentity();
        $this->redirect("Users/login");
    }

    public function loginAction() {
        //Get object from User form 
        $user_form = new Application_Form_User();

        $user_form->getElement("password")->setDescription('<a href="listusertype">Forgot password?</a>');
        $user_form->getElement("password")->getDecorator('Description')->setOption('escape', false);
        // remove this following Element from User form Sign Up
        $user_form->removeElement("name");
        $user_form->removeElement("confirmpassword");
        $user_form->removeElement("country");
        $user_form->removeElement("gender");
        $user_form->removeElement("image");
        // TO adjust style of form 
        $user_form->removeAttrib("class");
        // to adjust Style of submit button
        $user_form->getElement("submit")->setAttrib("class", "btn btn-success btn-md col-md-offset-10");
        // to check if Form Is POST
        if ($this->_request->isPost()) {
            @$user_form->getElement("email")->removeValidator(Zend_Validate_Db_NoRecordExists);


            // To Check the validation of form 
            if ($user_form->isValid($this->getRequest()->getParams())) {

                //get value of mail from post
                $email = $user_form->getvalue("email");
                // get value of Password from post
                $password = $user_form->getvalue("password");

                $db = Zend_Db_Table::getDefaultAdapter();
                // Get object from adaptor database
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'Users', 'email', 'password');
                // to Check if this email is exist
                $authAdapter->setIdentity($email);
                // to check if password is exists or not 
                $authAdapter->setCredential(md5($password));
                // to check if the password is related to this mail or not 
                $result = $authAdapter->authenticate();
                // if the mail and password are correct 
                if ($result->isValid()) {
                    $user_model = new Application_Model_Users();
                    $email_info = $user_model->getUserByEmail($email);
                    if ($email_info[0]['active'] == "1") {
                        $auth = Zend_Auth::getInstance();
                        $storage = $auth->getStorage();
                        //To save the needed data in session            
                        $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name', 'type', 'image')));



// to redirect to the correct page

                        $this->redirect("home/home");
                    } else {
                        $element = $user_form->getElement("password")->addErrorMessage("you arenot allowed to login");

                        $element->markAsError();
                    }
//
//                    $this->redirect("home/home");
                } else {
                    //if password and mail not correct together add this error message  
                    $element = $user_form->getElement("password")->addErrorMessage("wrong mail or password");

                    $element->markAsError();
                }
            }
        }
        // to send this form to view 
        $this->view->form = $user_form;
    }

    public function addAction() {


        // Get object from User form

        $form  = new Application_Form_User();
        
        if($this->_request->isPost()){
           if($form->isValid($this->_request->getParams())){
               // Get Value from POST
               $user_info = $form->getValues();
               // set user type as Student
               $user_info['type']='Student';
               // set default account as active
               $user_info['active']='1';
               // Take object from User model
               $user_model = new Application_Model_Users();
               // To not save confirm pasword in the Model Users table
               unset($user_info['confirmpassword']);
               
               
  //$originalFilename = pathinfo($form->image->getFileName());
  
    //$newFilename = $user_info['email'].  '.' . $originalFilename['extension'];
   
    //$form->image->addFilter('Rename', $newFilename);
 

              
    
   // $user_info['image']=$newFilename;
               //Call addUser function from model
      try{         
    
    
    $smtpoption=array('auth'=>'login',
            'username'=>'ATeamgroup2@gmail.com',
            'password'=>'coursera',
            'ssl' =>'ssl',
            'port'=>465
            
            
            );
     $sendmail = new Zend_Mail_Transport_Smtp("smtp.gmail.com",$smtpoption);
    $mail = new Zend_Mail();
    $mail->setBodyText('Thanks for registered ATeam ');
    $mail->setFrom('ATeamgroup2@gmail.com','ATeam');
    $mail->addTo($user_info['email'],$user_info['name']);
    $mail->setSubject('confirmation message');
      $mail->send($sendmail);
      $user_model->addUser($user_info);
     
      }
      catch(Exception $e){
          
         $this->view->error=$e->getMessage();
          
      }
                       
           }
       }
       // send this form to view
	$this->view->form = $form;
         
         
    }


    public function editAction() {

        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();


        //$webServiceNamespace = new Zend_Session_Namespace('Zend_Auth');
        //$webServiceNamespace->email ;
        //echo  $webServiceNamespace->email."hahahaha" ;
        $id = $sessionRead->id;

        // Get user Id from Url 
        //$id = $this->_request->getParam("id");
        // Get Object from User form 
        $form = new Application_Form_User();
        //$form->getElement("password")->setRequired(false);
        $form->getElement('email')->setAttrib('readonly', 'true');


        // Check if data is posted 
        if ($this->_request->isPost()) {
            // to remove validator from email field
            @ $form->getElement("email")->removeValidator(Zend_Validate_Db_NoRecordExists);
            $form->getElement("image")->setRequired(false);

            // Check is Data is valid

            if ($form->isValid($this->_request->getParams())) {


                // To take value from the Form is valid 
                $user_info = $form->getValues();
                // Get object from Users Model

                $user_model = new Application_Model_Users();
                unset($user_info['confirmpassword']);
                $user_info['id'] = $id;
                // call Edit user function from the model to update the data 

                $user_model->editUser($user_info);
                $this->redirect("Users/listuserid");
            }

            if ($form->isValid($this->_request->getParams())) {


                // To take value from the Form is valid 
                $user_info = $form->getValues();
                // Get object from Users Model

                $user_model = new Application_Model_Users();
                unset($user_info['confirmpassword']);
                $user_info['id'] = $id;
                // call Edit user function from the model to update the data 

                $user_model->editUser($user_info);
            }
        }
        // If the id is exit
        if (!empty($id)) {
            // Get object from users model
            $user_model = new Application_Model_Users();
            // Get user data from id
            $user = $user_model->getUserById($id);

            // fill the form with user data 
            $form->populate($user[0]);
        } //else
        //  $this->redirect("user/list");



        $this->view->form = $form;
        $this->render('add');
    }

    public function deleteAction() {

//$id=1;
        //if(!empty($id)){
        //  $user_model = new Application_Model_Users();
        // $user_model->deleteUser($id);
        //  }
    }

    public function listAction() {
        //$user_model = new Application_Model_Users();
        //$allUser=$user_model->listUsers();
        //var_dump($allUser);
    }

    public function listuseridAction() {
        $auth = Zend_Auth::getInstance();
        $storage = $auth->getStorage();
        $sessionRead = $storage->read();

        $id = $sessionRead->id; // will get id from session
        // open object from Users model
        $user_model = new Application_Model_Users();
        // Select User By Id
        $selectedUserById = $user_model->getUserById($id);
        // Send the data of selected User to the view 
        $this->view->user = $user_model->getUserById($id);
        //open object from UserCourse model
        $usercourse_model = new Application_Model_UserCourse();
        // Select cource By User Id
        $selectedUserCourseByUserId = $usercourse_model->selectUserCourseByUserId($id);
        // This is empty array to save the data about the course 
        $selectedCourse = array();


        for ($i = 0; $i < count($selectedUserCourseByUserId); $i++) {
            // Get object from Courses model
            $course_model = new Application_Model_Courses();
            // Get data about the course from course Id related to user_id
            $selectedCourseById = $course_model->getCourseById($selectedUserCourseByUserId[$i]['Course_Id']);

            if ($selectedCourseById[0]['hidden'] == '0')
            // To append data about the non hidden course to the array 
                $selectedCourse[] = $selectedCourseById;
        }


        // Send SElected Course to view
        $this->view->usercourse = $selectedCourse;
    }

    public function listusertypeAction() {
        //$type="Admin";
        //$user_model = new Application_Model_Users();
        //$selectedUserByType=$user_model->getUserByType($type);
        // var_dump($selectedUserByType);
        //Get object from User form 
        $user_form = new Application_Form_User();

        // remove this following Element from User form Sign Up
        $user_form->removeElement("name");
        $user_form->removeElement("confirmpassword");
        $user_form->removeElement("country");
        $user_form->removeElement("gender");
        $user_form->removeElement("image");
        $user_form->removeElement("password");
        // TO adjust style of form 
        $user_form->removeAttrib("class");
        // to adjust Style of submit button
        $user_form->getElement("submit")->setAttrib("class", "btn btn-success btn-md col-md-offset-10");


        // to check if Form Is POST
        if ($this->_request->isPost()) {
            @$user_form->getElement("email")->removeValidator(Zend_Validate_Db_NoRecordExists);


            // To Check the validation of form 
            if ($user_form->isValid($this->getRequest()->getParams())) {
                //get value of mail from post

                $email=$user_form->getvalue("email");
               $user_info=new Application_Model_Users();
                $checkmail=$user_info->getUserByEmail($email);
                if($checkmail){
               try{
                
                $smtpoption=array('auth'=>'login',
            'username'=>'ATeamgroup2@gmail.com',
            'password'=>'coursera',
            'ssl' =>'ssl',
            'port'=>465
            
            
            );
     $sendmail = new Zend_Mail_Transport_Smtp("smtp.gmail.com",$smtpoption);
    $mail = new Zend_Mail();
    
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
    
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $chars[rand(0, strlen($chars)-1)]; 
        
    }
    
   
    
    $mail->setBodyHtml('<a href="#">aya</a>');
    $mail->setBodyText('hello'. $checkmail[0]['name'].'your new password is '.$randomString);
    $mail->setFrom('ATeamgroup2@gmail.com','ATeam');
    $mail->addTo($checkmail[0]['email'], $checkmail[0]['name']);
    $mail->setSubject('Forget Password');
    $mail->send($sendmail);
     $user_model=new Application_Model_Users();
    $data=array('id'=>$checkmail[0]['id'],'password'=>$randomString);
    $user_model->editUser($data);
                $this->redirect('Users/login');
               }
               catch(Exception $e){
                    $this->view->error=$e->getMessage();
                   
               }
                }
                else{
                  $element= $user_form->getElement("email")->addErrorMessage(" This Email not found");  
                       
                    $element->markAsError();  
                    

                }
            }
        }

// to send this form to view 
        $this->view->form = $user_form;

        //$selectedUserByType=$user_model->getUserByType($type);
        // var_dump($selectedUserByType);
    }

}

