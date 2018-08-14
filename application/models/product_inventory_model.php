<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_inventory_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'products_inventory';
		$this->load->database();
	}
	
	function get_all_product_inventory(){
		$query = "SELECT * FROM products_inventory WHERE deleted=0 ORDER BY name";
		
		return $this->db->query($query)->result();
	}
	
	function get_per_day_history($month, $year){
		$query = "SELECT a.type, a.order_no, a.pi_id, SUM(a.quantity) AS quantity, a.uom_name, a.datetime_created, a.created_by FROM pi_history AS a 
			WHERE MONTH(a.datetime_created)=".$month." AND YEAR(a.datetime_created)=".$year." GROUP BY a.order_no, a.pi_id ORDER BY a.datetime_created";
		
		$result = $this->db->query($query)->result();
		
		$return_value = array();
		foreach($result as $key => $val){
			$return_value[date('d',strtotime($val->datetime_created))][$val->pi_id][$val->order_no] = array($val->quantity, $val->created_by, $val->datetime_created, $val->uom_name, $val->type);
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_per_day_history2($month, $day, $year){
		$filter_date = $year.'-'.$month.'-'.$day;
		$filter_date = date('Y-m-d', strtotime($filter_date.' -4 days'));
		$filter_date1 = $year.'-'.$month.'-'.$day;
		
		$query = "SELECT a.type, a.order_no, a.pi_id, SUM(a.quantity) AS quantity, a.uom_name, a.datetime_created, a.created_by FROM pi_history AS a 
			WHERE DATE(a.datetime_created) BETWEEN '".$filter_date."' AND '".$filter_date1."' GROUP BY a.order_no, a.pi_id ORDER BY a.datetime_created";
		
		$result = $this->db->query($query)->result();
		
		$return_value = array();
		foreach($result as $key => $val){
			$return_value[date('d',strtotime($val->datetime_created))][$val->pi_id][$val->order_no] = array($val->quantity, $val->created_by, $val->datetime_created, $val->uom_name, $val->type);
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_pi_data($pi_id){
		$query = "SELECT * FROM products_inventory WHERE id=".$pi_id;
		
		return $this->db->query($query)->row();
	}
	
	function get_pi_history($pi_id){
		$query = "SELECT a.uom_name, a.type, a.order_no, a.pi_id, SUM(a.quantity) AS quantity, a.datetime_created, a.created_by FROM pi_history AS a 
			WHERE a.pi_id=".$pi_id." GROUP BY a.order_no, a.pi_id ORDER BY a.datetime_created";
		
		$result = $this->db->query($query)->result();
		
		$return_value = array();
		foreach($result as $key => $val){
			$return_value[$val->order_no] = array($val->quantity, $val->created_by, $val->datetime_created, $val->type, $val->uom_name);
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_pi_history2($pi_id){
		$query = "SELECT a.uom_name, a.type, a.order_no, a.pi_id, SUM(a.quantity) AS quantity, a.datetime_created, a.created_by FROM pi_history AS a 
			WHERE YEAR(datetime_created)='".date('Y')."' AND MONTH(datetime_created)='".date('m')."' AND a.pi_id=".$pi_id." GROUP BY a.order_no, a.pi_id ORDER BY a.datetime_created";
		
		$result = $this->db->query($query)->result();
		
		$return_value = array();
		foreach($result as $key => $val){
			$return_value[$val->order_no] = array($val->quantity, $val->created_by, $val->datetime_created, $val->type, $val->uom_name);
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_pi_total($month, $year, $product_inventory){
		$return_value = array();
		
		$max_day = (integer) date("t", strtotime($year.'-'.$month.'-1'));
		foreach($product_inventory as $key => $val){
		
		for($day=1;$day<=$max_day;$day++){
			$theDate = $year.'-'.$month.'-'.$day;
			
			$query = "SELECT SUM(quantity) AS pi_total FROM pi_history WHERE type=2 AND DATE(datetime_created) < DATE('".$theDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_total'] = ($row->pi_total==NULL?0:$row->pi_total);
			
			$query = "SELECT SUM(quantity) AS pi_added FROM pi_history WHERE type=2 AND DATE(datetime_created) = DATE('".$theDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_added'] = ($row->pi_added==NULL?0:$row->pi_added);
				
			$query = "SELECT SUM(quantity) AS pi_deducted FROM pi_history WHERE type=1 AND DATE(datetime_created) = DATE('".$theDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_deducted'] = ($row->pi_deducted==NULL?0:$row->pi_deducted);
			
			$query = "SELECT SUM(quantity) AS total_deducted FROM pi_history WHERE type=1 AND DATE(datetime_created) < DATE('".$theDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['total_deducted'] = ($row->total_deducted==NULL?0:$row->total_deducted);
		}
		
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_pi_total2($month, $dayx, $year, $product_inventory){
		$return_value = array();
		
		$max_day = (integer) date("t", strtotime($year.'-'.$month.'-1'));
		$max_day = $dayx;
		foreach($product_inventory as $key => $val){
		
		$theDate = $year.'-'.$month.'-'.$dayx;
		$theDate = date('Y-m-d', strtotime($theDate.' -4 days'));
		for($dayz=0;$dayz<=4;$dayz++){
			$dispDate = date('Y-m-d', strtotime($theDate.' +'.$dayz.' days'));
			$day = (integer) date('d', strtotime($dispDate));
			
			$query = "SELECT SUM(quantity) AS pi_total FROM pi_history WHERE type=2 AND DATE(datetime_created) < DATE('".$dispDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_total'] = ($row->pi_total==NULL?0:$row->pi_total);
			
			$query = "SELECT SUM(quantity) AS pi_added FROM pi_history WHERE type=2 AND DATE(datetime_created) = DATE('".$dispDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_added'] = ($row->pi_added==NULL?0:$row->pi_added);
				
			$query = "SELECT SUM(quantity) AS pi_deducted FROM pi_history WHERE type=1 AND DATE(datetime_created) = DATE('".$dispDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['pi_deducted'] = ($row->pi_deducted==NULL?0:$row->pi_deducted);
			
			$query = "SELECT SUM(quantity) AS total_deducted FROM pi_history WHERE type=1 AND DATE(datetime_created) < DATE('".$dispDate."') AND pi_id=".$val->id;
			$row = $this->db->query($query)->row();
			
			$return_value[$val->id][$day]['total_deducted'] = ($row->total_deducted==NULL?0:$row->total_deducted);
		}
		
		}
		
		// echo '<pre>';
		// var_dump($return_value);die();
		return $return_value;
	}
	
	function get_all_uom(){
		$query = "SELECT id,name FROM products_inventory_uom";
		
		return $this->db->query($query)->result();
	}
	
	function insert_pi($insert_data){
		if($this->db->insert($this->tbl_name, $insert_data))
			return $this->db->insert_id();
		else
			return false;
	}
	
	function update_pi($update_data, $pi_id){
		return $this->db->update($this->tbl_name, $update_data, array('id' => $pi_id));
	}
	
	function request_purchase_number(){
		$query = "SELECT purchase_number FROM purchase_number";
		$row = $this->db->query($query)->row();
		
		$query = "UPDATE purchase_number SET purchase_number=purchase_number+1";
		$this->db->query($query);
		
		return $row->purchase_number;
	}
	
	function pi_purchase($purchase, $uom_name, $pi_id, $special_uom=0){
		$order_no = 'PO'.$this->request_purchase_number();
		
		if($special_uom!=0){
			$purchase = $purchase*$special_uom;
		}
		
		$insert_data = array(
			'type' => 2,
			'order_no' => $order_no,
			'pi_id' => $pi_id,
			'quantity' => $purchase,
			'uom_name' => $uom_name,
			'datetime_created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username'),
			'created_by_id' => $this->session->userdata('user_id')
		);
		
		if($this->db->insert('pi_history', $insert_data)){
			$query = "UPDATE products_inventory SET on_hand=on_hand+".$purchase." WHERE id=".$pi_id;
			$this->db->query($query);
		}
	}
	
	function is_uom_special($uom){
		$query = "SELECT equivalent FROM products_inventory_uom WHERE id=".$uom." AND special=1";
		$row = $this->db->query($query)->row();
		
		if(!empty($row))
			return $row->equivalent;
		else
			return 0;
	}
	
	function active_pi_product($pi_id){
		$query = "SELECT a.id FROM product_detail AS a 
			LEFT JOIN products AS b ON a.product_id=b.id 
		WHERE a.pi_id=".$pi_id." AND b.deleted=0";
		
		$row = $this->db->query($query)->row();
		
		if(empty($row))
			return false;
		else
			return true;
	}
	
	function delete_pi($pi_id){
		$query = "UPDATE products_inventory SET deleted=1 WHERE id=".$pi_id;
		$this->db->query($query);
	}
	
}