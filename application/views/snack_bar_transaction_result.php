<table class="table" id="mrt-result-table">
	<thead>
	<tr>
		<th>Order No</th>
		<th>Order Type</th>
		<th>Datetime Created</th>
		<th>Created By</th>
		<th>Paid</th>
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
		"sAjaxSource": "<?php echo $this->config->base_url().'snack_bar_transaction/snack_bar_transaction_listing';?>",
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