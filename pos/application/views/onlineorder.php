<!DOCTYPE html>
<html>

<head>
<!-- TABLES CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php include"sidebar.php"; ?>
    <?php
        if(!isset($status)){
        $user_id=$billing_id=$sub_total=$total=$status=$paymenttype_id="";
        }
    ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Online Order</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>onlineorder/view"><?= $this->lang->line('online_order_list'); ?></a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <?= form_open('#', array('class' => 'form', 'id' => 'category-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
                <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">

				<div class="form-group">
                    <div class="form-group col-sm-4 col-md-4">
                    <label for="status"><?= $this->lang->line('status'); ?><span class="text-danger">*</span></label>
                    <select class="form-control select2" id="status" name="status"  style="width: 100%;" >
                    <?php
                    $status0=$status1=$status2=$status3='';
                    if($status =='0') { $status0='selected'; }
                    if($status =='1') { $status1='selected'; }
                    if($status =='2') { $status2='selected'; }
                    if($status =='3') { $status3='selected'; }

                    ?>
                    <option <?= $status0 ?> value="0">Pending</option>
                    <option <?= $status1 ?> value="1">Processing</option>
                    <option <?= $status2 ?> value="2">Delivered</option>
                    <option <?= $status3 ?> value="3">Cancel</option>
                    </select>
                    <!-- </div> -->
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-md-4 form-group">
                         <label for="paymenttype_id"><?= $this->lang->line('bank_type'); ?><span class="text-danger">*</span></label>
                     <select class="form-control select2" id="paymenttype_id" name="paymenttype_id"  style="width: 100%;"  value="<?php print $paymenttype_id; ?>">
                        <?php
                           $query1="select * from db_paymenttypes";
                           $q1=$this->db->query($query1);
                           if($q1->num_rows($q1)>0)
                            {  echo '<option value="">-Select-</option>';
                                foreach($q1->result() as $res1)
                              {
                                $selected = ($paymenttype_id==$res1->id)? 'selected' : '';
                                echo "<option $selected value='".$res1->id."'>".$res1->payment_type."</option>";
                              }
                            }
                            else
                            {
                               ?>
                        <option value="">No Records Found</option>
                        <?php
                           }
                           ?>
                     </select>
                      </div>
                     <span id="paymenttype_id_msg" style="display:none" class="text-danger"></span>
                </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($status!=""){
                           $btn_name="Update";
                           $btn_id="update";
                          ?>
                            <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                            <?php
                      }
                                else{
                                    $btn_name="Save";
                                    $btn_id="save";
                                }

                                ?>

                   <div class="col-md-3 col-md-offset-3">
                      <button type="button" id="<?php echo $btn_id;?>" class=" btn btn-block btn-success" title="Save Data"><?php echo $btn_name;?></button>
                   </div>
                   <div class="col-sm-3">
                    <a href="<?=base_url('dashboard');?>">
                      <button type="button" class="col-sm-3 btn btn-block btn-warning close_btn" title="Go Dashboard">Close</button>
                    </a>
                   </div>
                </div>
             </div>
             <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php include"footer.php"; ?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- SOUND CODE -->
<?php include"comman/code_js_sound.php"; ?>
<!-- TABLES CODE -->
<?php include"comman/code_js_form.php"; ?>

<script src="<?php echo $theme_link; ?>js/onlineorder.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
