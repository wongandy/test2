<table class="table" id="mrt-result-table">
	<thead>
	<tr>
		<th>Transaction ID</th>
		<th>Room</th>
		<th>Movie</th>
		<th>Check In</th>
		<th>Check Out</th>
		<th>Total</th>
	</tr>
	</thead>
</table>
<script>
$(document).ready(function(){
	$('#mrt-result-table').dataTable( 
	{   "bJQueryUI": true,
			"sPaginationType": "full_numbers",
			"bProcessing": true,
			"bServerSide": true,
		"sAjaxSource": "<?php echo $this->config->base_url().'movie_room_transaction/movie_room_transaction_listing';?>",
		"fnServerParams": function ( aoData ) {
			aoData.push( 
				{ "name": "date_from", "value": "<?php echo $this->input->post('date_from');?>" },
				{ "name": "date_to", "value": "<?php echo $this->input->post('date_to');?>" }
			);
		},
		"bFilter": true,
		 "sDom": '<"H"lfr>t<"F"ip>',
		 "aLengthMenu": [[100, 200, 500, 1000], [100, 200, 500, 1000]],
		 aoColumnDefs: [
			  {
				 bSortable: false,
				 aTargets: [ -1 ]
			  }
			]
			//,
		//"lengthMenu": [[5,10, 25, 50], [5,10, 25, 50]]
	});
});
</script>