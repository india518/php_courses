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
            // if ($course->exists())
            // {
            //     echo $course->id;
            //     die;
            // }
    		//redirect(base_url());
            
            $html = <<<_HTML
            <div id="title_course_{$course->id}" class="course_title_bar">
                <h4>{$course->title}</h4>
                <div class="course_actions">
                    <form class="delete_course" action="{base_url()}courses/delete_course" method="post">
                        <input type="hidden" name="course_id" value="{$course->id}" />
                        <input type="submit" class="btn btn-danger" value="Delete Course" />
                    </form>
                    <form class="edit_course" action="{base_url()}courses/edit_course" method="post">
                        <input type="hidden" name="course_id" value="{$course->id}" />
                        <input type="submit" class="btn btn-primary" value="Edit Course" />
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <p id="course_id_{$course->id}">{$course->course_description}</p>
_HTML;
            $data = array();
            $data['html'] = $html;
            $data['action'] = 'add';
            echo json_encode($data);
    	}
    	else
    	{
    		$this->session->set_flashdata('error_messages', $course->error->all);
    		redirect(base_url());
    	}
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
            //redirect(base_url());   //will change this for AJAX
            $title = <<<_HTML
            <div id="title_course_{$course->id}" class="course_title_bar">
                <h4>{$course->title}</h4>
                <div class="course_actions">
                    <form class="delete_course" action="{base_url()}courses/delete_course" method="post">
                        <input type="hidden" name="course_id" value="{$course->id}" />
                        <input type="submit" class="btn btn-danger" value="Delete Course" />
                    </form>
                    <form class="edit_course" action="{base_url()}courses/edit_course" method="post">
                        <input type="hidden" name="course_id" value="{$course->id}" />
                        <input type="submit" class="btn btn-primary" value="Edit Course" />
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
_HTML;
            $description = "<p id='course_id_{$course->id}'>{$course->course_description}</p>";

            $data = array();
            $data['html']['title'] = $title;
            $data['html']['description'] = $description;
            $data['action'] = 'update';
            $data['id'] = $course->id;
            echo json_encode($data);
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
        //redirect(base_url());   //will change this for AJAX
        echo json_encode("");
    }
}

//end of file