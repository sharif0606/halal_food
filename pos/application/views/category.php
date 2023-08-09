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
	if(!isset($category_name)){
      $category_code=$category_name=$description=$is_slied=$is_advertise=$image=$banner_image=$advertise_image="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Add/Update Category</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>category/view"><?= $this->lang->line('categories_list'); ?></a></li>
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
            <form class="form-horizontal" enctype="multipart/form-data" id="category-form" onkeypress="return event.keyCode != 13;">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
              <input type="hidden" id="base_url" value="<?php echo $base_url;; ?>">
              <div class="box-body">
				


			<div class="form-group">
			      <label for="category" class="col-sm-2 control-label"><?= $this->lang->line('category_name'); ?><label class="text-danger">*</label></label>
           <div class="col-sm-4">
             <input type="text" class="form-control input-sm" id="category" name="category" placeholder="" onkeyup="shift_cursor(event,'description')" value="<?php print $category_name; ?>" autofocus >
				      <span id="category_msg" style="display:none" class="text-danger"></span>
            </div>
      </div>
      <div class="form-group">
          <label for="image" class="col-sm-2 control-label">Icon Image</label>
          <div class="col-sm-4">
              <input type="file" class="form-control" name="image">
              <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
              <?php if($image){ ?>
                <a href="<?= base_url($image) ?>" target="_blank">
                    <img src="<?= base_url($image) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="banner_image" class="col-sm-2 control-label">Banner Image</label>
          <div class="col-sm-4">
              <input type="file" class="form-control" name="banner_image">
              <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
              <?php if($banner_image){ ?>
                <a href="<?= base_url($banner_image) ?>" target="_blank">
                    <img src="<?= base_url($banner_image) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="advertise_image" class="col-sm-2 control-label">Advertisement Image</label>
          <div class="col-sm-4">
              <input type="file" class="form-control" name="advertise_image">
              <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 337px * 600px & Size: 1MB </span>
              <?php if($advertise_image){ ?>
                <a href="<?= base_url($advertise_image) ?>" target="_blank">
                    <img src="<?= base_url($advertise_image) ?>" alt="" width="50px">
                </a>
              <?php } ?>
          </div>
      </div>
      <div class="form-group">
          <label for="slied" class="col-sm-2 control-label">Is Slied<span class="text-danger"></label>
          <div class="col-sm-4">
              <select class="form-control" name="is_slied" >
              <?php 
                $yes_selected=$no_selected='';
                if($is_slied =='1') { $yes_selected='selected'; }
                if($is_slied =='0') { $no_selected='selected'; }

              ?>
                <option <?= $no_selected ?> value="0">No</option>
                <option <?= $yes_selected ?> value="1">Yes</option>
                
              </select>
          </div>
      </div>
      <div class="form-group">
          <label for="slied" class="col-sm-2 control-label">Is Advertise<span class="text-danger"></label>
          <div class="col-sm-4">
              <select class="form-control" name="is_advertise" >
              <?php 
                $yes_selected=$no_selected='';
                if($is_advertise =='1') { $yes_selected='selected'; }
                if($is_advertise =='0') { $no_selected='selected'; }

              ?>
                <option <?= $no_selected ?> value="0">No</option>
                <option <?= $yes_selected ?> value="1">Yes</option>
                
              </select>
          </div>
      </div>


				<div class="form-group">
                  <label for="description" class="col-sm-2 control-label"><?= $this->lang->line('description'); ?></label>
                  <div class="col-sm-4">
                    <textarea type="text" class="form-control" id="description" name="description" placeholder=""><?php print $description; ?></textarea>
					<span id="description_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>

              </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($category_code!=""){
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

<script src="<?php echo $theme_link; ?>js/category.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
