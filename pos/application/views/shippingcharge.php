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
	if(!isset($district_id)){
      $district_id=$shipping_charge="";
	}
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title;?>
        <small>Add/Update Shipping Charge</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $base_url; ?>shippingcharge/view"><?= $this->lang->line('shippingcharge_list'); ?></a></li>
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
                     <label for="district_id" class="col-sm-2 control-label"><?= $this->lang->line('district'); ?><span class="text-danger">*</span></label>
                     <div class="col-sm-4 input-group">
                     <select class="form-control select2" id="district_id" name="district_id"  style="width: 100%;"  value="<?php print $district_id; ?>">
                        <?php
                           $query1="select * from districts";
                           $q1=$this->db->query($query1);
                           if($q1->num_rows($q1)>0)
                            {  echo '<option value="">-Select-</option>';
                                foreach($q1->result() as $res1)
                              {
                                $selected = ($district_id==$res1->id)? 'selected' : '';
                                echo "<option $selected value='".$res1->id."'>".$res1->bn_name."</option>";
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
                     <span id="category_id_msg" style="display:none" class="text-danger"></span>
                </div>
				<div class="form-group">
                  <label for="shipping_charge" class="col-sm-2 control-label"><?= $this->lang->line('shippingcharge'); ?></label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" value="<?php print $shipping_charge; ?>" id="shipping_charge" name="shipping_charge" placeholder="shipping charge">
					<span id="shipping_charge_msg" style="display:none" class="text-danger"></span>
                  </div>
                </div>

              </div>
              <!-- /.box-footer -->
              <div class="box-footer">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                   <!-- <div class="col-sm-4"></div> -->
                   <?php
                      if($district_id!=""){
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

<script src="<?php echo $theme_link; ?>js/shippingcharge.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
</body>
</html>
