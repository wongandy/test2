<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movies_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'movies';
		$this->load->database();
	}
	
	function get_active_movies()
	{
		$query = "SELECT id,name,duration FROM movies WHERE active=1 and deleted=0 ORDER BY name";
		
		return $this->db->query($query)->result();
	}
	
	function insert_movie($insert_data){
		return $this->db->insert($this->tbl_name, $insert_data);
	}
	
	function get_movie_data($movie_id){
		$query = "SELECT * FROM movies WHERE id=".$movie_id;
		
		return $this->db->query($query)->row();
	}
	
	function update_movie($update_data, $movie_id){
		return $this->db->update($this->tbl_name, $update_data, array('id' => $movie_id));
	}
	
	function delete_movie($movie_id){
		return $this->db->update($this->tbl_name, array('deleted' => 1), array('id' => $movie_id));
	}
	
	function special_query(){
		$query = "SELECT position AS id, duration FROM movies_raw";
		
		$result = $this->db->query($query)->result();
		
		foreach($result as $key => $val){
			$this->db->update("movies",array('duration' => $val->duration),array('position' => (integer)$val->id));
			echo $val->id.'<br>';
		}
		// foreach($result as $key => $val){
			// $durationH = (string) $val->duration / 60;
			// $explodedDH = explode(".", $durationH);
			// $durationM = (integer) $val->duration % 60;
			// $new_duration = $explodedDH[0].':'.$durationM;
			
			// $this->db->update("movies_raw",array('duration' => $new_duration),array('position' => $val->id));
			// echo $val->id.'<br>';
		// }
	}
	
}