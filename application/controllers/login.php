<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('users_model','users');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['row'] = $this->page_setup->get_page_setup();
		$this->load->view('login_view', $data);
	}
	
	public function authenticate(){
		$result['error'] = 0;
		$result['message'] = '';
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		$user_detail = $this->users->authenticate($username, $password);
		
		if(!empty($user_detail)){
			$data = array(
				'is_login' => 1,
				'username' => $user_detail->username,
				'user_id' => $user_detail->id,
				'role' => $user_detail->role_id
			);
					
			$this->session->set_userdata($data);
		}else{
			$result['error'] = 1;
			$result['message'] = 'Username or/and Password did not match!';
		}
		
		echo json_encode($result);
	}
	
	public function logged_out(){
		$this->session->sess_destroy();
		
		redirect($this->config->base_url());
	}
}