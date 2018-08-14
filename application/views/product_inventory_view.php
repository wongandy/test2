<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->page_name; ?> | Products</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/main-style.css" rel="stylesheet" />
    <!-- Page-Level CSS -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/morris/morris-0.4.3.min.css" rel="stylesheet" />
	<!-- Validator -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/bootstrapValidator.css" rel="stylesheet">
	<!-- DataTables CSS -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/TableTools-2.2.3/css/dataTables.tableTools.css" rel="stylesheet">
	<!-- Spinner CSS -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/jquery.mloading.css" rel="stylesheet" type="text/css">
	
	<link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/timeline/timeline.css" rel="stylesheet" />
	<!--link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"-->
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">
                    <h3><?php echo $row->page_name; ?></h3>
                </a>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                <!-- main dropdown -->

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo $this->config->base_url().'login/logged_out';?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
        <!-- end navbar top -->

    </div>
    <!-- end wrapper -->
	<!--  page-wrapper -->
        <div>

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Product Inventory</h1>
                </div>
                <!--End Page Header -->
            </div>
			
			<div class="row">
				<div class="col-lg-12">
                <!-- Page Header -->
				<a href="javascript:add_this()"><i class="fa fa-plus fa-fw"></i> Add Product Inventory</a>
                <!--End Page Header -->
				</div>
            </div>
			
			<div class="row">
				<div class="col-lg-1">
					<label>Month : </label>
				</div>
				<div class="col-lg-2">
					<select class="form-control" id="filter_month" onChange="draw_pi_result();">
						<option <?php echo (date('m')==1?'selected':'');?> value="1">January</option>
						<option <?php echo (date('m')==2?'selected':'');?> value="2">February</option>
						<option <?php echo (date('m')==3?'selected':'');?> value="3">March</option>
						<option <?php echo (date('m')==4?'selected':'');?> value="4">April</option>
						<option <?php echo (date('m')==5?'selected':'');?> value="5">May</option>
						<option <?php echo (date('m')==6?'selected':'');?> value="6">June</option>
						<option <?php echo (date('m')==7?'selected':'');?> value="7">July</option>
						<option <?php echo (date('m')==8?'selected':'');?> value="8">August</option>
						<option <?php echo (date('m')==9?'selected':'');?> value="9">September</option>
						<option <?php echo (date('m')==10?'selected':'');?> value="10">October</option>
						<option <?php echo (date('m')==11?'selected':'');?> value="11">November</option>
						<option <?php echo (date('m')==12?'selected':'');?> value="12">December</option>
					</select>
				</div>
				<div class="col-lg-1">
					<label>Day : </label>
				</div>
				<div class="col-lg-2" id="day_selectbox">
					<select class="form-control" id="filter_day" onChange="draw_pi_result();">
						<?php
							$max_days = date("t", strtotime(date('Y-m-d')));
							// for($day=1;$day<=$max_days;$day++)
							for($day=1;$day<=31;$day++)
								echo '<option '.(date('d')==$day?'selected':'').' value="'.$day.'">'.$day.'</option>';
						?>
					</select>
				</div>
				<div class="col-lg-1">
					<label>Year : </label>
				</div>
				<div class="col-lg-2">
					<select class="form-control" id="filter_year" onChange="draw_pi_result();">
						<option value="<?php echo (integer) date('Y') - 4;?>"><?php echo (integer) date('Y') - 4;?></option>
						<option value="<?php echo (integer) date('Y') - 3;?>"><?php echo (integer) date('Y') - 3;?></option>
						<option value="<?php echo (integer) date('Y') - 2;?>"><?php echo (integer) date('Y') - 2;?></option>
						<option value="<?php echo (integer) date('Y') - 1;?>"><?php echo (integer) date('Y') - 1;?></option>
						<option selected value="<?php echo (integer) date('Y'); ?>"><?php echo (integer) date('Y'); ?></option>
						<option value="<?php echo (integer) date('Y') + 1;?>"><?php echo (integer) date('Y') + 1;?></option>
					</select>
				</div>
            </div>
			
			<div class="row">
				<div class="col-lg-12" id="pi_result_view"></div>
			</div>

        </div>
        <!-- end page-wrapper -->
	
	<input type="hidden" id="per_person_price" value="<?php echo $row->per_person_price; ?>"/>
	<input type="hidden" id="corkage_price" value="<?php echo $row->corkage_price; ?>"/>
	<!-- Modal -->
	<div id="dynamic-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content" style="width:900px;">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" id="dynamic-modal-title">Notification</h4>
		  </div>
		  <div class="modal-body" id="dynamic-modal-body"></div>
		  <div class="modal-footer" id="dynamic-modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
	
	<div id="dynamic-modal2" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" id="dynamic-modal-title2">Notification</h4>
		  </div>
		  <div class="modal-body" id="dynamic-modal-body2"></div>
		  <div class="modal-footer" id="dynamic-modal-footer2">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>

	  </div>
	</div>
	
	<!---ROTATE HEADER SAMPLE CSS---->
	<style>
		th{
			text-align:center;
		}
		th.rotate {
		  /* Something you can count on */
		  height: 140px;
		  white-space: nowrap;
		}

		th.rotate > div {
		  transform: 
			/* Magic Numbers */
			translate(25px, 51px)
			/* 45 is really 360 - 45 */
			rotate(315deg);
		  width: 30px;
		}
		th.rotate > div > span {
		  border-bottom: 1px solid #ccc;
		  padding: 5px 10px;
		}
	</style>

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/jquery-1.10.2.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/pace/pace.js"></script>
    <!--script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/siminta.js"></script-->
    <!-- Page-Level Plugin Scripts-->
    <!--script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/morris/morris.js"></script-->
    <!--script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/dashboard-demo.js"></script-->
	<!-- DataTables JavaScript -->
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/dataTables/dataTables.bootstrap.js"></script>
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/dataTables/dataTables.tableTools.js"></script>
	<!-- Validator -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/bootstrapValidator.js"></script>
	<!-- Spinner JS -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/jquery.mloading.js"></script>

	<script>
	function draw_pi_result(){
		var month = $("#filter_month").val();
		var day = $("#filter_day").val();
		var year = $("#filter_year").val();
		
		$.get("<?php echo $this->config->base_url().'product_inventory/get_result2';?>/"+month+"/"+day+"/"+year,function(result){
			$("#pi_result_view").html(result.table_draw);
		}, 'json');
	}
	
	function add_this(){
		$("body").mLoading();
			
		$.get("<?php echo $this->config->base_url().'product_inventory/get_uom_data';?>",function(result){
			var users_form = '\
			<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'product_inventory/add_pi';?>">\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>PI Name :</label>\
							<input class="form-control" id="pi_name" name="pi_name"/>\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>PI UOM :</label>\
							'+result.uom_selectbox+'\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>QTY ON HAND :</label>\
							<input type="text" class="form-control" value="0" readonly/>\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Purchase :</label>\
							<input type="number" class="form-control" id="purchase" name="purchase" value="0"/>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<input type="hidden" id="uom_name" name="uom_name" value=""/>\
						<button type="button" class="api-button btn btn-success">Save</button>\
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
					</div>\
				</div>\
				</form>\
			';
			
			setTimeout(function(){
				$("body").mLoading("hide");
				$("#dynamic-modal-title").html('Add Product Inventory');
				$("#dynamic-modal-body").html(users_form);
				$("#dynamic-modal-footer").html('');
				$("#dynamic-modal").modal({show:true});
				
				$('#update_user_form')
				.bootstrapValidator({
					message: 'This value is not valid',
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						pi_name: {
							validators: {
								notEmpty: {
									message: 'Field PI name is required'
								}
							}
						}
					}
				})
				.on('success.form.bv', function(e,data) {
					var uom = $("#uom").val();
					$("#uom_name").val($("#uom option[value='"+uom+"']").text());
					
					// Prevent form submission
					e.preventDefault();

					// Get the form instance
					var $form = $(e.target);

					// Get the BootstrapValidator instance
					var bv = $form.data('bootstrapValidator');
					
					$("#dynamic-modal").modal("hide");
					$("body").mLoading();
					
					$.post($form.attr('action'), $form.serialize(), function(result) {
						alert(result.msg);
						window.location.href = "<?php echo $this->config->base_url().'product_inventory';?>";
					}, 'json');
				});
				
		}, 1000);
				
		}, 'json');
	}
	
	$(document).ready(function(){
		draw_pi_result();
		
		$(document).on("click",".api-button",function(){
			if(!confirm("Are you sure you want to add this product inventory?"))
				return false;
				
			if($("#purchase").val()<=0){
				alert("Field purchase must not be empty/zero.");
				return false;
			}
			
			$('#update_user_form').submit();
		});
		
		$(document).on("click", ".view_pi", function(){
			var pi_id = $(this).attr('pi_id');
			
			$("body").mLoading();
			
			$.get("<?php echo $this->config->base_url().'product_inventory/get_pi_data';?>/"+pi_id,function(result){
				var users_form = '\
				<form id="delete_pi_form" method="post" action="<?php echo $this->config->base_url().'product_inventory/delete_pi';?>/'+pi_id+'">\
				</form>\
				<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'product_inventory/update_pi';?>/'+pi_id+'">\
					<div class="row">\
						<div class="col-lg-6">\
							<div class="form-group">\
								<label>PI Name :</label>\
								<input class="form-control" id="pi_name" name="pi_name" value="'+result.name+'"/>\
							</div>\
						</div>\
						<div class="col-lg-6">\
							<div class="form-group">\
								<label>PI UOM :</label>\
								'+result.uom_selectbox+'\
							</div>\
						</div>\
					</div>\
					<div class="row">\
						<div class="col-lg-6">\
							<div class="form-group">\
								<label>QTY ON HAND :</label>\
								<input type="text" class="form-control" value="'+result.on_hand+'" readonly/>\
							</div>\
						</div>\
						<div class="col-lg-6">\
							<div class="form-group">\
								<label>Purchase :</label>\
								<input type="number" class="form-control" id="purchase" name="purchase" value="0"/>\
							</div>\
						</div>\
					</div>\
					<div class="row">\
						<div class="col-lg-6">\
							<input type="hidden" id="uom_name" name="uom_name" value=""/>\
							<button type="button" class="upi-button btn btn-success">Update</button>\
							<button type="button" class="delete-button btn btn-danger">Delete</button>\
							<button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>\
						</div>\
					</div>\
					</form><br><br>\
					<div class="row">\
						<div class="col-lg-12">\
							<label>Product Timeline</label>\
						</div>\
					</div>\
					'+result.pi_timeline+'\
				';
				
				setTimeout(function(){
					$("body").mLoading("hide");
					$("#dynamic-modal-title").html('Product Inventory Detail');
					$("#dynamic-modal-body").html(users_form);
					$("#dynamic-modal-footer").html('');
					$("#dynamic-modal").modal({show:true});
					
					$('#update_user_form')
					.bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							pi_name: {
								validators: {
									notEmpty: {
										message: 'Field PI name is required'
									}
								}
							}
						}
					})
					.on('success.form.bv', function(e,data) {
						var uom = $("#uom").val();
						$("#uom_name").val($("#uom option[value='"+uom+"']").text());
						
						// Prevent form submission
						e.preventDefault();

						// Get the form instance
						var $form = $(e.target);

						// Get the BootstrapValidator instance
						var bv = $form.data('bootstrapValidator');
						
						$("#dynamic-modal").modal("hide");
						$("body").mLoading();
						
						$.post($form.attr('action'), $form.serialize(), function(result) {
							alert(result.msg);
							window.location.href = "<?php echo $this->config->base_url().'product_inventory';?>";
						}, 'json');
					});
					
					$('#delete_pi_form')
					.bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						}
					})
					.on('success.form.bv', function(e,data) {
						// Prevent form submission
						e.preventDefault();

						// Get the form instance
						var $form = $(e.target);

						// Get the BootstrapValidator instance
						var bv = $form.data('bootstrapValidator');
						
						$("#dynamic-modal").modal("hide");
						$("body").mLoading();
						
						$.post($form.attr('action'), $form.serialize(), function(result) {
							alert(result.msg);
							window.location.href = "<?php echo $this->config->base_url().'product_inventory';?>";
						}, 'json');
					});
					
			}, 1000);
					
			}, 'json');
		});
		
		$(document).on("click",".upi-button",function(){
			if(!confirm("Are you sure you want to update this product inventory?"))
				return false;
			
			$('#update_user_form').submit();
		});
		
		$(document).on("click",".delete-button",function(){
			if(!confirm("Are you sure you want to delete this product inventory?"))
				return false;
			
			$('#delete_pi_form').submit();
		});
		
		$(document).on("click",".view-detail",function(){
			var detail = $(this).attr("detail");
			
			$("#dynamic-modal-title2").html('Transaction Detail');
			$("#dynamic-modal-body2").html(detail);
			$("#dynamic-modal-footer2").html('');
			$("#dynamic-modal2").modal({show:true});
		});
	});
	</script>

</body>

</html>





