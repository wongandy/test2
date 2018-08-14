<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'products';
		$this->load->database();
	}
	
	function request_order_number2(){
		$query = "SELECT order_number FROM order_number";
		$row = $this->db->query($query)->row();
		
		$query = "UPDATE order_number SET order_number=order_number+1";
		$this->db->query($query);
		
		return $row->order_number;
	}
	
	function request_order_number(){
		// if(date('H')>=0 AND date('H')<=4){
			// $date_today = date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
		// }else{
			// $date_today = $date('Y-m-d');
			// #$date_today = $date('Y-m-d');
		// }
		$date_today = date('Y-m-d');
		
		$query = "SELECT order_number FROM order_number WHERE order_date='".$date_today."'";
		$row = $this->db->query($query)->row();
		
		if(empty($row)){#empty
			$insert_data = array(
				'order_date' => $date_today,
				'order_number' => 1
			);
			$this->db->insert("order_number", $insert_data);
			
			$query = "SELECT order_number FROM order_number WHERE order_date='".$date_today."'";
			$row = $this->db->query($query)->row();
			
			$query = "UPDATE order_number SET order_number=order_number+1 WHERE order_date='".$date_today."'";
			$this->db->query($query);
			
			return $row->order_number;
		}else{#not empty
			$query = "SELECT order_number FROM order_number WHERE order_date='".$date_today."'";
			$row = $this->db->query($query)->row();
			
			$query = "UPDATE order_number SET order_number=order_number+1 WHERE order_date='".$date_today."'";
			$this->db->query($query);
			
			return $row->order_number;
		}
	}
	
	function get_active_products()
	{
		$query = "SELECT * FROM products WHERE active=1 and deleted=0";
		
		return $this->db->query($query)->result();
	}
	
	function get_inventory_products(){
		$query = "SELECT id,name FROM products_inventory WHERE deleted=0 ORDER BY name";
		
		return $this->db->query($query)->result();
	}
	
	function check_product_quantity($product_id){
		$query = "SELECT a.quantity, b.on_hand FROM product_detail AS a 
			LEFT JOIN products_inventory AS b ON a.pi_id=b.id 
		WHERE a.deleted=0 AND a.product_id=".$product_id;
		
		$result = $this->db->query($query)->result();
		
		foreach($result as $key => $val){
			if($val->quantity > $val->on_hand){
				return false;
				break;
			}
		}
		
		return true;
	}
	
	function insert_product($insert_data){
		if($this->db->insert($this->tbl_name, $insert_data))
			return $this->db->insert_id();
		else
			return false;
	}
	
	function insert_product_detail($product_id){
		$pi_id = $this->input->post("pi_id");
		$pi_quantity = $this->input->post("uom_quantity");
		
		foreach($pi_id as $key => $val){
			$insert_data = array(
				'product_id' => $product_id,
				'pi_id' => $val,
				'quantity' => $pi_quantity[$key],
				'deleted' => 0
			);
			
			$this->db->insert('product_detail', $insert_data);
		}
	}
	
	function get_product_header($product_id){
		$query = "SELECT * FROM products WHERE id=".$product_id;
		
		return $this->db->query($query)->row();
	}
	
	function get_product_detail($product_id){
		$query = "SELECT a.pi_id, a.quantity, b.name FROM product_detail AS a 
			LEFT JOIN products_inventory AS b ON a.pi_id=b.id 
		WHERE a.product_id=".$product_id." AND a.deleted=0";
		
		return $this->db->query($query)->result();
	}
	
	function update_product($update_data, $product_id){
		return $this->db->update($this->tbl_name, $update_data, array('id' => $product_id));
	}
	
	function update_product_detail($product_id){
		$pi_id = $this->input->post("pi_id");
		$pi_quantity = $this->input->post("uom_quantity");
		
		$delete_pi_id = $this->input->post("delete_pi_id");
		if($delete_pi_id){
		foreach($delete_pi_id as $key => $val){
			$query = "UPDATE product_detail SET deleted=1 WHERE product_id=".$product_id." AND pi_id=".$val;
			$this->db->query($query);
		}
		}
		
		foreach($pi_id as $key => $val){
		  $query = "SELECT id FROM product_detail WHERE product_id=".$product_id." AND pi_id=".$val." AND deleted=0";
		  $row = $this->db->query($query)->row();
		  
		  if(empty($row)){
			$insert_data = array(
				'product_id' => $product_id,
				'pi_id' => $val,
				'quantity' => $pi_quantity[$key],
				'deleted' => 0
			);
			
			$this->db->insert('product_detail', $insert_data);
		  }
		}
	}
	
	function delete_product($product_id){
		return $this->db->update($this->tbl_name, array('deleted' => 1), array('id' => $product_id));
	}
	
}