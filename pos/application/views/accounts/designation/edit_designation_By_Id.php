<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li style="font-size:15px;font-weight:bold;">
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a>
		</li>
		<li class="active" style="font-size:13px;font-weight:bold;">Update Designation</li>
	</ul><!-- /.breadcrumb -->
</div>
<div class="row">
	<div class="col-xs-12">
		<!-- PAGE CONTENT BEGINS -->
		<div class="panel-body">
			<div class="row">
					<?php echo form_open_multipart('designation/Designation/update'); ?>

					<input type="hidden" value="<?= $designation_By_id['id']; ?>" name="id" class="form-control">
						  
					<div class="col-sm-4 col-xs-6">                                        
						<div class="form-group">
							<label>Designation</label>
							<input class="form-control" id="designation" name="designation" value="<?= $designation_By_id['designation']; ?>" type="text" placeholder="Designation" style="text-transform: capitalize;">
						</div>
					</div>
					<div class="col-sm-12 col-xs-12">        
						<div class="form-group">
							<div>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</div>
						<?php echo form_close(); ?>
				</div>                            
			</div><!-- /.panel-body -->
			<!-- PAGE CONTENT ENDS -->
	</div><!-- /.col -->
</div><!-- /.row -->
<script>
    $('#field_Officer').bootstrapValidator({
        message: 'This Value is not Valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            interest: {
                validators: {
                    notEmpty: {
                        message: 'The Interest field is required'
                    },
					regexp: {
                    regexp: /^[0-9]+$/,
                    message: 'The Name Field only consist of Alphabetic Letter [0-9]'
                  }
                }
            },            
			amount: {
                validators: {
                    notEmpty: {
                        message: 'The Amount field is required'
                    }
                }
            },
            
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email field is required'
                    },
                    emailAddress: {
                        message: 'This is not a valid email address'
                    }
                }
            },
            mobile_number: {
                validators: {
                    notEmpty: {
                        message: 'The Mobile Number field is required'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The Mobile Number Field only consist of Numeric [0-9]'
                    }
                }
            },
            photo: {
                validators: {
//                    notEmpty: {
//                        message: 'Please select an image'
//                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 500000,   // 2048 * 1024
                        message: 'The selected file size and Type is not valid'
                    }
                    
                }
            },
            participant_address: {
                validators: {
                    notEmpty: {
                        message: 'Please input Participant Address'
                    },
                }
            }, 
            package: {
                validators: {
                    notEmpty: {
                        message: 'Please select your Desired Package'
                    },
                }
            },
            job_status: {
                validators: {
                    notEmpty: {
                        message: 'Please specify Your Job Status With Organization Name'
                    },
                }
            },
            current_designation: {
                validators: {
                    notEmpty: {
                        message: 'Please specify Your Current Designation'
                    },
                }
            },
            payment_mode: {
                validators: {
                    notEmpty: {
                        message: 'Please Select your Payment Mode'
                    },
                }
            },
            field_Officer: {
                validators: {
                    notEmpty: {
                        message: 'Please Select your Semester'
                    },
                }
            },
            student_id: {
                validators: {
                    notEmpty: {
                        message: 'Please Input Your Student ID'
                    },
                }
            },
            deposit_file: {
                validators: {
                    notEmpty: {
                        message: 'Please select an image'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 600000,   // 2048 * 1024
                        message: 'The selected file size and Type is not valid'
                    }
                    
                }
            },
            bkas_id: {
                validators: {
                    notEmpty: {
                        message: 'Please input your Bkash Id'
                    },
                }
            },
        }
    }).on('err.field.fv', function(e, data) {
            // $(e.target)  --> The field element
            // data.fv      --> The FormValidation instance
            // data.field   --> The field name
            // data.element --> The field element

            data.fv.disableSubmitButtons(false);
        })
        .on('success.field.fv', function(e, data) {
            // e, data parameters are the same as in err.field.fv event handler
            // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
            // - The submit button is clicked
            // - The form is invalid
            data.fv.disableSubmitButtons(false);
        });
$('input[name="joining_Date"]').daterangepicker({
			  singleDatePicker: true,
			  startDate: new Date(),
			  showDropdowns: true,
			  //timePicker: true,
			  //timePicker24Hour: true,
			  //timePickerIncrement: 10,
			  autoUpdateInput: true,
			  locale: {
				//format: 'YYYY/MM/DD HH:mm'
				format: 'YYYY/MM/DD'
			  },
	});
</script>


