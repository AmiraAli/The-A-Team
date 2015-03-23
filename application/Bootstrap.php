<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initPlaceholders() {

        $aConfig = $this->getOptions();
        Zend_Registry::set('facebook_client_id', $aConfig['facebook']['client_id']);
        Zend_Registry::set('facebook_client_secret', $aConfig['facebook']['client_secret']);
        Zend_Registry::set('facebook_redirect_uri', $aConfig['facebook']['redirect_uri']);
    }

}
