<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('users_model','users');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 4;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('users_view', $data);
	}
	
	public function get_role_selectbox(){
		$roles = $this->users->get_user_roles();
		$role_selectbox = '<select class="form-control" id="role" name="role">';
		foreach($roles as $key => $val){
			$role_selectbox .= '<option value="'.$val->id.'">'.$val->name.'</option>';
		}
		$role_selectbox .= '</select>';
		
		$result['role_selectbox'] = $role_selectbox;
		
		echo json_encode($result, true);
	}
	
	public function add_user(){
		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$username = trim($this->input->post('username'));
		$password = $this->input->post('password');
		$role_id = $this->input->post('role');
		
		$insert_data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'username' => $username,
			'password' => $password,
			'role_id' => $role_id,
			'date_created' => date('Y-m-d H:i:s')
		);
		
		if($this->users->insert_user($insert_data)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly added the user.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon adding of user.';
		}
		
		echo json_encode($result, true);
	}
	
	public function get_user_detail($user_id){
		$user = $this->users->get_user_data($user_id);
		
		$roles = $this->users->get_user_roles();
		$role_selectbox = '<select class="form-control" id="role" name="role">';
		foreach($roles as $key => $val){
			$role_selectbox .= '<option '.($val->id==$user->role_id?'selected':'').' value="'.$val->id.'">'.$val->name.'</option>';
		}
		$role_selectbox .= '</select>';
		
		$result['role_selectbox'] = $role_selectbox;
		
		$result['firstname'] = $user->firstname;
		$result['lastname'] = $user->lastname;
		$result['username'] = $user->username;
		$result['password'] = $user->password;
		
		echo json_encode($result, true);
	}
	
	public function update_user($user_id){
		$firstname = trim($this->input->post('firstname'));
		$lastname = trim($this->input->post('lastname'));
		$username = trim($this->input->post('username'));
		$password = $this->input->post('password');
		$role_id = $this->input->post('role');
		
		$update_data = array(
			'firstname' => $firstname,
			'lastname' => $lastname,
			'username' => $username,
			'password' => $password,
			'role_id' => $role_id,
			'date_updated' => date('Y-m-d H:i:s')
		);
		
		if($this->users->update_user($update_data, $user_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly updated the user.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon update of user.';
		}
		
		echo json_encode($result, true);
	}
	
	public function delete_user($user_id){
		if($this->users->delete_user($user_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly deleted the user.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon delete of user.';
		}
		
		echo json_encode($result, true);
	}
	
	public function user_listing(){
		$condition = "";
		$aColumns = array(	
						  'a.id',			
						  'a.username',
						  'b.name',
					   );
			
			$sIndexColumn = 'a.id';       			
			$sTable = "users a";
			$sJoin = " LEFT JOIN user_roles b ON a.role_id=b.id ";
			
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
						  'a.id AS id',			
						  'a.username AS username',
						  'b.name AS role_name',
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
			while( $aRow = mysql_fetch_array($rResult))
			{   	
				$row = array();					
				//$row[] = $aRow['customer_id'];
				//$row[] = $aRow['first_name'].' '.$aRow['last_name'];
				$row[] = $aRow['id'];
				$row[] = $aRow['username'];
				$row[] = $aRow['role_name'];
				$row[] = '<a tag="'.$aRow['id'].'" id="priority_ticket_edit_btn_" href="#" style="color:#000;" onclick="edit_this('.$aRow['id'].')">
													 <i class="fa fa-pencil fa-fw"></i>
													 </a>
													 &nbsp;|&nbsp;<a tag="'.$aRow['id'].'" id="rep_issue_del_btn_" href="#" style="color:#000;" onclick="delete_this('.$aRow['id'].')">
													 <i class="fa fa-trash-o"></i>
													 </a>';
				
				$i++;
				$output['aaData'][] = $row;
			}	
	 
		echo json_encode( $output );
		exit();
	}
	
}