<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rooms_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'rooms';
		$this->load->database();
	}
	
	function get_active_rooms()
	{
		$query = "SELECT id,name,color FROM rooms WHERE active=1 and deleted=0";
		
		return $this->db->query($query)->result();
	}
	
	function insert_room($insert_data){
		return $this->db->insert($this->tbl_name, $insert_data);
	}
	
	function get_room_data($room_id){
		$query = "SELECT * FROM rooms WHERE id=".$room_id;
		
		return $this->db->query($query)->row();
	}
	
	function update_room($update_data, $room_id){
		return $this->db->update($this->tbl_name, $update_data, array('id' => $room_id));
	}
	
	function delete_room($room_id){
		return $this->db->update($this->tbl_name, array('deleted' => 1), array('id' => $room_id));
	}
	
}