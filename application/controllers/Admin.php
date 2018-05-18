<?php
class Admin extends CI_Controller
{
    public function __construct() 
	{
		parent::__construct();
		$this->load->model('Charter_model', 'charter_model', TRUE);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Charter_model', 'charter_model');
        $this->load->library('session');
    }
    
    private function _checkRights()
    {
        redirect(base_url().'admin/login');
    }
    
    public function login()
    {
        
    }
    
    public function index()
    {
        $this->_checkRights();
    }

    public function accept_request($id){
        $this->_checkRights();
        $requestinfo = $this->request_model->getCharterInfo($id);
        if ($requestinfo) {
            $this->request_model->acceptCharter($id);
            redirect(base_url().'admin/list_requests/');
        } else if (isset($requestinfo->approved)) {
            $this->session->set_flashdata('error_message',"The request n°$id approval is already filled");
            redirect(base_url().'admin/list_requests/');
        } else {
            $this->session->set_flashdata('error_message',"The request n°$id doesn't exist");
            redirect(base_url().'admin/list_requests/');
        }
    }

    public function decline_request($id){
        $this->_checkRights();
        $requestinfo = $this->request_model->getCharterInfo($id);
        if (($requestinfo) && !isset($requestinfo->approved)) {
            $this->request_model->declineCharter($id);
            redirect(base_url().'admin/list_requests/');
        } else if (isset($requestinfo->approved)) {
            $this->session->set_flashdata('error_message',"The request n°$id approval is already filled");
            redirect(base_url().'admin/list_requests/');
        } else {
            $this->session->set_flashdata('error_message',"The request n°$id doesn't exist");
            redirect(base_url().'admin/list_requests/');
        }
    }

    public function show_request($id){
        $this->_checkRights();
        $this->load->config('forms');
        $form_array = $this->config->item('admin_charter_form');
        $requestinfo = (array)$this->charter_model->getCharterInfo($id);
        $form_info = array_merge_recursive($form_array,$requestinfo);
        $data["id"] = $id;
        if ($requestinfo) {
            $data['form_info'] = $form_info;
        } else {
            $this->session->set_flashdata('error_message',"The request n°$id doesn't exist");
            redirect(base_url().'admin/list_requests/');
        }
        $this->load->view('admin/header');
        $this->load->view('admin/show_request', $data);
        $this->load->view('admin/footer');
    }

    public function list_requests()
    {
        #### Account verifications ####
        $this->_checkRights();
        $get = $this->input->get();
        $flash['flash_message'] = $this->session->flashdata('error_message');
        $requests = $this->charter_model->getCharterList(); // get requests list
        $data['requests'] = $requests;
        if(isset($get["csv"])){
            $array = json_decode(json_encode($requests), True);
            $this->exports_array_csv($array,"Request_list");
        }
        #### Views ####
        $this->load->view('admin/header');
        $this->load->view('admin/list_requests', $data);
        $this->load->view('admin/footer');
    }
}
