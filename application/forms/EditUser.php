<?php

class Application_Form_EditUser extends Zend_Form {

    public function init() 
            
            {
        $this->setAttrib("class", "form-inline");
        $this->setMethod("post");
      //$this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);
        $this->setAttrib("enctype","multipart/form-data");
        
        $username = new Zend_Form_Element_Text("name");
        $username->setLabel("Username: ");
        $username->setRequired();
        $username->addFilter(new Zend_Filter_StripTags);
        $username->setAttrib("class", "form-control");  
        
        // must be kept 
//        $this->addElement('hidden', 'id', array(
//            'decorators' => array('ViewHelper'),
//            'value' => @$_GET['id'],
//            // hidden field for id validation 
//        ));
        $id= new Zend_Form_Element_Hidden('id');
        
        $email = new Zend_Form_Element_Text("email");
//       $email->setRequired();
        $email->setLabel("Email: ");
        $email->setAttrib('disabled' , 'disabled');
        $email->setAttrib("class", "form-control");
        $email->addValidator(new Zend_Validate_EmailAddress());
//        $email->addValidator(new Zend_Validate_Db_NoRecordExists(array(
//        'table' => 'Users',
//        'field' => 'email'
//    )
//));
        $email->addFilter(new Zend_Filter_StripTags);
          
        $password = new Zend_Form_Element_Password("password");
//      $password->setRequired();
        $password->setLabel("Password: ");
        $password->setAttrib("class", "form-control");  
        
        
        $confirmpassword=new Zend_Form_Element_Password("confirmpassword");
//        $confirmpassword->setRequired();
        $confirmpassword->setLabel("ConfirmPassword: ");
        $confirmpassword->addValidator('Identical',false, array('token' => 'password'));
        $confirmpassword->setAttrib("class", "form-control");  

        
        $country=new Zend_Form_Element_Select('country');
        $country->setRequired();
               $country->addMultiOptions(Zend_Locale::getTranslationList('Territory','en_US','2'),Zend_Locale::getTranslationList('Territory','en_US','2'));

        $country->setLabel("country: ");
        $country->setAttrib("class", "form-control");  
        
        $type=new Zend_Form_Element_Select('type');
        $type->setRequired();
        $type->addMultiOption("Admin", "Admin");
        $type->addMultiOption("Student", "Student");
        $type->addMultiOption("Instructor", "Instructor");
        
        $type->setLabel("type: ");
        $type->setAttrib("class", "form-control");  

        
        $gender=new Zend_Form_Element_Radio("gender");
        $gender->addMultiOption("male", "male");
        $gender->addMultiOption("female", "female");
        $gender->setLabel("Gender: ");
        $gender->setRequired();
        $gender->setAttrib("class", "form-control");
        $gender->setAttrib("id", "gender");
        


         
         $file = new Zend_Form_Element_File('image');
         $file->setLabel('File')
                
                ->addValidator('NotEmpty')
                ->setDestination("/var/www/html/The-A-Team/public/images/users/");
        
        $submit=new Zend_Form_Element_Submit('submit');
        $submit->setValue("submit");
        $submit->setAttrib("class", "btn btn-success btn-md col-md-offset-8");
        $submit->setAttrib("id", "edituser");
//        $this->addElements(array($username,$email,$password,$confirmpassword,$type,$country,$hidden,$gender,$file,$submit));
            $this->addElements(array($id,$username,$email,$password,$confirmpassword,$type,$country,$gender,$file,$submit));


       

        

       

       
    }

}
