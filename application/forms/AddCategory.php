<?php

class Application_Form_AddCategory extends Zend_Form {

    public function init() {
        $this->setMethod("POST");
               
         $this->addElement('hidden','process',array(
            'value'=>'addcategory'
        ));
        $this->addElement('text', 'name', array(
            'required' => true,
            'label'=>'Category',
        ));
        //Add the submit button
        $this->addElement('submit', 'addcategory', array(
            'ignore' => true,
            'label' => 'submit',
        ));
        
    }

}
