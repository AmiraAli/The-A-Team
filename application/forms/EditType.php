<?php

class Application_Form_EditType extends Zend_Form
{

    public function init() {
        $this->setMethod("POST");

        $this->addElement('hidden', 'process', array(
            'value' => 'edittype'
        ));

        $this->addElement('text', 'myt', array(
            'required' => true,
            'label' => 'Type',
        ));
        //Add the submit button
        $this->addElement('submit', 'newtype', array(
            'ignore' => true,
            'label' => 'submit',
        ));
    }


}

