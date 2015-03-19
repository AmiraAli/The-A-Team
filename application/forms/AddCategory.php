<?php

class Application_Form_AddCategory extends Zend_Form {

    public function init() {
        $this->setMethod("POST");

        $this->addElement('text', 'category', array(
            'required' => true,
        ));
        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'submit',
        ));
    $this->addElement('submit', 'edit', array(
            'ignore' => true,
            'label' => 'update',
            'attribs'    => array('disabled' => 'disabled',),
        ));
        
        
    }

}
