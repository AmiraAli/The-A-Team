<?php

class Application_Form_Question extends Zend_Form
{

    public function init()
    {
        
       $this->setMethod("post");
       //$this->setAction("http://localhost/The-A-Team/public/Questions/add");
       
        $title = new Zend_Form_Element_Text("title");
       
         $title->setLabel("Title: ");
         $title->setRequired();
         $title->addFilter(new Zend_Filter_StripTags);
       
        $question = new Zend_Form_Element_Textarea("body");
        $question->setAttrib("cols", "50");
        $question->setAttrib("rows", "4");
        $question->setLabel("Question: ");
        $question->setRequired();
        $question->addFilter(new Zend_Filter_StripTags);
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class", "btn btn-info");
        $submit->setValue("submit");
//        $submit->setAttrib();
        
        
        $this->addElements(array($title,$question,$submit));
    }


}

