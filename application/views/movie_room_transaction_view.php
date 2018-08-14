<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->page_name; ?> | Movie Room Transactions</title>
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
                    <h1 class="page-header">Movie Room Transactions</h1>
                </div>
                <!--End Page Header -->
            </div>
			
			<div class="row">
                <!-- Page Header -->
				<div class="col-lg-6">
					<div class="form-group">
						<label>Date :</label>
						<input type="date" class="form-control" id="date_from" name="date_from" onChange="movie_room_transaction_table();" value="<?php echo date('Y-m-d');?>"/>
					</div>
				</div>
				<!--div class="col-lg-6">
					<div class="form-group">
						<label>Date To :</label>
						<input type="date" class="form-control" id="date_to" name="date_to" onChange="movie_room_transaction_table();" value="<?php echo date('Y-m-d');?>"/>
					</div>
				</div-->
			</div>
			<div class="row">
                <div id="movie-room-transaction-table"></div>
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
	function edit_this(theid){
		$("body").mLoading();
		
		$.get("<?php echo $this->config->base_url().'movie_room_transaction/get_mrt_detail';?>/"+theid,function(result){
		
		console.log(result);
		
		var users_form = '\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Room :</label>\
						<input class="form-control" value="'+result.room_name+'" readonly>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Movie :</label>\
						<input class="form-control" value="'+result.movie_name+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>No. of Person :</label>\
						<input class="form-control" value="'+result.no_of_person+'" readonly>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Corkage :</label>\
						<input class="form-control" value="'+(result.corkage==1?'Yes':'No')+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Check In Time :</label>\
						<input class="form-control" value="'+result.check_in+'" readonly>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Check Out :</label>\
<<<<<<< HEAD
						<input class="form-control" value="'+result.check_out+'" readonly>\
=======
						<input class="form-control" value="'+result.check_in+'" readonly>\
>>>>>>> 9579a53575e97dad17a475845d906729a0e1cf99
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Datetime Created :</label>\
						<input class="form-control" value="'+result.datetime_created+'" readonly>\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Created By :</label>\
						<input class="form-control" value="'+result.created_by+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Money :</label>\
						<input class="form-control" value="'+result.money+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Total :</label>\
						<input class="form-control" value="'+result.total+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-6">\
					<div class="form-group">\
					</div>\
				</div>\
				<div class="col-lg-6">\
					<div class="form-group">\
						<label>Change :</label>\
						<input class="form-control" value="'+result.money_change+'" readonly>\
					</div>\
				</div>\
			</div>\
			<div class="row">\
				<div class="col-lg-12">\
					'+result.additional_table+'\
				</div>\
			</div>\
		';
		
		setTimeout(function(){
			$("body").mLoading("hide");
			$("#dynamic-modal-title").html('Movie Room Transaction Detail');
			$("#dynamic-modal-body").html(users_form);
			$("#dynamic-modal-footer").html('');
			$("#dynamic-modal").modal({show:true});
		}, 1000);
		
		}, 'json');
	}
	
	function movie_room_transaction_table(){
		var date_from = $("#date_from").val();
		var date_to = $("#date_to").val();
		
		$.post("<?php echo $this->config->base_url().'movie_room_transaction/reload_table'?>",{date_from:date_from, date_to:date_to},function(result){
			console.log(result);
			$("#movie-room-transaction-table").html(result.table_draw);
		}, 'json');
	}
	
	$(document).ready(function(){
		movie_room_transaction_table();
	});
	</script>

</body>

</html>





