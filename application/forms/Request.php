<?php

class Application_Form_Request extends Zend_Form
{

    public function init()
    {
       $this->setMethod("post");
       $this->setAction("http://localhost/The-A-Team/public/Requests/add");
        $request = new Zend_Form_Element_Textarea("desc");
        $request->setLabel("Request: ");
        $request->setRequired();
        $request->addFilter(new Zend_Filter_StripTags);
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setValue("submit");
//        $submit->setAttrib();
        
        
        $this->addElements(array($request,$submit));
    }


}

