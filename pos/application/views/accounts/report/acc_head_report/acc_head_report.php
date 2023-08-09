<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/daterangepicker.min.css" />
<!-- page specific plugin styles -->
<?php if($this->session->flashdata('message')):?>
	<?=$this->session->flashdata('message')?>
<?php endif?>
<div class="row">
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="form-field-select-3">Account Head</label>
			<br />
			<select class="form-control" id="accHead">
				<option value=""> Choose a Head... </option>
				<?php if($accHead){ 
					foreach($accHead as $mh){ ?>
				<option value="<?= $mh['table_id'] ?>,<?= $mh['table_name'] ?>"><?= $mh['ac'] ?></option>
				<?php } } ?>
				
			</select>
		</div>
	</div>
	
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Date</label>
			<div class="input-group">
				<input class="form-control date-picker" id="current_date" type="text" data-date-format="dd-mm-yyyy" required />
				<span class="input-group-addon">
					<i class="fa fa-calendar bigger-110"></i>
				</span>
			</div>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12 col-sm-3">
		<button type="button" class="btn btn-primary" onclick="get_details_report()">Get Report</button>
	</div>
</div>
<hr>
<div class="row" id="details_data">

</div>

<script>
function get_details_report(){
	var accHead=$('#accHead').val();
	var rDate=$('#current_date').val();

	if(accHead){
	$.ajax({
        url: baseUrl+'report/acc_head_report/get_acc_report',
        data:{
                'accHead':accHead,
				'rDate':rDate
            }, 
            dataType: 'json',
            success: function(data){
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
	}
	else{
		alert("Please select any Account head");
		$('#tbl_fcoa_master').focus();
	}
        return false; // keeps the page from not refreshing     
}
window.onload=function(){
	jQuery(function($) {
		
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('.date-picker').daterangepicker({
			'applyClass' : 'btn-sm btn-success',
			'cancelClass' : 'btn-sm btn-default',
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
				format:'DD-MM-YYYY',
				separator: ' / ' 
			},
			ranges: {
			   'Today': [moment(), moment()],
			   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			   'This Month': [moment().startOf('month'), moment().endOf('month')],
			   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		})
		.prev().on(ace.click_event, function(){
			$(this).next().focus();
		});
		
		setTimeout(function() {
			$('.alert').hide('slowly');
		}, 3000);
		
		
	});
}
</script>