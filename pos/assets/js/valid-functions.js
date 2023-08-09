/*Admin -> Manage COA Head Validation for Delete */
function admin_showhide(rowbase,row_id,incm){
$(document).ready(function() {
	var inc=1;
	$(".service_note_"+rowbase).each(function(){
		if(inc!=parseFloat(incm)){
			//$(this).fadeOut(500);
			$(this).hide();
		}
		else{
			//$(this).fadeIn(500);
			$(this).show();
		}
		inc++;
	});
});
}

function delete_alert(mgs){						
	var con = confirm(mgs);	
	if(con){
		/*
		$.ajax({
			type: "POST",
			data: {
					"service_type_id" : service_type_id
			},
			dataType: 'html',
			url: 'ajax/delete_service_type.php',
			error: function() {alert("Error");},
			success: function(data) {
				//$('#st'+service_type_id).fadeOut(500);
			}
		});
		*/
	}
	else{
		return false;	
	}	
}

function removeChar(item)
{ 
	var val = item.value;
  	val = val.replace(/[^.0-9]/g, "");  
  	if (val == ' '){val = ''};   
  	item.value=val;
}

function removeNumber(item)
{ 
	//alert('hi therer');
	var val = item.value;
	val = val.replace(/[^A-Za-z]/g, "");
	if (val == ' '){val = ''};   
	item.value=val;
}

$("#fcoa_master_id_sub2").change(function(){
	var fcoa_master_id = $(this).val();
		/*
		$.ajax({ 
        url: baseUrl+'admin/get_student_list_for_fees_json',
        data:
            {                  
                'fcoa_master_id':fcoa_master_id
            }, 
            dataType: 'json',
            success: function(data)
            {
                result                = ''+data['result']+'';
                mainContent           = ''+data['mainContent']+'';

                if(result == 'success')
                {            
                    $('#display').html(mainContent);     
                }                
            }
        });
		*/
		
	$.getJSON( baseUrl+'accounts/get_sub1_list_json',{'fcoa_master_id':fcoa_master_id}, function(j){
			
			if(j.length>0)
			{
				var options = '';
				var dispaly_code_name = '';
				options += '<option value="">Select COA-SUB1</option>';
				for (var i = 0; i < j.length; i++) {
					
					if(j[i].fcoacode==null){
						var dispaly_code_name=j[i].optionDisplay;
					}
					else{
						var dispaly_code_name=j[i].fcoacode + '-' +j[i].optionDisplay;
					}
					
				options += '<option value="' + j[i].optionValue + '">' + dispaly_code_name + '</option>';
				}
				
				$('#sub2_head_row').hide();
				$('#sub1_head_row').show();
				$('select#fcoa_id_sub2').html('');
				$('select#fcoa_id_sub2').html(options);
			}
			else
			{
				$('#sub1_head_row').hide(); 
				$('#sub2_head_row').hide();
			}
	});
});


$("#fcoa_master_id").change(function(){
	var fcoa_master_id = $(this).val();
	$.getJSON( baseUrl+'accounts/get_sub1_list_json',{'fcoa_master_id':fcoa_master_id}, function(j){
			
			if(j.length>0)
			{
				var options = '';
				var dispaly_code_name = '';
				options += '<option value="">Select COA-SUB1</option>';
				for (var i = 0; i < j.length; i++) {
					
					if(j[i].fcoacode==null){
						var dispaly_code_name=j[i].optionDisplay;
					}
					else{
						var dispaly_code_name=j[i].fcoacode + '-' +j[i].optionDisplay;
					}
					
				options += '<option value="' + j[i].optionValue + '">' + dispaly_code_name + '</option>';
				}
				
				$('#sub2_head_row').hide();
				$('#sub1_head_row').show();
				$('select#fcoa_id').html('');
				$('select#fcoa_id').html(options);
			}
			else
			{
				$('#sub1_head_row').hide(); 
				$('#sub2_head_row').hide();
			}
	});
});

$("#fcoa_id").change(function(){
	var fcoa_id = $(this).val();
	$('#sub2_head_row').hide(); 
	
	$.getJSON( baseUrl+'accounts/get_sub2_list_json',{'fcoa_id':fcoa_id}, function(j){
			
			if(j.length>0)
			{
				var options = '';
				var dispaly_code_name = '';
				options += '<option value="">Select COA-SUB2</option>';
				for (var i = 0; i < j.length; i++) {
					
					if(j[i].fcoacode==null){
						var dispaly_code_name=j[i].optionDisplay;
					}
					else{
						var dispaly_code_name=j[i].fcoacode + '-' +j[i].optionDisplay;
					}
					
				options += '<option value="' + j[i].optionValue + '">' + dispaly_code_name + '</option>';
				}
				
				$('#sub2_head_row').show();
				
				$('select#fcoa_bkdn_id').html('');
				$('select#fcoa_bkdn_id').html(options);
			}
			else
			{
				$('#sub1_head_row').hide(); 
				$('#sub2_head_row').hide(); 
				
			}
	});
});


