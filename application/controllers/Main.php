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
			$clean['date']= date("Y-M-d H:i");
            $requestId = $this->charter_model->insertCharter($clean);
			if (!$requestId)
			{
				echo "A problem appeared in your request";
            } else {
                echo '<br>Your request had been taken, you will be contacted by e-mail when accepted <br>'
				. '<a href="http://paracou.cirad.fr">Back to Paracou Gateway</a>';
				// Mail here
            }
        }
	}
}
