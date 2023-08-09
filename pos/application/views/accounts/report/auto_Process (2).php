<style>

	h4{font-size:14px;}
	td{font-size:11px;}
	th{font-size: 11px;}
	input[type="text"] {
		font-size: 11px;
		height:16px;
		background: rgba(0, 0, 0, 0) !important;
		border: none;
		outline: none;
		color:#393939;
	}
	input[type="checkbox"]{
		width:10px;
		height:10px;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
		padding:2px;
	}
	
</style>
<?php if($this->session->flashdata('message')): ?>
	<?php echo $this->session->flashdata('message'); ?>
<?php endif;?> 

	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>



<div id="display">

<?= form_open('auto_Process/Auto_Process/save_auto_Process'); ?>
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">Collection Sheet</p>
					<div class="table-responsive">
			<table id="" class="table table-striped table-bordered" width="100%">
				<tr>
					<td>Branch Name & Code</td>
					<td>Boalkhali</td>
					<td>Smity Name & Code</td>
					<td>
						<?= $samity_list_By_id['samity_Code'].'-'.$samity_list_By_id['samity_Name'];?>
					</td>
					<td>Samity Day</td>
					<td class="date">
						<?php $s_date=array(1=>'Monday','Tuesday','Wednesday','Thursday',' ','Saturday','Sunday'); ?>
						<?= $s_date[$samity_list_By_id['samity_Day']] ?>
					</td>
					<td>Samity Opening Day</td>
					<td><?= $samity_list_By_id['opening_Date'];?></td>
				<tr>
				<tr>
					<td>Print Date</td>
					<td><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
					<td>Product Category</td>
					<td>All</td>
					<td>Product Name</td>
					<td>All</td>
					<td>Collection Date</td>
					<td><input class="form-control" id="disbursement_Date" name="payment_Date"  type="text" value="<?= date('Y-m-d', strtotime( $_GET['updated_on'])); ?>"></td>
					
				</tr>
				<tr>
				   <td colspan="8" class="text-center"><b>Payment Date:</b></b><b><?= $_GET['payment_Date']; ?></h4></b>
				</tt>
			</table>

<input type="hidden" value="<?= $_GET['samity_Name']; ?>" name="samity_Name" id="samity_Name">
				<input type="hidden" value="<?= $s_date[$samity_list_By_id['samity_Day']] ?>" id="samity_Day">
	</div>			
<div class="data">


			<input type="hidden" id="baseurl" name="" value="<?= base_url()?>" />
			<div class="table-responsive">
				
				<input type="hidden" value="<?= $_GET['date']; ?>" name="">
					<table class="table table-striped table-bordered" width="100%">
						<thead>
							<tr>
								<th colspan="5">Member Information</th>
								<th colspan="10">Loan Information</th>
								<th colspan="8">Savings Information</th>
							</tr>
							<tr>
								<!--<th>#</th>
								<th>Id</th>
								<th>M.Name</th>
								<th>Gurdian</th>
								<th>Present</th>
								<th>Savings Id</th>
								<th>Savings Amt.</th>
								<th>Full</th>
								<th>Partial</th>
								<th>Zero</th>
								<th>Amount</th>-->
								<th>#</th>
								<th>Id</th>
								<th>M.Name</th>
								<th>Gurdian</th>
								<th>Present</th>
								<th>Loan #</th>
								<th>Inst</th>
								<th>Inst.Amt.</th>
								<th>Due</th>
								<th>OP.</th>
								<th>Adv</th>
								<th>Full</th>
								<th>Partial</th>
								<th>Zero</th>
								<th>Amt.</th>
								<th>DNo.</th>
								<th>Op.</th>
								<th>Savings #</th>
								<th>Amt.</th>
								<th>Full</th>
								<th>Partial</th>
								<th>Zero</th>
								<th>Amt.</th>
							</tr>
						</thead>
						<tbody id="data"> <!-- data here --> </tbody>
						<tfoot>
							<tr>
								<td colspan="4">Total Present</td>
								<td><input type="text" id="total_Present" size="2" readonly="readonly"></td>
								<td colspan="2">Total Inst. Amt.</td>
								<td><input type="text" id="total_Installment_Amt" size="6" readonly="readonly"></td>
								<td colspan="6">Total repay Amt.</td>
								<td><input type="text" id="total_Amt" size="6" readonly="readonly"></td>
								<td colspan="3">Total</td>
								<td><input type="text" size="6" readonly="readonly" id="total_deposit"></td>
								<td colspan="3">Total Paid Amt.</td>
								<td><input type="text"size="6" readonly="readonly" id="total_pay_deposit"></td>
							</tr>
							<tr>
								<td colspan="4">Manager Singnature</td>
								<td colspan="11"></td>
								<td colspan="2">Date</td>
								<td colspan="6"></td>
							</tr>
						</tfoot>
					</table>
					<!--<button type="submit" class="btn btn-success">Save</button>-->
				
			</div>

			<?= form_close(); ?>
		</div>



