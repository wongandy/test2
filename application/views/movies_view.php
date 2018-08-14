<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->page_name; ?> | Movies</title>
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
                    <h1 class="page-header">Movies</h1>
                </div>
                <!--End Page Header -->
            </div>
			
			<div class="row">
                <!-- Page Header -->
				<a href="javascript:add_this()"><i class="fa fa-plus fa-fw"></i> Add Movie</a>
                <table class="table table-striped table-bordered table-hover monitor-ticket-table" id="status_dataTables-example">
				   <thead>
						<tr>
							<th>Movie Name</th>
							<th>IMDb Rating</th>
							<th>Duration</th>
							<th>Genres</th>
							<th>Year</th>
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
	function add_this(){
		$("body").mLoading();
		
		var users_form = '\
		<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'movies/add_movie';?>">\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Movie Name :</label>\
						<input class="form-control" id="movie_name" name="movie_name"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Description :</label>\
						<textarea class="form-control" col="3" id="description" name="description"></textarea>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Duration :</label>\
						<input class="form-control" id="duration" name="duration" placeholder="2:59"/>\
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
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>IMDb Rating :</label>\
						<input class="form-control" id="imdb_rating" name="imdb_rating"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Year :</label>\
						<input type="number" class="form-control" id="year" name="year"/>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Position :</label>\
						<input type="number" class="form-control" id="position" name="position"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Genres :</label>\
						<input class="form-control" id="genres" name="genres"/>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<button type="button" class="am-button btn btn-success">Save</button>\
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
				</div>\
			</div>\
			</form>\
		';
		
		setTimeout(function(){
			$("body").mLoading("hide");
			$("#dynamic-modal-title").html('Add Movie');
			$("#dynamic-modal-body").html(users_form);
			$("#dynamic-modal-footer").html('');
			$("#dynamic-modal").modal({show:true});
			
			$(document).on("click",".am-button",function(){
				if(!confirm("Are you sure you want to add this movie?"))
					return false;
				
				$('#update_user_form').submit();
			});
			
			$('#update_user_form')
			.bootstrapValidator({
				message: 'This value is not valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					movie_name: {
						validators: {
							notEmpty: {
								message: 'Field movie name is required'
							}
						}
					},
					duration: {
						validators: {
							notEmpty: {
								message: 'Field duration is required'
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
					window.location.href = "<?php echo $this->config->base_url().'movies';?>";
				}, 'json');
			});
		}, 1000);
	}
	
	function edit_this(theid){
		$("body").mLoading();
		
		$.get("<?php echo $this->config->base_url().'movies/get_movie_detail';?>/"+theid,function(result){
		
		
		var users_form = '\
		<form id="update_user_form" method="post" action="<?php echo $this->config->base_url().'movies/update_movie';?>/'+theid+'">\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Movie Name :</label>\
						<input class="form-control" id="movie_name" name="movie_name" value="'+result.movie_name+'"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Description :</label>\
						<textarea class="form-control" col="3" id="description" name="description">'+result.description+'</textarea>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Duration :</label>\
						<input class="form-control" id="duration" name="duration" value="'+result.duration+'" placeholder="2:59"/>\
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
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>IMDb Rating :</label>\
						<input class="form-control" id="imdb_rating" name="imdb_rating" value="'+result.imdb_rating+'"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Year :</label>\
						<input type="number" class="form-control" id="year" name="year" value="'+result.year+'"/>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Position :</label>\
						<input type="number" class="form-control" id="position" name="position" value="'+result.position+'"/>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Genres :</label>\
						<input class="form-control" id="genres" name="genres" value="'+result.genres+'"/>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<button type="button" class="um-button btn btn-success">Update</button>\
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
				</div>\
			</div>\
			</form>\
		';
		
		setTimeout(function(){
			$("body").mLoading("hide");
			$("#dynamic-modal-title").html('Update Movie');
			$("#dynamic-modal-body").html(users_form);
			$("#dynamic-modal-footer").html('');
			$("#dynamic-modal").modal({show:true});
			
			$(document).on("click",".um-button",function(){
				if(!confirm("Are you sure you want to update this movie?"))
					return false;
				
				$('#update_user_form').submit();
			});
			
			$('#update_user_form')
			.bootstrapValidator({
				message: 'This value is not valid',
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					movie_name: {
						validators: {
							notEmpty: {
								message: 'Field movie name is required'
							}
						}
					},
					duration: {
						validators: {
							notEmpty: {
								message: 'Field duration is required'
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
					window.location.href = "<?php echo $this->config->base_url().'movies';?>";
				}, 'json');
			});
		}, 1000);
		
		}, 'json');
	}
	
	function delete_this(theid){
		if(confirm("Are you sure you want to delete this movie?")){
			$.get("<?php echo $this->config->base_url().'movies/delete_movie';?>/"+theid, function(result){
				alert(result.msg);
				window.location.href = "<?php echo $this->config->base_url().'movies';?>";
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
			"sAjaxSource": "<?php echo $this->config->base_url().'movies/movie_listing';?>",
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





