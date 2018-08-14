<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('report_model','report');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 9;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('report_view', $data);
	}
	
	public function get_result(){
		$report_type = $this->input->post("report_type");
		$date_from = $this->input->post("date_from");
		$date_to = $this->input->post("date_to");
		
		$data = $this->report->get_report($report_type, $date_from, $date_to);
		
		if(!empty($data)){
		foreach($data as $key => $val)
			$report[] = array('label' => $val->label, 'value' => $val->value);
		}else{
			$report[] = array('label' => 'NONE', 'value' => 0);
		}
		
		$result['report'] = $report;
		
		echo json_encode($result, true);
	}
	
}