<script>
$('document').ready(function(){


	function view_loan_Lists(){
	    // $('#proType').val();
		var baseUrl = document.getElementById('baseurl').value;
		var samity_Name = $('#samity_Name').val();
		 console.log(samity_Name);
		var date ='<?php echo $_GET['date'];?>';
		var proType ='<?php echo $_GET['proType'];?>';

		$.ajax({
		 url:baseUrl+'report/Auto_Process_Report/search',
		 method: 'get',
		 data: {samity_Name:samity_Name,
		 date:date,proType:proType},
		 dataType: 'json',
		 success: function(response){
			 console.log(response);
			if(response.length>0){
				var data				= '';
				var member_Id 			= '';
				var member_Name 		= '';
				var father_Name 		= '';
				var installment_Amount 	= '';
				var saving_Code 		= '';
				var loan_No 			= '';
				var loan_ID 			= '';
				var mandotory_Amount 	= '';
				var v_product_Code 		= '';
				var v_Amt				= '';
				var dps_No				= '';
				var dps_id		 		= '';
				var savings_Amount		= '';
				var total_ins_Amt 		= 0;
				var amount 				= 0;
				var sl					= 1;
				var instNo              ='';
				var instAmt             ='';
				var tpAmt               ='';
				var dNo                 ='';
				var dtAmt               ='';
				var rSav                ='';
				var rp_Amt              ='';
				var rp_status           ='';
				var sP_Amt              ='';
				var sp_status           ='';
				var rp_status           ='';
				var lp_Amt              ='';
				var lp_Status           ='';
				
				
				
				
				for (var i = 0; i < response.length; i++) {
				    
					var member_Id 			= response[i].member_Id;
					var installment_Amount 	= response[i].installment_Amount;
					var member_Name 		= response[i].member_Name;
					var father_Name 		= response[i].father_Name;
					var loan_No 			= response[i].loan_No;
					var loan_ID 			= response[i].loan_ID;
					var saving_Code 		= response[i].saving_Code;
					var mandotory_Amount 	= response[i].amount;
					var v_product_Code 		= response[i].v_product_Code;
					var v_Amt 				= response[i].v_Amt;
					var dps_No 				= response[i].dps_No;
					var dps_id 				= response[i].dps_id;
					var savings_Amount 		= response[i].savings_Amount;
					var instNo 		        = response[i].instNo;
					var instAmt 		    = parseInt(response[i].instAmt);
					var tpAmt 		        = parseInt(response[i].tpAmt);
					var dNo 		        = response[i].dNo;
					var dtAmt 		        = response[i].dtAmt;
					var rSav 		        = response[i].rSav;
					var rp_Amt              = response[i].rp_Amt;
    				var rp_status           = response[i].rp_status;
    				var sP_Amt              = response[i].sP_Amt;
    				var sp_status           = response[i].sp_status;
    				var rp_status           = response[i].rp_status;
    				var lp_Amt              = response[i].lp_Amt;
    				var lp_Status           = response[i].lp_Status;

					//total_ins_Amt +=  parseInt(installment_Amount);
					amount += parseInt(installment_Amount);
					var getamt=installment_Amount;	

					$('#total_Present').val(0);
					if(installment_Amount == null){
						total_ins_Amt = 0;	
						amount= 0;
					}else{
						total_ins_Amt;
						amount;
					}
				$('#total_Installment_Amt').val(total_ins_Amt);
				//$('#total_Amt').val(amount);
					if(installment_Amount == null){
						loan_No = '-';
						installment_Amount = '-';
					}else{
						loan_No = loan_No;
						installment_Amount = installment_Amount;
					}
					if(savings_Amount == null){
						dps_No = '-';
						savings_Amount = '-';
					}else{
						dps_No = dps_No;
						savings_Amount = savings_Amount;
					}
    					if(dps_No=='' || dps_No=='-'){
						    var r=1;
					    }else{
						    var dps_array = dps_No.split(',');
						    var r=1;
						    for(var d = 0; d < dps_array.length; d++){
							r+=d;
						    }
					    }
					
    					if(saving_Code){
    						//alert('nosaving');
    						r=parseInt(r)+1;
    					}else{
    						
    					}
    
    					if(v_product_Code){
    						//alert('noproduct');
    						r=parseInt(r)+1;
    					}else{
    						
    					}


						//$('#results_'+increment).append('<div class="item" align="left" onClick="account_code_fill(\''+display_value+'\','+increment+',\''+table_name+'\','+table_id+');"><b>'+display_value+'</b></div>');	

					data += '<tr>';
					data += '<td rowspan="'+ r +'">'+sl+'</td><td rowspan="'+ r +'"><input type="text" name="member_Id[]" value="'+member_Id+'" readonly="readonly" size="11"></td><td rowspan="'+ r +'"><input type="text" value="'+member_Name+'" readonly="readonly" name=""  size="14"></td><td rowspan="'+ r +'"><input type="text" value="'+father_Name+'" readonly="readonly" name="" size="14"></td><td rowspan="'+ r +'"><input type="checkbox" name="is_Present['+member_Id+']" id="is_Present" onClick="countpresent()"></td>';
					
					if(installment_Amount.indexOf(',')<0){	
						if(installment_Amount == '-'){
							data+='<td colspan="10" rowspan="'+ r +'"></td>';
						}else{
	//console.log("single");							
						data +='<td rowspan="'+ r +'"><input type="hidden" name="loan_ID[]" value="'+loan_ID+'"><input type="text" value="'+loan_No+'" name="loan_No[]" size="16"></td><td rowspan="'+ r +'">'+instNo+'</td><td rowspan="'+ r +'"><input type="text" id="installment_Amount1_'+i+'" value="'+installment_Amount+'" readonly size="9" class="loan_amt" name="inst_Amt[]"></td><td rowspan="'+ r +'">'+ (instAmt > tpAmt ?  instAmt - tpAmt: "-") +'</td><td rowspan="'+ r +'">'+tpAmt+'</td><td rowspan="'+ r +'">'+(tpAmt > instAmt ?  tpAmt - instAmt: "-") +'</td><td rowspan="'+ r +'"><input type="checkbox" id="chkfull1_'+i+'" '+ ( lp_Status == 1?  'checked="true"' : "-") +' onClick="return false;" name="full[]"></td><td rowspan="'+ r +'"><input type="checkbox" name="part[]" id="chkpartial1_'+i+'" '+ ( lp_Status == 2?  'checked="true"' : "-") +' onClick="return false;"></td><td rowspan="'+ r +'"><input type="checkbox"  id="chkzero1_'+i+'"  onClick="return false;" name="zero[]" '+ ( lp_Status == 3?  'checked="true"' : "-") +'></td><td rowspan="'+ r +'" class="lp_Amt">'+lp_Amt+'</td>';}  
					}else{
						var loan_array = installment_Amount.split(',');
						var installment_Amount_ = installment_Amount.split(',');
						var loanid= new Array();
						var loanid = loan_ID.split(',');
					//console.log(loan_array);
						var loan= new Array();
						loan = loan_No.split(',');
						data +='<td colspan="8" rowspan="'+ r +'" class="all"><table class="change table table-striped table-bordered">';	
						for(var j = 0; j < loan_array.length; j++)
						{
							data +='<tr><td rowspan="" class="all"><input type="hidden" name="loan_ID[]" value="'+loan_ID[j]+'" size="6"><input type="text" value="'+loan[j]+'"name="loan_No[]" size="12"></td><td rowspan=""><input type="text" id="installment_Amount_'+j+'" value="'+loan_array[j]+'" readonly size="6" class="loan_amt" name="inst_Amt[]"></td><td rowspan=""><input type="text" name="due[]" id="due_'+j+'" readonly="readonly" size="3"></td><td rowspan=""><input type="text" name="adv[]"  id="advance_'+j+'" readonly="readonly" size="3"></td><td rowspan=""><input type="checkbox" name="full[]" checked="true" id="chkfull_'+j+'" onClick="changefull(this,'+j+','+loan_array[j]+')"></td><td rowspan=""><input type="checkbox" name="part[]" id="chkpartial_'+i+'" onClick="changePartial('+j+')"></td><td rowspan=""><input type="checkbox"  id="chkzero_'+j+'"  onClick="changeamt(this,'+j+','+amount+');" name="zero[]"></td><td rowspan=""><input type="text" id="amtdt_'+j+'" value="'+loan_array[j]+'" size="5" class="main" onChange="getsubtotal()" name="p_Amt[]"></td></tr>';
						}
						data +='</table></td>';
					}
						if(mandotory_Amount){
						data+='<td>-</td><td>'+rSav+'</td><td><input type="hidden" name="member_Id_v[]" value="'+member_Id+'" size="6"><input type="text" value="'+saving_Code+'" name="saving_Code['+member_Id+']" size="16"></td></td><td><input type="text" value="'+mandotory_Amount+'" name="mandotory_Amount['+member_Id+']" size="6" class="acc_Amt"></td><td><input type="checkbox"  id="chk_sav_full_'+i+'" onclick="return false;" '+ ( rp_status == 1?  'checked="true"' : "-") +'></td><td><input type="checkbox"  id="chk_sav_partial_'+i+'" onclick="return false;" '+ ( rp_status == 2?  'checked="true"' : "-") +'></td><td><input type="checkbox"  id="chk_sav_zero_'+i+'" onClick="return false;" '+ ( rp_status == 3?  'checked="true"' : "-") +');"></td><td class="deposit">'+rp_Amt+'</td></tr>';
						}
					if(v_product_Code){
					    alert(v_Amt)
						data += '<tr><td><input type="text" value="'+v_product_Code+'" name="v_product_Code['+member_Id+']" size="12"></td><td><input type="text" value="'+v_Amt+'" name="v_Amt['+member_Id+']" size="6"></td><td><input type="checkbox" checked="true" id="chk_man_full_'+i+'"></td><td><input type="checkbox" id="chk_man_partial_'+i+'"></td><td><input type="checkbox"  id="chk_man_zero_'+i+'" onClick="changeMan(this,'+i+','+v_Amt+');"></td><td><input type="text" id="amt_man_'+i+'" value="'+v_Amt+'" name="v_Amt_P['+member_Id+']" size="6" class="deposit" onChange="getsavtotal()"></td></tr>';
					}
					
					/*data += '<tr><td>s'+dps_No+'</td><td>'
					+savings_Amount+'</td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="checkbox"></td><td><input type="text" id="" value="'+savings_Amount+'"  size="6"></td></tr>';*/
					
					if(savings_Amount.indexOf(',')<0){
						if(savings_Amount == '-'){

						}else{

    						data += '<td>'+dNo+'</td><td>'+dtAmt+'</td><td><input type="hidden" value="'+dps_id+'" name="dps_id[]" size="12">'+dps_No+'</td><td><input type="hidden" value="'+savings_Amount+'"  size="12" class="acc_Amt">'+savings_Amount+'</td><td><input type="checkbox" id="chk_dps1_full_'+i+'" '+ ( sp_status == 1?  'checked="true"' : "-") +' onClick="return false;"></td><td>-</td><td><input type="checkbox" id="chk_dps1_zero_'+i+'" onClick="return false;" '+ ( sp_status == 2?  'checked="true"' : "-") +'></td><td class="deposit">'+sP_Amt+'</td>';

						}
					}
					else{
					var str_array = savings_Amount.split(',');
						var dps= new Array();
						var dpsid= new Array();
						dps = dps_No.split(',');
						dpsid = dps_id.split(',');
						for(var is = 0; is < str_array.length; is++){
							//console.log(str_array);
							data += '<tr><td><input type="hidden" value="'+dpsid[is]+'" name="dps_id[]" size="12"><input type="hidden" value="'+str_array[is]+'" name="savings_Amount[]" size="12">'+dps[is]+'</td><td>'+str_array[is]+'</td><td><input type="checkbox" checked="true" id="chk_dps_full_'+is+'"></td><td><input type="checkbox" id="chk_dps_partial_'+is+'"></td><td><input type="checkbox" id="chk_dps_zero_'+is+'" onClick="changeDps(this,'+is+','+str_array[is]+');"></td><td><input type="text" id="amt_dps_'+is+'" value="'+str_array[i]+'"  size="6" class="deposit" onChange="getsavtotal()"></td></tr>';
						}	
					}
					sl++;
							data += '</tr>';
//alert(getamt);
				}
//alert(getamt);
					$('#data').html(data);
					$('#members_Info').fadeIn("slow");
					
					var sum = 0;
					$(".loan_amt").each(function(){
						sum += parseInt($(this).val());
					});
					$('#total_Installment_Amt').val(sum);
					
					var lp_Amt=0;
					$(".lp_Amt").each(function(){
						lp_Amt += parseInt($(this).text());
					});
					$('#total_Amt').val(lp_Amt);
					

					
					var acc_Amt = 0;
					$(".acc_Amt").each(function(){
					    acc_Amt += parseInt($(this).val());
					});
					//console.log(deposit);
					$('#total_deposit').val(acc_Amt)
					
				    var deposit = 0;
					$(".deposit").each(function(){
						deposit += parseInt($(this).text());
					});
					$('#total_pay_deposit').val(deposit);
					
			}else{
				$('#members_Info').css('background-color', '#D9A38A');
				$('#members_Info').fadeOut('slow');
			}
			//$('#members_Info').html(response.member_Name);
		 },error: function(response) { console.log(response) }
	   });
		 }
		 view_loan_Lists();
		 $('#disbursement_Date').on('change',function(){
		     view_loan_Lists();
		 });
 		 $('#proType').on('change',function(){
		     view_loan_Lists();
		 });

		 });
