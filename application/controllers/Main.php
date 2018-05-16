<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Charter_model', 'charter_model', TRUE);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->config('forms');
		$form_array = $this->config->item('charter_form');
		// form_array name => array(type, label, rules, tip)
		foreach ($form_array as $name => $value) 
		{
			$label = $value['label'];
			$rules = $value['rules'];
			$this->form_validation->set_rules($name,$label,$rules);
		}
		if ($this->form_validation->run() == FALSE) 
		{
			$data['form_array'] = $form_array;
			$this->load->view('index', $data);
		} else {
            $post = $this->input->post();
            $clean = $this->security->xss_clean($post);
            $requestId = $this->charter_model->insertCharter($clean);
			if (!$requestId)
			{
                $this->session->set_flashdata('flash_message', 'A problem appeared in your request');
               //redirect(base_url().'main/login');
            } else {
                $requestInfo = $this->request_model->getRequestInfo($requestId);
                print_r($requestInfo);
                echo '<br>Your request had been taken, you will be contacted by e-mail when accepted <br>'
                . '<a href="'. base_url().'/main/">Back to login</a>';
            }
        }
	}
}
