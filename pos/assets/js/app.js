jQuery(function($) {
	

 
   function getMemberShareInfo(ids) {
    var baseUrl = document.getElementById('baseurl').value;
	
    $.ajax({
		
     url:baseUrl+'share/share/view_Member_By_Id',
     method: 'get',
     data: {id: ids},
     dataType: 'json',
     success: function(response){
		console.log(response);
 
     }
   });
   }



});