/*=========================Total Present calculation==========================*/
		function countpresent(){
			var a = $('#is_Present:checked').length;
			$('#total_Present').val(a);
		}
/*=======================/ Total Present calculation========================*/

/*==================Calculation of loan subtotal to total=====================*/
    function getsubtotal(){
    	//alert('ok');
    	var main = 0;
    	$(".main").each(function(){
    	main += +$(this).val();
    		//console.log(main);
    	});
    	$('#total_Amt').val(main);
    }
/*==================/Calculation of loan subtotal to total====================*/

/*========change partial/full Loan amount of single loan of a member========*/
		function changefull(id,inc,getamt){
			var changed = id.checked;
			if(changed == true){
				//alert(changed);
			 $('#chkzero_'+inc).attr( "checked", false );
			 $('#chkpartial_'+inc).attr( "checked", false );
			 $('#chkfull_'+inc).attr( "checked", true );
			 $('#amtdt_'+inc).val(getamt);
			 //$('#total_Amt').val(getamt);
                getsubtotal();
			}else{
				alert('false works');
			}
		}
		function changePartial(inc){
			 $('#chkfull_'+inc).attr( "checked", false );
			 $('#chkzero_'+inc).attr( "checked", false );
			  $('#amtdt_'+inc).val('').focus();
			   $('#amtdt_'+inc).on('keyup',function(){
			      getsubtotal();//Common function for calculate all Loan amount	
			  });
		}
		function changeamt(id,inc,amt){
			var changed=id.checked;
			alert(inc);
			if(changed==true){
				//alert($('#amtdt_'+inc).text());
			$('#chkfull_'+inc).attr( "checked", false );
			$('#chkpartial_'+inc).attr( "checked", false );
			$('#amtdt_'+inc).val(0);		
			var b = parseInt($('#installment_Amount_'+inc).val());
				getsubtotal();			
			}
			else{
				alert('false works');
			}
		}
