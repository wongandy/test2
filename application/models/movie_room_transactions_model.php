<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_room_transactions_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'movie_room_transactions';
		$this->load->database();
	}
	
	function room_transaction_check($room_id)
	{
		$query = "SELECT id,check_out FROM movie_room_transactions WHERE room_id=".$room_id." AND DATE(check_out)='".date('Y-m-d')."' AND deleted=0 ORDER BY check_out DESC";
		
		return $this->db->query($query)->row();
	}
	
	function room_transaction_check2($room_id,$check_in,$check_out){
		
		$query = "SELECT id FROM movie_room_transactions WHERE room_id=".$room_id." AND DATE(check_in)='".date('Y-m-d')."' AND deleted=0 AND (TIME(check_in) BETWEEN TIME('".date('H:i:s',$check_in)."') AND TIME('".date('H:i:s',$check_out)."') OR TIME(check_out) BETWEEN TIME('".date('H:i:s',$check_in)."') AND TIME('".date('H:i:s',$check_out)."'))";
		
		if($this->db->query($query)->row())
			return true;
		else
			return false;
	}
	
	function get_previous_transaction($room_id, $check_in){
		$query = "SELECT check_out FROM movie_room_transactions WHERE room_id=".$room_id." AND DATE(check_in)='".date('Y-m-d')."' AND deleted=0 AND done!=1 AND TIME(check_out) < TIME('".date('H:i:s',$check_in)."') ORDER BY check_out DESC";
		
		$row = $this->db->query($query)->row();
		
		if(!empty($row))
			return $row->check_out;
		else
			return 0;
	}
	
	function insert_transaction($insert_data){
		if($this->db->insert($this->tbl_name, $insert_data))
			return true;
		else
			return false;
	}
	
	function insert_additional_person($insert_data){
		if($this->db->insert("additional_mrt_person", $insert_data))
			return true;
		else
			return false;
	}
	
	function get_room_occupancy($rooms){
		$theDate = date('Y-m-d');
		$theDate2 = date('Y-m-d', strtotime($theDate . ' +1 day'));
		// $theDate = '2017-08-05';
		
		$query = "SELECT a.id,a.room_id,a.no_of_person, a.check_in,a.check_out,c.name AS movie_name FROM movie_room_transactions AS a 
			LEFT JOIN movies AS c ON c.id=a.movie_id 
		WHERE a.check_in BETWEEN '".$theDate." 06:00:00' AND '".$theDate2." 04:00:00' AND a.deleted=0 AND a.done=0 ORDER BY a.check_in";
		
		// echo $query;die();		
		
		$result = $this->db->query($query)->result();
		
		$data = array();
		foreach($result as $key => $val){
			$query = "SELECT SUM(additional_person) AS additional_person FROM additional_mrt_person WHERE mrt_id=".$val->id." AND deleted=0";
			$row = $this->db->query($query)->row();
			if(!empty($row))
				$no_of_person = $val->no_of_person+$row->additional_person;
			else
				$no_of_person = $val->no_of_person;
			
			$data[$val->room_id][] = array($val->id, $no_of_person, $val->check_in, $val->check_out, $val->movie_name);
		}
		
		$draw_data = array();
		$last_check_out = '';
		for($x=0;$x<15;$x++){
			foreach($rooms as $key => $val){
				if(!empty($data[$val->id][$x])){
					$draw_data[$val->id][$x] = $data[$val->id][$x];
					$last_check_out = $data[$val->id][$x][3];
				}else{
					$draw_data[$val->id][$x] = array();
				}
			}
		}
		
		// echo '<pre>';
		// print_r($draw_data);die();
		
		return $draw_data;
		
	}
	
	function force_done($rooms=array()){
		$query = "UPDATE movie_room_transactions SET done=1 WHERE check_out<'".date('Y-m-d H:i:s')."'";
		
		$this->db->query($query);
		
		$query = "DELETE FROM vacant_room_schedule WHERE check_out<'".date('Y-m-d H:i:s')."'";
		
		$this->db->query($query);
		
		foreach($rooms as $room_key => $room_val){
			if(!$this->have_advanced_reservation(date('Y-m-d H:i:s'),$room_val->id)){
				$query = "SELECT id FROM movie_room_transactions WHERE room_id=".$room_val->id." AND done=0 ";
				$row = $this->db->query($query)->row();
				
				if(empty($row)){
					$query = "DELETE FROM vacant_room_schedule WHERE room_id=".$room_val->id;
			
					$this->db->query($query);
				}
			}
		}
	}
	
	function get_mrt_detail($mrt_id){
		$query = "SELECT c.name AS movie_name, b.name AS room_name, a.id, a.no_of_person, a.corkage, a.money, a.total, a.money_change, a.check_in, a.check_out, a.datetime_created, a.created_by FROM movie_room_transactions AS a 
			LEFT JOIN rooms AS b ON a.room_id=b.id 
			LEFT JOIN movies AS c ON a.movie_id=c.id 
			WHERE a.id=".$mrt_id;
			
		return $this->db->query($query)->row();
	}
	
	function get_mrt_additional($mrt_id){
		$query = "SELECT * FROM additional_mrt_person WHERE mrt_id=".$mrt_id;
		
		return $this->db->query($query)->result();
	}
	
	function fresh_room_transaction($room_id){
		$query = "SELECT id FROM movie_room_transactions WHERE DATE(datetime_created)='".date('Y-m-d')."' AND deleted=0 AND done=0 AND room_id=".$room_id;
		
		$row = $this->db->query($query)->row();
		
		if(empty($row))
			return true;
		else
			return false;
	}
	
	function insert_vrs($insert_data){
		$this->db->insert('vacant_room_schedule', $insert_data);
	}
	
	function get_vacant_detail($mrt_id){
		$query = "SELECT * FROM vacant_room_schedule WHERE id=".$mrt_id;
		
		return $this->db->query($query)->row();
	}
	
	function have_advanced_reservation($check_in,$room_id){
<<<<<<< HEAD
		$query = "SELECT id FROM movie_room_transactions WHERE check_in>'".$check_in."' AND deleted=0 AND done=0 AND room_id=".$room_id;
=======
		$query = "SELECT id FROM movie_room_transactions WHERE check_in>='".$check_in."' AND deleted=0 AND done=0 AND room_id=".$room_id;
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		
		$row = $this->db->query($query)->row();
		
		if(!empty($row))
			return true;
		else
			return false;
	}
	
	function delete_after_checkin_vrs($check_in,$room_id){
		$query = "DELETE FROM vacant_room_schedule WHERE room_id=".$room_id." AND check_in>='".$check_in."'";
		
		$this->db->query($query);
	}
	
	function delete_vrs_id($mrt_id){
		$query = "DELETE FROM vacant_room_schedule WHERE id=".$mrt_id;
		
		$this->db->query($query);
	}
	
	function get_room_occupancy2($rooms){
<<<<<<< HEAD
		$query = "SELECT a.id,a.room_id,a.no_of_person, a.check_in,a.check_out,c.name AS movie_name,a.movie_id FROM movie_room_transactions AS a 
=======
		$query = "SELECT a.id,a.room_id,a.no_of_person, a.check_in,a.check_out,c.name AS movie_name FROM movie_room_transactions AS a 
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
			LEFT JOIN movies AS c ON c.id=a.movie_id 
		WHERE DATE(a.check_in)='".date('Y-m-d')."' AND a.deleted=0 AND a.done=0 ORDER BY a.check_in";
		
		$room_checkin = $this->db->query($query)->result();
		
		$data = array();
		foreach($room_checkin as $key => $val){
			$query = "SELECT SUM(additional_person) AS additional_person FROM additional_mrt_person WHERE mrt_id=".$val->id." AND deleted=0";
			$row = $this->db->query($query)->row();
			if(!empty($row))
				$no_of_person = $val->no_of_person+$row->additional_person;
			else
				$no_of_person = $val->no_of_person;
			
			// $data[$val->room_id][$val->check_in] = array($val->id, $no_of_person, $val->check_in, $val->check_out, $val->movie_name);
<<<<<<< HEAD
			$data[$val->room_id.'|'.$val->check_in] = array($val->id, $no_of_person, $val->check_in, $val->check_out, $val->movie_name, $val->movie_id);
=======
			$data[$val->room_id.'|'.$val->check_in] = array($val->id, $no_of_person, $val->check_in, $val->check_out, $val->movie_name);
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		}
		
		$query = "SELECT * FROM vacant_room_schedule WHERE status=1 AND DATE(datetime_created)='".date('Y-m-d')."'";
		
		$room_vacant = $this->db->query($query)->result();
		
		foreach($room_vacant as $key => $val){
			// $data[$val->room_id][$val->check_in] = array($val->id, 0, $val->check_in, $val->check_out, 'vacant');
<<<<<<< HEAD
			$data[$val->room_id.'|'.$val->check_in] = array($val->id, 0, $val->check_in, $val->check_out, 'Vacant',0);
=======
			$data[$val->room_id.'|'.$val->check_in] = array($val->id, 0, $val->check_in, $val->check_out, 'Vacant');
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		}
		
		ksort($data);
		
		// echo '<pre>';
		// var_dump($data);die();
		return $data;
	}
	
	function room_occupancy_near_end_id(){
		$query = "SELECT id FROM movie_room_transactions WHERE deleted=0 AND done=0 ORDER BY check_out";
		
		$row = $this->db->query($query)->row();
		
		if(!empty($row))
			return $row->id;
		else
			return 0;
	}
	
	function vacant_near_end_id(){
		$query = "SELECT id FROM vacant_room_schedule WHERE 1=1 ORDER BY check_in";
		
		$row = $this->db->query($query)->row();
		
		if(!empty($row))
			return $row->id;
		else
			return 0;
	}
	
<<<<<<< HEAD
	function get_mrt_details($mrt_id){
		$query = "SELECT * FROM movie_room_transactions WHERE id=".$mrt_id;
		$row = $this->db->query($query)->row();
		
		return $row;
	}
	
	function update_room_movie($update_data, $mrt_id){
		$this->db->update('movie_room_transactions', $update_data, array('id' => $mrt_id) );
	}
=======
	
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}