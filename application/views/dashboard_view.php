<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->page_name; ?> | Dashboard</title>
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
	<!-- Spinner CSS -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/jquery.mloading.css" rel="stylesheet" type="text/css">
	<!--link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen"-->
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper" style="width:170%;">
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
				<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2 || $this->session->userdata('role')==3):?>
				<li>
					<button type="button" id="snacks-bar-window" class="btn btn-primary btn-circle btn-xl" title="Snax Bar"><i class="fa fa-plus-square"></i></button>
				</li>
				<?php endif;?>
				<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2):?>
				<li>
					<button type="button" id="movie-room-check-in" class="movie-room-check-in btn btn-success btn-circle btn-xl" room_id="0" title="Movie Room Check In"><i class="fa fa-check-square"></i></button>
				</li>
				<?php endif;?>

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
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!--End Page Header -->
            </div>
			
			<div class="row">
                <!-- Page Header -->
                <div id="room-tracker-table-div" class="col-lg-12"></div>
                <!--End Page Header -->
            </div>
			
			<!--div class="row">
                <div class="col-lg-2">
					<h3>Room One</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Two</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
            </div>
			
			<div class="row">
                <div class="col-lg-2">
					<h3>Room One</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Two</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
				<div class="col-lg-2">
					<h3>Room Three</h3>
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
                </div>
            </div-->

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
	<!-- Validator -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/bootstrapValidator.js"></script>
	<!-- Spinner JS -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/jquery.mloading.js"></script>
	<!-- Spinner JS
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/bootstrap-datetimepicker.min.js"></script-->

	<script>
	$(document).ready(function(){
		$.get("<?php echo $this->config->base_url().'dashboard/reload_table2'?>",function(result){
			$("#room-tracker-table-div").html(result.table_draw);
		}, 'json');
		
		<!-------------------------MOVIE ROOM CHECK IN FORM----------------------------->
		<?php if($this->session->userdata('role')==1 || $this->session->userdata('role')==2):?>
		$(document).on("click","#additional-person",function(){
			$("body").mLoading();
			var current_person = $(this).attr("current_person");
			var room_name = $(this).attr("room_name");
			var movie_name = $(this).attr("movie_name");
			var mrt_id = $(this).attr("mrt_id");
			
			var additional_person_form = '\
			<form id="additional_person_form" method="post" action="<?php echo $this->config->base_url().'dashboard/additional_person';?>/'+mrt_id+'">\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Movie :</label>\
							<input class="form-control" value="'+movie_name+'" readonly/>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Current No. of Person :</label>\
							<input class="form-control" value="'+current_person+'" readonly/>\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Additional Person :</label>\
							<input type="number" class="form-control" id="additional_person" name="additional_person" onClick="this.select();" value="0"/>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Money :</label>\
							<input type="number" class="form-control" name="additionalp_money" id="additionalp_money" onClick="this.select();" value="0" readonly>\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Note :</label>\
							<textarea class="form-control" col="4" row="4" id="description" name="description"></textarea>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="1">1</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="5">5</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="10">10</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="20">20</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="50">50</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="100">100</button>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Total :</label>\
							<input class="form-control" name="additionalp_total" id="additionalp_total" value="0" readonly>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="200">200</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button btn btn-default" amount="500">500</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button btn btn-default" amount="1000">1000</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button btn btn-warning" amount="0">Reset</button>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Change :</label>\
							<input class="form-control" name="additionalp_change" id="additionalp_change" onClick="this.select();" value="0" readonly>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<button type="button" class="as-button btn btn-success">Submit</button>\
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
					</div>\
				</div>\
				</form>\
			';
			
			setTimeout(function(){
				$("body").mLoading("hide");
				$("#dynamic-modal-title").html('Additional Person for '+room_name);
				$("#dynamic-modal-body").html(additional_person_form);
				$("#dynamic-modal-footer").html('');
				$("#dynamic-modal").modal({show:true});
				
				$(document).on("click",".as-button",function(){
					if(!confirm('Please confirm the inputted data!')){
						return false;
					}
					
					var additional_person = $("#additional_person").val();
					if(additional_person<=0){
						alert("Additional Person value must not be zero.");
						return false;
					}
					var change = $("#additionalp_change").val();
					if(change<0){
						alert("Money must be greater than or equal to Total.");
						return false;
					}
					
					$('#additional_person_form').submit();
				});
				
				$('#additional_person_form')
				.bootstrapValidator({
					message: 'This value is not valid',
					feedbackIcons: {
						valid: 'glyphicon glyphicon-ok',
						invalid: 'glyphicon glyphicon-remove',
						validating: 'glyphicon glyphicon-refresh'
					},
					fields: {
						additional_person: {
							validators: {
								notEmpty: {
									message: 'Additional Person is required'
								}
							}
						},
						additionalp_money: {
							validators: {
								notEmpty: {
									message: 'Money is required'
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
						if(result.error == 0)
						{
							setTimeout(function(){
								$("body").mLoading("hide");
								$("#dynamic-modal-title").html('Success Message');
								$("#dynamic-modal-body").html('<div class="alert alert-success"><strong>Attention!</strong> '+result.message+'</div>');
								$("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
								$("#dynamic-modal").modal({show:true});
							}, 1000);
							setTimeout(function(){
								$("body").mLoading("hide");
								window.location.href = "<?php echo $this->config->base_url().'dashboard';?>";
							}, 4000);
						}
						else
						{
							setTimeout(function(){
								$("body").mLoading("hide");
								$("#dynamic-modal-title").html('Error Message');
								$("#dynamic-modal-body").html('<div class="alert alert-warning"><strong>Attention!</strong> '+result.message+'</div>');
								$("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
								$("#dynamic-modal").modal({show:true});
							}, 1000);
						}
					}, 'json');
				});
			}, 1000);
			
			$(document).on("click",".money-button",function(){
				var money = parseFloat($("#additionalp_money").val());
				var amount = parseFloat($(this).attr("amount"));
				
				var total = money+amount;
				if(amount==0)
					total = 0;
				
				$("#additionalp_money").val(total);
				
				var additional_person = parseInt($("#additional_person").val());
				var money = parseInt($("#additionalp_money").val());
				var per_person_price = parseInt($("#per_person_price").val());
				var total = 0;
				var change = 0;
				
				if(additional_person<0 || isNaN(additional_person)){
					additional_person = 0;
					$("#additional_person").val(0);
				}
				total = additional_person*per_person_price;
				
				if(money<0 || isNaN(money)){
					money = 0;
					$("#additionalp_money").val(0);
				}
					
				change = money-total;
				
				$("#additionalp_total").val(total);
				$("#additionalp_change").val(change);
			});
		});
		
		$(document).on("keyup","#additional_person, #additionalp_money",function(){
			var additional_person = parseInt($("#additional_person").val());
			var money = parseInt($("#additionalp_money").val());
			var per_person_price = parseInt($("#per_person_price").val());
			var total = 0;
			var change = 0;
			
			if(additional_person<0 || isNaN(additional_person)){
				additional_person = 0;
				$("#additional_person").val(0);
			}
			total = additional_person*per_person_price;
			
			if(money<0 || isNaN(money)){
				money = 0;
				$("#additionalp_money").val(0);
			}
				
			change = money-total;
			
			$("#additionalp_total").val(total);
			$("#additionalp_change").val(change);
		});
		
		$(document).on("change","#additional_person, #additionalp_money",function(){
			var additional_person = parseInt($("#additional_person").val());
			var money = parseInt($("#additionalp_money").val());
			var per_person_price = parseInt($("#per_person_price").val());
			var total = 0;
			var change = 0;
			
			if(additional_person<0 || isNaN(additional_person)){
				additional_person = 0;
				$("#additional_person").val(0);
			}
			total = additional_person*per_person_price;
			
			if(money<0 || isNaN(money)){
				money = 0;
				$("#additionalp_money").val(0);
			}
				
			change = money-total;
			
			$("#additionalp_total").val(total);
			$("#additionalp_change").val(change);
		});
		
		$(document).on("click",".movie-room-check-in",function(){
			var room_id = $(this).attr("room_id");
			var corkage = <?php echo $row->corkage_price; ?>;
			if($(this).attr("check_in_time"))
				var check_in_time = $(this).attr("check_in_time");
			else
				var check_in_time = '<?php echo str_replace(' ','T',date('Y-m-d H:i'));?>';
				
			$("body").mLoading();
			
			$.get("<?php echo $this->config->base_url().'dashboard/get_rooms_movies';?>/"+room_id,function(result){
				// console.log(result);
				var movie_room_check_in_form = '\
				<form id="movie_room_form" method="post" action="<?php echo $this->config->base_url().'dashboard/movie_room_check_in2';?>">\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Room :</label>\
							'+result.rooms_selectbox+'\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Movie :</label>\
							'+result.movies_selectbox+'\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>No. of Person :</label>\
							<input type="number" class="form-control" name="no_of_person" id="no_of_person" onClick="this.select();" value="0">\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Corkage (P'+corkage+') :</label>\
							<select class="form-control" name="corkage" id="corkage"><option value="0">No</option><option value="1">Yes</option></select>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Check In Time</label>\
							<p>Hour : '+result.hour_select+' Minute : '+result.minute_select+' AM/PM : '+result.am_pm_select+'</p>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Money :</label>\
							<input type="number" class="form-control" name="money" id="money" onClick="this.select();" value="0" readonly>\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Total :</label>\
							<input class="form-control" name="total" id="total" value="0" readonly>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="1">1</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="5">5</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="10">10</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="20">20</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="50">50</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="100">100</button>\
					</div>\
					<div class="col-lg-6">\
						<div class="form-group">\
							<label>Change :</label>\
							<input class="form-control" name="change" id="change" value="0" readonly>\
						</div>\
					</div>\
				</div>\
				<div class="row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="200">200</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button1 btn btn-default" amount="500">500</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button1 btn btn-default" amount="1000">1000</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button1 btn btn-warning" amount="0">Reset</button>\
					</div>\
					<div class="col-lg-6">\
						<button type="button" class="mrci-button btn btn-success">Movie Room Check-In</button>\
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
					</div>\
				</div>\
				<input type="hidden" id="vacant_hours" name="vacant_hours" value="<?php echo $row->vacant_hours; ?>"/>\
				<input type="hidden" id="allowed_idle_mins" name="allowed_idle_mins" value="<?php echo $row->allowed_idle_mins; ?>"/>\
				</form>\
				';
				
				setTimeout(function(){
					$("body").mLoading("hide");
					$("#dynamic-modal-title").html('Movie Room Check In');
					$("#dynamic-modal-body").html(movie_room_check_in_form);
					$("#dynamic-modal-footer").html('');
					$("#dynamic-modal").modal({show:true});
					
					$(document).on("click",".mrci-button",function(){
						if(!confirm('Please confirm the inputted data!')){
							return false;
						}
						
						var no_of_person = $("#no_of_person").val();
						if(no_of_person<=0){
							alert("No. of Person value must not be zero.");
							return false;
						}
						var change = $("#change").val();
						if(change<0){
							alert("Money must be greater than or equal to Total.");
							return false;
						}
						
						$('#movie_room_form').submit();
					});
					
					$('#movie_room_form')
					.bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							money: {
								validators: {
									notEmpty: {
										message: 'Money is required'
									}
								}
							},
							hour_value: {
								validators: {
									notEmpty: {
										message: 'Check In Time Hour is required'
									}
								}
							},
							minute_value: {
								validators: {
									notEmpty: {
										message: 'Check In Time Minute is required'
									}
								}
							},
							ampm_value: {
								validators: {
									notEmpty: {
										message: 'Check In Time AM/PM is required'
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
						
						$("body").mLoading();
						
						$.post($form.attr('action'), $form.serialize(), function(result) {
							console.log(result);
							if(result.error == 0)
							{
								$("#dynamic-modal").modal("hide");
								
								setTimeout(function(){
									$("body").mLoading("hide");
									$("#dynamic-modal-title").html('Success Message');
									$("#dynamic-modal-body").html('<div class="alert alert-success"><strong>Attention!</strong> '+result.message+'</div>');
									$("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
									$("#dynamic-modal").modal({show:true});
								}, 1000);
								setTimeout(function(){
									$("body").mLoading("hide");
									window.location.href = "<?php echo $this->config->base_url().'dashboard';?>";
								}, 4000);
							}
							else
							{
								setTimeout(function(){
									$("body").mLoading("hide");
									alert(result.message);
									return false;
								}, 1000);
								// setTimeout(function(){
									// $("body").mLoading("hide");
									// $("#dynamic-modal-title").html('Error Message');
									// $("#dynamic-modal-body").html('<div class="alert alert-warning"><strong>Attention!</strong> '+result.message+'</div>');
									// $("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
									// $("#dynamic-modal").modal({show:true});
								// }, 1000);
							}
						}, 'json');
						
						e.stopImmediatePropagation();
					});
				}, 1000);
				
				$(document).on("click",".money-button1",function(){
					var money = parseFloat($("#money").val());
					var amount = parseFloat($(this).attr("amount"));
					
					var total = money+amount;
					if(amount==0)
						total = 0;
					
					$("#money").val(total);
					
					var no_of_person = parseInt($("#no_of_person").val());
					var corkage = parseInt($("#corkage").val());
					var money = parseInt($("#money").val());
					var per_person_price = parseInt($("#per_person_price").val());
					var corkage_price = parseInt($("#corkage_price").val());
					var total = 0;
					var change = 0;
					
					if(no_of_person<0 || isNaN(no_of_person)){
						no_of_person = 0;
						$("#no_of_person").val(0);
					}
					total = no_of_person*per_person_price;
					
					if(money<0 || isNaN(money)){
						money = 0;
						$("#money").val(0);
					}
					
					if(corkage==1)
						total = parseInt(total)+parseInt(corkage_price);
						
					change = money-total;
					
					$("#total").val(total);
					$("#change").val(change);
				});
				
			}, 'json');
		});
		
		$(document).on("change","#no_of_person, #corkage, #money",function(){
			var no_of_person = parseInt($("#no_of_person").val());
			var corkage = parseInt($("#corkage").val());
			var money = parseInt($("#money").val());
			var per_person_price = parseInt($("#per_person_price").val());
			var corkage_price = parseInt($("#corkage_price").val());
			var total = 0;
			var change = 0;
			
			if(no_of_person<0 || isNaN(no_of_person)){
				no_of_person = 0;
				$("#no_of_person").val(0);
			}
			total = no_of_person*per_person_price;
			
			if(money<0 || isNaN(money)){
				money = 0;
				$("#money").val(0);
			}
			
			if(corkage==1)
				total = parseInt(total)+parseInt(corkage_price);
				
			change = money-total;
			
			$("#total").val(total);
			$("#change").val(change);
		});
		
		$(document).on("keyup","#no_of_person, #money",function(){
			var no_of_person = parseInt($("#no_of_person").val());
			var corkage = parseInt($("#corkage").val());
			var money = parseInt($("#money").val());
			var per_person_price = parseInt($("#per_person_price").val());
			var corkage_price = parseInt($("#corkage_price").val());
			var total = 0;
			var change = 0;
			
			if(no_of_person<0 || isNaN(no_of_person)){
				no_of_person = 0;
				$("#no_of_person").val(0);
			}
			total = no_of_person*per_person_price;
			
			if(money<0 || isNaN(money)){
				money = 0;
				$("#money").val(0);
			}
			
			if(corkage==1)
				total = parseInt(total)+parseInt(corkage_price);
				
			change = money-total;
			
			$("#total").val(total);
			$("#change").val(change);
		});
		<?php endif; ?>
		<!-------------------------MOVIE ROOM CHECK IN FORM----------------------------->
		
		<!-------------------------SNACKS BAR FORM----------------------------->
	var search_form = '';
	<?php if($this->session->userdata('role')==1 OR $this->session->userdata('role')==2): ?>
		var search_form = '\
			<div class="row">\
				<div class="col-lg-2">\
					<label>Order No. :</label>\
				</div>\
				<div class="col-lg-4">\
					<input type="number" class="form-control" name="search_order_no" id="search_order_no" onClick="this.select();">\
				</div>\
				<div class="col-lg-6">\
					<button type="button" id="search_snack_bar" class="btn btn-default">Search</button>\
				</div>\
			</div><br>\
		';
	<?php endif; ?>
	var cart_items = 1;
		$(document).on("click","#snacks-bar-window",function(){
			$("body").mLoading();
			
			$.get("<?php echo $this->config->base_url().'dashboard/get_products';?>",function(result){
				console.log(result);
				var snacks_bar_form = '\
				<form id="snacks_bar_form" method="post" action="<?php echo $this->config->base_url().'dashboard/snacks_bar_transaction';?>">'+search_form+'\
				<div id="order_no_search_form">\
				<div class="order_no_search_form row">\
					<div class="col-lg-12">\
						'+result.draw_products+'\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-2">\
						<label>Order No. :</label>\
					</div>\
					<div class="col-lg-4">\
						<input type="number" class="form-control" id="order_no" name="order_no" value="'+result.order_no+'" readonly/>\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-2">\
						<label>Type :</label>\
					</div>\
					<div class="col-lg-4">\
						<select class="form-control" id="snacks_type" name="snacks_type"><option value="room">Room</option><option value="take out">Take Out</option></select>\
					</div>\
				</div>\
				<div class="order_no_search_form row" id="rooms_selectbox">\
					<div class="col-lg-2">\
						<label>Room :</label>\
					</div>\
					<div class="col-lg-4">\
						'+result.rooms_selectbox+'\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-12">\
						<table class="table" id="add-to-cart-table">\
							<thead>\
							<tr>\
								<th>Product</th>\
								<th>Price</th>\
								<th>Quantity</th>\
								<th>Subtotal</th>\
								<th>Remove</th>\
							</tr>\
							</thead>\
						</table>\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="1">1</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="5">5</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="10">10</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="20">20</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="50">50</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="100">100</button>\
					</div>\
					<div class="col-lg-2">\
						<label>Total :</label>\
					</div>\
					<div class="col-lg-4">\
						<input class="form-control" name="total" id="snacks-total" value="0.00" readonly>\
					</div>\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="200">200</button>\
					</div>\
					<div class="col-lg-1">\
						<button type="button" class="money-button11 btn btn-default" amount="500">500</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button11 btn btn-default" amount="1000">1000</button>\
					</div>\
					<div class="col-lg-2">\
						<button type="button" class="money-button11 btn btn-warning" amount="0">Reset</button>\
					</div>\
					<div class="col-lg-2">\
						<label>Money :</label>\
					</div>\
					<div class="col-lg-4">\
						<input class="form-control" name="snacks_money" id="snacks_money" onClick="this.select();" value="0.00" readonly>\
					</div>\
				</div>\
				<div class="order_no_search_form row">\
					<div class="col-lg-6">\
						<div class="form-group">\
						</div>\
					</div>\
					<div class="col-lg-2">\
						<label>Change :</label>\
					</div>\
					<div class="col-lg-4">\
						<input class="form-control" name="change" id="snacks-change" value="0.00" readonly>\
					</div>\
				</div><br>\
				<div class="order_no_search_form row">\
					<div class="col-lg-6">\
						<div class="form-group">\
						</div>\
					</div>\
					<div class="col-lg-6">\
						<button type="button" class="co-button btn btn-success">Check-Out</button>\
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>\
					</div>\
				</div>\
				</div>\
				</form>\
				';
				
				setTimeout(function(){
					$("body").mLoading("hide");
					$("#dynamic-modal-title").html('Snack Bar');
					$("#dynamic-modal-body").html(snacks_bar_form);
					$("#dynamic-modal-footer").html('');
					$("#dynamic-modal").modal({show:true});
					
					$(document).on("click",".co-button",function(){
						if(!confirm('Please confirm the inputted data!')){
							return false;
						}
						
						var snacks_total = parseFloat($("#snacks-total").val());
						if(snacks_total<=0){
							alert("Total must not be zero.");
							return false;
						}
						
						var snacks_money = parseFloat($("#snacks_money").val());
						if(snacks_money<=0){
							alert("Money must not be zero.");
							return false;
						}
						var change = $("#snacks-change").val();
						if(change<0){
							alert("Money must be greater than or equal to Total.");
							return false;
						}
						
						$('#snacks_bar_form').submit();
					});
					
					$('#snacks_bar_form')
					.bootstrapValidator({
						message: 'This value is not valid',
						feedbackIcons: {
							valid: 'glyphicon glyphicon-ok',
							invalid: 'glyphicon glyphicon-remove',
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							snacks_money: {
								validators: {
									notEmpty: {
										message: 'Money is required'
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
							if(result.error == 0)
							{
								setTimeout(function(){
									$("body").mLoading("hide");
									$("#dynamic-modal-title").html('Success Message');
									$("#dynamic-modal-body").html('<div class="alert alert-success"><strong>Attention!</strong> '+result.message+'</div>');
									$("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
									$("#dynamic-modal").modal({show:true});
								}, 1000);
								setTimeout(function(){
									$("body").mLoading("hide");
									window.location.href = "<?php echo $this->config->base_url().'dashboard';?>";
								}, 4000);
							}
							else
							{
								setTimeout(function(){
									$("body").mLoading("hide");
									$("#dynamic-modal-title").html('Error Message');
									$("#dynamic-modal-body").html('<div class="alert alert-warning"><strong>Attention!</strong> '+result.message+'</div>');
									$("#dynamic-modal-footer").html('<button type="button" class="btn btn-danger" data-dismiss="modal">Ok</button>');
									$("#dynamic-modal").modal({show:true});
								}, 1000);
							}
						}, 'json');
						
						e.stopImmediatePropagation();
					});
				}, 1000);
				
				$(document).on("click",".money-button11",function(){
					var money = parseFloat($("#snacks_money").val());
					var amount = parseFloat($(this).attr("amount"));
					
					var total = money+amount;
					if(amount==0)
						total = 0;
					
					$("#snacks_money").val(total);
					
					var money = parseFloat($("#snacks_money").val());
					var total = parseFloat($("#snacks-total").val());
					
					
					if(isNaN(money)){
						$("#snacks_money").val('0.00');
						money = parseFloat($("#snacks_money").val());
					}
					
					var change = money-total;
						
					$("#snacks-change").val(change);
				});
				
				$(document).on("change","#snacks_type",function(){
					if(this.value!='room'){
						$("#rooms_selectbox").hide();
					}else{
						$("#rooms_selectbox").show();
					}
				});
				
			}, 'json');
		});
		
		$(document).on("click",".add-to-cart",function(){
			var product_id = $(this).attr("product_id");
			var product_name = $(this).attr("product_name");
			var product_price = parseFloat($(this).attr("product_price"));
			var subtotal = 1*product_price;
			
			$.get("<?php echo $this->config->base_url().'dashboard/check_product_quantity';?>/"+product_id,function(result){
			
			if(result.error==0){
			
			var cart_have = 0;
			var td_cart_items = 0;
			$('input[name^="cart_product_id"]').each(function(){
				if(parseInt(product_id)==parseInt($(this).val())){
					cart_have++;
					td_cart_items = $(this).attr("item");
				}
			});
			
			if(cart_have!=0){
				var xxcart_price = $("#cart_price"+td_cart_items).val();
				var xxquantity = $("#cart_quantity"+td_cart_items).val();
				xxquantity++;
				
				var xxsubtotal = xxquantity*xxcart_price;
				
				$("#cart_quantity"+td_cart_items).val(xxquantity);
				$("#cart-item-total-"+td_cart_items).val(xxsubtotal);
				
				var xxtotal = 0;
				$('input[name^="cart_subtotal"]').each(function(){
					xxtotal = xxtotal+parseFloat($(this).val());
				});
				
				$("#snacks-total").val(xxtotal);
				
				var xxmoney = parseFloat($("#snacks_money").val());
				var xxchange = xxmoney-xxtotal;
				
				$("#snacks-change").val(xxchange);
				
				return false;
			}
			
			var draw_tr = '\
			<tr class="cart-item-'+cart_items+'">\
				<td><input class="form-control" value="'+product_name+'" readonly/></td>\
				<td><input class="form-control" id="cart_price'+cart_items+'" name="cart_price[]" value="'+product_price+'" readonly/></td>\
				<td><input type="number" class="cart_quantity form-control" id="cart_quantity'+cart_items+'" name="cart_quantity[]" cart_items="'+cart_items+'" value="1"/></td>\
				<td><input class="form-control" id="cart-item-total-'+cart_items+'" name="cart_subtotal[]" value="'+subtotal+'" readonly/></td>\
				<td style="text-align:center;"><a href="javascript:void(0)" cart_item="'+cart_items+'" class="remove-item"><i class="fa fa-times fa-fw"></i></a>\
				<input type="hidden" class="cart_product_ids" name="cart_product_id[]" item="'+cart_items+'" value="'+product_id+'"/>\
				</td>\
			</tr>\
			';
			
			var total = parseFloat($("#snacks-total").val());
			total = total+subtotal;
			
			$("#snacks-total").val(total);
			
			var money = parseFloat($("#snacks_money").val());
			var change = money-total;
			
			$("#snacks-change").val(change);
			
			$("#add-to-cart-table").append(draw_tr);
			cart_items++;
			}else{
				alert(result.message);
				return false;
			}
			
			}, 'json');
		});
		
		$(document).on("change", ".cart_quantity", function(){
			var td_cart_items = $(this).attr("cart_items");
			var cart_price = $("#cart_price"+td_cart_items).val();
			var quantity = $(this).val();
			
			var subtotal = quantity*cart_price;
			
			$("#cart-item-total-"+td_cart_items).val(subtotal);
			
			var total = 0;
			$('input[name^="cart_subtotal"]').each(function(){
				total = total+parseFloat($(this).val());
			});
			
			$("#snacks-total").val(total);
			
			var money = parseFloat($("#snacks_money").val());
			var change = money-total;
			
			$("#snacks-change").val(change);
		});
		
		$(document).on("change","#snacks_money",function(){
			var money = parseFloat(this.value);
			var total = parseFloat($("#snacks-total").val());
			
			
			if(isNaN(money)){
				$("#snacks_money").val('0.00');
				money = parseFloat($("#snacks_money").val());
			}
			
			var change = money-total;
				
			$("#snacks-change").val(change);
		});
		
		$(document).on("keyup","#snacks_money",function(){
			var money = parseFloat(this.value);
			var total = parseFloat($("#snacks-total").val());
			
			
			if(isNaN(money)){
				$("#snacks_money").val('0.00');
				money = parseFloat($("#snacks_money").val());
			}
			
			var change = money-total;
				
			$("#snacks-change").val(change);
		});
		
		$(document).on("click",".remove-item",function(event){
			var cart_item = $(this).attr("cart_item");
			var money = parseFloat($("#snacks_money").val());
			var subtotal = parseFloat($("#cart-item-total-"+cart_item).val());
			var total = parseFloat($("#snacks-total").val());
			
			if(confirm('Are you sure you want to remove this item from the cart?')){
				total = total-subtotal;
				$(".cart-item-"+cart_item).remove();
				$("#snacks-total").val(total);
				
				total = parseFloat($("#snacks-total").val());
				var change = money-total;
				$("#snacks-change").val(change);
			}else
				return false;
				
			event.stopImmediatePropagation();
		});
		
		$(document).on("click","#search_snack_bar",function(){
			var search_order_no = $("#search_order_no").val();
			
			if(search_order_no!=''){
			$("body").mLoading();
			$.get("<?php echo $this->config->base_url().'dashboard/search_order_no';?>/"+search_order_no,function(result){
				console.log(result);
				if(result.error==0){
					setTimeout(function(){
						$("body").mLoading("hide");
						$(".order_no_search_form").html('');
						$("#order_no_search_form").html(result.search_order_form);
						$(document).on("click",".money-button111",function(){
							var money = parseFloat($("#snacks_money").val());
							var amount = parseFloat($(this).attr("amount"));
							
							var total = money+amount;
							if(amount==0)
								total = 0;
							
							$("#snacks_money").val(total);
							
							var money = parseFloat($("#snacks_money").val());
							var total = parseFloat($("#snacks-total").val());
							
							
							if(isNaN(money)){
								$("#snacks_money").val('0.00');
								money = parseFloat($("#snacks_money").val());
							}
							
							var change = money-total;
								
							$("#snacks-change").val(change);
						});
					}, 1000);
				}else{
					setTimeout(function(){
						$("#search_order_no").val('');
						$("body").mLoading("hide");
						alert(result.message);
						return false;
					}, 1000);
				}
			}, 'json');
			}else{
				alert('Order No field is required!');
				return false;
			}
		});
		<!-----------------------SNACKS BAR FORM ---------------------------------------------------------->
		
		<!------------------------TABLE RELOAD EVERY 5minutes--------------------------------------------->
		window.setInterval(function(){
			$.get("<?php echo $this->config->base_url().'dashboard/reload_table2'?>",function(result){
				$("#room-tracker-table-div").html(result.table_draw);
			}, 'json');
		}, 100000);
		<!------------------------TABLE RELOAD EVERY 5minutes--------------------------------------------->
	});
	</script>

</body>

</html>





