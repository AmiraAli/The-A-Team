
<?php

class Application_Form_Matrial extends Zend_Form {

    public function init() {
        $this->setMethod("post");
        $this->setAttrib("class", "form-inline");
        //name of matrial
        $matrialname = new Zend_Form_Element_Text("name");
        $matrialname->setAttrib("class", "form-control");
        $matrialname->setLabel("Name: ");
        $matrialname->setRequired();
        $matrialname->addFilter(new Zend_Filter_StripTags);

        //select matrial types
        $type = new Zend_Form_Element_Select("matrialtype");

        $matrial_model = new Application_Model_Types();

        $types_array = $matrial_model->selectAllTypes();
        for ($i = 0; $i < count($types_array); $i++) {
            $type->addMultiOption($types_array[$i]['name'], $types_array[$i]['name']);
        }
        $type->setAttrib("class","form-control");
        $type->setLabel("Matrial Type: ");
        $type->setRequired();

        //Add matrial
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setAttrib("class","btn btn-primary");

        $this->addElements(array($matrialname, $type, $submit));
    }

}
?>
