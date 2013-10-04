<?php

class Course extends Datamapper {

    // var $created_field = 'created_at';
    // var $updated_field = 'updated_at';

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

    public function p_save($course_data)
    {
        $data = elements(array('title', 'course_description'), $course_data, NULL);
        $this->title = $data['title'];
        $this->course_description = $data['course_description'];
        $this->created_at = date("Y-m-d H:i:s");

        return $this->save();  
    }

    public function p_update($course_data)
    {
        $data = elements(array('course_id', 'title', 'course_description'), $course_data, NULL);
        $this->id = $data['course_id'];
        $this->title = $data['title'];
        $this->course_description = $data['course_description'];
        $this->updated_at = date("Y-m-d H:i:s");

        return $this->save();  
    }
}

//end of file