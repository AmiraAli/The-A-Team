<?php

class FacebookController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        
    }

    public function facebookauthAction() {
        $log = new Application_Form_Facebook();
        $user = new Application_Model_Users();

        if ($this->_request->isPost()) {
            if ($log->isValid($this->_request->getParams())) {

                $db = Zend_Db_Table::getDefaultAdapter();
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'Users', 'email', 'password');
                $authAdapter->setIdentity($_POST['name'] . '@ateam.com');
                $authAdapter->setCredential(md5($_POST['facebookid']));
                $result = $authAdapter->authenticate();
                $email = $_POST['name'] . '@ateam.com';
                $password = $_POST['facebookid'];

                if ($result->isValid()) {
                    // facebookid  appears to be valid
                    $user_model = new Application_Model_Users();
                    $email_info = $user_model->getUserByEmail($email);
                    if ($email_info[0]['active'] == "1") {
                        $auth = Zend_Auth::getInstance();
                        $storage = $auth->getStorage();
                        //To save the needed data in session            
                        $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name', 'type', 'image')));

                        $this->redirect("home/home");
                    } else {
                        $element = $log->getElement("facebookid")->addErrorMessage("you arenot allowed to login");
                        $element->markAsError();
                    }
//
                } else {
                    // facebookid is invalid; print the reason
                    // so create new account 
                    $data = array(
                        'name' => $_POST['name'],
                        'email' => $_POST['name'] . '@ateam.com',
                        'password' => $_POST['facebookid'],
                        'image' => 'facebook.png',
                        'type' => 'Student',
                        'gender' => $_POST['gender'],
                        'country' => $_POST['country'],
                        'active' => '1',
                        'facebookid' => $_POST['facebookid'],
//                        'googleid' => NULL,
//                        'twitterid' => NULL,
                    );
                    $newuser = $user->addUserByFacebook($data);
                    $email = $_POST['name'] . '@ateam.com';
                    $password = $_POST['facebookid'];
                    $db = Zend_Db_Table::getDefaultAdapter();
                    $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'Users', 'email', 'password');
                    $authAdapter->setIdentity($_POST['name'] . '@ateam.com');
                    $authAdapter->setCredential(md5($_POST['facebookid']));
                    $result = $authAdapter->authenticate();

                    $user_model = new Application_Model_Users();
                    $email_info = $user_model->getUserByEmail($email);

                    
                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    //To save the needed data in session            
                    $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name', 'type', 'image')));

                    $this->redirect("home/home");
                }
            }
        }
        $this->view->log = $log;
    }

}
