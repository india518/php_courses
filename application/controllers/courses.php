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
    	$data['courses'] = $courses->get(); //seems to be ordered by id, by default
        $data['course_edit'] = FALSE; //we are not editing; see edit_course_form()
    	$this->load->view('courses_index', $data);
    }

    function new_course_form()
    {
    	//now that we're using Datamapper, we use the validations in the model
    	//http://datamapper.wanwizard.eu/pages/validation.html#

    	//Tighten this up into fewer lines later:
    	$course = new Course();
    	$course->title = $this->input->post('title');
    	$course->course_description = $this->input->post('course_description');
    	$course->created_at = date("Y-m-d H:i:s");
    	//$save_success = $course->save(); //unneccessary step

    	if ($course->save()) //hmm, note that this is like rails!
    	{
    		redirect(base_url());
    	}
    	else
    	{
    		$this->session->set_flashdata('error_messages', $course->error->all);
    		redirect(base_url());
    	}
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
        //get the object from the database
        $course = new Course();
        $course->where('id', $this->input->post('course_id'))->get();

        //load page with course info for form
        //Need to DRY some of this up... how?
        $courses = new Course();
        $data['courses'] = $courses->get(); //seems to be ordered by id, by default
        // here is our info for the form, since we are editting a course
        $data['course_edit'] = $course;
        $this->load->view('courses_index', $data);
    }

    function update_course_form()
    {
        //while getting this to work, lets create some helpful variables we can delete later:
        $id = $this->input->post('course_id');
        $title = $this->input->post('title');
        $description = $this->input->post('course_description');

        //get the object from the database
        $course = new Course();
        $course->where('id', $id)->get();
        $course->title = $title;
        $course->course_description = $description;
        $course->updated_at = date("Y-m-d H:i:s");
        if ($course->save()) //hmm, note that this is like rails!
        {
            redirect(base_url());
        }
        else
        {
            // var_dump($course->error->all);
            // die();
            $this->session->set_flashdata('error_messages', $course->error->all);
            redirect(base_url());
        }
    }

    function delete_course()
    {
        //get the object from the database
        $course = new Course();
        $course->where('id', $this->input->post('course_id'))->get();
        
        //delete object
        $course->delete();
        redirect(base_url());   //will change this for AJAX
    }
}

//end of file