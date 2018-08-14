<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movie_room_transaction extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('movie_room_transactions_model','movie_room_transaction');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 2;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('movie_room_transaction_view', $data);
	}
	
	public function reload_table(){
		$data['date_from'] = $this->input->post('date_from');
		$data['date_to'] = $this->input->post('date_to');
		
		$result['table_draw'] = $this->load->view('movie_room_transaction_result', $data, true);
		
		echo json_encode($result);
	}
	
	public function add_room(){
		$name = trim($this->input->post('room_name'));
		$color = $this->input->post('color');
		$active = $this->input->post('active');
		
		$insert_data = array(
			'name' => $name,
			'color' => $color,
			'active' => $active
		);
		
		if($this->rooms->insert_room($insert_data)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly added the room.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon adding of room.';
		}
		
		echo json_encode($result, true);
	}
	
	public function get_mrt_detail($mrt_id){
		$data = $this->movie_room_transaction->get_mrt_detail($mrt_id);
		$additional = $this->movie_room_transaction->get_mrt_additional($mrt_id);
		
		$additional_table = '
			<table class="table">
				<thead>
				<tr>
					<th>Additional Person</th>
					<th>Money</th>
					<th>Money Change</th>
					<th>Total</th>
					<th>Created By</th>
					<th>Datetime Created</th>
				</tr>
				</thead>
				<tbody>
		';
		foreach($additional as $key => $val){
			$additional_table .= '
				<tr>
					<td>'.$val->additional_person.' - <p style="color:red;">'.$val->description.'</p></td>
					<td>'.$val->money.'</td>
					<td>'.$val->money_change.'</td>
					<td>'.$val->total.'</td>
					<td>'.$val->created_by.'</td>
					<td>'.$val->datetime_created.'</td>
				</tr>
			';
		}
		$additional_table .= '</tbody></table>';
		
		$result['id'] = $data->id;
		$result['no_of_person'] = $data->no_of_person;
		$result['corkage'] = $data->corkage;
		$result['room_name'] = $data->room_name;
		$result['movie_name'] = $data->movie_name;
		$result['check_in'] = $data->check_in;
		$result['check_out'] = $data->check_out;
		$result['money'] = $data->money;
		$result['money_change'] = $data->money_change;
		$result['total'] = $data->total;
		$result['datetime_created'] = $data->datetime_created;
		$result['created_by'] = $data->created_by;
		$result['additional_table'] = $additional_table;
		
		echo json_encode($result, true);
	}
	
	public function update_room($room_id){
		$name = trim($this->input->post('room_name'));
		$color = $this->input->post('color');
		$active = $this->input->post('active');
		
		$update_data = array(
			'name' => $name,
			'color' => $color,
			'active' => $active
		);
		
		if($this->rooms->update_room($update_data, $room_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly updated the room.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon update of room.';
		}
		
		echo json_encode($result, true);
	}
	
	public function delete_room($room_id){
		if($this->rooms->delete_room($room_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly deleted the room.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon delete of room.';
		}
		
		echo json_encode($result, true);
	}
	
	public function movie_room_transaction_listing(){
		// $condition = " AND a.datetime_created BETWEEN '".$_GET['date_from']." 00:00:00' AND '".$_GET['date_to']." 23:59:59' ";
		$condition = " AND DATE(a.datetime_created) = '".$_GET['date_from']."'";
		$aColumns = array(	
						  'a.id',			
						  'b.name',
						  'c.name',
						  'a.check_in',
						  'a.check_out',
						  'a.total',
					   );
			
			$sIndexColumn = 'a.id';       			
			$sTable = "movie_room_transactions AS a";
			$sJoin = " LEFT JOIN rooms AS b ON a.room_id=b.id ";
			$sJoin .= " LEFT JOIN movies AS c ON a.movie_id=c.id ";
			
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
						  'a.id AS idx',			
						  'b.name AS room_name',
						  'c.name AS movie_name',
						  'DATE_FORMAT(a.check_in, "%M %d, %Y %H:%i:%s") AS check_in',
						  'DATE_FORMAT(a.check_out, "%M %d, %Y %H:%i:%s") AS check_out',
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
				
				$query = "SELECT SUM(total) AS atotal FROM additional_mrt_person WHERE mrt_id=".$aRow['idx'];
				$additional = mysql_query($query);
				$additionalResult = mysql_fetch_array($additional);
				if(!empty($additionalResult))
					$waTotal = $aRow['total']+$additionalResult[0];
				else
					$waTotal = $aRow['total'];
					
				$row[] = $aRow['idx'];
				$row[] = $aRow['room_name'];
				$row[] = $aRow['movie_name'];
				$row[] = $aRow['check_in'];
				$row[] = $aRow['check_out'];
				$row[] = '<a href="#" onclick="edit_this('.$aRow['idx'].')">'.$waTotal.'</a>';
				
				$allTotal = $allTotal+$waTotal;
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