<?php

class Application_Form_Answer extends Zend_Form
{

    public function init()
    {
       $this->setMethod("post");
       //$this->setAction("http://localhost/The-A-Team/public/Answers/add");
        $answer = new Zend_Form_Element_Textarea("body");
        $answer->setAttrib("cols", "50");
        $answer->setAttrib("rows", "4");
        $answer->setLabel("Answer: ");
        $answer->setRequired();
        $answer->addFilter(new Zend_Filter_StripTags);
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class", "btn btn-info");
        $submit->setValue("submit");
//        $submit->setAttrib();
        
        
        $this->addElements(array($answer,$submit));
    }
    


}

