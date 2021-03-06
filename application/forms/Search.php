<?php

class Application_Form_Search extends Zend_Form
{

    public function init()
    {

        $this->setMethod('post');
        $this->addElement('select','search',
        array(
        'label'=> 'Search:',
        'multiOptions' => array(
            '--Choose--' => '--Choose--',
            'Courses' => 'Courses',
            'Users'   => 'Users',
            'Categories'  => 'Categories',
            'Materials'=>'Materials',
            'Comments'=>'Comments',
        )
    )
);
        
          //Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Search',
        ));
    }
  

}

