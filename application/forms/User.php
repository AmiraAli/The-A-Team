<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        $this->setMethod("post");
        $username = new Zend_Form_Element_Text("name");
        $username->setLabel("Username: ");
        $username->setRequired();
        $username->addFilter(new Zend_Filter_StripTags);
        
        $email = new Zend_Form_Element_Text("email");
        $email->setRequired();
        $email->setLabel("Email: ");
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addValidator(new Zend_Validate_Db_NoRecordExists(array(
        'table' => 'Users',
        'field' => 'email'
    )
));
        $email->addFilter(new Zend_Filter_StripTags);
          
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setLabel("Password");
        
        $confirmpassword=new Zend_Form_Element_Password("confirmpassword");
        $confirmpassword->setRequired();
        $confirmpassword->setLabel("ConfirmPassword");
        $confirmpassword->addValidator('Identical',false, array('token' => 'password'));
        
        $country=new Zend_Form_Element_Select('country');
        $country->setRequired();
        $country->addMultiOption("egypt", "egypt");
        $country->addMultiOption("America", "America");
        $country->addMultiOption("Dubai", "Dubai");
        $country->addMultiOption("England", "England");
        $country->addMultiOption("Yonan", "Yonan");
        $country->setLabel("country");
        
        $gender=new Zend_Form_Element_Radio("gender");
        $gender->addMultiOption("male", "male");
        $gender->addMultiOption("female", "female");
        $gender->setLabel("Gender");
        $gender->setRequired();
        
        $file= new Zend_Form_Element_File("image");
        $file->setLabel("upload a photo");
        $file-> addValidator('Count', false, 1);
        $file->addValidator('Size', false, 102400);
        $file->setRequired();
        $file->addValidator('Extension', false, 'jpg,png,gif');
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setValue("submit");
        
        $this->addElements(array($username,$email,$password,$confirmpassword,$country,$gender,$file,$submit));
    }


}

