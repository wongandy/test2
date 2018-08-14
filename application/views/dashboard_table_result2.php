<table class="table">
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
<?php

?>
	</tr>
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
</table>