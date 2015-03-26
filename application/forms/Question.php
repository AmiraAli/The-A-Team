<?php

class Application_Form_Question extends Zend_Form
{

    public function init()
    {
        
       $this->setMethod("post");
       $this->setAttrib("class", "form-inline");
       //$this->setAction("http://localhost/The-A-Team/public/Questions/add");
       
        $title = new Zend_Form_Element_Text("title");
       
         $title->setLabel("Title: ");
         $title->setRequired();
         $title->addFilter(new Zend_Filter_StripTags);
         $title->setAttrib("class", "form-control");

       
        $question = new Zend_Form_Element_Textarea("body");
        $question->setAttrib("cols", "50");
        $question->setAttrib("rows", "4");
        $question->setLabel("Question: ");
        $question->setRequired();
        $question->addFilter(new Zend_Filter_StripTags);
        $question->setAttrib("class", "form-control");

        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class", "btn btn-primary");
        $submit->setAttrib("id", "alert");

        $submit->setValue("submit");
//        $submit->setAttrib();
        
        
        $this->addElements(array($title,$question,$submit));
    }


}

