<?php

class TwitterController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function loginAction() {

        $twitter = new Zend_Service_Twitter(array(
            'access_token' => array(// or use "accessToken" as the key; both work
                'token' => '246920430-ZTYnuTYiZK5V3JGN51nfdJ7DQNREfhZ4qo7eGk2D',
                'secret' => 'yqIcmw9pPYc7O02ajTVoC8QMXZeltChqnK6kmY7rdiefc',
            ),
            'oauth_options' => array(// or use "oauthOptions" as the key; both work
                'consumerKey' => 'PUIAULm56CbeTAjL6oG5Mx63e',
                'consumerSecret' => 'q9FXqOjiMCZUdoJFQxFTy249yS9MHN3sID2k4Vz6oCMAWbdqfb',
            ),
        ));
        // verify user's credentials with Twitter
        $response = $twitter->account->verifyCredentials();

        $response = $response->toValue();
        $response = get_object_vars($response);
//        var_dump($response);
//        echo "name: " . $response['name'] . "</br>";
//        echo "id: " . $response['id'] . "</br>";
//        echo "image: " . $response['profile_image_url'] . "</br>";
    }

    public function shareAction() {
     
        $twitter = new Zend_Service_Twitter(array(
            'access_token' => array(// or use "accessToken" as the key; both work
                'token' => '246920430-ZTYnuTYiZK5V3JGN51nfdJ7DQNREfhZ4qo7eGk2D',
                'secret' => 'yqIcmw9pPYc7O02ajTVoC8QMXZeltChqnK6kmY7rdiefc',
            ),
            'oauth_options' => array(// or use "oauthOptions" as the key; both work
                'consumerKey' => 'PUIAULm56CbeTAjL6oG5Mx63e',
                'consumerSecret' => 'q9FXqOjiMCZUdoJFQxFTy249yS9MHN3sID2k4Vz6oCMAWbdqfb',
            ),
        ));
     $response = $twitter->statuses->userTimeline();
     
//     var_dump($response);
     
    }

}
