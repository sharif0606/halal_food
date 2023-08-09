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
				<option value="<?= $k ?>" <?= date('n')==$k?"selected":"" ?>><?= $v ?></option>
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
	<div class="col-xs-12 col-sm-3">
		<button type="button" class="btn btn-primary" onclick="get_details_report()">Get Report</button>
	</div>
</div>
<hr>
<div class="row" id="details_data">

</div>

<script type="text/javascript">
//print all report
	function printPageArea(areaID){
		var printContent = document.getElementById(areaID);
		var WinPrint = window.open('', '', 'width=900,height=650');
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:12px;border-collapse: collapse;} table, td, th {border: 1px solid black;} table>thead>tr{border:none;} h4,p{text-align:center;padding:0;margin:0}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>


<script>
function get_details_report(){
	var rMonth=$('#current_month').val();
	var rYear=$('#current_year').val();

	if(rMonth && rYear){
	$.ajax({
        url: baseUrl+'report/balance_sheet_report/grpr',
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
	}
	else{
		alert("Please select any date");
		$('#current_date').focus();
	}
        return false; // keeps the page from not refreshing     
}
</script>
