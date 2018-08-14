<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'users';
		$this->load->database();
	}
	
	function authenticate($username, $password)
	{
		$query = "SELECT * FROM users WHERE username='".mysql_real_escape_string($username)."' AND password='".$password."' AND deleted=0";
		
		return $this->db->query($query)->row();
	}
	
	function get_users(){
		$query = "SELECT * FROM users WHERE deleted=0";
		
		return $this->db->query($query)->result();
	}
	
	function insert_user($insert_data){
		return $this->db->insert($this->tbl_name, $insert_data);
	}
	
	function get_user_data($user_id){
		$query = "SELECT * FROM users WHERE id=".$user_id;
		
		return $this->db->query($query)->row();
	}
	
	function update_user($update_data, $user_id){
		return $this->db->update($this->tbl_name, $update_data, array('id' => $user_id));
	}
	
	function delete_user($user_id){
		return $this->db->update($this->tbl_name, array('date_deleted' => date('Y-m-d H:i:s'), 'deleted' => 1), array('id' => $user_id));
	}
	
	function get_user_roles(){
		$query = "SELECT * FROM user_roles";
		
		return $this->db->query($query)->result();
	}
	
}