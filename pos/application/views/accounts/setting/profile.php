<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/profile.css" />


<div>
	<div id="user-profile-2" class="user-profile">
		<div class="tabbable">
			<ul class="nav nav-tabs padding-18" id="myTab">
				<li class="active">
					<a data-toggle="tab" href="#home">
						<i class="green ace-icon fa fa-user bigger-120"></i>
						Profile
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#Designation">
						<i class="orange ace-icon fa fa-rss bigger-120"></i>
						Designation
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#Section">
						<i class="blue ace-icon fa fa-users bigger-120"></i>
						Section
					</a>
				</li>

				<li>
					<a data-toggle="tab" href="#SMS">
						<i class="pink ace-icon fa fa-envelope-o bigger-120"></i>
						SMS
					</a>
				</li>
			</ul>

			<div class="tab-content no-border padding-24">
				<div id="home" class="tab-pane in active">
					<div class="row">
						<div class="col-xs-12 col-sm-3 center">
							<span class="profile-picture">
								<img alt="Company Logo" id="avatar2" src="<?= base_url()?><?= $profileData['logo']?>" width="100%" />
							</span>

							<div class="space space-4"></div>
						<?php if($profileData['id']){ ?>
							<a href="#" data-toggle="modal" data-target="#myModalEdit" class="btn btn-sm btn-block btn-success" onclick="edit_profile('LOGO','file','image','')">
								<span class="bigger-110">Change Logo</span>
							</a>
						<?php } ?>
						</div><!-- /.col -->

						<div class="col-xs-12 col-sm-9">
							

							<div class="profile-user-info">
								<div class="profile-info-row">
									<div class="profile-info-name"> Company Name </div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" > <?= $profileData['comName']?$profileData['comName']:'Name'; ?> </span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Company Name','text','comName','<?= $profileData['comName'] ?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>	
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Registration No </div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" > <?= $profileData['regNo']?$profileData['regNo']:'Reg no'; ?> </span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Registration No','text','regNo','<?= $profileData['regNo'] ?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
									
								</div>

								<div class="profile-info-row">
									<div class="profile-info-name"> VAT/TIIN No </div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" > <?= $profileData['tiin']?$profileData['tiin']:'Tin'; ?> </span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('VAT/TIIN No','text','tiin','<?= $profileData['tiin']; ?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Location <i class="fa fa-map-marker light-orange bigger-110"></i></div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" >Address: <?= $profileData['address']?$profileData['address']:'Address'; ?> </span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Address','text','address','<?= $profileData['address']?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="hr hr-8 dotted"></div>

							<div class="profile-user-info">
								
								<div class="profile-info-row">
									<div class="profile-info-name">
										Cell No
									</div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" ><?= $profileData['cell']?$profileData['cell']:'01000000000'; ?></span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Cell No','text','cell','<?= $profileData['cell']?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">
										Telephone
									</div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" ><?= $profileData['telephone']?$profileData['telephone']:'01000000000'; ?></span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Telephone','text','telephone','<?= $profileData['telephone']?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name">
										Email
									</div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<span class="user" ><?= $profileData['email']?$profileData['email']:'example@domain.com'; ?></span>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Email','text','email','<?= $profileData['email']?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
								
								<div class="profile-info-row">
									<div class="profile-info-name"> Website </div>

									<div class="profile-info-value">
										<div class="profile-activity clearfix">
											<div>
												<a href="#" target="_blank"><?= $profileData['website']?$profileData['website']:'www.domain.com'; ?></a>
											</div>
											<div class="tools action-buttons">
												<a href="#" class="blue" data-toggle="modal" data-target="#myModalEdit" title="Edit" onclick="edit_profile('Website','text','website','<?= $profileData['website']?>')">
												<i class="ace-icon fa fa-pencil bigger-125"></i>
												</a>
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->

					<div class="space-20"></div>

				</div><!-- /#home -->

				<div id="Designation" class="tab-pane">
				
					<div class="profile-feed row">
						<div class="col-sm-12">
							<a href="javascript: void(0)" class="pull-right add-button-fa" title="Add New" data-toggle="modal" onmouseover="clear_input_box()" data-target="#myModal"> <i class="pull-left thumbicon fa fa-plus no-hover"></i> </a>
						</div>
						<?php if($designationList):
								foreach($designationList as $desL): ?>
						<div class="col-sm-4">
							<div class="profile-activity clearfix">
								<div>
									<a class="user" > <?= $desL['designation']; ?> </a>
								</div>

								<div class="tools action-buttons">
									<a href="#" class="blue" data-toggle="modal" data-target="#myModal" onclick="edit_des(<?= $desL['id'] ?>)" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-125"></i>
									</a>

									<a href="<?= base_url() ?>setting/profile_setting/data_delete/<?= $desL['id'] ?>/1" class="red" onclick="return confirm('Do you want to delete this record?');" title="Delete">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
									
								</div>
							</div>
						</div><!-- /.col -->
						<?php endforeach; endif; ?>
						
					</div><!-- /.row -->
					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<form method="post" action="<?= base_url() ?>setting/profile_setting/data_save" id="form">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title des-title"></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label for="f_name">Designation </label>
													<input type="hidden" name="tsn" id="tsn" value="1" />
													<input type="hidden" name="id" id="desId" value="0" />
													<input type="text" name="name" id="desName" class="form-control" required />
												</div>
											</div>
										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary save_btn" >Save</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- /#feed -->

				<div id="Section" class="tab-pane">
				
					<div class="profile-feed row">
						<div class="col-sm-12">
							<a href="javascript: void(0)" class="pull-right add-button-fa" title="Add New" data-toggle="modal" onmouseover="clear_input_box()" data-target="#myModalsec"> <i class="pull-left thumbicon fa fa-plus no-hover"></i> </a>
						</div>
						<?php if($sectionList):
								foreach($sectionList as $secL): ?>
						<div class="col-sm-4">
							<div class="profile-activity clearfix">
								<div>
									<a class="user" > <?= $secL['name']; ?> </a>
								</div>

								<div class="tools action-buttons">
									<a href="#" class="blue" data-toggle="modal" data-target="#myModalsec" onclick="edit_sec(<?= $secL['id'] ?>)" title="Edit">
										<i class="ace-icon fa fa-pencil bigger-125"></i>
									</a>

									<a href="<?= base_url() ?>setting/profile_setting/data_delete/<?= $secL['id'] ?>/2" class="red" onclick="return confirm('Do you want to delete this record?');" title="Delete">
										<i class="ace-icon fa fa-times bigger-125"></i>
									</a>
									
								</div>
							</div>
						</div><!-- /.col -->
						<?php endforeach; endif; ?>
						
					</div><!-- /.row -->
					<!-- Modal -->
					<div id="myModalsec" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<!-- Modal content-->
							<div class="modal-content">
								<form method="post" action="<?= base_url() ?>setting/profile_setting/data_save" id="form">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title sec-title"></h4>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<label for="f_name">Section </label>
													<input type="hidden" name="tsn" id="tsn" value="2" />
													<input type="hidden" name="id" id="secId" value="0" />
													<input type="text" name="name" id="secName" class="form-control" required />
												</div>
											</div>
										</div>

									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary save_btn" >Save</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div><!-- /#feed -->
				
				<div id="SMS" class="tab-pane">
					
					<?php if($smsData && $smsData[0]->loginStatus==1){?>
					<br><br><br>
						<div class="center">
							<a href="<?= base_url()?>setting/profile_setting/sms_logout" class="btn btn-danger">Disable SMS</a>
						</div>
					<?php }else{ ?>
					<div class="form">
						<div class="thumbnail"><i class="fa fa-envelope" aria-hidden="true"></i></div>
						<form class="login-form" method="post" action="<?= base_url()?>setting/profile_setting/sms_check">
							<input type="text" name="uName" placeholder="username"/>
							<input type="password" name="uPass" placeholder="password"/>
							<button type="submit"><b>login</b></button>
						</form>
					</div>
					<?php } ?>
				</div><!-- /#SMS -->
				
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div id="myModalEdit" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<?php echo form_open_multipart('setting/profile_setting/profile_save'); ?>
			<input type="hidden" name="id" value="<?= $profileData['id']!='' ?  $profileData['id'] : 0; ?>"/>
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title profile-title"></h4>
				</div>
				<div class="modal-body input-body">
					

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary save_btn" >Save</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>						


		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>assets/js/jquery.gritter.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootbox.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/select2.min.js"></script>

		<!-- inline scripts related to this page -->
