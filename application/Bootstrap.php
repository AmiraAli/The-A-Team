<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initViewHelpers()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
   
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view=$layout->getView();
        //Meta
        $view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type',
        'text/html;charset=utf-8');
        // Set the initial title and separator:
        $view->headTitle('The-A-Team')->setSeparator(' :: ');
//        // Set the initial stylesheet:
//        $view->headLink()->prependStylesheet('/bootstrap-3.3.2-dist/css/bootstrap.css');
//        $view->headLink()->prependStylesheet('/bootstrap-3.3.2-dist/css/bootstrap-theme.css');
//        // Set the initial JS to load:
//        $view->headScript()->prependFile('/jquery-2.1.3.min.js');
//        $view->headScript()->prependFile('/bootstrap-3.3.2-dist/js/bootstrap.js');
//        $view->headScript()->prependFile('/bootstrap-3.3.2-dist/js/npm.js');
        
    }
}

