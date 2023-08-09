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
	if(!isset($cupon_name)){
      $cupon_code=$cupon_name=$number_of=$start_date=$finish_date=$discount_type=$discount=$status="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Add/Update Cupon</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>cupon/view"><?= $this->lang->line('cupons_list'); ?></a></li>
        <li class="active"><?=$page_title;?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info ">
            <div class="box-header with-border">
              <h3 class="box-title">Please Enter Valid Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= form_open('#', array('class' => 'form', 'id' => 'cupon-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
            <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
            <div class="box-body">
			<div class="form-group">
			      <label for="cupon" class="col-sm-2 control-label"><?= $this->lang->line('cupon_name'); ?><label class="text-danger">*</label></label>
            <div class="col-sm-4">
                <input type="text" class="form-control input-sm" id="cupon_name" name="cupon_name" placeholder="" value="<?php print $cupon_name; ?>" autofocus >
                        <span id="cupon_msg" style="display:none" class="text-danger"></span>
                </div>
      </div>
      <div class="form-group">
          <label for="cupon_code" class="col-sm-2 control-label"><?= $this->lang->line('cupon_code'); ?></label>
          <div class="col-sm-4">
              <input type="text" class="form-control" name="cupon_code" value="<?php print $cupon_code; ?>">
              <?php if($cupon_code){ ?>
                <a href="<?= base_url($cupon_code) ?>" target="_blank">
                    <img src="<?= base_url($cupon_code) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="number_of" class="col-sm-2 control-label"><?= $this->lang->line('number_of'); ?></label>
          <div class="col-sm-4">
              <input type="text" class="form-control" name="number_of" value="<?php print $number_of; ?>">
              <?php if($number_of){ ?>
                <a href="<?= base_url($number_of) ?>" target="_blank">
                    <img src="<?= base_url($number_of) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="start_date" class="col-sm-2 control-label"><?= $this->lang->line('start_date'); ?></label>
          <div class="col-sm-4">
              <input type="date" class="form-control" name="start_date" value="<?php print $start_date; ?>">
              <?php if($start_date){ ?>
                <a href="<?= base_url($start_date) ?>" target="_blank">
                    <img src="<?= base_url($start_date) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="finish_date" class="col-sm-2 control-label"><?= $this->lang->line('finish_date'); ?></label>
          <div class="col-sm-4">
              <input type="date" class="form-control" name="finish_date" value="<?php print $finish_date; ?>">
              <?php if($finish_date){ ?>
                <a href="<?= base_url($finish_date) ?>" target="_blank">
                    <img src="<?= base_url($finish_date) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="slied" class="col-sm-2 control-label"><?= $this->lang->line('discount_type'); ?><span class="text-danger"></label>
          <div class="col-sm-4">
              <select class="form-control" name="discount_type" >
              <?php
                $amount=$percent='';
                if($discount_type =='0') { $percent='selected'; }
                if($discount_type =='1') { $amount='selected'; }

              ?>
                <option <?= $percent ?> value="0">Percent</option>
                <option <?= $amount ?> value="1">Amount</option>

              </select>
          </div>
      </div>


				<div class="form-group">
          <label for="description" class="col-sm-2 control-label"><?= $this->lang->line('discount'); ?></label>
          <div class="col-sm-4">
              <input type="text" class="form-control" name="discount" value="<?php print $discount; ?>">
              <?php if($discount){ ?>
                <a href="<?= base_url($discount) ?>" target="_blank">
                    <img src="<?= base_url($discount) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
                </div>

              </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($cupon_name!=""){
                          $btn_name="Update";
                          $btn_id="update";
                        ?>
                          <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                          <?php
                      }else{
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

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->

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

<script src="<?php echo $theme_link; ?>js/cupon.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
