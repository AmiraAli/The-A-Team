<?php

class Application_Form_Request extends Zend_Form
{

    public function init()
    {
       $this->setMethod("post");
        $request = new Zend_Form_Element_Text("desc");
        $request->setLabel("Request: ");
        $request->setRequired();
        $request->addFilter(new Zend_Filter_StripTags);
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setValue("submit");
        
        $this->addElements(array($request,$submit));
    }


}

