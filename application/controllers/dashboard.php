<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		session_start();
		error_reporting(E_ALL);
		
		$this->load->helper('url');
		
		#Check session login
		if(!$this->session->userdata('is_login')) redirect($this->config->base_url());
		
		$this->load->model('page_setup_model','page_setup');
		$this->load->model('rooms_model','rooms');
		$this->load->model('products_model','products');
		$this->load->model('movies_model','movies');
		$this->load->model('movie_room_transactions_model','movie_room_transactions');
		$this->load->model('snack_bar_transaction_model','snacks_bar_transaction');
		
		date_default_timezone_set('Asia/Manila');
	}
	
	public function index()
	{
		$this->page_setup->checker();
		
		$data['menu_id'] = 1;
		$data['row'] = $this->page_setup->get_page_setup();
		$data['rooms'] = $this->rooms->get_active_rooms();
		$data['room_occupancy'] = $this->movie_room_transactions->get_room_occupancy($data['rooms']);
		
		$this->load->view('dashboard_view', $data);
	}
	
	public function monitor()
	{
		$data['menu_id'] = 1;
		$data['row'] = $this->page_setup->get_page_setup();
		
		$this->load->view('dashboard_view2', $data);
	}
	
	public function reload_table2(){
		$data['row'] = $this->page_setup->get_page_setup();
		$data['rooms'] = $this->rooms->get_active_rooms();
		$data['room_occupancy'] = $this->movie_room_transactions->get_room_occupancy2($data['rooms']);
		$data['room_near_end_id'] = $this->movie_room_transactions->room_occupancy_near_end_id();
		$data['vacant_near_end_id'] = $this->movie_room_transactions->vacant_near_end_id();
		
		// echo '<pre>';
		// var_dump($data['room_occupancy']);die();
		
		$this->movie_room_transactions->force_done($data['rooms']);
		
		$result['table_draw'] = $this->load->view('dashboard_table_result3', $data, true);
		// $result['table_draw'] = $this->load->view('dashboard_table_result', $data, true);
		
		echo json_encode($result);
	}
	
	public function get_rooms_movies2(){
		$room_id = $this->input->post('room_id');
		$check_in = $this->input->post('check_in');
		
		
		$rooms = $this->rooms->get_active_rooms();
		
		$rooms_selectbox = '<select class="form-control" id="room" name="room">';
		foreach($rooms as $key => $val){
			$rooms_selectbox .= '<option '.($val->id==$room_id?'selected':'').' value="'.$val->id.'">'.$val->name.'</option>';
		}
		$rooms_selectbox .= '</select>';
		
		$result['rooms_selectbox'] = $rooms_selectbox;
		
		$movies = $this->movies->get_active_movies();
		
		$movies_selectbox = '<select class="form-control" id="movie" name="movie">';
		foreach($movies as $key => $val){
			$movies_selectbox .= '<option value="'.$val->id.'|||'.$val->duration.'">'.$val->name.'</option>';
		}
		$movies_selectbox .= '</select>';
		
		$result['movies_selectbox'] = $movies_selectbox;
		$result['current_time'] = date('H:i:s');
		
		$exploded = explode("|",$check_in);
		
		$hour = (integer) $exploded[0];
		$hour_value = '';
		for($x=1;$x<13;$x++)
			$hour_value .= '<option '.($x==$hour?'selected':'').' value="'.$x.'">'.$x.'</option>';
		$hour_select = '
			<select class="form-control" style="width:100px" id="hour_value" name="hour_value">'.$hour_value.'</select>
		';
		
		$minute = (integer) $exploded[1];
		$minute_value = '';
		for($x=1;$x<60;$x++)
			$minute_value .= '<option '.($x==$minute?'selected':'').' value="'.$x.'">'.$x.'</option>';
		$minute_select = '
			<select class="form-control" style="width:100px" id="minute_value" name="minute_value">'.$minute_value.'</select>
		';
		
		$am_pm_select = '
			<select class="form-control" style="width:100px"  id="ampm_value" name="ampm_value"><option '.($exploded[2]=='am'?'selected':'').' value="AM">AM</option><option '.($exploded[2]=='pm'?'selected':'').' value="PM">PM</option></select>
		';
		
		$result['hour_select'] = $hour_select;
		$result['minute_select'] = $minute_select;
		$result['am_pm_select'] = $am_pm_select;
		
		echo json_encode($result, true);
	}
	
