<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = '';
		$this->load->database();
	}
	
	function get_report($report_type, $date_from, $date_to){
		if($report_type==1){#Top 5 Products
			$query = "SELECT b.name AS label, SUM(a.quantity) AS value FROM snack_bar_transactions_detail AS a 
				LEFT JOIN products AS b ON a.product_id=b.id 
			WHERE a.deleted=0 AND a.order_no IN (SELECT order_no FROM snack_bar_transactions_header WHERE DATE(datetime_created) BETWEEN DATE('".$date_from."') AND DATE('".$date_to."')) GROUP BY a.product_id 
			ORDER BY `value`  DESC LIMIT 5";
		}else if($report_type==2){#Top 5 Movies
			$query = "SELECT b.name as label, COUNT(a.movie_id) AS value FROM movie_room_transactions AS a 
				LEFT JOIN movies AS b ON a.movie_id=b.id 
			WHERE a.deleted=0 AND DATE(a.datetime_created) BETWEEN DATE('".$date_from."') AND DATE('".$date_to."') GROUP BY a.movie_id 
			ORDER BY `value`  DESC LIMIT 5";
		}
		
		return $this->db->query($query)->result();
	}
	
}