<?php

class Application_Form_Facebook extends Zend_Form
{

    public function init()
    {
        $this->setMethod("POST");
        
        
        $this->addElement('hidden', 'name', array(
            'required' => true,
           
        ));
        $this->addElement('text', 'facebookid', array(
            'required' => true,
            
        ));
        $this->addElement('hidden', 'country', array(
            'required' => true,
           
        ));
        $this->addElement('hidden', 'gender', array(
            'required' => true,
           
        ));
        
        
        
        
        $this->addElement('submit','Facebook',array(
            'ignore'=>true,
        ));
    }


}

