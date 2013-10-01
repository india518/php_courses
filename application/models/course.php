<?php

class Course extends Datamapper {

    var $created_field = 'created_at';
    var $updated_field = 'updated_at';

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

    function create_course($course)
    {
    	//NOTE: always make sure that you set this in config.php:
        // $config['global_xss_filtering'] = TRUE;
        $course['created_at'] = date("Y-m-d H:i:s");
        $course_created = $this->db->insert('courses', $course);
        //$course_created is a boolean flag that indicates if our SQL
        // transaction is successful

        //$course_id = $this->db->insert_id();
        return $this->db->insert_id();
    }

}

//end of file