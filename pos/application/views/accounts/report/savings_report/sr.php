<!-- page specific plugin styles -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/chosen.min.css" />
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/daterangepicker.min.css" />
<!-- page specific plugin styles -->
<?php if($this->session->flashdata('message')):?>
	<?=$this->session->flashdata('message')?>
<?php endif?>
<?php
$months = array(1=>'January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December');
 ?>
<div class="row">
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Month</label>
			<select id="current_month" class="form-control">
				<?php foreach($months as $k=>$v){ ?>
				<option value="<?= str_pad($k,2,"0",STR_PAD_LEFT) ?>" <?= date('n')==$k?"selected":"" ?>><?= $v ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-3">
		<div>
			<label for="accDate">Year</label>
			<select id="current_year" class="form-control">
				<?php for($y=2018;$y<= date('Y');$y++){ ?>
				<option value="<?= $y ?>" <?= date('Y')==$y?"selected":"" ?>><?= $y ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="col-lg-12 col-sm-6">

		<button type="button" class="btn btn-primary" onclick="get_details_report()">Get Report (Monthly RS & LTS)</button>
		
		<button type="button" class="btn btn-warning" onclick="get_details_report_day()">Get Report Daily (LTS)</button>
		
		<button type="button" class="btn btn-success" onclick="get_details_report_day_wise()">Get Report Date Wise(LTS)</button>
		
		<button type="button" class="btn btn-info" onclick="get_details_report_rs_day()">Get Report Daily(RS)</button>
		<button type="button" class="btn btn-danger" onclick="get_details_report_rs_day_wise()">Get Report Date Wise(RS)</button>


	</div>
</div>
<hr>
<div class="row" id="details_data">

</div>

<script>
function get_details_report(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	$.ajax({
        url: baseUrl+'report/Savings_report/gsrm',
        data:{
				'rMonth':rMonth,
				'rYear':rYear,
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
		
    return false; // keeps the page from not refreshing     
}

function get_details_report_day(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	$.ajax({
        url: baseUrl+'report/savings_report/glsrd',
        data:{
				'rMonth':rMonth,
				'rYear':rYear,
            }, 
            dataType: 'json',
            success: function(data){
				console.log(data);
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
		
    return false; // keeps the page from not refreshing     
}


function get_details_report_day_wise(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	$.ajax({
        url: baseUrl+'report/savings_report/gsrbd',
        data:{
				'rMonth':rMonth,
				'rYear':rYear,
            }, 
            dataType: 'json',
            success: function(data){
				console.log(data);
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
		
    return false; // keeps the page from not refreshing     
}

function get_details_report_rs_day(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	$.ajax({
        url: baseUrl+'report/savings_report/grsrd',
        data:{
				'rMonth':rMonth,
				'rYear':rYear,
            }, 
            dataType: 'json',
            success: function(data){
				console.log(data);
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
		
    return false; // keeps the page from not refreshing     
}

function get_details_report_rs_day_wise(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	$.ajax({
        url: baseUrl+'report/savings_report/grsbdw',
        data:{
				'rMonth':rMonth,
				'rYear':rYear,
            }, 
            dataType: 'json',
            success: function(data){
				console.log(data);
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
		
    return false; // keeps the page from not refreshing     
}


function get_rs_total(){


	$.ajax({
        url: baseUrl+'report/savings_report/grstotal',
        
            dataType: 'json',
            success: function(data){
				console.log(data);
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                    $('#details_data').html(mainContent);
				
            },error:function(e){
				console.log(e);
			}
        });
		
    return false; // keeps the page from not refreshing     
}

</script>