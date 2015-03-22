<?php

class Application_Form_Editcomment extends Zend_Form
{

    public function init() {
        $this->setMethod("POST");

        $this->addElement('hidden', 'process', array(
            'value' => 'editcomment'
        ));

        $this->addElement('text', 'body', array(
            'required' => true,
            'label' => 'Body',
        ));
        //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'submit',
        ));
    }


}

