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

	private function _requestMail($requestInfo){

        $this->load->library('email');
        $this->load->config('email');
		$email_config = $this->config->item('email');
		
		$request_email_title = $this->config->item('request_email_title');
		$request_email = $this->config->item('request_email');
		$this->email->initialize($email_config);
		
		$this->email->from("noreply@paracou.cirad.fr", 'Paracou Form');
        $this->email->to($requestInfo->email);
        $this->email->subject($request_email_title);
		$this->email->message("Dear $requestInfo->name_principal_investigator, <br>
		$request_email
		");
        
        $r = $this->email->send();
        $this->email->clear();
        if(!$r){
            log_message('error', $this->email->print_debugger());
        }

        $message_admin = "$requestInfo->name_principal_investigator ($requestInfo->email) applied on paracoucharter, <a href='https://paracoucharter.cirad.fr/admin'>click here</a> to go on the admin panel";
		
		$admin_list = $this->config->item('admin_list');

        foreach ($admin_list as $admin) {
            $this->email->initialize($email_config);
            $this->email->from("noreply@paracou.cirad.fr", 'Paracou Form');
            $this->email->to($admin['email']);
            $this->email->subject('Request received in Paracou Form');
            $this->email->message($message_admin);
            $r_admin = $this->email->send();
            $this->email->clear();
            
            if(!$r_admin){
                log_message('error', $this->email->print_debugger());
            }
		}
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
			$this->form_validation->set_rules($name, $label, $rules);
		}

		if ($this->form_validation->run() == FALSE) 
		{
			$data['form_array'] = $form_array;
			$this->load->view('index', $data);
		} else {
            $post = $this->input->post();
			$clean = $this->security->xss_clean($post);
			$clean['date']= date("Y-m-d H:i");
            $requestId = $this->charter_model->insertCharter($clean);
			if (!$requestId)
			{
				echo "A problem appeared in your request";
            } else {
				$request = $this->charter_model->getCharterInfo($requestId);
				echo '<br>Your request had been taken, you will be contacted by e-mail when accepted <br>'
				. '<a href="http://paracou.cirad.fr">Back to Paracou Gateway</a>';
				$this->_requestMail($request);
            }
        }
	}
}
