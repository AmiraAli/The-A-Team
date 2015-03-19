<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {


    protected function _initPlaceholders() {
        
    }
protected function _initMail()
{
$config = array(
            'auth' => 'login',
            'username' => 'username@gmail.com',
            'password' => '@Ya1381992',
            'ssl' => 'tls',
            
        );

    $tr = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
    
    Zend_Mail::setDefaultTransport($tr);
}

}
