<table class="room-tracker table">
<thead>
<tr>
<?php
$vh_explode = explode(":",$row->vacant_hours);
$vh_h = $vh_explode[0]*3600;
$vh_m = $vh_explode[1]*60;
$vh_total = $vh_h+$vh_m;

$emptyCount=0;
$roomCount=0;

$vacant = array();
foreach($rooms as $room_key => $room_val){
	$roomCount++;
	$have_active[$room_val->id] = 0;
	$vacant_flag[$room_val->id] = 0;
	$vacant[$room_val->id] = 0;
	$vacant_start[$room_val->id] = array(date('H:i',strtotime(date('Y-m-d H:i:s'))+60),strtotime(date('Y-m-d H:i:s'))+60);
	echo '<th>'.$room_val->name.'</th>';
}
?>
</tr>
</thead>
<tbody>
<?php
echo '<tr>';
foreach($rooms as $room_key => $room_val){
	$theValues = $room_occupancy[$room_val->id][0];
	if(!empty($theValues)){
		$dcheck_in = '';
		$dcheck_out = '';
		$draw_number = floor((strtotime($theValues[2])-strtotime(date('Y-m-d H:i:s')))/$vh_total);
		
		if($draw_number<=0)
			break;
			
		$active = 'style="color:red;"';
		$have_active[$room_val->id] = 1;
		
		echo '<td>';
		for($vd=1;$vd<=$draw_number;$vd++){
		  if($dcheck_in==''){
			echo '
				<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'" check_in_time="'.date('H:i',strtotime(date('Y-m-d H:i:s'))+60).'">
				<div class="panel panel-primary text-center no-boder">
					<div class="panel-body white">
							<i class="fa fa-check-square fa-3x"></i>
						<h3 '.$active.'>VACANT '.date('h:i a',strtotime(date('Y-m-d H:i:s'))+60).' - '.date('h:i a',strtotime(date('Y-m-d H:i:s'))+$vh_total+60).'</h3>
					</div>
					<div class="panel-footer">
						<span class="panel-eyecandy-title">Movie Room Check In
						</span>
					</div>
				</div>
				</a>
					';
			$dcheck_in = strtotime(date('Y-m-d H:i:s'))+60;
			$dcheck_out = strtotime(date('Y-m-d H:i:s'))+$vh_total+60;
			$vacant_flag[$room_val->id] = 1;
		  }else{
			echo '
				<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'" check_in_time="'.date('H:i',$dcheck_out+60).'">
				<div class="panel panel-primary text-center no-boder">
					<div class="panel-body white">
						
							<i class="fa fa-check-square fa-3x"></i>
						
						<h3>VACANT '.date('h:i a',$dcheck_out+60).' - '.date('h:i a',$dcheck_out+$vh_total+60).'</h3>
					</div>
					<div class="panel-footer">
						<span class="panel-eyecandy-title">Movie Room Check In
						</span>
					</div>
				</div>
				</a>
					';
			$dcheck_in = $dcheck_in+60;
			$dcheck_out = $dcheck_out+$vh_total+60;
		  }
		}
		echo '</td>';
	}else{
		$active = 'style="color:red;"';
		$have_active[$room_val->id] = 1;
		
		echo '
		<td>
			<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'">
			<div class="panel panel-primary text-center no-boder">
				<div class="panel-body white">
					
						<i class="fa fa-check-square fa-3x"></i>
					
					<h3 '.$active.'>VACANT until close.</h3>
				</div>
				<div class="panel-footer">
					<span class="panel-eyecandy-title">Movie Room Check In
					</span>
				</div>
			</div>
			</a>
		</td>
			';
		$vacant_flag[$room_val->id] = 1;
	}
}
echo '</tr>';