function adddesemp(){
	var html='';
	var cinput = parseFloat($('#area').find('input[class*="jobinc"]:last').val());
	var inputs=cinput+1;

	if($("#particulars_"+cinput).val()==''){
		alert('Please Insert Particulars');
		$("#particulars_"+cinput).focus();
		return false;
	}
	if($("#account_code_"+cinput).val()==''){
		alert('Please Insert Chart of Account head');
		$("#account_code_"+cinput).focus();
		return false;
	}
	else {
		html+='<tr><td style="text-align:center;" id="increment_'+inputs+'">'+inputs+'</td><td style="text-align:left;"><input type="text" name="particulars[]" id="particulars_'+inputs+'" value="" maxlength="50" style="text-align:left;border:none;" autocomplete="off" /></td><td style="text-align:left;"><div style="width:100%;position:relative;"><input type="text" name="account_code[]" id="account_code_'+inputs+'" class="cls_account_code" value="" style="border:none;" onkeyup="check_account_code(this.value,'+inputs+');" maxlength="100" autocomplete="off"/><div id="account_code_suggestions_'+inputs+'" style="display:none;"><div id="account_code_list_'+inputs+'" style="border:1px solid #3F3FFF;"></div></div></div><input type="hidden" name="table_name[]" id="table_name_'+inputs+'" value=""><input type="hidden" name="table_id[]" id="table_id_'+inputs+'" value=""></td><td style="text-align:left;"><input type="text" name="debit[]" id="debit_'+inputs+'" class="cls_debit" value="" autocomplete="off" style="text-align:center; border:none;" maxlength="15" onkeyup="removeChar(this)" onBlur="return debit_entry('+inputs+');" /> </td><td style="text-align:left;"><input type="text" name="credit[]" id="credit_'+inputs+'" class="cls_credit" value=""  autocomplete="off" style="text-align:center; border:none;" maxlength="15" onkeyup="removeChar(this)" onBlur="return credit_entry('+inputs+');" /> <input type="hidden" name="jobinc[]" id="jobinc_'+inputs+'" class="jobinc" value="'+inputs+'"><input type="hidden" name="bkdn_id[]" value="" /></td></tr>';
		$('#area:last').append(html);
	}
}

function removedesemp(){					
	var cinput = parseFloat($('#area').find('input[class*="jobinc"]:last').val());
	if(cinput>1){
	var inputs=cinput-1;
		if (confirm('Continue Delete?')) {
			$('#area tr:last').remove();
			sum_of_debit_credit();
		}
	}
}


function check_account_code(code,increment){
	if(code!=""){
    $.getJSON( baseUrl+'accounts/get_check_account_code',{'code':code,'increment':increment}, function(j){
	if(j.length>0){
		var data			= '';
		var table_name 		= '';
		var table_id 		= '';
		var display_value 	= '';
		
		for (var i = 0; i < j.length; i++) {
			
			var table_name 		= j[i].table_name;
			var table_id 		= j[i].table_id;
			var display_value 	= j[i].display_value;
			
		//$('#results_'+increment).append('<div class="item" align="left" onClick="account_code_fill(\''+display_value+'\','+increment+',\''+table_name+'\','+table_id+');"><b>'+display_value+'</b></div>');	
		data += '<div class="item" align="left" onClick="account_code_fill(\''+display_value+'\','+increment+',\''+table_name+'\','+table_id+');"><b>'+display_value+'</b></div>';
		}
		
		$('#account_code_list_'+increment).html(data);
		$('#account_code_'+increment).css('background-color', '#FFFFE0');
		$('#account_code_suggestions_'+increment).fadeIn("slow");
	}
	else
	{
		$('#table_name_'+increment).val('');
		$('#table_id_'+increment).val('');
		$('#account_code_'+increment).val('');
		$('#account_code_'+increment).css('background-color', '#D9A38A');
		$('#account_code_suggestions_'+increment).fadeOut();
				
	}
});		
}
else {
	$('#table_name_'+increment).val('');
	$('#table_id_'+increment).val('');
	$('#account_code_'+increment).val('');
	$('#account_code_'+increment).css('background-color', '#D9A38A');
	$('#account_code_suggestions_'+increment).fadeOut();
}
}

