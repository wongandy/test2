<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_setup_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'page_setup';
		$this->load->database();
	}
	
	function get_page_setup()
	{
		$query = "SELECT * FROM page_setup WHERE id=1";
		
		return $this->db->query($query)->row();
	}
	
	function checker(){
		$query = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'project_xyz' AND TABLE_NAME = 'additional_mrt_person' AND COLUMN_NAME = 'description'";
		
		$row = $this->db->query($query)->row();
		
		if(empty($row)){
			$query = "ALTER TABLE `additional_mrt_person` ADD `description` varchar(300) NULL default ''";
			$this->db->query($query);
		}
	}
	
}