$vacantHours = array();
for($x=0;$x<15;$x++){
echo '<tr>';
	foreach($rooms as $room_key => $room_val){
$theValues = $room_occupancy[$room_val->id][$x];
if(!empty($theValues)){
		if(strtotime($theValues[2])<=strtotime(date('Y-m-d H:i:s')) AND strtotime($theValues[3])>=strtotime(date('Y-m-d H:i:s'))){
			$active = 'style="color:red;"';
			$have_active[$room_val->id] = 1;
		}else
			$active = '';
		
		$vacant_start[$room_val->id] = array(date('H:i', strtotime($theValues[3])+300),strtotime($theValues[3])+300);
		echo '
	<td>
		<a href="javascript:void(0)" id="additional-person" mrt_id="'.$theValues[0].'" current_person="'.$theValues[1].'" room_name="'.$room_val->name.'" movie_name="'.$theValues[4].'">
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body '.$room_val->color.'">
				
					<i class="fa fa-users fa-3x"></i>
				
				<h3 '.$active.'>'.date('h:i a', strtotime($theValues[2])).' - '.date('h:i a', strtotime($theValues[3])).' </h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">'.$theValues[4].'
				</span>
			</div>
		</div>
		</a>
	</td>
		';
}else{
  if($vacant[$room_val->id]==0 AND $vacant_flag[$room_val->id]==0){
	$active = '';
	if($have_active[$room_val->id] != 1)
		$active = 'style="color:red;"';
	
	echo '
	<td>
		<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'" date="'.date('Y-m-d',$vacant_start[$room_val->id][1]).'">
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body white">
				
					<i class="fa fa-check-square fa-3x"></i>
				
				<h3 '.$active.'>VACANT until close.</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In
				</span>
			</div>
		</div>
		</a>
	</td>
		';
	$vacant[$room_val->id] = 1;
	$emptyCount++;
  }else
	echo '<td></td>';
}

	#break the loop
	if($emptyCount==$roomCount){
		break 2;
	}

	}
echo '</tr>';

#start vacant draw
echo '<tr>';
foreach($rooms as $room_key => $room_val){
	$theValues1='';
	$theValues2='';
	
	if(!empty($room_occupancy[$room_val->id][$x]))
		$theValues1 = $room_occupancy[$room_val->id][$x];
		
	if(!empty($room_occupancy[$room_val->id][$x+1]))
		$theValues2 = $room_occupancy[$room_val->id][$x+1];
		
	if($theValues1!='' AND $theValues2!=''){
		$dcheck_in = '';
		$dcheck_out = '';
		$draw_number = floor((strtotime($theValues2[2])-strtotime($theValues1[3]))/$vh_total);
		echo '<td>';
		for($vd=1;$vd<=$draw_number;$vd++){
		  if($dcheck_in==''){
			echo '
				<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'" check_in_time="'.date('H:i',strtotime($theValues1[3])+60).'">
				<div class="panel panel-primary text-center no-boder">
					<div class="panel-body white">
						
							<i class="fa fa-check-square fa-3x"></i>
						
						<h3>VACANT '.date('h:i a',strtotime($theValues1[3])+60).' - '.date('h:i a',strtotime($theValues1[3])+$vh_total+60).'</h3>
					</div>
					<div class="panel-footer">
						<span class="panel-eyecandy-title">Movie Room Check In
						</span>
					</div>
				</div>
				</a>
					';
			$dcheck_in = strtotime($theValues1[3])+60;
			$dcheck_out = strtotime($theValues1[3])+$vh_total+60;
		  }else{
			echo '
				<a href="javascript:void(0)" class="movie-room-check-in" room_id="'.$room_val->id.'" check_in_time="'.date('H:i',$dcheck_out+60).'">
				<div class="panel panel-primary text-center no-boder">
					<div class="panel-body white">
						
							<i class="fa fa-check-square fa-3x"></i>
						
						<h3>VACANT '.date('h:i a',$dcheck_out+60).' - '.date('h:i a',$dcheck_out+$vh_total+60).'</h3>
					</div>
					<div class="panel-footer">
						<span class="panel-eyecandy-title">Movie Room Check In
						</span>
					</div>
				</div>
				</a>
					';
			$dcheck_in = $dcheck_in+60;
			$dcheck_out = $dcheck_out+$vh_total+60;
		  }
		}
		echo '</td>';
	}else{
		echo '<td></td>';
	}
}
echo '</tr>';
#end vacant draw

}
?>
</tbody>
</table>

<!--table class="table">
	<thead>
	<tr>
	<?php
	$vh_explode = explode(":",$row->vacant_hours);
	$vh_h = $vh_explode[0]*3600;
	$vh_m = $vh_explode[1]*60;
	$vh_total = $vh_h+$vh_m;

	$emptyCount=0;
	$roomCount=0;

	$vacant = array();
	foreach($rooms as $room_key => $room_val){
		$roomCount++;
		$have_active[$room_val->id] = 0;
		$vacant_flag[$room_val->id] = 0;
		$vacant[$room_val->id] = 0;
		$vacant_start[$room_val->id] = array(date('H:i',strtotime(date('Y-m-d H:i:s'))+60),strtotime(date('Y-m-d H:i:s'))+60);
		echo '<th>'.$room_val->name.'</th>';
	}
	?>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
		<td>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		<div class="panel panel-primary text-center no-boder">
			<div class="panel-body">
				<a href="javascript:void(0)" class="movie-room-check-in">
					<i class="fa fa-check-square fa-3x"></i>
				</a>
				<h3>Movie Title</h3>
			</div>
			<div class="panel-footer">
				<span class="panel-eyecandy-title">Movie Room Check In</span>
			</div>
		</div>
		</td>
	</tr>
	</tbody>
</table-->