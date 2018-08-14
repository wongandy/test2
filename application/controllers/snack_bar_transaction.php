<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snack_bar_transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('snack_bar_transaction_model','snack_bar_transaction');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 3;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('snack_bar_transaction_view', $data);
	}
	
	public function reload_table(){
		$data['date_from'] = $this->input->post('date_from');
		$data['date_to'] = $this->input->post('date_to');
		
		$result['table_draw'] = $this->load->view('snack_bar_transaction_result', $data, true);
		
		echo json_encode($result);
	}
	
	public function get_snack_bar_detail($order_no){
		$order_header = $this->snack_bar_transaction->get_order_header3($order_no);
		$order_detail = $this->snack_bar_transaction->get_order_detail($order_no);
		
		$order_detail_view = '';
		foreach($order_detail as $key => $val){
			$order_detail_view .= '
			<tr>
				<td><input class="form-control" value="'.$val->product_name.'" readonly/></td>
				<td><input class="form-control" value="'.$val->price.'" readonly/></td>
				<td><input class="form-control" value="'.$val->quantity.'" readonly/></td>
				<td><input class="form-control" value="'.$val->subtotal.'" readonly/></td>
			</tr>
			';
		}
		
		$html_draw = '
		<div class="row">
			<div class="col-lg-2">
				<label>Order No :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->order_no.'" readonly/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2">
				<label>Room :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->room_name.'" readonly/>
			</div>
			<div class="col-lg-2">
				<label>Type :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->order_type.'" readonly/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2">
				<label>Created :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->datetime_created.'" readonly/>
			</div>
			<div class="col-lg-2">
				<label>Created By :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->created_by.'" readonly/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-2">
				<label>Updated :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->datetime_updated.'" readonly/>
			</div>
			<div class="col-lg-2">
				<label>Updated By :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.$order_header->updated_by.'" readonly/>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<table class="table" id="add-to-cart-table">
					<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Subtotal</th>
					</tr>
					</thead>
					<tbody>
						'.$order_detail_view.'
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
				</div>
			</div>
			<div class="col-lg-2">
				<label>Total :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" name="total" id="snacks-total" value="'.$order_header->total.'" readonly>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
				</div>
			</div>
			<div class="col-lg-2">
				<label>Money :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" name="snacks_money" id="snacks_money" value="'.$order_header->money.'" readonly>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
				</div>
			</div>
			<div class="col-lg-2">
				<label>Change :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" name="change" id="snacks-change" value="'.$order_header->money_change.'" readonly>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
				</div>
			</div>
			<div class="col-lg-2">
				<label>Paid :</label>
			</div>
			<div class="col-lg-4">
				<input class="form-control" value="'.($order_header->paid==1?'Yes':'No').'" readonly>
			</div>
		</div>
		';
		
		$result['html_draw'] = $html_draw;
		$result['order_no'] = $order_header->order_no;
		
		echo json_encode($result, true);
	}
	
	public function snack_bar_transaction_listing(){
		// $condition = " AND a.datetime_created BETWEEN '".$_GET['date_from']." 00:00:00' AND '".$_GET['date_to']." 23:59:59' ";
		$condition = " AND DATE(a.datetime_created) = '".$_GET['date_from']."'";
		$aColumns = array(	
						  'a.order_no',
						  'a.order_type',
						  'a.datetime_created',
						  'a.created_by',
						  'a.paid',
						  'a.total',
					   );
			
			$sIndexColumn = 'a.order_no';       			
			$sTable = "snack_bar_transactions_header AS a";
			$sJoin = "";
			
			/* 
			 * Paging
			 */
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
					mysql_real_escape_string( $_GET['iDisplayLength'] );
			}
	
			/*
			 * Ordering
			 */
			$sOrder = "";
			if ( isset( $_GET['iSortCol_0'] ) ) 
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
						$sOrder .= "".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]." ".
							mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
					}
				}
				
				$sOrder = substr_replace( $sOrder, "", -2 );
				$str_order = explode("  AS",$sOrder);
					if(@$str_order[1] != "")
					{
					  $sOrder = "ORDER BY".$str_order[1];
					}
					
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}
			
			/* 
			 * Filtering
			 * NOTE this does not match the built-in DataTables filtering which does it
			 * word by word on any field. It's possible to do here, but concerned about efficiency
			 * on very large tables, and MySQL's regex functionality is very limited
			 */
			 
		 
			$sWhere = " WHERE a.deleted=0 $condition";  
			if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" ){
				$sWhere .= " AND (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
					//$sWhere .= "".$aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR "; 
					$sFieldname = $aColumns[$i]; 
					if(strpos($sFieldname, "  AS ") !== false) {
						$arr = explode("  ", $sFieldname);
						$sFieldname = $arr[0];
					}
					$sWhere .= $sFieldname." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";   			
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
			}
			
			
			/* Individual column filtering */
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
				{
					if ( $sWhere == "" )
					{
						$sWhere = "WHERE ";
					}
					else
					{
						$sWhere .= " AND ";
					}
					$sFieldname = $aColumns[$i];
					if(strpos($sFieldname, "  AS ") !== false) 
					{
						$arr = explode("  ", $sFieldname);
						$sFieldname = $arr[0];
					}
				   $sWhere .= $sFieldname." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				 }   
					//$sWhere .= "".$aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
				
				//}
			}
			
			
			/*
			 * SQL queries
			 * Get data to display
			 */
			 
			$aColumns = array(
						  'a.order_no AS order_no',
						  'a.order_type AS order_type',
						  'DATE_FORMAT(a.datetime_created, "%M %d, %Y %H:%i:%s") AS datetime_created',
						  'a.created_by AS created_by',
						  'a.paid AS paid',
						  'a.total AS total',
					   );
			$sQuery = "
				SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
				FROM $sTable
				$sJoin
				$sWhere
				$sOrder
				$sLimit
				";    
			// die($sQuery);
			$sDataQuery = $sQuery;
			$rResult = mysql_query($sQuery);
			//echo $this->db->last_query(); 
			 
			/* Total data set length */
			$sQuery1 = "
				SELECT COUNT(".$sIndexColumn.") as 'totalcount'
				FROM   
				$sTable
				$sJoin
				$sWhere
			";
			
			//echo $sQuery1; die();
			//$rResultTotal = $this->db->query($sQuery1)->row(); 
			//$iTotal = $rResultTotal->totalcount;
			
			$rResultTotal = mysql_query( $sQuery1) or die(mysql_error());
			$aResultTotal = mysql_fetch_array($rResultTotal);
			$iTotal = $aResultTotal[0];
			
			/*
			 * Output
			 */
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iTotal,
				"aaData" => array(),
				"sQuery" => $sDataQuery
			);	  		
			
			$i = $_GET['iDisplayStart']+1;
			$allTotal = 0;
			while( $aRow = mysql_fetch_array($rResult))
			{   	
				$row = array();					
				//$row[] = $aRow['customer_id'];
				//$row[] = $aRow['first_name'].' '.$aRow['last_name'];
				$row[] = $aRow['order_no'];
				$row[] = $aRow['order_type'];
				$row[] = $aRow['datetime_created'];
				$row[] = $aRow['created_by'];
				$row[] = ($aRow['paid']==1?'Yes':'No');
				$row[] = '<a href="#" onclick="edit_this('.$aRow['order_no'].')">'.$aRow['total'].'</a>';
				
				$allTotal = $allTotal+$aRow['total'];
				// $row[] = '<a tag="'.$aRow['id'].'" id="priority_ticket_edit_btn_" href="#" style="color:#000;" onclick="edit_this('.$aRow['id'].')">
													 // <i class="fa fa-pencil fa-fw"></i>
													 // </a>
													 // &nbsp;|&nbsp;<a tag="'.$aRow['id'].'" id="rep_issue_del_btn_" href="#" style="color:#000;" onclick="delete_this('.$aRow['id'].')">
													 // <i class="fa fa-trash-o"></i>
													 // </a>';
				
				$i++;
				$output['aaData'][] = $row;
			}
			
			$row = array();
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = '';
			$row[] = 'TOTAL:';
			$row[] = $allTotal;
			
			$i++;
			$output['aaData'][] = $row;
	 
		echo json_encode( $output );
		exit();
	}
	
}