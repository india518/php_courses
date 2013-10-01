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
    	$data['courses'] = $courses->get(); //seems to be ordered by id, by default
    	$this->load->view('courses_index', $data);
    }

    function process_course_form()
    {
    	//now that we're using Datamapper, we use the validations in the model
    	//http://datamapper.wanwizard.eu/pages/validation.html#

    	//Tighten this up into fewer lines later:
    	$course = new Course();
    	$course->title = $this->input->post('title');
    	$course->course_description = $this->input->post('course_description');
    	$course->created_at = date("Y-m-d H:i:s");
    	$course->save();

    	redirect(base_url());
    }
}

//end of file