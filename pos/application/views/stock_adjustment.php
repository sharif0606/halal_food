<!DOCTYPE html>
<html>

<head>
<!-- FORM CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
<style type="text/css">
table.table-bordered > thead > tr > th {
/* border:1px solid black;*/
text-align: center;
}
.table > tbody > tr > td, 
.table > tbody > tr > th, 
.table > tfoot > tr > td, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > thead > tr > th 
{
padding-left: 2px;
padding-right: 2px;  

}
</style>
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 
 
 <?php include"sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
         <h1>
            <?=$page_title;?>
            <small>Add/Update Sales</small>
         </h1>
         <ol class="breadcrumb">
            <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $base_url; ?>sales"><?= $this->lang->line('stock_list'); ?></a></li>
            <li><a href="<?php echo $base_url; ?>sales/add">New Stock</a></li>
            <li class="active"><?=$page_title;?></li>
         </ol>
      </section>

    <!-- Main content -->
     <section class="content">
               <div class="row">
                <!-- ********** ALERT MESSAGE START******* -->
               <?php include"comman/code_flashdata.php"; ?>
               <!-- ********** ALERT MESSAGE END******* -->
                  <!-- right column -->
                  <div class="col-md-12">
                     <!-- Horizontal Form -->
                     <div class="box box-info " >
                        <!-- style="background: #68deac;" -->
                        
                        <!-- form start -->
                         <!-- OK START -->
                        <?= form_open('#', array('class' => 'form-horizontal', 'id' => 'stock_transfer_form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
                           <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
                           <input type="hidden" value='0' id="hidden_rowcount" name="hidden_rowcount">
                          
                           <div class="box-body">
                              <div class="form-group">
                                 <label for="entry_date" class="col-sm-2 control-label">Exchange Date <label class="text-danger">*</label></label>
                                 <div class="col-sm-3">
                                    <div class="input-group date">
                                       <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                       </div>
                                       <input type="text" class="form-control pull-right datepicker"  id="entry_date" name="entry_date" readonly>
                                    </div>
                                    <span id="entry_date_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                             <div class="form-group">
                                <label for="warehouse_from" class="col-sm-2 control-label">From <?= $this->lang->line('warehouse'); ?> <label class="text-danger">*</label></label>
                                <div class="col-sm-3">
                                    <select class="form-control select2" id="warehouse_from" name="warehouse_from"  style="width: 100%;">
                                        <?php
                                            $query1="select * from db_warehouse where status=1";
                                            $q1=$this->db->query($query1);
                                            if($q1->num_rows($q1)>0){ 
                                                  echo "<option value=''>-Select-</option>";
                                                  foreach($q1->result() as $res1){
                                                  echo "<option  value='".$res1->id."'>".$res1->warehouse_name ."</option>";
                                                }
                                              }
                                              else{
                                                 ?>
                                          <option value="">No Records Found</option>
                                          <?php } ?>
                                       </select>
                                    <span id="warehouse_from_msg" style="display:none" class="text-danger"></span>
                                 </div>
                                <label for="warehouse_to" class="col-sm-2 control-label">To <?= $this->lang->line('warehouse'); ?> <label class="text-danger">*</label></label>
                                 <div class="col-sm-3">
                                       <select class="form-control select2" id="warehouse_to" name="warehouse_to"  style="width: 100%;">
                                          <?php
                                             
                                             $query1="select * from db_warehouse where status=1";
                                             $q1=$this->db->query($query1);
                                             if($q1->num_rows($q1)>0){ 
                                                  echo "<option value=''>-Select-</option>";
                                                  foreach($q1->result() as $res1){
                                                  echo "<option  value='".$res1->id."'>".$res1->warehouse_name ."</option>";
                                                }
                                              }
                                              else{
                                                 ?>
                                          <option value="">No Records Found</option>
                                          <?php } ?>
                                       </select>
                                    <span id="towarehouse_id_msg" style="display:none" class="text-danger"></span>
                                 </div>
                              </div>
                           </div>
                           <!-- /.box-body -->
                           
                           <div class="row">
                              <div class="col-md-12">
                                <div class="col-md-12">
                                  <div class="box">
                                    <div class="box-info">
                                      <div class="box-header">
                                        <div class="col-md-8 col-md-offset-2 d-flex justify-content" >
                                          <div class="input-group">
                                                <span class="input-group-addon" title="Select Items"><i class="fa fa-barcode"></i></span>
                                                 <input type="text" class="form-control " placeholder="Item name/Barcode/Itemcode" id="item_search">
                                              </div>
                                        </div>
                                    
                                      </div>
                                      <div class="box-body">
                                        <div class="table-responsive" style="width: 100%">
                                        <table class="table table-hover table-bordered" style="width:100%" id="stock_table">
                                             <thead class="custom_thead">
                                                <tr class="bg-primary" >
                                                   <th rowspan='2' style="width:15%"><?= $this->lang->line('item_name'); ?></th>
                                                   <th rowspan='2' style="width:10%;min-width: 180px;"><?= $this->lang->line('quantity'); ?></th>
                                                   <th rowspan='2' style="width:7.5%"><?= $this->lang->line('action'); ?></th>
                                                </tr>
                                             </thead>
                                             <tbody>
                                               
                                             </tbody>
                                          </table>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                  

                                </div>
                              </div>
                              
                              
                              <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <label for="" class="col-sm-4 control-label"><?= $this->lang->line('quantity'); ?></label>    
                                          <div class="col-sm-4">
                                             <label class="control-label total_quantity text-success" style="font-size: 15pt;">0</label>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                           <div class="form-group">
                                              <label for="exc_note" class="col-sm-4 control-label"><?= $this->lang->line('note'); ?></label>    
                                              <div class="col-sm-8">
                                                 <textarea class="form-control text-left" id='exc_note' name="exc_note"></textarea>
                                                <span id="exc_note_msg" style="display:none" class="text-danger"></span>
                                              </div>
                                           </div>
                                        </div>
                                      </div>
                                </div>
                              </div>
                           </div>
                           
                           <!-- /.box-body -->
                           <div class="box-footer col-sm-12">
                              <center>
                                <?php
                                if(isset($sales_id)){
                                  $btn_id='update';
                                  $btn_name="Update";
                                  echo '<input type="hidden" name="sales_id" id="sales_id" value="'.$sales_id.'"/>';
                                }
                                else{
                                  $btn_id='save';
                                  $btn_name="Save";
                                }

                                ?>
                                 <div class="col-md-3 col-md-offset-3">
                                    <button type="button" id="<?php echo $btn_id;?>" class="btn bg-maroon btn-block btn-flat btn-lg payments_modal" title="Save Data"><?php echo $btn_name;?></button>
                                 </div>
                                 <div class="col-sm-3"><a href="<?= base_url()?>dashboard">
                                    <button type="button" class="btn bg-gray btn-block btn-flat btn-lg" title="Go Dashboard">Close</button>
                                  </a>
                                </div>
                              </center>
                           </div>
                           

                           <?= form_close(); ?>
                           <!-- OK END -->
                     </div>
                  </div>
                  <!-- /.box-footer -->
                 
               </div>
               <!-- /.box -->
             </section>
            <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
 <?php include"footer.php"; ?>
<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- GENERAL CODE -->
<?php include"comman/code_js_form.php"; ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

      <script src="<?php echo $theme_link; ?>js/stock.js"></script>  
      <script>
        var base_url=$("#base_url").val();
        
        $("#store_from").change(function(){
          var store_id=$(this).val();
          $.post(base_url+"sales/get_warehouse_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#warehouse_from").html('').append(result).select2();
          });
        });
        $("#store_to").change(function(){
          var store_id=$(this).val();
          $.post(base_url+"sales/get_warehouse_select_list",{store_id:store_id},function(result){
              result='<option value="">All</option>'+result;
              $("#warehouse_to").html('').append(result).select2();
          });
        });

        /*Warehouse*/
        $("#warehouse_from").change(function(){
          var warehouse_id=$(this).val();
          $("#stock_table > tbody").empty();
          calculate_quantity();
        });
        /*Warehouse end*/

         $(".close_btn").click(function(){
           if(confirm('Are you sure you want to navigate away from this page?')){
               window.location='https://billing.creatantech.com/dashboard';
             }
         });
         //Initialize Select2 Elements
             $(".select2").select2();
         //Date picker
             $('.datepicker').datepicker({
               autoclose: true,
            format: 'dd-mm-yyyy',
              todayHighlight: true
             });
          
        /*if($("#warehouse_id").val()==''){
          $("#item_search").attr({
            disabled: true,
          });
          toastr["warning"]("Please Select Warehouse!!");
          failed.currentTime = 0; 
          failed.play();
         
        }*/
         
      
      
   
         /* ---------- Final Description of amount end ------------*/
          
         function removerow(id){//id=Rowid
           
         $("#row_"+id).remove();
         calculate_quantity();
         failed.currentTime = 0;
        failed.play();
         }
        
        function calculate_quantity(){
          var total_quantity=0;
          var rowcount=$("#hidden_rowcount").val();
          console.log(rowcount)
           for(i=0;i<rowcount;i++){
                total_quantity +=parseInt($("#td_data_"+i+"_3").val());
                console.log(total_quantity)
           }//for end
           
          //Show total Sales Quantitys
           $(".total_quantity").html(total_quantity);
        }
    </script>

      <!-- Make sidebar menu hughlighter/selector -->
      <script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
