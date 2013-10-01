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
        parent::__construct($id);
    }

    function get_course($id)
    {
        //create a temporary course object
        $course = new Course();

        // Get the record for this course
        $course->get_by_id($id);
    }

}

//end of file