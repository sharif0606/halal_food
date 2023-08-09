<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Dashboard</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" />
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/fontawesome.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/brands.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/solid.min.css" />
		<link rel="stylesheet" href="<?= base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />


		<!-- text fonts -->
		<link rel="stylesheet" href="<?= base_url('assets/css/fonts.googleapis.com.css') ?>" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?= base_url('assets/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />
        <!-- Data Table Css for Fixed Header-->
		<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css"/>
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?= base_url('assets/css/ace-part2.min.css') ?>" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="<?= base_url('assets/css/ace-skins.min.css') ?>" />
		<!--<link rel="stylesheet" href="<?= base_url('assets/css/ace-rtl.min.css') ?>" />-->
		<!-- DaterangePicker css -->
		<!--<link href="<?= base_url('assets/bootstrap-daterangepicker/css/daterangepicker.css') ?>" rel="stylesheet"/>-->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
		<!--/-->

		
		<script src="<?= base_url('assets/js/jquery-2.1.4.min.js') ?>"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<!-- Data Range Picker and Moemnt Js-->
		<!--<script src="<?= base_url('assets/bootstrap-daterangepicker/js/moment.min.js')?>"></script>
		<script src="<?= base_url('assets/bootstrap-daterangepicker/js/daterangepicker.min.js')?>"></script>-->
		<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		<!-- /-->
		
		<!-- Bootstrap Validator Js-->
		<script src="<?= base_url('assets/bootstrapValidator/js/bootstrapValidator.js')?>"></script>
		<!-- /-->
		<!--Select 2-->
		<link href="<?= base_url('assets/select/select2.min.css" rel="stylesheet')?>" />
        <script src="<?= base_url('assets/select/select2.min.js')?>"></script>
        <script>
            var baseUrl = "<?= base_url('accounts/') ?>";
        </script>
		<!--/-->
		<style>
			.vHide{
				display:none;
			}
			/*tfoot{
				display:none;
			}*/
			.table>thead>tr>th:first-child{
				padding:0px;
				border:none;
			}
			
		</style>
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default navbar-collapse h-navbar ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<div class="navbar-header pull-left">
					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons,.navbar-menu">
						<span class="sr-only">Toggle user menu</span>

						<img src="assets/images/avatars/user.jpg" alt="Jason's Photo" />
					</button>

					<button class="pull-right navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#sidebar">
						<span class="sr-only">Toggle sidebar</span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>

						<span class="icon-bar"></span>
					</button>
				</div>
				<nav role="navigation" class="navbar-menu">
					<ul class="nav navbar-nav">
						<li>
							<a href="#">
								<span></span>Welcome,<?= $this->session->userdata('role_name'); ?>
							</a>
						</li>
					</ul>
				</nav>
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue dropdown-modal user-min">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?= base_url('assets/images/avatars/user.jpg')?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?= $this->session->userdata('role_name'); ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!--<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>-->

								<li>
									<a href="<?= base_url(); ?>auth/Auth_login/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>
            <?php $this->load->view('accounts/include/top_menu') ?>
            <?php $this->load->view('accounts/include/settings') ?>