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
        //Review with John:
        //It seems odd to make a Course object that will end up being an array
        //of Course objects. Seems to work, but is it correct?
    	$courses = new Course();
    	$data['courses'] = $courses->get(); //ordered by id, by default?
        $data['course_edit'] = FALSE; //because we are not editing; see edit_course_form()
    	$this->load->view('courses_index', $data);
    }

    function new_course_form()
    {
    	//now that we're using Datamapper, we have the validations in the model,
        //not in the controller
    	//source: http://datamapper.wanwizard.eu/pages/validation.html#

    	$course = new Course();
    	$course->title = $this->input->post('title');
    	$course->course_description = $this->input->post('course_description');
    	$course->created_at = date("Y-m-d H:i:s");

    	if ($course->save()) //hmm, note that this is like rails!
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
        $course = new Course($this->input->post('course_id'));

        //load page, with course info so that the form is already filled in.
        //Need to DRY some of this up., since it is repeated from index()... how?
        $courses = new Course();
        $data['courses'] = $courses->get();
        // here is our info to populate the form, since we are editting a course
        $data['course_edit'] = $course;

        $this->load->view('courses_index', $data);
    }

    function update_course_form()
    {
        $course = new Course($this->input->post('course_id'));
        $course->title = $this->input->post('title');
        $course->course_description = $this->input->post('course_description');
        $course->updated_at = date("Y-m-d H:i:s");
        if ($course->save())
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