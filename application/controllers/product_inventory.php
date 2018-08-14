<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_inventory extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('product_inventory_model','product_inventory');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 8;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('product_inventory_view', $data);
	}
	
	public function get_result($month, $year){
		$product_inventory = $this->product_inventory->get_all_product_inventory();
		$pi_result = $this->product_inventory->get_per_day_history($month, $year);
		$pi_total = $this->product_inventory->get_pi_total($month, $year, $product_inventory);
		
		$table_draw = '
		<table class="table">
			<thead><tr>
			<th>Product</th>
		';
		
		$max_day = (integer) date("t", strtotime($year.'-'.$month.'-1'));
		for($day=1;$day<=$max_day;$day++){
			$table_draw .= '<th>'.date('M d', strtotime($year.'-'.$month.'-'.$day)).'</th>';
		}
		// $table_draw .= '<th><div style="width:150px;">QTY On Hand</div></th></tr></thead>';
		
		$table_draw .= '<tbody>';
		
		foreach($product_inventory as $key => $val){
			$table_draw .= '<tr><td><div style="width:200px;"><a href="#" class="view_pi" pi_id="'.$val->id.'">'.$val->name.'</a></div></td>';
			for($day=1;$day<=$max_day;$day++){
				if($day<10)
					$day_ = '0'.$day;
				else
					$day_ = $day;
					
				$div_draw = '<div style="width:225px;">';
				$div_draw .= '<p><b>'.$val->name.'</b></p>';
			  
				if($pi_total[$val->id][$day]['pi_added']!=0)
					$div_draw .= '<p style="color:green;"><b>'.$pi_total[$val->id][$day]['pi_total'].' + '.$pi_total[$val->id][$day]['pi_added'].' = '.($pi_total[$val->id][$day]['pi_total']+$pi_total[$val->id][$day]['pi_added']).'</b></p>';
				else
					$div_draw .= '<p style="color:green;"><b>No Purchase</b></p>';
				
				$div_draw .= '<p style="color:red;"><b>'.(($pi_total[$val->id][$day]['pi_total']+$pi_total[$val->id][$day]['pi_added'])-$pi_total[$val->id][$day]['total_deducted']).' - '.$pi_total[$val->id][$day]['pi_deducted'].' = '.((($pi_total[$val->id][$day]['pi_total']+$pi_total[$val->id][$day]['pi_added'])-$pi_total[$val->id][$day]['total_deducted'])-$pi_total[$val->id][$day]['pi_deducted']).'</b></p>';
					
				if(!empty($pi_result[$day_][$val->id])){
					
				  foreach($pi_result[$day_][$val->id] as $key2 => $val2){
					$p_uom = $val2[3];
				   if($val2[4]==1){
					$div_draw .= '<p>Order No: '.$key2.'</p>
							<p>Quantity: -'.$val2[0].' '.$val2[3].'</p>
							<p>Created By: '.$val2[1].'</p>
							<p>------------------------------</p>';
				   }else{
					$div_draw .= '<p>Purchase No: '.$key2.'</p>
							<p>Quantity: +'.($val2[3]=='cup'?($val2[0]/300):($val2[3]=='kilogram'?($val2[0]/1000):$val2[0])).' '.$val2[3].'</p>
							<p>Created By: '.$val2[1].'</p>
							<p>------------------------------</p>';
				   }
				  }
					$div_draw .= '</div>';
					$table_draw .= '<td>'.$div_draw.'</td>';
				}else
					$table_draw .= '<td>'.$div_draw.'</td>';
			}
			// $table_draw .= '<th>'.$val->on_hand.'</th>';
			$table_draw .= '</tr>';
		}
		
		$table_draw .= '</tbody>';
		
		$table_draw .= '</table>';
		
		$result['table_draw'] = $table_draw;
		
		echo json_encode($result);
	}
	
	public function get_result2($month, $dayx, $year){
		$product_inventory = $this->product_inventory->get_all_product_inventory();
		// $pi_result = $this->product_inventory->get_per_day_history($month, $year);
		$pi_result = $this->product_inventory->get_per_day_history2($month, $dayx, $year);
		// $pi_total = $this->product_inventory->get_pi_total($month, $year, $product_inventory);
		$pi_total = $this->product_inventory->get_pi_total2($month, $dayx, $year, $product_inventory);
		
		// echo '<pre>';
		// var_dump($pi_total);die();
		
		$table_draw = '
		<table class="table">
			<thead><tr>
			<th>Product</th>
		';
		
		$max_day = (integer) date("t", strtotime($year.'-'.$month.'-1'));
		$max_day = $dayx;
		// for($day=$dayx-4;$day<=$max_day;$day++){
		$theDate = $year.'-'.$month.'-'.$dayx;
		$theDate = date('Y-m-d', strtotime($theDate.' -4 days'));
		for($dayz=0;$dayz<=4;$dayz++){
			$dispDate = date('Y-m-d', strtotime($theDate.' +'.$dayz.' days'));
			$table_draw .= '<th>'.date('M d', strtotime($dispDate)).'</th>';
		}
		
		// $table_draw .= '<th><div style="width:150px;">QTY On Hand</div></th></tr></thead>';
		
		$table_draw .= '<tbody>';
		
		$theDate = $year.'-'.$month.'-'.$dayx;
		$theDate = date('Y-m-d', strtotime($theDate.' -4 days'));
		foreach($product_inventory as $key => $val){
			$table_draw .= '<tr><td><div style="width:200px;"><a href="#" class="view_pi" pi_id="'.$val->id.'">'.$val->name.'</a></div></td>';
			// for($day=1;$day<=$max_day;$day++){
			// for($day=$dayx;$day<=$max_day;$day++){
			// for($day=$dayx-4;$day<=$max_day;$day++){
			for($dayz=0;$dayz<=4;$dayz++){
				$dispDate = date('Y-m-d', strtotime($theDate.' +'.$dayz.' days'));
				$day = (integer) date('d', strtotime($dispDate));
				
				if($day<10)
					$day_ = '0'.$day;
				else
					$day_ = $day;
					
				$div_draw = '<div style="width:225px;">';
				$div_draw .= '<p><b>'.$val->name.'</b></p>';
			  
				if($pi_total[$val->id][$day]['pi_added']!=0){
					$first = (integer) $pi_total[$val->id][$day]['pi_total'];
					$second = (integer) $pi_total[$val->id][$day]['total_deducted'];
					$div_draw .= '<p style="color:red;"><b>'.($first - $second).' + '.$pi_total[$val->id][$day]['pi_added'].' = '.(($first - $second)+$pi_total[$val->id][$day]['pi_added']).'</b></p>';
				}else
					$div_draw .= '<p style="color:red;"><b>No Purchase</b></p>';
				
				$div_draw .= '<p style="color:black;"><b>'.(($pi_total[$val->id][$day]['pi_total']+$pi_total[$val->id][$day]['pi_added'])-$pi_total[$val->id][$day]['total_deducted']).' - '.$pi_total[$val->id][$day]['pi_deducted'].' = '.((($pi_total[$val->id][$day]['pi_total']+$pi_total[$val->id][$day]['pi_added'])-$pi_total[$val->id][$day]['total_deducted'])-$pi_total[$val->id][$day]['pi_deducted']).'</b></p>';
				
				if(!empty($pi_result[$day_][$val->id])){
					$details = '';
					
				  foreach($pi_result[$day_][$val->id] as $key2 => $val2){
					$p_uom = $val2[3];
				   if($val2[4]==1){
					$details .= '<p>Order No: '.$key2.'</p>
							<p>Quantity: -'.$val2[0].' '.$val2[3].'</p>
							<p>Created By: '.$val2[1].'</p>
							<p>------------------------------</p>';
				   }else{
					$details .= '<p>Purchase No: '.$key2.'</p>
							<p>Quantity: +'.($val2[3]=='cup'?($val2[0]/300):($val2[3]=='kilogram'?($val2[0]/1000):$val2[0])).' '.$val2[3].'</p>
							<p>Created By: '.$val2[1].'</p>
							<p>------------------------------</p>';
				   }
				  }
					$details .= '</div>';
					
					$div_draw .= '<p><a href="#" class="view-detail" detail="'.$details.'">View Details</a></p>';
				}
					
				// if(!empty($pi_result[$day_][$val->id])){
					
				  // foreach($pi_result[$day_][$val->id] as $key2 => $val2){
					// $p_uom = $val2[3];
				   // if($val2[4]==1){
					// $div_draw .= '<p>Order No: '.$key2.'</p>
							// <p>Quantity: -'.$val2[0].' '.$val2[3].'</p>
							// <p>Created By: '.$val2[1].'</p>
							// <p>------------------------------</p>';
				   // }else{
					// $div_draw .= '<p>Purchase No: '.$key2.'</p>
							// <p>Quantity: +'.($val2[3]=='cup'?($val2[0]/300):($val2[3]=='kilogram'?($val2[0]/1000):$val2[0])).' '.$val2[3].'</p>
							// <p>Created By: '.$val2[1].'</p>
							// <p>------------------------------</p>';
				   // }
				  // }
					// $div_draw .= '</div>';
					// $table_draw .= '<td>'.$div_draw.'</td>';
				// }else
					$table_draw .= '<td>'.$div_draw.'</td>';
			}
			// $table_draw .= '<th>'.$val->on_hand.'</th>';
			$table_draw .= '</tr>';
		}
		
		$table_draw .= '</tbody>';
		
		$table_draw .= '</table>';
		
		$result['table_draw'] = $table_draw;
		
		echo json_encode($result);
	}
	
	public function get_uom_data(){
		$uom = $this->product_inventory->get_all_uom();
		$uom_selectbox = '<select class="form-control" id="uom" name="uom">';
		$uom_name = '';
		foreach($uom as $key => $val){
			$uom_selectbox .= '<option value="'.$val->id.'">'.$val->name.'</option>';
		}
		$uom_selectbox .= '</select>';
		
		$result['uom_selectbox'] = $uom_selectbox;
		
		echo json_encode($result, true);
	}
	
	public function get_pi_data($pi_id){
		$pi_data = $this->product_inventory->get_pi_data($pi_id);
		$pi_history = $this->product_inventory->get_pi_history2($pi_id);
		
		$uom = $this->product_inventory->get_all_uom();
		$uom_selectbox = '<select class="form-control" id="uom" name="uom">';
		$uom_name = '';
		foreach($uom as $key => $val){
			if($pi_data->uom==$val->id)
				$uom_name = $val->name;
				
			$uom_selectbox .= '<option '.($pi_data->uom==$val->id?'selected':'').' value="'.$val->id.'">'.$val->name.'</option>';
		}
		$uom_selectbox .= '</select>';
		
		$timeline_detail = '';
		$total_purchase = 0;
		foreach($pi_history as $key => $val){
			
			if($val[3]==1){
				$total_purchase = $total_purchase+$val[0];
				$timeline_detail .= '
					<li class="timeline-inverted">
						<div class="timeline-badge danger">
							<i class="fa fa-minus-square"></i>
						</div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Snacks Bar Transaction</h4>
							</div>
							<div class="timeline-body">
								<p>Order No : '.$key.'</p>
								<p>Quantity : '.$val[0].' '.$val[4].'</p>
								<p>Created By : '.$val[1].'</p>
								<p>Datetime Created : '.$val[2].'</p>
							</div>
						</div>
					</li>
				';
			}else{
				$timeline_detail .= '
					<li>
						<div class="timeline-badge success">
							<i class="fa fa-plus-square"></i>
						</div>
						<div class="timeline-panel">
							<div class="timeline-heading">
								<h4 class="timeline-title">Purchase</h4>
							</div>
							<div class="timeline-body">
								<p>Order No : '.$key.'</p>
								<p>Quantity : '.($val[4]=='cup'?($val[0]/300):($val[4]=='kilogram'?($val[0]/1000):$val[0])).' '.$val[4].'</p>
								<p>Created By : '.$val[1].'</p>
								<p>Datetime Created : '.$val[2].'</p>
							</div>
						</div>
					</li>
				';
			}
		}
		
		$total_purchase = $total_purchase+$pi_data->on_hand;
		
		$pi_timeline = '
		<div class="row">
		<div class="col-lg-12">
			<ul class="timeline">
				'.$timeline_detail.'
				<li>
					<div class="timeline-badge">
						<i class="fa fa-check-square"></i>
					</div>
					<div class="timeline-panel">
						<div class="timeline-heading">
							<h4 class="timeline-title">Total '.$pi_data->name.' Purchase : '.$total_purchase.' '.$uom_name.'</h4>
						</div>
						<div class="timeline-body">
							<p></p>
						</div>
					</div>
				</li>
			</ul>
		</div>
		</div>
		';
		
		$result['name'] = $pi_data->name;
		$result['on_hand'] = $pi_data->on_hand;
		$result['uom_selectbox'] = $uom_selectbox;
		$result['pi_timeline'] = $pi_timeline;
		
		echo json_encode($result, true);
	}
	
	public function add_pi(){
		$pi_name = $this->input->post('pi_name');
		$uom = $this->input->post('uom');
		$purchase = $this->input->post('purchase');
		$uom_name = $this->input->post('uom_name');
		
		$insert_data = array(
			'name' => $pi_name,
			'uom' => $uom,
		);
		
		$pi_id = $this->product_inventory->insert_pi($insert_data);
		if($pi_id){
			if($purchase>=1)
				$this->product_inventory->pi_purchase($purchase, $uom_name, $pi_id);
				
			$result['error'] = 0;
			$result['msg'] = 'Successfuly added the product inventory.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon adding of product inventory.';
		}
		
		echo json_encode($result, true);
	}
	
	public function update_pi($pi_id){
		$pi_name = $this->input->post('pi_name');
		$uom = $this->input->post('uom');
		$purchase = $this->input->post('purchase');
		$uom_name = $this->input->post('uom_name');
		
		$special_uom = $this->product_inventory->is_uom_special($uom);
		if($special_uom!=0){
		
			$update_data = array(
				'name' => $pi_name
			);
		
		}else{
			$update_data = array(
				'name' => $pi_name,
				'uom' => $uom
			);
		}
		
		if($this->product_inventory->update_pi($update_data, $pi_id)){
			if($purchase>=1)
				$this->product_inventory->pi_purchase($purchase, $uom_name, $pi_id, $special_uom);
				
			$result['error'] = 0;
			$result['msg'] = 'Successfully updated the product inventory.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon updating of product inventory.';
		}
		
		echo json_encode($result, true);
	}
	
	function delete_pi($pi_id){
		if($this->product_inventory->active_pi_product($pi_id)){
			$result['error'] = 1;
			$result['msg'] = 'Issue upon deleting of product inventory. Product inventory is still used on a certain product. Please delete first the product.';
		}else{
			$this->product_inventory->delete_pi($pi_id);
			
			$result['error'] = 0;
			$result['msg'] = 'Successfully deleted the product inventory.';
		}
		
		echo json_encode($result, true);
	}
	
}