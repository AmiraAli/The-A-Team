<?php

class Application_Form_EditCategory extends Zend_Form
{

    public function init()
    {
       $this->setMethod("POST");

        $this->addElement('text', 'category', array(
            'required' => true,
            'label'=>'Category',
        ));
        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'submit',
        ));
    }


}

