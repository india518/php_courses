<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Courses extends CI_Controller {

	function __construct()
    {
        parent::__construct();

		//This cannot be used with Ajax, but if we disable Ajax it will
		// give us information about speeding up our queries:
		$this->output->enable_profiler(TRUE);
    }

    function index()
    {
    	$courses = new Course();
    	$data['courses'] = $courses->get();
        
        $data['course_to_edit'] = FALSE; //because we are not editing; see edit_course_form()
    	
        $this->load->view('courses_index', $data);
        $courses->clear();
    }

    function new_course_form()
    {
    	//now that we're using Datamapper, we have the validations in the model,
        //not in the controller
    	//source: http://datamapper.wanwizard.eu/pages/validation.html#

    	$course = new Course();
    	
    	if ($course->p_save($this->input->post()))
    	{
    		redirect(base_url());   //will change this for AJAX
    	}
    	else
    	{
    		$this->session->set_flashdata('error_messages', $course->error->all);
    		redirect(base_url());
    	}
        // THOUGHTS ON AJAX, for the next step:
    	//note that once we implement AJAX, we'll need code (perhaps a helper function?)
    	// to construct the html for another accordion tab:
/* 		$html = <<<_HTML
			<div class="course_title">
				<h4 class="pull-left"><?#= $course->title ?></h4>
				<div class="title_bar_forms pull-right">
					<!-- insert 'edit' form here -->
					<a class="btn btn-primary">edit course</a>
					<!-- insert 'delete' form here -->
					<a class="btn btn-danger">delete course</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<p id="course_id_<?#= $course->id ?>"><?= $course->course_description ?></p>
_HTML
		$data = array();
		$data['html'] = $html;
		echo json_encode($data);*/
    }

    function edit_course()
    {
        //retrieve the object from the database
        $data['course_to_edit'] = new Course($this->input->post('course_id'));
        
        $courses = new Course();
        $data['courses'] = $courses->get();
        
        $this->load->view('courses_index', $data);
        $courses->clear();
    }

    function update_course_form()
    {
        $course = new Course($this->input->post('course_id'));
        
        if ($course->p_update($this->input->post()))
        {
            redirect(base_url());   //will change this for AJAX
        }
        else
        {
            $this->session->set_flashdata('error_messages', $course->error->all);
            redirect(base_url());
        }
    }

    function delete_course()
    {
        $course = new Course($this->input->post('course_id'));
        $course->delete();
        redirect(base_url());   //will change this for AJAX
    }
}

//end of file