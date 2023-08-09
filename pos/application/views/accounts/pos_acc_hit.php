<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/daterangepicker.min.css" />
<!-- page specific plugin styles -->
<?php if($this->session->flashdata('message')):?>
	<?=$this->session->flashdata('message')?>
<?php endif?>
<form method="get" action="<?= base_url('accounts/cornjob/submit_all');?>" onsubmit="return confirm('Are you sure? if you transfer amount POS to account section you cannot change it. So please check again then submit.')">
    <div class="row">
    	<div class="col-xs-12 col-sm-3">
    		<div>
    			<label for="accDate">As of This Date</label>
    			<div class="input-group">
    				<input class="form-control date-picker" name="current_date" type="text" data-date-format="dd-mm-yyyy" required />
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
    		<button type="submit" class="btn btn-primary">POS to account</button>
    	</div>
    </div>
</form>
<div class="text-danger text-center"><h1>If you transfer amount POS to account section you cannot change it. So please check your POS section carefully then submit.</h1></div>
<script>
window.onload=function(){
	jQuery(function($) {
		
		//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
		$('.date-picker').daterangepicker({
		    'singleDatePicker': true,
			'applyClass' : 'btn-sm btn-success',
			'cancelClass' : 'btn-sm btn-default',
			locale: {
				applyLabel: 'Apply',
				cancelLabel: 'Cancel',
				format:'DD-MM-YYYY',
				separator: ' / ' 
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