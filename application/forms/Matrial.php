<?php

class Application_Form_Matrial extends Zend_Form
{

    public function init()
    {
        $this->setMethod("post");
        
        //name of matrial
        $matrialname = new Zend_Form_Element_Text("name");
        $matrialname->setAttrib("class", "form-control");
        $matrialname->setLabel("Name: ");
        $matrialname->setRequired();
    }


}