/*=================/For Single Loand End/====================================*/

/*===============Multiple Full/Partial Loan Amount Calculation==================*/
		function changefull1(id,inc,getamt){
			var changed = id.checked;
			if(changed == true){
				//alert(changed);
			 $('#chkzero1_'+inc).attr( "checked", false );
			 $('#chkpartial1_'+inc).attr( "checked", false );
			 $('#chkfull1_'+inc).attr( "checked", true );
			 $('#chkfull1_'+inc).val(1);
			 $('#amtdt1_'+inc).val(getamt);
			 //$('#total_Amt').val(getamt);
                getsubtotal();
			}else{
				alert('false works');
			}
		}
		function changePartial1(inc){
			 $('#chkfull1_'+inc).attr( "checked", false );
			 $('#chkzero1_'+inc).attr( "checked", false );
			 $('#amtdt1_'+inc).val('').focus();
			 $('#chkpartial1_'+inc).val(2);
			 $('#amtdt1_'+inc).prop('required',true);
			   $('#amtdt1_'+inc).on('keyup',function(){
			      getsubtotal();//Common function for calculate all Loan amount	
			  });
			  	
		}
		function changeamt1(id,inc,amt){
			var changed1=id.checked;
			//alert(inc);
			if(changed1==true){
				//alert($('#amtdt_'+inc).text());
				$('#chkfull1_'+inc).attr( "checked", false );
				$('#chkpartial1_'+inc).attr( "checked", false );
				$('#amtdt1_'+inc).val(0);
				$('#chkzero1_'+inc).val(3);
			getsubtotal();
				
			}
			else{
				alert('false works');
			}
		}
