<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/daterangepicker.min.css" />
<!-- page specific plugin styles -->
<?php if($this->session->flashdata('message')):?>
	<?=$this->session->flashdata('message')?>
<?php endif?>
    
<?php
$months = array('01'=>'January', 
                '02'=>'February',
                '03'=>'March', 
                '04'=>'April',
                '05'=>'May',
                '06'=>'June',
                '07'=>'July ',
                '08'=>'August',
                '09'=>'September',
                '10'=>'October',
                '11'=>'November',
                '12'=>'December');
 ?>
<div class="row">
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Day</label>
			<select id="day" class="form-control">
				<?php for($i=1;$i<=31;$i++){ ?>
				<option value="<?= $i ?>"><?= $i ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Month</label>
			<select id="month" class="form-control">
				<?php foreach($months as $k=>$v){ ?>
				<option value="<?= $k ?>" <?= date('n')==$k?"selected":"" ?>><?= $v ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Year</label>
			<select id="year" class="form-control">
				<?php for($y=2018;$y<= date('Y');$y++){ ?>
				<option value="<?= $y ?>" <?= date('Y')==$y?"selected":"" ?>><?= $y ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-xs-12 col-sm-3">
		<button type="button" class="btn btn-primary" onclick="run_corn()">Get Report</button>
	</div>
</div>

<script>
function run_corn(){
    
	var date=$('#year').val()+'-'+$('#month').val()+'-'+$('#day').val();
    window.location.href="<?= base_url() ?>cornjob/index/"+date;
	
}
</script>