<?php

class Course extends Datamapper {

    var $created_field = 'created_at';
    var $updated_field = 'updated_at';

    var $validation = array(
        'title' => array(
            'label' => 'Title',
            'rules' => array('required')
        ),
        'course_description' => array(
            'label' => 'Description',
            'rules' => array('required')
        )
    );

    function __construct($id = NULL)
    {
        //including the (optional) $id parameter lets us load a model by ID
        // when it is created. (See courses/edit_course() and courses/update_course_form()
        // for an example of this in action
        parent::__construct($id);
    }

}

//end of file