/*======================Single Loan Amount Calculation========================*/

/*=============Loan Full, Partial,Zero Calculation completed==================*/

/*=======================Saving section calculation start=====================*/

   
/*Voluntry and Mandatory*/

		function chk_sav_full(id,inc,mAmt){
		    alert('ok');
			var changed = id.checked;
			if(changed == true){
				//alert(changed);
			 $('#chk_sav_zero_'+inc).attr( "checked", false );
			 $('#chk_sav_partial_'+inc).attr( "checked", false );
			 $('#chk_sav_full_'+inc).attr( "checked", true );
			 $('#chk_sav_full_'+inc).val(1);
			 $('#amt_sav_'+inc).val(mAmt);
			 //$('#total_Amt').val(getamt);
                getsavtotal();
			}else{
				alert('false works');
			}
		}
		function chk_sav_partial(inc){
			 $('#chk_sav_zero_'+inc).attr( "checked", false );
			 $('#chk_sav_full_'+inc).attr( "checked", false );
			 $('#amt_sav_'+inc).val('').focus();
			 $('#chk_sav_partial_'+inc).val(2);
		 	 $('#amt_sav_'+inc).prop('required',true);
			   $('#amt_sav_'+inc).on('keyup',function(){
			      getsavtotal();//Common function for calculate all Loan amount	
			  });
			  	
		}
		function chk_sav_zero(id,inc,amt){
			var changed1=id.checked;
			//alert(inc);
			if(changed1==true){
				//alert($('#amtdt_'+inc).text());
				$('#chk_sav_full_'+inc).attr( "checked", false );
				$('#chk_sav_partial_'+inc).attr( "checked", false );
				$('#amt_sav_'+inc).val(0);
				$('#chk_sav_zero_'+inc).val(3);
			getsavtotal();
				
			}
			else{
				alert('false works');
			}
		}

		/*End*/
		
		/*Single Dps*/
		function changeDps1(id,inc,amt){
			var changed=id.checked;
			//alert(inc);
			if(changed==true){
				
									
				//alert($('#amtdt_'+inc).text());
				
				$('#chk_dps1_full_'+inc).attr( "checked", false );
				$('#chk_dps1_partial_'+inc).attr( "checked", false );
				$('#amt_dps1_'+inc).val(0);		
				getsavtotal();
				
			}
			else{
				alert('false works');
			}
		}
		
		function changeDps(id,inc,amt){

			var changed=id.checked;
			//alert(inc);
			if(changed==true){
				
									
				//alert($('#amtdt_'+inc).text());
				
				$('#chk_dps_full_'+inc).attr( "checked", false );
				$('#chk_dps_partial_'+inc).attr( "checked", false );
				$('#amt_dps_'+inc).val(0);		
				getsavtotal();
				
			}
			else{
				alert('false works');
			}
		}
		//print all report
	function printPageArea(areaID){
		var printContent = document.getElementById(areaID);
		var WinPrint = window.open('', '', 'width=900,height=650');
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:11px;border-collapse: collapse;} table, td, th {border: 1px solid black;} h4,p{text-align:center;padding:0;margin:0} input[type="text"]{border: none !important;box-shadow: none !important;outline: none !important;font-size:11px;} button{display:none;} table{margin-top:10px;}input[type="checkbox"]{width:10px;height:10px;}	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {padding:2px;}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}

/*---------------Saving section-------------------*/
   </script>

   		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/2.1.25/daterangepicker.min.js"></script>
		<script>
		

   
			$('input[name=today]').daterangepicker({
			  singleDatePicker: true,
			  startDate: new Date(),
			  showDropdowns: true,
			  //timePicker: true,
			  //timePicker24Hour: true,
			  //timePickerIncrement: 10,
			  autoUpdateInput: true,
			  locale: {
				//format: 'YYYY/MM/DD'
				format: 'YYYY/MM/DD'
			  },
			});
				$('input[name="payment_Date"]').daterangepicker({
	"singleDatePicker": true,
    "showDropdowns": true,
    "minYear":2018,
    //"minDate": 2017/01/01,
    //"maxDate": moment(new Date()).format("YYYY/MM/DD"),
	 locale: {
		//format: 'YYYY/MM/DD HH:mm'
		format: 'YYYY/MM/DD'
		},
	});
		</script>