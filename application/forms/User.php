<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {  $this->setAttrib("class", "form-inline");
        $this->setMethod("post");
        
        $username = new Zend_Form_Element_Text("name");
        $username->setLabel("Username: ");
        $username->setRequired();
        $username->addFilter(new Zend_Filter_StripTags);
        $username->setAttrib("class", "form-control");  
        
        
        $email = new Zend_Form_Element_Text("email");
        $email->setRequired();
        $email->setLabel("Email: ");
        $email->setAttrib("class", "form-control");
        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addValidator(new Zend_Validate_Db_NoRecordExists(array(
        'table' => 'Users',
        'field' => 'email'
    )
));
        $email->addFilter(new Zend_Filter_StripTags);
          
        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setLabel("Password: ");
    $password->setAttrib("class", "form-control");  
        
        
        $confirmpassword=new Zend_Form_Element_Password("confirmpassword");
        $confirmpassword->setRequired();
        $confirmpassword->setLabel("ConfirmPassword: ");
        $confirmpassword->addValidator('Identical',false, array('token' => 'password'));
        $confirmpassword->setAttrib("class", "form-control");  

        
        $country=new Zend_Form_Element_Select('country');
        $country->setRequired();
        $country->addMultiOptions(Zend_Locale::getTranslationList('Territory','en_US','2'),Zend_Locale::getTranslationList('Territory','en_US','2'));
//        
        $country->setLabel("country: ");
        $country->setAttrib("class", "form-control");  

        
        $gender=new Zend_Form_Element_Radio("gender");
        $gender->addMultiOption("male", "male");
        $gender->addMultiOption("female", "female");
        $gender->setLabel("Gender: ");
        $gender->setRequired();
        $gender->setAttrib("class", "form-control");
        

        $file= new Zend_Form_Element_File("image");
        $file->setLabel("upload a photo: ");
        $file-> addValidator('Count', false, 1);
        $file->addValidator('Size', false, 102400);
        $file->setDestination("/var/www/html/The-A-Team/public/images/users/");
        $file->setRequired();
        $file->addValidator('Extension', false, 'jpg,png,gif');
         

        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setValue("submit");
        $submit->setAttrib("class", "btn btn-success btn-md col-md-offset-8");
        
        $this->addElements(array($username,$email,$password,$confirmpassword,$country,$gender,$file,$submit));
    }


}

