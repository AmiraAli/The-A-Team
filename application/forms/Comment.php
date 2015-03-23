<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    { 
        $this->setMethod("post");
        $this->setAttrib("class", "form-inline");
        $comment = new Zend_Form_Element_Textarea("body");
        $comment->setAttrib("cols", "50");
        $comment->setAttrib("rows", "4");
        $comment->setAttrib("class", "form-control");
        $comment->setRequired();
        $comment->addFilter(new Zend_Filter_StripTags);
        
        $submit=new Zend_Form_Element_Submit('Add');
        $submit->setValue("Add");
        $submit->setAttrib("id", "alert");
        $submit->setAttrib("class", "btn btn-primary");
        $this->addElements(array($comment,$submit));
    }


}

