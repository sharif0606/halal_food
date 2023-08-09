<?php echo form_open_multipart('setting/user_setting/user_save'); ?>
	<div class="modal-content">
		<div id="modal-wizard-container">
			<div class="modal-header">
				<ul class="steps">
					<li data-step="1" class="active">
						<span class="step">1</span>
						<span class="title">Basic</span>
					</li>

					<li data-step="2">
						<span class="step">2</span>
						<span class="title">Authorization</span>
					</li>

					<li data-step="3">
						<span class="step">3</span>
						<span class="title">Authorised Area</span>
					</li>
					
					<li data-step="4">
						<span class="step">4</span>
						<span class="title">Finish</span>
					</li>
				</ul>
			</div>

			<div class="modal-body step-content">
				<div class="step-pane active" data-step="1">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="f_name">Name </label>
								<input type="hidden" name="id" value="0" />
								<input type="text" name="name" id="name" class="form-control" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="shortName">Name In Bangla </label>
								<input type="text" name="shortName" id="shortName" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="email">Email</label>
								<input type="text" name="email" id="email" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="contact"> Phone </label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-phone"></i>
									</span>
									<input type="text" name="contact" id="contact" placeholder="8801_________" class="form-control input-mask-phone" />
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="designation">Designation </label>
								<select name="designation" id="designation" class="form-control" >
								<option value="">---- Select ----</option>
								<?= $designationList ?>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="section">Section  </label>
								<select name="section" id="section" class="form-control" >
								<option value="">---- Select ----</option>
								<?= $sectionList ?>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-10 col-sm-10 col-xs-10">
								<label for="image">photo  </label>
								<input type="file" name="image" id="id-input-file-2" class="form-control" />
							</div>
							<div class="col-md-2 col-sm-2 col-xs-2" id="image">
							
							
							</div>
						</div>
					</div>
				</div>
				<!-- step one finished -->
				<div class="step-pane" data-step="2">
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="u_name">User Name </label>
								<input type="text" name="u_name" id="u_name" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="password">Password</label>
								<input type="password" name="password" id="password" class="form-control" />
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label for="c_password">Conform Password</label>
								<input type="password" name="cPassword" id="cPassword" class="form-control" />
							</div>
						</div>
					</div>
				</div>
				<!-- step two finished -->
				<div class="step-pane" data-step="3">
					<div class="widget-main padding-8">
						<ul class="tree tree-unselectable" role="tree">
							<li class="tree-item hide" data-template="treeitem" role="treeitem">
								<span class="tree-item-name">
									<i class="icon-item ace-icon fa fa-times"></i>
									<span class="tree-label"></span>
								</span>
							</li>
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Samity</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="Samity" />
											<span class="tree-label">Samity</span>
										</span>
									</li>
								</ul>
							</li>
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Field Officer</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="Field_Officer" />
											<span class="tree-label">Field Officer</span>
										</span>
									</li>
								</ul>
							</li>
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Member</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="add_Member"/>
											<span class="tree-label">Member Register</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="member_Lists"/>
											<span class="tree-label">Member Lists</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="edit_member_By_Id"/>
											<span class="tree-label">Edit Member</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="delete_member_By_Id"/>
											<span class="tree-label">Delete Member</span>
										</span>
									</li>
								</ul>
							</li>
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Visa</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="visaProcess" />
											<span class="tree-label">Process</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="visaOverview" />
											<span class="tree-label">Overview</span>
										</span>
									</li>
								</ul>
							</li>
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Training</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="trainingProcess" />
											<span class="tree-label">Process</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="trainingOverview" />
											<span class="tree-label">Overview</span>
										</span>
									</li>
								</ul>
							</li>
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Finger Print</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="fingerPrintProcess" />
											<span class="tree-label">Process</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="fingerPrintOverview" />
											<span class="tree-label">Overview</span>
										</span>
									</li>
								</ul>
							</li>
							
							
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Flight</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="flightProcess" />
											<span class="tree-label">Process</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="flightOverview" />
											<span class="tree-label">Overview</span>
										</span>
									</li>
								</ul>
							</li>
							
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Report</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="headReport" />
											<span class="tree-label">Headwise Report</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="officeReport" />
											<span class="tree-label">Office Report</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="agentReport" />
											<span class="tree-label">Agent Report</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="passReport" />
											<span class="tree-label">Passenger Report</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="trialBalance" />
											<span class="tree-label">Trial Balance</span>
										</span>
									</li>
								</ul>
							</li>
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Setting</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="setting" />
											<span class="tree-label">Setting</span>
										</span>
									</li>
									 <li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="user_management"/>
											<span class="tree-label">User Management</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="agentSet"/>
											<span class="tree-label">Agent Setting</span>
										</span>
									</li>
								</ul>
							</li>
							
							<li class="tree-branch tree-open" role="treeitem" aria-expanded="true">
								<div class="tree-branch-header">
									<span class="tree-branch-name">
										<i class="icon-folder ace-icon tree-plus"></i>
										<span class="tree-label">Account</span>
									</span>
								</div>
								<ul class="tree-branch-children hidden" role="group">
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="mHead" />
											<span class="tree-label">Master Head</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="s1Head" />
											<span class="tree-label">Sub1 Head</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="s2Head" />
											<span class="tree-label">Sub2 Head</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="s3Head" />
											<span class="tree-label">Sub3 Head</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="nvHead" />
											<span class="tree-label">Navigation Head View</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="procCharge" />
											<span class="tree-label">Processing Charge</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="imHead" />
											<span class="tree-label">Import Head</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="vEntry" />
											<span class="tree-label">Voucher Entry</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="vList" />
											<span class="tree-label">Voucher List</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="vDelete" />
											<span class="tree-label">Voucher Delete</span>
										</span>
									</li>
									<li class="tree-item" role="treeitem">
										<span class="tree-item-name">
											<input name="accessArea[]" class="ace" type="checkbox" value="accApprove" />
											<span class="tree-label">Voucher Approve</span>
										</span>
									</li>
								</ul>
							</li>
							
							<li class="tree-item" role="treeitem">
								<span class="tree-item-name">
									<input name="accessArea[]" class="ace" type="checkbox" value="sms" />
									<span class="tree-label">SMS</span>
								</span>
							</li>
						</ul>
						
					</div>
				</div>
				<!-- step three finished -->
				<div class="step-pane" data-step="4">
					<div class="center">
						<br>
						<br>
						<br>
						<button type="submit" class="btn btn-primary" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Finish &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer wizard-actions">
			<button type="button" class="btn btn-sm btn-prev">
				<i class="ace-icon fa fa-arrow-left"></i>
				Prev
			</button>

			<button type="button" class="btn btn-success btn-sm btn-next" data-last="Finish">
				Next
				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>

			<button type="button" class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
				<i class="ace-icon fa fa-times"></i>
				Cancel
			</button>
		</div>
	</div>
