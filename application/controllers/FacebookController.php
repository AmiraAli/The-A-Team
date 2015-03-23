<?php

class FacebookController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function facebookauthAction() {
        $this->_helper->viewRenderer->setNoRender(true);

        if (Zend_Registry::get('facebook_client_id')) {
            $current_facebook_id = Zend_Registry::get('facebook_client_id');

            $_user = new Application_Model_Users();
            $user = $_user->getUserByFacebookId($current_facebook_id);
//            echo Zend_Registry::get('facebook_client_id');
//           $session = new Zend_Session_Namespace('session');
//           $session->type=$user[0]['type'];
//           $session->name=$user[0]['name'];
//           $session->id=$user[0]['id'];
//           $session->email=$user[0]['email'];
//           $session->image=$user[0]['image'];
//            
            $db = Zend_Db_Table::getDefaultAdapter();
                // Get object from adaptor database
                $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'Users', 'email', 'password');
                // to Check if this email is exist
                $authAdapter->setIdentity($user[0]['email']);
                // to check if password is exists or not 
                $authAdapter->setCredential($user[0]['password']);
                // to check if the password is related to this mail or not 
                $result = $authAdapter->authenticate();
                // if the mail and password are correct 
                if ($result->isValid()) {

                    $auth = Zend_Auth::getInstance();
                    $storage = $auth->getStorage();
                    //To save the needed data in session            
                    $storage->write($authAdapter->getResultRowObject(array('email', 'id', 'name', 'type','image')));
            
            
            
            
            
//             to redirect to the correct page
            $this->redirect("control-room/admin");

//            echo $current_facebook_id;
//            echo $mess;
        } else {
            $mess = "<h1>plz login fist</h1>";
            echo $mess;
        }
//            echo $userid;


        $user = $_user->getUserByFacebookId($current_facebook_id);





//        if ($userid[0] !== Zend_Auth::getInstance()->getIdentity()->id) {
//            // Get a Facebook authorization for the publish_stream and offline_access
//            $url = 'https://graph.facebook.com/oauth/authorize?client_id=' .
//                    Zend_Registry::get('facebook_client_id') .
//                    '&redirect_uri=' .
//                    Zend_Registry::get('facebook_redirect_uri') .
//                    '&scope=publish_stream,offline_access';
//
//            // Return URL that should be used for redirection in Javascript
//            die("1|$url");
//        } else {
//            // No user logged in
//            die("0|Please login first");
      }
    }

    public function facebookcbAction() {
        $request = $this->getRequest();
        $params = $request->getParams();

        if (isset($params['code'])) {
            // This is the callback from Facebook, get the code parameter
            $code = $params['code'];

            $url = 'https://graph.facebook.com/oauth/access_token';
            $arpost = array(
                'client_id' => Zend_Registry::get('facebook_client_id'),
                'redirect_uri' => Zend_Registry::get('facebook_redirect_uri'),
                'client_secret' => Zend_Registry::get('facebook_client_secret'),
                'code' => $code);

            // Now request the access_token
            $result = $this->requestFacebookAPI_GET($url, $arpost);

            if ($result === FALSE) {
                // Redirect to error page
            } else {
                parse_str($result, $arresult);

                // Use the access_token to retrieve the user's profile
                $url = 'https://graph.facebook.com/me';
                $arpost = array('access_token' => $arresult['access_token']);

                $result = $this->requestFacebookAPI_GET($url, $arpost);

                if ($result === FALSE) {
                    // Redirect to error page
                } else {
                    $arprofile = json_decode($result, true);

                    $data = array(
                        'id' => Zend_Auth::getInstance()->getIdentity()->id,
                        'facebook_access_token' => $arresult['access_token'],
                        'facebook_name' => $arprofile['name'],
                        'facebook_id' => $arprofile['id']
                    );

                    // Save this array in the database as part of the user profile
                    // Redirect to success page
                }
            }
        }
    }

}
