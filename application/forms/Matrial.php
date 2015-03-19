
<?php

class Application_Form_Matrial extends Zend_Form {

    public function init() {
        $this->setMethod("post");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib("class", "form-inline");

        //name of matrial
        $matrialname = new Zend_Form_Element_Text("name");
        $matrialname->setAttrib("class", "form-control");
        $matrialname->setLabel("Name: ");
        $matrialname->setRequired();
        $matrialname->addFilter(new Zend_Filter_StripTags);

        //select matrial types
        $type = new Zend_Form_Element_Select("matrialtype");

        //get all types  of matrial from database
        $matrial_model = new Application_Model_Types();

        $types_array = $matrial_model->selectAllTypes();
        for ($i = 0; $i < count($types_array); $i++) {
            $type->addMultiOption($types_array[$i]['name'], $types_array[$i]['name']);
        }
        $type->setAttrib("class", "form-control");
        $type->setLabel("Matrial Type: ");
        $type->setRequired();

        //uploading matrial

        $destination = APPLICATION_PATH . '/../public/materials';

        $file = new Zend_Form_Element_File("file");
        $file->setLabel("Upload Material: ");
        $file->setAttrib('class', 'form-control');
        $file->setDestination('/var/www/html/The-A-Team/public/materials');
        $file->setRequired();

        //Add matrial
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setAttrib("class", "btn btn-primary");

        $this->addElements(array($matrialname, $type, $file, $submit));
    }

}


        
//        $file = new Zend_Form_Element_File('file');
//        $file->setAttrib('id', 'templateFile')
//                ->setAttrib('class', 'form-control')
//                ->setAttrib('placeholder', 'File containing template headers')
//                ->setLabel('Upload matrial:')
//                ->setDestination("$destination")
////                ->addFilter('Rename',$destination) 
//                ->setRequired(true)
//                ->addValidator('Count', false, 1)
//                ->addValidator('NotEmpty', false)
//                ->addValidator('Size', false, '15MB')
//                ->addValidator("Extension", false, array('txt', 'csv','text'))
//                 ->setValueDisabled(true)
//                ->addFilter('StringTrim');
