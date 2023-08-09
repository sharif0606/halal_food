<style>
	.text-danger{
		font-size:12px;
		font-weight:bold;
	}
	.help-block{
		font-size:12px;
		font-weight:bold;
		color:red;
	}
</style>
<div class="breadcrumbs ace-save-state" id="breadcrumbs">
	<ul class="breadcrumb">
		<li style="font-size:15px;font-weight:bold;">
			<i class="ace-icon fa fa-home home-icon"></i>
			<a href="#">Home</a>
		</li>
		<li class="active" style="font-size:13px;font-weight:bold;">Add Designation</li>
	</ul><!-- /.breadcrumb -->
</div>
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					
                    <div class="panel-body">
                        <div class="row">
								<?php echo form_open_multipart('designation/Designation/add','id=designation'); ?>						  								  							  
								<div class="col-sm-4 col-xs-6">                                        
									<div class="form-group">
                                        <label>Designation</label>
                                        <input class="form-control" id="designation" name="designation" type="text" placeholder="Designation" style="text-transform: capitalize;">
                                    </div>
								</div>
                                <div class="col-sm-12 col-xs-12">        
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Save</button>
									</div>
								</div>
                                   	<?php echo form_close(); ?>
                            </div>                            
                        </div><!-- /.panel-body -->
						<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->

<script>
    $('#designation').bootstrapValidator({
        message: 'This Value is not Valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            designation: {
                validators: {
                    notEmpty: {
                        message: 'The Designation field is required'
                    },
					//regexp: {
                   // regexp: /^[a-z,A-Z]+$/,
                   // message: 'The Designation Field only consist of Alphabetic Letter [A-z,a-z]'
                  }
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
</script>