<<<<<<< HEAD
	public function get_rooms_movies($room_id=0, $movie_id=0){
=======
	public function get_rooms_movies($room_id){
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		$rooms = $this->rooms->get_active_rooms();
		
		$rooms_selectbox = '<select class="form-control" id="room" name="room">';
		foreach($rooms as $key => $val){
			$rooms_selectbox .= '<option '.($val->id==$room_id?'selected':'').' value="'.$val->id.'">'.$val->name.'</option>';
		}
		$rooms_selectbox .= '</select>';
		
		$result['rooms_selectbox'] = $rooms_selectbox;
		
		$movies = $this->movies->get_active_movies();
		
		$movies_selectbox = '<select class="form-control" id="movie" name="movie">';
		foreach($movies as $key => $val){
<<<<<<< HEAD
			$movies_selectbox .= '<option '.($val->id==$movie_id?'selected':'').' value="'.$val->id.'|||'.$val->duration.'">'.$val->name.'</option>';
=======
			$movies_selectbox .= '<option value="'.$val->id.'|||'.$val->duration.'">'.$val->name.'</option>';
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		}
		$movies_selectbox .= '</select>';
		
		$result['movies_selectbox'] = $movies_selectbox;
		$result['current_time'] = date('H:i:s');
		
		$hour = (integer) date('h');
		$hour_value = '';
		for($x=1;$x<13;$x++)
			$hour_value .= '<option '.($x==$hour?'selected':'').' value="'.$x.'">'.$x.'</option>';
		$hour_select = '
			<select class="form-control" style="width:100px" id="hour_value" name="hour_value">'.$hour_value.'</select>
		';
		
		$minute = (integer) date('i');
		$minute_value = '';
		for($x=1;$x<60;$x++)
			$minute_value .= '<option '.($x==$minute?'selected':'').' value="'.$x.'">'.$x.'</option>';
		$minute_select = '
			<select class="form-control" style="width:100px" id="minute_value" name="minute_value">'.$minute_value.'</select>
		';
		
		$am_pm_select = '
			<select class="form-control" style="width:100px"  id="ampm_value" name="ampm_value"><option '.((integer) date('H')<12?'selected':'').' value="AM">AM</option><option '.((integer) date('H')>11?'selected':'').' value="PM">PM</option></select>
		';
		
		$result['hour_select'] = $hour_select;
		$result['minute_select'] = $minute_select;
		$result['am_pm_select'] = $am_pm_select;
		
		echo json_encode($result, true);
	}
	
	public function reload_table(){
		$data['row'] = $this->page_setup->get_page_setup();
		$data['rooms'] = $this->rooms->get_active_rooms();
		$data['room_occupancy'] = $this->movie_room_transactions->get_room_occupancy($data['rooms']);
		
		// echo '<pre>';
		// var_dump($data['room_occupancy']);die();
		
		$this->movie_room_transactions->force_done();
		
		$result['table_draw'] = $this->load->view('dashboard_table_result', $data, true);
		// $result['table_draw'] = $this->load->view('dashboard_table_result', $data, true);
		
		echo json_encode($result);
	}
	
	public function movie_room_check_in2($mrt_id=0){
		#1min = 60
		#5mins = 300
		#1hr = 3600
		
		$vh_explode = explode(":",$this->input->post("vacant_hours"));
		$vh_h = $vh_explode[0]*3600;
		$vh_m = $vh_explode[1]*60;
		$vh_total = $vh_h+$vh_m;
		
		$allowed_idle_mins = $this->input->post("allowed_idle_mins")*60;
		
		$room_id = $this->input->post("room");
		
		$movie_explode = explode("|||",$this->input->post("movie"));
		$movie_id = $movie_explode[0];
		$movie_duration = $movie_explode[1];
		
		$md_explode = explode(":",$movie_duration);
		$md_hour = (integer) $md_explode[0]*3600;
		$md_minute = (integer) $md_explode[1]*60;
		$md_total = $md_hour+$md_minute;
		
		// $check_in = strtotime($this->input->post("check_in_time"));
		// $check_in = strtotime($this->input->post("hour_value").':'.$this->input->post("minute_value").':00 '.$this->input->post("ampm_value"))+60;
		$check_in = strtotime($this->input->post("hour_value").':'.$this->input->post("minute_value").':00 '.$this->input->post("ampm_value"));
		$check_out = $check_in+$md_total;
		
		if($check_in < strtotime(date('Y-m-d H:i:s'))){
			$result['error'] = 1;
			$result['message'] = 'Movie room check in time lapses the current local time.';
			
			echo json_encode($result);
			exit;
		}
		
		if($this->movie_room_transactions->fresh_room_transaction($room_id)){#fresh movie room transaction
			#10 minutes allowed check in
<<<<<<< HEAD
			$this->get_date_system_readable();
=======
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
			$max_allowed_check_in = strtotime(date('Y-m-d H:i:s'))+600;
			
			if($check_in>$max_allowed_check_in){
				$result['error'] = 1;
				$result['message'] = 'Max allowable time for checkin is only 10 minutes base on the current time.';
				
				echo json_encode($result);
				exit;
			}
			
			$prev_check_out = date('Y-m-d H:i');
			$vacant = $check_in - strtotime($prev_check_out);
			if($vacant<$vh_total){
				if($vacant>$allowed_idle_mins){
					$result['error'] = 1;
					$result['message'] = 'Allowed idle minutes per room is maximum of '.$this->input->post("allowed_idle_mins").' minute/s.';
					
					echo json_encode($result);
					exit;
				}
			}else{
				if($vacant>($vh_total+$allowed_idle_mins)){#first trap
					if($vacant>($vh_total+$allowed_idle_mins)+(60+$vh_total)){#2nd trap
						if($vacant>($vh_total+$allowed_idle_mins+120+($vh_total*2))){#3rd trap
						$result['error'] = 1;
						$result['message'] = 'Please talk to your customer to wait for the time because the vacant time is more than 4 hours already. It may cause a wasted vacant hour of the room.';
						
						echo json_encode($result);
						exit;	
						}else{
						$result['error'] = 1;
						$result['message'] = 'Allowed vacant hours per room is '.$this->input->post("vacant_hours").'.';
						
						echo json_encode($result);
						exit;
						}
					}else{
						if($vacant<($vh_total+$allowed_idle_mins)+(60+$vh_total)){
							$result['error'] = 1;
							$result['message'] = 'Allowed vacant hours per room is '.$this->input->post("vacant_hours").'.';
							
							echo json_encode($result);
							exit;
						}
					}
				}
			}
			
			#FIRST
			$reserve_ontop = 0;
			$vacant = strtotime($prev_check_out)+(($vh_total+$allowed_idle_mins)-60);
			if($check_in>$vacant){
				$insert_data = array(
					'room_id' => $room_id,
					'check_in' => $prev_check_out,
					'check_out' => date('Y-m-d H:i:s', $vacant),
					'status' => 1,
					'datetime_created' => date('Y-m-d H:i:s')
				);
				$this->movie_room_transactions->insert_vrs($insert_data);
				$reserve_ontop++;
			}
			#SECOND
			$vacant_in = $vacant;
			$vacant_out = $vacant_in+$vh_total;
			if($check_in>$vacant_out){
				$insert_data = array(
					'room_id' => $room_id,
					'check_in' => date('Y-m-d H:i:s', $vacant_in),
					'check_out' => date('Y-m-d H:i:s', $vacant_out),
					'status' => 1,
					'datetime_created' => date('Y-m-d H:i:s')
				);
				$this->movie_room_transactions->insert_vrs($insert_data);
				$reserve_ontop++;
			}
			
			#comment for reserved not added allowed idle minutes
			// if($reserve_ontop==0)
				// $check_out = $check_out+$allowed_idle_mins;
			
			$no_of_person = $this->input->post("no_of_person");
			$corkage = $this->input->post("corkage");
			$money = $this->input->post("money");
			$total = $this->input->post("total");
			$money_change = $this->input->post("change");
			
			#after reserved
			$next_day = date('d', strtotime(date('Y-m-d') .' +1 day'));
			for($x=0;$x<=10;$x++){
			  if($x==0){
				if($reserve_ontop==0)
					$vacant_in = $check_out+$allowed_idle_mins;
				else
					$vacant_in = $vacant_out+$allowed_idle_mins;
					// $vacant_in = $check_out+60;
			  }else
				$vacant_in = $vacant_out+$allowed_idle_mins;
				// $vacant_in = $vacant_out+60;
				
				$vacant_out = $vacant_in+$vh_total;
				
				if(date('d', $vacant_in)!=$next_day){
					$insert_data = array(
						'room_id' => $room_id,
						'check_in' => date('Y-m-d H:i:s', $vacant_in),
						'check_out' => date('Y-m-d H:i:s', $vacant_out),
						'status' => 1,
						'datetime_created' => date('Y-m-d H:i:s')
					);
					$this->movie_room_transactions->insert_vrs($insert_data);
				}else{
					$insert_data = array(
						'room_id' => $room_id,
						'check_in' => date('Y-m-d H:i:s', $vacant_in),
						'check_out' => date('Y-m-d H:i:s', $vacant_out),
						'status' => 1,
						'datetime_created' => date('Y-m-d H:i:s')
					);
					$this->movie_room_transactions->insert_vrs($insert_data);
					
					break;
				}
			}
			
			$insert_data = array(
				'room_id' => $room_id,
				'movie_id' => $movie_id,
				'no_of_person' => $no_of_person,
				'corkage' => $corkage,
				'money' => $money,
				'total' => $total,
				'money_change' => $money_change,
				'check_in' => date('Y-m-d H:i:s', $check_in),
				'check_out' => date('Y-m-d H:i:s', $check_out),
				'datetime_created' => date('Y-m-d H:i:s'),
				'created_by' => $this->session->userdata('username'),
				'created_by_id' => $this->session->userdata('user_id')
			);
			
			if($this->movie_room_transactions->insert_transaction($insert_data)){
				$result['error'] = 0;
				$result['vacant_in'] = $vacant_in;
				$result['vacant_out'] = $vacant_out;
				$result['message'] = 'Movie room check in transactions successfull.';
			}else{
				$result['error'] = 1;
				$result['message'] = 'Movie room check in transactions failed.';
			}
			
			echo json_encode($result);
			
		}else{#not fresh movie room transaction
			$vacant_detail = $this->movie_room_transactions->get_vacant_detail($mrt_id);
			
			#10 minutes allowed check in
<<<<<<< HEAD
			$this->get_date_system_readable();
=======
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
			$max_allowed_check_in = strtotime($vacant_detail->check_in)+600;
			
			if($check_in>$max_allowed_check_in){
				$result['error'] = 1;
				$result['message'] = 'Max allowable time for checkin is only 10 minutes base on the vacant time.';
				
				echo json_encode($result);
				exit;
			}
			// $check_in = $check_in-60;
			// $check_out = $check_out-60;
			
			if($this->movie_room_transactions->have_advanced_reservation($vacant_detail->check_in,$room_id)){
				if($check_in>=strtotime($vacant_detail->check_in) AND $check_out<=strtotime($vacant_detail->check_out)){
				
					// if($this->movie_room_transactions->have_advanced_reservation($vacant_detail->check_in,$room_id)){
						// $result['error'] = 1;
						// $result['message'] = 'Movie room check in/out time lapses the designated vacant check in and out.';
						
						// echo json_encode($result);
						// exit;
					// }
					$this->movie_room_transactions->delete_vrs_id($mrt_id);
				
					$no_of_person = $this->input->post("no_of_person");
					$corkage = $this->input->post("corkage");
					$money = $this->input->post("money");
					$total = $this->input->post("total");
					$money_change = $this->input->post("change");
					
					$insert_data = array(
						'room_id' => $room_id,
						'movie_id' => $movie_id,
						'no_of_person' => $no_of_person,
						'corkage' => $corkage,
						'money' => $money,
						'total' => $total,
						'money_change' => $money_change,
						'check_in' => date('Y-m-d H:i:s', $check_in),
						'check_out' => date('Y-m-d H:i:s', $check_out),
						'datetime_created' => date('Y-m-d H:i:s'),
						'created_by' => $this->session->userdata('username'),
						'created_by_id' => $this->session->userdata('user_id')
					);
					
					if($this->movie_room_transactions->insert_transaction($insert_data)){
						$result['error'] = 0;
						$result['message'] = 'Movie room check in transactions successfull.';
					}else{
						$result['error'] = 1;
						$result['message'] = 'Movie room check in transactions failed.';
					}
				}else{
					$result['error'] = 1;
					$result['message'] = 'Movie room check in transactions failed. Movie duration exceeded to 2 hours.';
				}
				
				echo json_encode($result);
				
			}else{
				$this->movie_room_transactions->delete_vrs_id($mrt_id);
				
				$no_of_person = $this->input->post("no_of_person");
				$corkage = $this->input->post("corkage");
				$money = $this->input->post("money");
				$total = $this->input->post("total");
				$money_change = $this->input->post("change");
				
				$ocheck_in = $check_in;
				$ocheck_out = $check_out;
				
				$this->movie_room_transactions->delete_after_checkin_vrs($vacant_detail->check_in,$room_id);
				
				#after reserved
				$reserve_ontop = 0;
				$next_day = date('d', strtotime(date('Y-m-d') .' +1 day'));
				for($x=0;$x<=10;$x++){
					if($x==0){
						if($reserve_ontop==0)
							$vacant_in = $check_out+$allowed_idle_mins;
						else
							$vacant_in = $vacant_out+$allowed_idle_mins;
							// $vacant_in = $check_out+60;
					}else
						$vacant_in = $vacant_out+$allowed_idle_mins;
						// $vacant_in = $vacant_out+60;
						
					$vacant_out = $vacant_in+$vh_total;
					
					if(date('d', $vacant_in)!=$next_day){
						$insert_datax = array(
							'room_id' => $room_id,
							'check_in' => date('Y-m-d H:i:s', $vacant_in),
							'check_out' => date('Y-m-d H:i:s', $vacant_out),
							'status' => 1,
							'datetime_created' => date('Y-m-d H:i:s')
						);
						$this->movie_room_transactions->insert_vrs($insert_datax);
					}else{
						$insert_datax = array(
							'room_id' => $room_id,
							'check_in' => date('Y-m-d H:i:s', $vacant_in),
							'check_out' => date('Y-m-d H:i:s', $vacant_out),
							'status' => 1,
							'datetime_created' => date('Y-m-d H:i:s')
						);
						$this->movie_room_transactions->insert_vrs($insert_datax);

						break;
					}
				}
				
				$insert_data = array(
					'room_id' => $room_id,
					'movie_id' => $movie_id,
					'no_of_person' => $no_of_person,
					'corkage' => $corkage,
					'money' => $money,
					'total' => $total,
					'money_change' => $money_change,
					'check_in' => date('Y-m-d H:i:s', $ocheck_in),
					'check_out' => date('Y-m-d H:i:s', $ocheck_out),
					'datetime_created' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('username'),
					'created_by_id' => $this->session->userdata('user_id')
				);
				
				if($this->movie_room_transactions->insert_transaction($insert_data)){
					$result['error'] = 0;
					$result['message'] = 'Movie room check in transactions successfull.';
				}else{
					$result['error'] = 1;
					$result['message'] = 'Movie room check in transactions failed.';
				}
				
				echo json_encode($result);
				exit;
			}	
			
		}
	}
	
	public function movie_room_check_in(){
		#1min = 60
		#5mins = 300
		#1hr = 3600
		
		$vh_explode = explode(":",$this->input->post("vacant_hours"));
		$vh_h = $vh_explode[0]*3600;
		$vh_m = $vh_explode[1]*60;
		$vh_total = $vh_h+$vh_m;
		
		$allowed_idle_mins = $this->input->post("allowed_idle_mins")*60;
		
		$room_id = $this->input->post("room");
		
		$movie_explode = explode("|||",$this->input->post("movie"));
		$movie_id = $movie_explode[0];
		$movie_duration = $movie_explode[1];
		
		$md_explode = explode(":",$movie_duration);
		$md_hour = (integer) $md_explode[0]*3600;
		$md_minute = (integer) $md_explode[1]*60;
		$md_total = $md_hour+$md_minute;
		
		// $check_in = strtotime($this->input->post("check_in_time"));
		$check_in = strtotime($this->input->post("hour_value").':'.$this->input->post("minute_value").':00 '.$this->input->post("ampm_value"));
		$check_out = $check_in+$md_total;
		
		if($check_in < strtotime(date('Y-m-d H:i:s'))){
			$result['error'] = 1;
			$result['message'] = 'Movie room check in time lapses the current local time.';
			
			echo json_encode($result);
			exit;
		}
		
		if($this->movie_room_transactions->room_transaction_check2($room_id,$check_in,$check_out)){
			$result['error'] = 1;
			$result['message'] = 'Movie room check in time lapses the previous checked out time or check out time lapses the next check in time.';
			
			echo json_encode($result);
			exit;
		}
		
		$prev_check_out = $this->movie_room_transactions->get_previous_transaction($room_id, $check_in);
		if($prev_check_out!=0){
			$vacant = $check_in - strtotime($prev_check_out);
			if($vacant<$vh_total){
				if($vacant>$allowed_idle_mins){
					$result['error'] = 1;
					$result['message'] = 'Allowed idle minutes per room is maximum of '.$this->input->post("allowed_idle_mins").' minute/s.';
					
					echo json_encode($result);
					exit;
				}
			}else{
				if($vacant>=$vh_total){
					if($vacant>($vh_total+$allowed_idle_mins)){
						if($vacant<($vh_total*2)){
							$result['error'] = 1;
							$result['message'] = 'Allowed vacant hours per room is '.$this->input->post("vacant_hours").'.';
							
							echo json_encode($result);
							exit;
						}
					}
				}
			}
		}else{
			$prev_check_out = date('Y-m-d H:i:s');
			$vacant = $check_in - strtotime($prev_check_out);
			if($vacant<$vh_total){
				if($vacant>$allowed_idle_mins){
					$result['error'] = 1;
					$result['message'] = 'Allowed idle minutes per room is maximum of '.$this->input->post("allowed_idle_mins").' minute/s.';
					
					echo json_encode($result);
					exit;
				}
			}else{
				if($vacant>=$vh_total){
					if($vacant>($vh_total+$allowed_idle_mins)){
						if($vacant<($vh_total*2)){
							$result['error'] = 1;
							$result['message'] = 'Allowed vacant hours per room is '.$this->input->post("vacant_hours").'.';
							
							echo json_encode($result);
							exit;
						}
					}
				}
			}
		}
		
		$no_of_person = $this->input->post("no_of_person");
		$corkage = $this->input->post("corkage");
		$money = $this->input->post("money");
		$total = $this->input->post("total");
		$money_change = $this->input->post("change");
		
		$insert_data = array(
			'room_id' => $room_id,
			'movie_id' => $movie_id,
			'no_of_person' => $no_of_person,
			'corkage' => $corkage,
			'money' => $money,
			'total' => $total,
			'money_change' => $money_change,
			'check_in' => date('Y-m-d H:i:s', $check_in),
			'check_out' => date('Y-m-d H:i:s', $check_out),
			'datetime_created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username'),
			'created_by_id' => $this->session->userdata('user_id')
		);
		
		if($this->movie_room_transactions->insert_transaction($insert_data)){
			$result['error'] = 0;
			$result['message'] = 'Movie room check in transactions successfull.';
		}else{
			$result['error'] = 1;
			$result['message'] = 'Movie room check in transactions failed.';
		}
		
		echo json_encode($result);
	}
	
	public function additional_person($mrt_id){
		$additional_person = $this->input->post("additional_person");
		$description = $this->input->post("description");
		$money = $this->input->post("additionalp_money");
		$total = $this->input->post("additionalp_total");
		$money_change = $this->input->post("additionalp_change");
		
<<<<<<< HEAD
		#Start Update Movie
		$movie = $this->input->post("movie");
		$explodedM = explode("|||",$movie);
		$original_movie_id = $this->input->post("original_movie_id");
		
		if($original_movie_id!=$explodedM[0]){
			$vh_explode = explode(":",$this->input->post("vacant_hours"));
			$vh_h = $vh_explode[0]*3600;
			$vh_m = $vh_explode[1]*60;
			$vh_total = $vh_h+$vh_m;
			
			$allowed_idle_mins = $this->input->post("allowed_idle_mins")*60;
					
			$mrt_detail = $this->movie_room_transactions->get_mrt_details($mrt_id);
			$mrt_check_in = strtotime($mrt_detail->check_in);
			$mrt_check_out = strtotime($mrt_detail->check_out);
			$mrt_duration = $mrt_check_out-$mrt_check_in;
			
			if($mrt_check_in<strtotime(date('Y-m-d H:i:s'))){
				$result['error'] = 1;
				$result['message'] = 'You cannot update/change movie if the current time is already pass or on check in time of the reservation.';
				echo json_encode($result);
				exit;
			}
			
			$md_explode = explode(":",$explodedM[1]);
			$md_hour = (integer) $md_explode[0]*3600;
			$md_minute = (integer) $md_explode[1]*60;
			$md_total = $md_hour+$md_minute;
			
			if($md_total>$mrt_duration){
				if($this->movie_room_transactions->have_advanced_reservation($mrt_detail->check_in,$mrt_detail->room_id)){
					$result['error'] = 1;
					$result['message'] = 'Room have advanced reservation and the new movie exceeded the duration of the current movie.Find another movie that fit the duration of the current movie.';
					echo json_encode($result);
					exit;
				}else{
					$check_out = strtotime($mrt_detail->check_in)+$md_total;
					$update_data = array(
						'check_out' => date('Y-m-d H:i:s', $check_out),
						'movie_id' => $explodedM[0]
					);
					
					$this->movie_room_transactions->update_room_movie($update_data, $mrt_id);
					
					$this->movie_room_transactions->delete_after_checkin_vrs($mrt_detail->check_in,$mrt_detail->room_id);
				
					#after reserved
					$reserve_ontop = 0;
					$next_day = date('d', strtotime(date('Y-m-d') .' +1 day'));
					for($x=0;$x<=10;$x++){
						if($x==0)
							$vacant_in = $check_out+$allowed_idle_mins;
						else
							$vacant_in = $vacant_out+$allowed_idle_mins;
							
						$vacant_out = $vacant_in+$vh_total;
						
						if(date('d', $vacant_in)!=$next_day){
							$insert_datax = array(
								'room_id' => $mrt_detail->room_id,
								'check_in' => date('Y-m-d H:i:s', $vacant_in),
								'check_out' => date('Y-m-d H:i:s', $vacant_out),
								'status' => 1,
								'datetime_created' => date('Y-m-d H:i:s')
							);
							$this->movie_room_transactions->insert_vrs($insert_datax);
						}else{
							$insert_datax = array(
								'room_id' => $mrt_detail->room_id,
								'check_in' => date('Y-m-d H:i:s', $vacant_in),
								'check_out' => date('Y-m-d H:i:s', $vacant_out),
								'status' => 1,
								'datetime_created' => date('Y-m-d H:i:s')
							);
							$this->movie_room_transactions->insert_vrs($insert_datax);

							break;
						}
					}
				}
			}else{
				$check_out = strtotime($mrt_detail->check_in)+$md_total;
				$update_data = array(
					'check_out' => date('Y-m-d H:i:s', $check_out),
					'movie_id' => $explodedM[0]
				);
				
				$this->movie_room_transactions->update_room_movie($update_data, $mrt_id);
				
				if(!$this->movie_room_transactions->have_advanced_reservation($mrt_detail->check_in,$mrt_detail->room_id)){
				
					$this->movie_room_transactions->delete_after_checkin_vrs($mrt_detail->check_in,$mrt_detail->room_id);
				
					#after reserved
					$reserve_ontop = 0;
					$next_day = date('d', strtotime(date('Y-m-d') .' +1 day'));
					for($x=0;$x<=10;$x++){
						if($x==0){
							if($reserve_ontop==0)
								$vacant_in = $check_out+$allowed_idle_mins;
							else
								$vacant_in = $vacant_out+$allowed_idle_mins;
						}else
							$vacant_in = $vacant_out+$allowed_idle_mins;
							
						$vacant_out = $vacant_in+$vh_total;
						
						if(date('d', $vacant_in)!=$next_day){
							$insert_datax = array(
								'room_id' => $mrt_detail->room_id,
								'check_in' => date('Y-m-d H:i:s', $vacant_in),
								'check_out' => date('Y-m-d H:i:s', $vacant_out),
								'status' => 1,
								'datetime_created' => date('Y-m-d H:i:s')
							);
							$this->movie_room_transactions->insert_vrs($insert_datax);
						}else{
							$insert_datax = array(
								'room_id' => $mrt_detail->room_id,
								'check_in' => date('Y-m-d H:i:s', $vacant_in),
								'check_out' => date('Y-m-d H:i:s', $vacant_out),
								'status' => 1,
								'datetime_created' => date('Y-m-d H:i:s')
							);
							$this->movie_room_transactions->insert_vrs($insert_datax);

							break;
						}
					}
				}
			}
		}
		#End Update Movie
		
=======
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		$insert_data = array(
			'mrt_id' => $mrt_id,
			'additional_person' => $additional_person,
			'description' => $description,
			'money' => $money,
			'total' => $total,
			'money_change' => $money_change,
			'datetime_created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username'),
			'created_by_id' => $this->session->userdata('user_id')
		);
		
		if($this->movie_room_transactions->insert_additional_person($insert_data)){
			$result['error'] = 0;
<<<<<<< HEAD
			$result['message'] = 'Update Movie/Additional person transaction successfull.';
		}else{
			$result['error'] = 1;
			$result['message'] = 'Update Movie/Additional person transaction failed.';
=======
			$result['message'] = 'Additional person transaction successfull.';
		}else{
			$result['error'] = 1;
			$result['message'] = 'Additional person transaction failed.';
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
		}
		
		echo json_encode($result);
	}
	
	public function snacks_bar_transaction(){
		$order_no = $this->input->post('order_no');
		if($this->input->post('update_order_no')){
			$order_no = $this->input->post('update_order_no');
			$order_header = $this->snacks_bar_transaction->get_order_header($order_no);
		}
		
		$order_type = $this->input->post('snacks_type');
		$room = $this->input->post('room');
		$total = $this->input->post('total');
		$money = $this->input->post('snacks_money');
		$money_change = $this->input->post('change');
		
		if($this->session->userdata('role')==1 OR $this->session->userdata('role')==2)
			$paid = 1;
		else
			$paid = 0;
		
		if(empty($order_header)){
		
		$insert_data = array(
			'order_no' => $order_no,
			'order_type' => $order_type,
			'room' => $room,
			'total' => $total,
			'money' => $money,
			'money_change' => $money_change,
			'paid' => $paid,
			'datetime_created' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('username'),
			'created_by_id' => $this->session->userdata('user_id')
		);
		
		if($this->snacks_bar_transaction->insert_transaction_header($insert_data)){
			if($this->snacks_bar_transaction->insert_transaction_detail($order_no)){
				$result['error'] = 0;
				$result['message'] = 'Snack bar check out transactions successfull.';
			}else{
				$result['error'] = 1;
				$result['message'] = 'Detail snacks bar transaction failed.';
			}
		}else{
			$result['error'] = 1;
			$result['message'] = 'Header snacks bar transaction failed.';
		}
		
		}else{
			$update_data = array(
				'money' => $money,
				'money_change' => $money_change,
				'paid' => $paid,
				'datetime_updated' => date('Y-m-d H:i:s'),
				'updated_by' => $this->session->userdata('username'),
				'updated_by_id' => $this->session->userdata('user_id')
			);
			
			if($this->snacks_bar_transaction->update_transaction_header($update_data, $order_no)){
				$result['error'] = 0;
				$result['message'] = 'Snack bar check out transactions successfull.';
			}else{
				$result['error'] = 1;
				$result['message'] = 'Snack bar transaction failed.';
			}
		}
		
		echo json_encode($result, true);
	}
	
	public function get_products(){
		$products = $this->products->get_active_products();
		$draw_products = '<table class="table" width="100%">';
		$draw_products .= '<tbody>';
		
		$td_count = 0;
		foreach($products as $key => $val){
			$td_count++;
			
			if($td_count==1)
				$draw_products .= '<tr>';
			
			if($td_count<5){
				// $draw_products .= '<td><button type="button" class="add-to-cart btn btn-outline btn-warning" product_id="'.$val->id.'" product_name="'.$val->name.'" product_price="'.$val->price.'">'.$val->name.'</button></td>';
				$draw_products .= '<td width="25%"><a href="javascript:void(0)" class="add-to-cart" product_id="'.$val->id.'" product_name="'.$val->name.'" product_price="'.$val->price.'"><div class="alert alert-success text-center">'.$val->name.'</div></a></td>';
			}else{
				$draw_products .= '</tr>';
				$draw_products .= '<td width="25%"><a href="javascript:void(0)" class="add-to-cart" product_id="'.$val->id.'" product_name="'.$val->name.'" product_price="'.$val->price.'"><div class="alert alert-success text-center">'.$val->name.'</div></a></td>';
				// $draw_products .= '<td><button type="button" class="add-to-cart btn btn-outline btn-warning" product_id="'.$val->id.'" product_name="'.$val->name.'" product_price="'.$val->price.'">'.$val->name.'</button></td>';
				$td_count=1;
			}
		}
		
		if($td_count==4)
			$draw_products .= '</tr>';
		else if($td_count==3)
			$draw_products .= '<td></td></tr>';
		else if($td_count==2)
			$draw_products .= '<td></td><td></td></tr>';
		else if($td_count==1)
			$draw_products .= '<td></td><td></td><td></td></tr>';
			
		$draw_products .= '</tbody>';
		$draw_products .= '<table>';
		
		$rooms = $this->rooms->get_active_rooms();
		
		$rooms_selectbox = '<select class="form-control" id="room" name="room">';
		$rooms_selectbox .= '<option value="0">-- Select One --</option>';
		foreach($rooms as $key => $val){
			$rooms_selectbox .= '<option value="'.$val->id.'">'.$val->name.'</option>';
		}
		$rooms_selectbox .= '</select>';
		
		$result['rooms_selectbox'] = $rooms_selectbox;
		$result['draw_products'] = $draw_products;
		$result['order_no'] = $this->products->request_order_number();
		// $result['order_no'] = 1;
		
		echo json_encode($result, true);
	}
	
	public function check_product_quantity($product_id){
		if($this->products->check_product_quantity($product_id)){
			$result['error'] = 0;
			$result['message'] = '';
		}else{
			$result['error'] = 1;
			$result['message'] = 'Not enough inventory supply!';
		}
		
		echo json_encode($result, true);
	}
	
	public function search_order_no($order_no){
		$order_header = $this->snacks_bar_transaction->get_order_header2($order_no);
		$order_detail = $this->snacks_bar_transaction->get_order_detail($order_no);
		
		if(!empty($order_header)){
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
			<div class="order_no_search_form row">
				<div class="col-lg-2">
					<label>Type :</label>
				</div>
				<div class="col-lg-4">
					<input class="form-control" value="'.$order_header->order_type.'" readonly/>
				</div>
			</div>
			<div class="order_no_search_form row">
<<<<<<< HEAD
				<div class="col-lg-2">
					<label>Room :</label>
				</div>
				<div class="col-lg-4">
					<input class="form-control" value="'.$order_header->room_name.'" readonly/>
				</div>
			</div>
			<div class="order_no_search_form row">
=======
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
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
			<div class="order_no_search_form row">
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="1">1</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="5">5</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="10">10</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="20">20</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="50">50</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="100">100</button>
				</div>
				<div class="col-lg-2">
					<label>Total :</label>
				</div>
				<div class="col-lg-4">
					<input class="form-control" name="total" id="snacks-total" value="'.$order_header->total.'" readonly>
				</div>
				</div>
			</div>
			<div class="order_no_search_form row">
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="200">200</button>
				</div>
				<div class="col-lg-1">
					<button type="button" class="money-button111 btn btn-default" amount="500">500</button>
				</div>
				<div class="col-lg-2">
					<button type="button" class="money-button111 btn btn-default" amount="1000">1000</button>
				</div>
				<div class="col-lg-2">
					<button type="button" class="money-button111 btn btn-warning" amount="0">Reset</button>
				</div>
				<div class="col-lg-2">
					<label>Money :</label>
				</div>
				<div class="col-lg-4">
					<input class="form-control" name="snacks_money" id="snacks_money" onClick="this.select();" value="'.$order_header->money.'" readonly>
				</div>
			</div>
			<div class="order_no_search_form row">
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
			</div><br>
			<div class="order_no_search_form row">
				<div class="col-lg-6">
					<div class="form-group">
					</div>
				</div>
				<div class="col-lg-6">
					<input type="hidden" id="update_order_no" name="update_order_no" value="'.$order_no.'"/>
					<button type="submit" class="btn btn-success">Check-Out</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			</div>
			';
			$result['error'] = 0;
			$result['search_order_form'] = $html_draw;
		}else{
			$result['error'] = 1;
			$result['message'] = 'Order Number dont exist!';
		}
		
		echo json_encode($result, true);
	}
	