<script type="text/javascript">

$('#myTab li:eq(<?= $this->uri->segment(4) ?>) a').tab('show');

function edit_profile(title,type,name,val){
	$('.profile-title').html(title);
		$('.input-body').html('<input type="'+type+'" name="'+name+'" class="form-control" value="'+val+'" />');
	
}
function edit_des(id){
	/* change add screen to update screen */
	$('.des-title').html('Designation Edit');
	$('.save_btn').html('Update');
	
	var dataArray=<?php echo json_encode($designationList) ?>;
	
	for(i=0; i < dataArray.length; i++)
	{
		if(dataArray[i].id==id){
			var id=dataArray[i].id;
			var name=dataArray[i].name;
		}
	}
		$('#desId').val(id);
		$('#desName').val(name);

		$('#desName').focus();
}
function edit_sec(id){
	/* change add screen to update screen */
	$('.sec-title').html('Section Edit');
	$('.save_btn').html('Update');
	
	var dataArray=<?php echo json_encode($sectionList) ?>;
	
	for(i=0; i < dataArray.length; i++)
	{
		if(dataArray[i].id==id){
			var id=dataArray[i].id;
			var name=dataArray[i].name;
		}
	}
		$('#secId').val(id);
		$('#secName').val(name);

		$('#secName').focus();
}

function clear_input_box(){
	$('.des-title').html('Designation Add');
	$('.sec-title').html('Section Add');
	$('.save_btn').html('Save');
	$('[name=id]').val();
	$('[name=name]').val();
	//document.getElementById("form").reset();
}
</script>