function account_code_fill(value,increment,tablename,tableid) {
	$('#account_code_'+increment).css('background-color', '#FFFFE0');
	$('#account_code_'+increment).val(value);
	$('#table_name_'+increment).val(tablename);
	$('#table_id_'+increment).val(tableid);
	sum_of_debit_credit();
	$('#account_code_suggestions_'+increment).fadeOut();
	$('#account_code_'+increment).focus();
}

function sum_of_debit_credit(){
	$.total_debit=0;
	$.total_credit=0;
	
	/* Debit SUM */
	$(".cls_debit").each(function(){
		var debit_amount=$(this).val();
		$.total_debit+=Number(debit_amount);
	});
	/* Debit SUM */
	
	/* Credit SUM */
	$(".cls_credit").each(function(){
		var credit_amount=$(this).val();
		$.total_credit+=Number(credit_amount);
	});
	/* Credit SUM */
	
	$("#debit_sum").val($.total_debit);
	$("#credit_sum").val($.total_credit);	
}

function debit_entry(inc){
	if($("#account_code_"+inc).val()!=''){
	
		var debit_amount = Number($('#debit_'+inc).val());	

		if(debit_amount<=0){
			$('.debit_'+inc).text('Please Insert Debit Amount');
			$("#debit_"+inc).val('');
			sum_of_debit_credit();
			return false;
		}
		else {
			$("#credit_"+inc).val('');
			sum_of_debit_credit();
		}
	}
	else {
		
		alert("Please Enter Account Code");
		$("#debit_"+inc).val('');
		sum_of_debit_credit();
		$("#account_code_"+inc).focus();
	}
}

function credit_entry(inc){
	if($("#account_code_"+inc).val()!=''){
	
		var credit_amount = Number($('#credit_'+inc).val());	

		if(credit_amount<=0){
			$('.credit_'+inc).text('Please Insert Debit Amount');
			$("#credit_"+inc).val('');
			sum_of_debit_credit();
			return false;
		}
		else {
			$("#debit_"+inc).val('');
			sum_of_debit_credit();
		}
	}
	else {
		
		alert("Please Enter Account Code");
		$("#credit_"+inc).val('');
		sum_of_debit_credit();
		$("#account_code_"+inc).focus();
	}
}
function entry_validation(form){

$("#subsub").prop("disabled", true);
//$("#action").val(string);
	
	if($("#current_date").val()==''){
		alert('Please Select Current Date');
		$("#current_date").focus();
		$("#subsub").prop("disabled", false);
		return false;
	}
	else if($("#pay_to").val()==''){
		alert('Please Type Pay To Name');
		$("#pay_to").focus();
		$("#subsub").prop("disabled", false);
		return false;
	}
	else if($("#purpose").val()==''){
		alert('Please Type Your Purpose');
		$("#purpose").focus();
		$("#subsub").prop("disabled", false);
		return false;
	}
	else if($("#debit_sum").val()==''){
		alert('Total Debit Is Empty');
		$("#subsub").prop("disabled", false);
		return false;
	}
	else if($("#credit_sum").val()==''){
		alert('Total Credit Is Empty');
		$("#subsub").prop("disabled", false);
		return false;
	}
	else if($("#debit_sum").val() != $("#credit_sum").val()){
		alert('Total Debit And Credit Are Not Equal');
		$("#subsub").prop("disabled", false);
		return false;
	}
	
	$.con=1;
	$.inc=1;
	
	$('.cls_debit').each(function(){
	
		if($("#particulars_"+$.inc).val()==''){
			alert('Please Type Your Particulars');
			$("#particulars_"+$.inc).focus();
			$.con=$.con*0;
			$("#subsub").prop("disabled", false);
			return false;
		}
		else if($("#account_code_"+$.inc).val()==''){
			alert('Please Insert Account Code');
			$("#account_code_"+$.inc).focus();
			$.con=$.con*0;
			$("#subsub").prop("disabled", false);
			return false;
		}
		$.inc++;
	});
	
	if($.con>0){
		$("#detvoucherform").submit();
	}
}		
/*
function check_account_code(code,increment){
$.ajax({
		type: "POST",
		data: {
				"code" : code,
				"increment" : increment
		},
		dataType: 'html',
		url: baseUrl+'accounts/get_check_account_code',
		error: function() {alert("Error");},
		success: function(data) {
			
			if(data.length >0) {
				$('#account_code_list_'+increment).html(data);
				$('#account_code_'+increment).css('background-color', '#FFFFE0');
				$('#account_code_suggestions_'+increment).fadeIn("slow");
			}
			else {
				$('#table_name_'+increment).val('');
				$('#table_id_'+increment).val('');
				$('#account_code_'+increment).val('');
				$('#account_code_'+increment).css('background-color', '#D9A38A');
				$('#account_code_suggestions_'+increment).fadeOut();
			}
		}
	});
}
*/		
