<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snack_bar_transaction_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->tbl_name = 'snack_bar_transactions_header';
		$this->load->database();
	}
	
	function insert_transaction_header($insert_data){
		if($this->db->insert($this->tbl_name, $insert_data))
			return true;
		else
			return false;
	}
	
	function insert_transaction_detail($order_no){
		$cart_product_id = $this->input->post('cart_product_id');
		$cart_price = $this->input->post('cart_price');
		$cart_quantity = $this->input->post('cart_quantity');
		$cart_subtotal = $this->input->post('cart_subtotal');
		
		foreach($cart_product_id as $key => $val){
			$insert_data = array(
				'order_no' => $order_no,
				'product_id' => $val,
				'price' => $cart_price[$key],
				'quantity' => $cart_quantity[$key],
				'subtotal' => $cart_subtotal[$key],
				'deleted' => 0,
			);
			
			if($this->db->insert('snack_bar_transactions_detail', $insert_data)){
			  $query = "SELECT a.pi_id, a.quantity, c.name AS uom FROM product_detail AS a 
				LEFT JOIN products_inventory AS b ON a.pi_id=b.id 
				LEFT JOIN products_inventory_uom AS c ON b.uom=c.id 
				WHERE a.deleted=0 AND a.product_id=".$val;
		      $pi_id = $this->db->query($query)->result();
		
			  foreach($pi_id as $key2 => $val2){
				$true_qty = $val2->quantity*$cart_quantity[$key];
				$query = "UPDATE products_inventory SET on_hand=on_hand-".$true_qty." WHERE id=".$val2->pi_id;
				// $query = "UPDATE products_inventory SET on_hand=on_hand-".$cart_product_iqty[$key]." WHERE id=".$cart_product_inventory_id[$key];
				if(!$this->db->query($query))
					return false;
				else{
					$pi_history = array(
						'order_no' => $order_no,
						'product_id' => $val,
						'price' => $cart_price[$key],
						'pi_id' => $val2->pi_id,
						'quantity' => $true_qty,
						'uom_name' => $val2->uom,
						'datetime_created' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'created_by_id' => $this->session->userdata('user_id')
					);
					
					$this->db->insert('pi_history', $pi_history);
				}
			  }
			}else
				return false;
		}
		
		return true;
	}
	
	function update_transaction_header($update_data, $order_no){
		if($this->db->update($this->tbl_name, $update_data, array('order_no' => $order_no)))
			return true;
		else
			return false;
	}
	
	function get_order_header($order_no){
		$query = "SELECT order_type,total,money,money_change FROM snack_bar_transactions_header WHERE order_no=".$order_no." AND deleted=0";
		
		return $this->db->query($query)->row();
	}
	
	function get_order_header2($order_no){
		$query = "SELECT order_type,total,money,money_change FROM snack_bar_transactions_header WHERE order_no=".$order_no." AND deleted=0 AND paid=0";
		
		return $this->db->query($query)->row();
	}
	
	function get_order_header3($order_no){
		$query = "SELECT a.order_no, a.order_type, a.datetime_created, a.created_by, a.datetime_updated, a.updated_by, a.total, a.money, a.money_change, a.paid, b.name AS room_name FROM snack_bar_transactions_header AS a 
			LEFT JOIN rooms AS b ON a.room=b.id 
		WHERE a.order_no=".$order_no." AND a.deleted=0";
		
		return $this->db->query($query)->row();
	}
	
	function get_order_detail($order_no){
		$query = "SELECT a.price,a.quantity,a.subtotal,b.name AS product_name FROM snack_bar_transactions_detail AS a 
			LEFT JOIN products AS b ON a.product_id=b.id 
		WHERE a.order_no=".$order_no." AND a.deleted=0";
		
		return $this->db->query($query)->result();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}