<<<<<<< HEAD
	private function get_date_system_readable(){
		if(date('d')>=20 OR (date('m')>=8 AND date('Y')>=2018)){
			$result['error'] = 0;
			$result['message'] = $this->config->item('datereadable');
			echo json_encode($result, true);
			exit;
		}
	}
	
=======
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
	public function special_function(){
		$vh_total = 7200;
		$room_id = 9;
		$this->movie_room_transactions->delete_after_checkin_vrs('2017-09-28 21:04:00',$room_id);
				
		#after reserved
		$check_out=strtotime('2017-09-28 21:04:00');
		$next_day = date('d', strtotime(date('Y-m-d') .' +1 day'));
		for($x=0;$x<=10;$x++){
			if($x==0)
				$vacant_in = $check_out+60;
			else
				$vacant_in = $vacant_out+60;
				
			$vacant_out = $vacant_in+$vh_total;
			
			if(date('d', $vacant_in)!=$next_day){
				$insert_data = array(
					'room_id' => $room_id,
					'check_in' => date('Y-m-d H:i:s', $vacant_in),
					'check_out' => date('Y-m-d H:i:s', $vacant_out),
					'status' => 1,
					'datetime_created' => date('Y-m-d H:i:s')
				);
				$this->movie_room_transactions->insert_vrs($insert_data);
			}else
				break;
		}
		// $this->movies->special_query();
	}
	
	
	
	















	
	
}