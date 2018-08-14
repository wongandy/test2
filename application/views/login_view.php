<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row->page_name; ?> | Login</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
	<link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/style.css" rel="stylesheet" />
	<link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/main-style.css" rel="stylesheet" />
	<!-- Validator -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/bootstrapValidator.css" rel="stylesheet">
	<!-- Spinner CSS -->
    <link href="<?php echo $this->config->base_url().'chemicals/';?>assets/css/jquery.mloading.css" rel="stylesheet" type="text/css">

</head>

<body class="body-Login-back">

    <div class="container">
       
        <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
				<h1><?php echo $row->page_name; ?></h1>
              <!---img src="assets/img/logo.png" alt=""/-->
			</div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">                  
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form id="login_form" method="post" action="<?php echo $this->config->base_url().'login/authenticate';?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password">
                                </div>
                                <!--div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div-->
								
								<button type="submit" class="btn btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<!-- Modal -->
	<div id="dynamic-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
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

     <!-- Core Scripts - Include with every page -->
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/jquery-1.10.2.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo $this->config->base_url().'chemicals/';?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>
	<!-- Validator -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/bootstrapValidator.js"></script>
	<!-- Spinner JS -->
	<script src="<?php echo $this->config->base_url().'chemicals/';?>assets/scripts/jquery.mloading.js"></script>

	<script>
	$(document).ready(function(){
		$('#login_form')
		.bootstrapValidator({
			message: 'This value is not valid',
			feedbackIcons: {
				valid: 'glyphicon glyphicon-ok',
				invalid: 'glyphicon glyphicon-remove',
				validating: 'glyphicon glyphicon-refresh'
			},
			fields: {
				username: {
					validators: {
						notEmpty: {
							message: 'Username is required'
						}
					}
				},
				password: {
					validators: {
						notEmpty: {
							message: 'Password is required'
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
				if(result.error == 0)
				{
					setTimeout(function(){
						$("body").mLoading("hide");
						if(result.role==1 || result.role==4)
							window.location.href = "<?php echo $this->config->base_url().'movies';?>";
						else
							window.location.href = "<?php echo $this->config->base_url().'dashboard/monitor';?>";
					}, 1000);
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
	});
	</script>
	
</body>

</html>