</form>

<script src="<?= base_url();?>assets/js/wizard.min.js"></script>
<script src="<?= base_url();?>assets/js/bootbox.js"></script>
<script type="text/javascript">
			jQuery(function($) {
				var $validation = false;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 && $validation) {
						if(!$('#validation-form').valid()) e.preventDefault();
					}
				})
				//.on('changed.fu.wizard', function() {
				//})
				.on('finished.fu.wizard', function(e) {
					bootbox.dialog({
						message: "Thank you! Your information was successfully saved!", 
						buttons: {
							"success" : {
								"label" : "OK",
								"className" : "btn-sm btn-primary"
							}
						}
					});
				}).on('stepclick.fu.wizard', function(e){
					e.preventDefault();//this will prevent clicking and selecting steps
				});
			
			
				//jump to a step
				/**
				var wizard = $('#fuelux-wizard-container').data('fu.wizard')
				wizard.currentStep = 3;
				wizard.setState();
				*/
			
				//determine selected step
				//wizard.selectedItem().step
			
				
				$('#modal-wizard-container').ace_wizard();
				$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');
				
				$('#id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:true,
					onchange:null,
					thumbnail:true, //| true | large
					whitelist:'gif|png|jpg|jpeg',
					blacklist:'exe|php'
					//onchange:''
					//
				});
			})
	
				
	$('.tree-branch-header').click(function(){
		
		if($(this).find('i').hasClass('tree-minus'))
		{
			$(this).find('i').removeClass('tree-minus');
			$(this).find('i').addClass('tree-plus');
			$(this).next('ul').addClass('hidden');
		}
		else if($(this).find('i').hasClass('tree-plus')){
			
			$(this).find('i').removeClass('tree-plus');
			$(this).find('i').addClass('tree-minus');
			$(this).next('ul').removeClass('hidden');
		}
	});

	$('.input-mask-phone').mask('8801999999999');
	/* remove white spance */
	$(function() {
	  var txt = $("#u_name");
	  var func = function() {
		txt.val(txt.val().replace(/\s/g, ''));
	  }
	  txt.keyup(func).blur(func);
	});
	
	
	
	function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" height="50" width="50" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('image').innerHTML=span.innerHTML;
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  document.getElementById('id-input-file-2').addEventListener('change', handleFileSelect, false);
</script>