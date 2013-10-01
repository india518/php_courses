<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		//This cannot be used with Ajax, but if we disable Ajax it will
		// give us information about speeding up our queries:
		//$this->output->enable_profiler(TRUE);
    }

    function index()
    {
    	$courses = new Course();
    	$data['courses'] = $courses->get();

    	// echo "<h2>index view test</h2>";
    	// foreach($data['courses'] as $course)
    	// {
    	// 	echo "<p>{$course->title}: {$course->course_description}</p>";
    	// }

    	$this->load->view('courses_index', $data);
    }

}

//end of file