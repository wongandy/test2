<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movies extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('movies_model','movies');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$data['menu_id'] = 5;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('movies_view', $data);
	}
	
	public function add_movie(){
		$name = trim($this->input->post('movie_name'));
		$description = $this->input->post('description');
		$duration = trim($this->input->post('duration'));
		$active = $this->input->post('active');
		$imdb_rating = $this->input->post('imdb_rating');
		$year = $this->input->post('year');
		$position = $this->input->post('position');
		$genres = $this->input->post('genres');
		
		$insert_data = array(
			'name' => $name,
			'description' => $description,
			'duration' => $duration,
			'active' => $active,
			'imbd_rating' => $imdb_rating,
			'year' => $year,
			'position' => $position,
			'genres' => $genres
		);
		
		if($this->movies->insert_movie($insert_data)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly added the movie.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon adding of movie.';
		}
		
		echo json_encode($result, true);
	}
	
	public function get_movie_detail($movie_id){
		$movie = $this->movies->get_movie_data($movie_id);
		
		$result['movie_name'] = $movie->name;
		$result['description'] = $movie->description;
		$result['duration'] = $movie->duration;
		$result['imdb_rating'] = $movie->imbd_rating;
		$result['year'] = $movie->year;
		$result['position'] = $movie->position;
		$result['genres'] = $movie->genres;
		$result['active'] = $movie->active;
		
		echo json_encode($result, true);
	}
	
	public function update_movie($movie_id){
		$name = trim($this->input->post('movie_name'));
		$description = $this->input->post('description');
		$duration = trim($this->input->post('duration'));
		$active = $this->input->post('active');
		$imdb_rating = $this->input->post('imdb_rating');
		$year = $this->input->post('year');
		$position = $this->input->post('position');
		$genres = $this->input->post('genres');
		
		$update_data = array(
			'name' => $name,
			'description' => $description,
			'duration' => $duration,
			'active' => $active,
			'imbd_rating' => $imdb_rating,
			'year' => $year,
			'position' => $position,
			'genres' => $genres
		);
		
		if($this->movies->update_movie($update_data, $movie_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly updated the movie.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon update of movie.';
		}
		
		echo json_encode($result, true);
	}
	
	public function delete_movie($movie_id){
		if($this->movies->delete_movie($movie_id)){
			$result['error'] = 0;
			$result['msg'] = 'Successfuly deleted the movie.';
		}else{
			$result['error'] = 1;
			$result['msg'] = 'Issue upon delete of movie.';
		}
		
		echo json_encode($result, true);
	}
	
	public function movie_listing(){
		$condition = "";
		$aColumns = array(			
						  'name',
						  'imbd_rating',
						  'duration',
						  'genres',
						  'year',
						  'id',
					   );
			
			$sIndexColumn = 'id';       			
			$sTable = "movies";
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
			 
		 
			$sWhere = " WHERE deleted=0 $condition";  
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
						  'name',
						  'imbd_rating',
						  'duration',
						  'genres',
						  'year',
						  'id',
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
				$row[] = $aRow['name'];
				$row[] = $aRow['imbd_rating'];
				$row[] = $aRow['duration'];
				$row[] = $aRow['genres'];
				$row[] = $aRow['year'];
			  if($this->session->userdata('role')==1){
				$row[] = '<a tag="'.$aRow['id'].'" id="priority_ticket_edit_btn_" href="#" style="color:#000;" onclick="edit_this('.$aRow['id'].')">
													 <i class="fa fa-pencil fa-fw"></i>
													 </a>
													 &nbsp;|&nbsp;<a tag="'.$aRow['id'].'" id="rep_issue_del_btn_" href="#" style="color:#000;" onclick="delete_this('.$aRow['id'].')">
													 <i class="fa fa-trash-o"></i>
													 </a>';
			  }else{
				$row[] = 'List Only';
			  }
				
				$i++;
				$output['aaData'][] = $row;
			}	
	 
		echo json_encode( $output );
		exit();
	}
	
}