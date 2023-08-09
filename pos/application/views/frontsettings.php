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
	if(!isset($phone)){
      $popular_icon=$offer_icon=$logo_img=$description=$address=$phone=$email=$facebooklink=$twitterlink=$linkdinlink=$youtubelink="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Add/Update Front Settings</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>frontsettings/view"><?= $this->lang->line('frontsettings_list'); ?></a></li>
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
                    <label for="popular_icon" class="col-sm-2 control-label"><?= $this->lang->line('popular_icon'); ?></label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="popular_icon">
                        <span id="popular_icon_msg" style="display:block;" class="text-danger">Max Width/Height: 20px *20px & Size: 1MB </span>
                        <?php if($popular_icon){ ?>
                            <a href="<?= base_url($popular_icon) ?>" target="_blank">
                                <img src="<?= base_url($popular_icon) ?>" alt="" width="50px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="offer_icon" class="col-sm-2 control-label"><?= $this->lang->line('offer_icon'); ?></label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="offer_icon">
                        <span id="offer_icon_msg" style="display:block;" class="text-danger">Max Width/Height: 20px * 20px & Size: 1MB </span>
                        <?php if($offer_icon){ ?>
                            <a href="<?= base_url($offer_icon) ?>" target="_blank">
                                <img src="<?= base_url($offer_icon) ?>" alt="" width="50px">
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo_img" class="col-sm-2 control-label"><?= $this->lang->line('logo_img'); ?></label>
                    <div class="col-sm-4">
                        <input type="file" class="form-control" name="logo_img">
                        <span id="logo_img_msg" style="display:block;" class="text-danger">Max Width/Height: 400px * 100px & Size: 1MB </span>
                        <?php if($logo_img){ ?>
                            <a href="<?= base_url($logo_img) ?>" target="_blank">
                                <img src="<?= base_url($logo_img) ?>" alt="" width="50px">
                            </a>
                        <?php } ?>
                    </div>
                </div>

				<div class="form-group">
                  <label for="address" class="col-sm-2 control-label"><?= $this->lang->line('address'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $address; ?>" id="address" name="address" placeholder="">
					<span id="address_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label"><?= $this->lang->line('phone'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $phone; ?>" id="phone" name="phone" placeholder="">
					<span id="phone_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label"><?= $this->lang->line('email'); ?></label>
                  <div class="col-sm-4">
                    <input type="email" class="form-control" value="<?php print $email; ?>" id="email" name="email" placeholder="">
					<span id="email_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="facebooklink" class="col-sm-2 control-label"><?= $this->lang->line('facebooklink'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $facebooklink; ?>" id="facebooklink" name="facebooklink" placeholder="">
					<span id="facebooklink_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="twitterlink" class="col-sm-2 control-label"><?= $this->lang->line('twitterlink'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $twitterlink; ?>" id="twitterlink" name="twitterlink" placeholder="">
					<span id="twitterlink_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="linkdinlink" class="col-sm-2 control-label"><?= $this->lang->line('linkdinlink'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $linkdinlink; ?>" id="linkdinlink" name="linkdinlink" placeholder="">
					<span id="linkdinlink_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="youtubelink" class="col-sm-2 control-label"><?= $this->lang->line('youtubelink'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $youtubelink; ?>" id="youtubelink" name="youtubelink" placeholder="">
					<span id="youtubelink_msg" style="display:none" class="text-danger"></span>
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
                      if($phone!=""){
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

<script src="<?php echo $theme_link; ?>js/frontsettings.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
