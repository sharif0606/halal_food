
$('#save,#update').click(function (e) {
	var base_url=$("#base_url").val().trim();
    //Initially flag set true
    var flag=true;

    function check_field(id)
    {
      if(!$("#"+id).val().trim() ) //Also check Others????
        {
            $('#'+id+'_msg').fadeIn(200).show().html('Required Field').addClass('required');
           // $('#'+id).css({'background-color' : '#E8E2E9'});
            flag=false;
        }
        else
        {
             $('#'+id+'_msg').fadeOut(200).hide();
             //$('#'+id).css({'background-color' : '#FFFFFF'});    //White color
        }
    }

    //Validate Input box or selection box should not be blank or empty
	check_field("title");

    if(flag==false)
    {

		toastr["warning"]("You have Missed Something to Fillup!")
		return;
    }

    var this_id=this.id;

    if(this_id=="save")  //Save start
    {
					if(confirm("Do You Wants to Save Record ?")){
						e.preventDefault();
						data = new FormData($('#category-form')[0]);//form name
						/*Check XSS Code*/
						if(!xss_validation(data)){ return false; }

						$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
						$("#"+this_id).attr('disabled',true);  //Enable Save or Update button
						$.ajax({
						type: 'POST',
						url: base_url+'footslider/newfslider',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(result){
                            console.log(result);
             // alert(result);return;
							if(result=="success")
							{
								//alert("Record Saved Successfully!");
								window.location=base_url+"footslider/view";
								return;
							}
							else if(result=="failed")
							{
								toastr["error"]("Sorry! Failed to save Record.Try again!");
							   //	return;
							}
							else
							{
								toastr["error"](result);
							}
							$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
							$(".overlay").remove();
					   }
					   });
				}

				//e.preventDefault


    }//Save end

	else if(this_id=="update")  //Save start
    {


					if(confirm("Do You Wants to Update Record ?")){
						e.preventDefault();
						data = new FormData($('#category-form')[0]);//form name
						/*Check XSS Code*/
						if(!xss_validation(data)){ return false; }

						$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
						$("#"+this_id).attr('disabled',true);  //Enable Save or Update button
						$.ajax({
						type: 'POST',
						url: base_url+'footslider/update_footslider',
						data: data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(result){
                            console.log(result)
              //alert(result);return;
							if(result=="success")
							{
								//toastr["success"]("Record Updated Successfully!");
								window.location=base_url+"footslider/view";
							}
							else if(result=="failed")
							{
								toastr["error"]("Sorry! Failed to save Record.Try again!");
							   //alert("Sorry! Failed to save Record.Try again");
							   //	return;
							}
							else
							{
								toastr["error"](result);
							}
							$("#"+this_id).attr('disabled',false);  //Enable Save or Update button
							$(".overlay").remove();
					   },error: function(s){
                        console.log(s);
                       }
					   });
				}

				//e.preventDefault


    }//Save end


});


//On Enter Move the cursor to desigtation Id
function shift_cursor(kevent,target){

    if(kevent.keyCode==13){
		$("#"+target).focus();
    }

}


//Delete Record start
function delete_fslider(q_id)
{

   if(confirm("Do You Wants to Delete Record ?")){
   	$(".box").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
   $.post("delete_fslider",{q_id:q_id},function(result){
   //alert(result);return;
	   if(result=="success")
				{
					toastr["success"]("Record Deleted Successfully!");
					$('#example2').DataTable().ajax.reload();
				}
				else if(result=="failed"){
				  	toastr["error"]("Failed to Delete .Try again!");
				}
				else{
					toastr["error"](result);
				}
				$(".overlay").remove();
				return false;
   });
   }//end confirmation
}
//Delete Record end
