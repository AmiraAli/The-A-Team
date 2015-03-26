<?php

class Application_Form_AddCourse extends Zend_Form {

    public function init() {

        $this->setMethod("POST");

         $this->setDecorators(array(
            'FormElements',
            'Form',
            array(array('wholerow' => 'HtmlTag'), array('tag' => 'tr')),
            array(array('table' => 'HtmlTag'),    array('tag' => 'table')),
        ));
       
         $this->addElement('hidden','process',array(
            'value'=>'addcourse'
        ));
         
        $this->addElement('text', 'title', array(
            'label' => 'Title :',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(array('stringLength', false, array(1, 25))),
            //array('messages'=>'*email is required')
            
        ));

        $this->addElement('textarea', 'desc', array(
            'label' => 'Description :',
            'required' => true,
            'validators' => array(array('stringLength', false, array(1, 1000))
            ),
            'cols' => '20',
            'rows' => '12',
            'filter' => 'StringTrim',
        ));
        
       
        
        $categories = new Zend_Form_Element_Select("categories");
        $categories->setLabel("Category");
        $_categories = new Application_Model_Categories();
        $types_array = $_categories->listCategories();
        for ($i = 0; $i < count($types_array); $i++) {
            $categories->addMultiOption($types_array[$i]['name'], $types_array[$i]['name']);
        }
        $this->addElement($categories);
        
        
        
        $this->addElement('select', 'duration', array(
            'label' => 'Duration(week/s):',
            'multiOptions' => array(
                
                '1' => '1', '2' => '2', '3' => '3', '3' => '3', '4' => '4',
                '5' => '5', '6' => '6', '7' => '7', '8' => '8',
                '9' => '9', '10' => '10', '11' => '11', '12' => '12',
            ),
        ));
        $this->addElement('select', 'year', array(
            'label' => 'year',
            'multiOptions' => array(
                '2015' => '2015', '2016' => '2016', '2017' => '2017',
                '2018' => '2018', '2019' => '2019',
                '2020' => '2020',
            ),
             'decorators'=>array(
            'ViewHelper',
            array(array('filedtd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('fieldtr' => 'HtmlTag'), array('tag' => 'tr')),
            'Label',
            array(array('labeltd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('labertr' => 'HtmlTag'), array('tag' => 'tr')),
            array(array('table' => 'HtmlTag'),   array('tag' => 'table')),
            array(array('wholetd' => 'HtmlTag'), array('tag' => 'td')),
            )
        ));

        $this->addElement('select', 'month', array(
            'label' => 'month',
            'multiOptions' => array(
                'January' => 'January',
                'February' => 'February',
                'March' => 'March',
                'April' => 'April',
                'May' => 'May',
                'June' => 'June',
                'July' => 'July',
                'August' => 'August',
                'September' => 'September',
                'October' => 'October',
                'November' => 'November',
                'December' => 'December',
            ),
             'decorators'=>array(
            'ViewHelper',
            array(array('filedtd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('fieldtr' => 'HtmlTag'), array('tag' => 'tr')),
            'Label',
            array(array('labeltd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('labertr' => 'HtmlTag'), array('tag' => 'tr')),
            array(array('table' => 'HtmlTag'),   array('tag' => 'table')),
            array(array('wholetd' => 'HtmlTag'), array('tag' => 'td')),
            )
        ));
        $this->addElement('select', 'day', array(
            'label' => 'day',
            'multiOptions' => array(
               
                '1' => '1', '2' => '2', '3' => '3', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10',
                '11' => '11', '12' => '12', '13' => '13', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '29', '30' => '30',
                '21' => '21', '22' => '22', '23' => '23', '23' => '23', '24' => '24', '25' => '25', '26' => '26', '27' => '27', '28' => '28', '29' => '29', '30' => '30',
            ),
             'decorators'=>array(
            'ViewHelper',
            array(array('filedtd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('fieldtr' => 'HtmlTag'), array('tag' => 'tr')),
            'Label',
            array(array('labeltd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('labertr' => 'HtmlTag'), array('tag' => 'tr')),
            array(array('table' => 'HtmlTag'),   array('tag' => 'table')),
            array(array('wholetd' => 'HtmlTag'), array('tag' => 'td')),
            )
        ));
        $this->addElement('submit', 'addcourse', array(
            'ignore' => true,
            'label' => 'Post Now',
            'decorators'=>array(
            'ViewHelper',
            array(array('filedtd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('fieldtr' => 'HtmlTag'), array('tag' => 'tr')),
            'Label',
            array(array('labeltd' => 'HtmlTag'), array('tag' => 'td')),
            array(array('labertr' => 'HtmlTag'), array('tag' => 'tr')),
            array(array('table' => 'HtmlTag'),   array('tag' => 'table')),
            array(array('wholetd' => 'HtmlTag'), array('tag' => 'td')),
            )
        ));
    }

}
