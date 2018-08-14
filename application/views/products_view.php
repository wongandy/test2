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

        <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
               <?php $this->load->view('menus'); ?>
            </div>
            <!-- end sidebar-collapse -->
        </nav>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Products</h1>
                </div>
                <!--End Page Header -->
            </div>
			
			<div class="row">
                <!-- Page Header -->
				<a href="javascript:add_this()"><i class="fa fa-plus fa-fw"></i> Add Product</a>
                <table class="table table-striped table-bordered table-hover monitor-ticket-table" id="status_dataTables-example">
				   <thead>
						<tr>
							<th>Product ID</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>
                <!--End Page Header -->
            </div>

        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->
	
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
	var uom_count = 1;
	function add_this(){
		$("body").mLoading();
		
		$.get("<?php echo $this->config->base_url().'products/get_inventory_products';?>",function(result){
		
		var users_form = '\
		<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'products/add_product';?>">\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Product Name :</label>\
						<input class="form-control" id="product_name" name="product_name"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Description :</label>\
						<textarea class="form-control" cols="3" id="description" name="description"></textarea>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Price :</label>\
						<input type="text" class="form-control" id="price" name="price"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Active :</label>\
						<select class="form-control" id="active" name="active"><option value="1">Yes</option><option value="0">No</option></select>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-12">\
					<label>Product Inventory</label>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-12">\
					<table class="new_product_uom_table table">\
						<thead>\
						<tr>\
							<th>Product</th>\
							<th>Quantity</th>\
							<th>Operation</th>\
						</tr>\
						</thead>\
						<tbody>\
						<tr>\
							<td>'+result.pi_selectbox+'</td>\
							<td><input type="number" class="form-control" id="new_uom_quantity"/></td>\
							<td><a href="#" class="add_new_uom_add">ADD</a></td>\
						</tr>\
						</tbody>\
					</table>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<button type="button" class="ap-button btn btn-success">Save</button>\
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
				</div>\
			</div>\
			</form>\
		';
		
		setTimeout(function(){
			$("body").mLoading("hide");
			$("#dynamic-modal-title").html('Add Product');
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
					product_name: {
						validators: {
							notEmpty: {
								message: 'Field product name is required'
							}
						}
					},
					price: {
						validators: {
							notEmpty: {
								message: 'Field price is required'
							}
						}
					}
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
					window.location.href = "<?php echo $this->config->base_url().'products';?>";
				}, 'json');
			});
			
		}, 1000);
		
		}, 'json');
		
	}
	
	$(document).on("click",".ap-button",function(){
		if(!confirm("Are you sure you want to add this product?"))
			return false;
			
		if(isNaN($("#price").val())){
			$("#price").val('');
			alert("Field price is not a number");
			return false;
		}
		
		var product_uom_count = 0;
		$('input[name^="uom_name"]').each(function() {
			product_uom_count++;
		});
		
		if(product_uom_count==0){
			alert("Please add atleast one product.");
			return false;
		}
		
		$('#update_user_form').submit();
	});
	
	$(document).on("click",".add_new_uom_add",function(){
		if(!confirm("Are you sure you want to add product inventory?"))
			return false;
			
		var uom_name = $("#new_pi").val();
		var pi_name = $("#new_pi option[value='"+uom_name+"']").text();
		var uom_quantity = $("#new_uom_quantity").val();
		var current_uom = $("#new_current_uom").is(':checked');
		
		if(uom_name==0){
			alert("Product is required upon adding product inventory.");
			return false;
		}
		if(uom_quantity=='' || uom_quantity==0){
			alert("Quantity is required upon adding product inventory.");
			return false;
		}
		
		var html = '\
			<tr id="tr_uom_'+uom_count+'">\
				<td><input class="form-control" name="uom_name[]" value="'+pi_name+'" readonly/><input type="hidden" id="pi_id" name="pi_id[]" value="'+uom_name+'"/></td>\
				<td><input class="form-control" name="uom_quantity[]" value="'+uom_quantity+'" readonly/></td>\
				<td><a href="#" class="remove_new_uom_add" uom_count="'+uom_count+'">Remove</a></td>\
			</tr>\
		';
		
		$(".new_product_uom_table").append(html);
		
		$("#new_uom_quantity").val('');
			
		uom_count++;
	});
	
	$(document).on("click",".remove_new_uom_add",function(){
		if(!confirm("Are you sure you want to remove product inventory?"))
			return false;
			
		var tr_id = $(this).attr("uom_count");
		$("#tr_uom_"+tr_id).remove();
	});
	
	function edit_this(theid){
		$("body").mLoading();
		
		$.get("<?php echo $this->config->base_url().'products/get_product_detail';?>/"+theid,function(result){
		
		var users_form = '\
		<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'products/update_product';?>/'+theid+'">\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Product Name :</label>\
						<input class="form-control" id="product_name" name="product_name" value="'+result.product_name+'"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Description :</label>\
						<textarea class="form-control" cols="3" id="description" name="description">'+result.description+'</textarea>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Price :</label>\
						<input type="text" class="form-control" id="price" name="price" value="'+result.price+'"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Active :</label>\
						<select class="form-control" id="active" name="active"><option '+(result.active==1?'selected':'')+' value="1">Yes</option><option '+(result.active==0?'selected':'')+' value="0">No</option></select>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-12">\
					<label>Product Inventory</label>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-12">\
					<table class="new_product_uom_table table">\
						<thead>\
						<tr>\
							<th>Product</th>\
							<th>Quantity</th>\
							<th>Operation</th>\
						</tr>\
						</thead>\
						<tbody>\
						<tr>\
							<td>'+result.pi_selectbox+'</td>\
							<td><input type="number" class="form-control" id="new_uom_quantity"/></td>\
							<td><a href="#" class="add_new_uom_up">ADD</a></td>\
						</tr>\
						</tbody>\
					</table>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<button type="button" class="up-button btn btn-success">Update</button>\
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
				</div>\
			</div>\
			</form>\
		';
		
		var html = '';
		$.each(result.product_detail, function(key,value) {
		
		html += '\
			<tr id="tr_uom_'+uom_count+'">\
				<td><input class="form-control" name="uom_name[]" value="'+value.name+'" readonly/><input type="hidden" id="pi_id" name="pi_id[]" value="'+value.pi_id+'"/></td>\
				<td><input class="form-control" name="uom_quantity[]" value="'+value.quantity+'" readonly/></td>\
				<td><a href="#" class="remove_new_uom_up" uom_count="'+uom_count+'" pi_id="'+value.pi_id+'">Remove</a></td>\
			</tr>\
		';
		
		uom_count++;
		
		});
		
		setTimeout(function(){
			$("body").mLoading("hide");
			$("#dynamic-modal-title").html('Update Product');
			$("#dynamic-modal-body").html(users_form);
			$("#dynamic-modal-footer").html('');
			$("#dynamic-modal").modal({show:true});
			
			$(".new_product_uom_table").append(html);
			
			$('#update_user_form')
			.bootstrapValidator({
				message: 'This value is not valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					product_name: {
						validators: {
							notEmpty: {
								message: 'Field product name is required'
							}
						}
					},
					price: {
						validators: {
							notEmpty: {
								message: 'Field price is required'
							}
						}
					}
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
					window.location.href = "<?php echo $this->config->base_url().'products';?>";
				}, 'json');
			});
		}, 1000);
		
		}, 'json');
	}
	
	$(document).on("click",".up-button",function(){
		if(!confirm("Are you sure you want to update this product?"))
			return false;
			
		if(isNaN($("#price").val())){
			$("#price").val('');
			alert("Field price is not a number");
			return false;
		}
		
		var product_uom_count = 0;
		$('input[name^="uom_name"]').each(function() {
			product_uom_count++;
		});
		
		if(product_uom_count==0){
			alert("Please add atleast one product.");
			return false;
		}
		
		$('#update_user_form').submit();
	});
	
	$(document).on("click",".add_new_uom_up",function(){
		if(!confirm("Are you sure you want to add product inventory?"))
			return false;
			
		var uom_name = $("#new_pi").val();
		var pi_name = $("#new_pi option[value='"+uom_name+"']").text()
		var uom_quantity = $("#new_uom_quantity").val();
		var current_uom = $("#new_current_uom").is(':checked');
		
		if(uom_name==0){
			alert("Product is required upon adding product inventory.");
			return false;
		}
		if(uom_quantity=='' || uom_quantity==0){
			alert("Quantity is required upon adding product inventory.");
			return false;
		}
		
		var html = '\
			<tr id="tr_uom_'+uom_count+'">\
				<td><input class="form-control" name="uom_name[]" value="'+pi_name+'" readonly/><input type="hidden" id="pi_id" name="pi_id[]" value="'+uom_name+'"/></td>\
				<td><input class="form-control" name="uom_quantity[]" value="'+uom_quantity+'" readonly/></td>\
				<td><a href="#" class="remove_new_uom_up" uom_count="'+uom_count+'">Remove</a></td>\
			</tr>\
		';
		
		$(".new_product_uom_table").append(html);
		
		$("#new_uom_quantity").val('');
			
		uom_count++;
	});
	
	$(document).on("click",".remove_new_uom_up",function(){
		if(!confirm("Are you sure you want to remove product inventory?"))
			return false;
			
		var tr_id = $(this).attr("uom_count");
		var pi_id = $(this).attr("pi_id");
		
		$(".new_product_uom_table").append('<input type="hidden" name="delete_pi_id[]" value="'+pi_id+'"/>');
		$("#tr_uom_"+tr_id).remove();
	});
	
	function delete_this(theid){
		if(confirm("Are you sure you want to delete this product?")){
			$.get("<?php echo $this->config->base_url().'products/delete_product';?>/"+theid, function(result){
				alert(result.msg);
				window.location.href = "<?php echo $this->config->base_url().'products';?>";
			}, 'json');
		}else
			return false;
	}
	
	$(document).ready(function(){
		$('#status_dataTables-example').dataTable( 
		{   "bJQueryUI": true,
				"sPaginationType": "full_numbers",
				"bProcessing": true,
				"bServerSide": true,
			"sAjaxSource": "<?php echo $this->config->base_url().'products/product_listing';?>",
			"bFilter": true,
			 "sDom": '<"H"lfr>t<"F"ip>',
			 "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
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

</body>

</html>





