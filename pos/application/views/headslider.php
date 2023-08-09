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
	if(!isset($title)){
      $slider_image=$title=$short_description=$link="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Add/Update Headslider</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>category/view"><?= $this->lang->line('headslider_list'); ?></a></li>
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
                    <label for="image" class="col-sm-2 control-label"><?= $this->lang->line('slider_image'); ?></label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="slider_image">
                        <span id="slider_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1290px * 400px & Size: 1MB </span>
                        <?php if($slider_image){ ?>
                            <a href="<?= base_url($slider_image) ?>" target="_blank">
                                <img src="<?= base_url($slider_image) ?>" alt="" width="50px">
                            </a>
                        <?php } ?>
                    </div>
                </div>

				<div class="form-group">
                  <label for="title" class="col-sm-2 control-label"><?= $this->lang->line('title'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $title; ?>" id="title" name="title" placeholder="">
					<span id="title_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="link" class="col-sm-2 control-label"><?= $this->lang->line('link'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $link; ?>" id="link" name="link" placeholder="">
					<span id="link_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
				<div class="form-group">
                  <label for="short_description" class="col-sm-2 control-label"><?= $this->lang->line('short_description'); ?></label>
                  <div class="col-sm-4">
                    <textarea type="text" class="form-control" id="short_description" name="short_description" placeholder=""><?php print $short_description; ?></textarea>
					<span id="short_description_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>

              </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($title!=""){
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

<script src="<?php echo $theme_link; ?>js/headslider.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
