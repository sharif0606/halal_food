<!DOCTYPE html>
<html>
   <head>
  <!-- TABLES CSS CODE -->
  <?php include"comman/code_css_form.php"; ?>
  <!-- </copy> -->
  <!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.css" rel="stylesheet">


  </head>
   <body class="hold-transition skin-blue  sidebar-mini">

    <!-- **********************MODALS***************** -->
    <?php include"modals/modal_brand.php"; ?>
    <?php include"modals/modal_category.php"; ?>
    <?php include"modals/modal_unit.php"; ?>
    <?php include"modals/modal_tax.php"; ?>
    <!-- **********************MODALS END***************** -->

      </div>
      <div class="wrapper">
      <?php include"sidebar.php"; ?>
      <?php
         if(!isset($item_name)){
         $custom_barcode ='';
         $item_name=$opening_stock=$item_code=$brand_id=$category_id=$subcategory_id=$childcategory_id=$gst_percentage=$tax_type=$warehouse_id=
         $sales_price=$purchase_price=$profit_margin=$unit_id=$price=$alert_qty=
         $lot_number=$wholesale_price=$item_image=$item_image_two=
         $item_image_three=$item_image_four=$item_image_five=$weight=$is_feature=$is_latest=$is_top=$is_review=$short_description=$long_description="";
         $stock = $old_price=0;
         $expire_date ='';
         $description ='';
         $final_price ='';
          $tax_id='';
          $sku=$hsn=time();
         }
         $new_opening_stock ='';
         $adjustment_note ='';
         ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <h1>
               <?= $page_title;?>
               <small>Add/Update Items</small>
            </h1>
            <ol class="breadcrumb">
               <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
               <li><a href="<?php echo $base_url; ?>items"><?= $this->lang->line('items_list'); ?></a></li>
               <li class="active"><?= $page_title;?></li>
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
                  <div class="box box-info ">

                      <?= form_open('#', array('class' => 'form', 'id' => 'items-form', 'enctype'=>'multipart/form-data', 'method'=>'POST'));?>
                        <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
                        <div class="box-body">
                           <div class="row">
                            <div class="form-group col-md-4">
                                <label for="item_name"><?= $this->lang->line('item_name'); ?><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="" value="<?php print $item_name; ?>" >
                                <span id="item_name_msg" style="display:none" class="text-danger"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="brand_id">Brand</label>
                                <div class="input-group">
                                    <select class="form-control select2" id="brand_id" name="brand_id"  style="width: 100%;"  >
                                        <?php
                                            $query1="select * from db_brands where status=1";
                                            $q1=$this->db->query($query1);
                                            if($q1->num_rows($q1)>0){  echo '<option value="">-Select-</option>';
                                                foreach($q1->result() as $res1){
                                                    $selected = ($brand_id==$res1->id)? 'selected' : '';
                                                    echo "<option $selected value='".$res1->id."'>".$res1->brand_name."</option>";
                                                }
                                            } else {
                                        ?>
                                        <option value="">No Records Found</option>
                                        <?php } ?>
                                     </select>
                                    <span class="input-group-addon pointer" data-toggle="modal" data-target="#brand_modal" title="Add Customer"><i class="fa fa-plus-square-o text-primary fa-lg"></i></span>
                                </div>
                                <span id="brand_id_msg" style="display:none" class="text-danger"></span>
                            </div>
                              <div class="form-group col-md-4">
                                 <label for="category_id">Category <span class="text-danger">*</span></label>
                                 <!--<div class="input-group">-->
                                 <select onchange="$('#subcategory_id option').hide();$('.subopt'+this.value).show()" class="form-control select2" id="category_id" name="category_id"  style="width: 100%;"  value="<?php print $category_id; ?>">
                                    <?php
                                        $query1="select * from db_category where status=1";
                                        $q1=$this->db->query($query1);
                                        if($q1->num_rows($q1)>0){  echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1){
                                                $selected = ($category_id==$res1->id)? 'selected' : '';
                                                echo "<option $selected value='".$res1->id."'>".$res1->category_name."</option>";
                                            }
                                        }else{
                                    ?>
                                    <option value="">No Records Found</option>
                                    <?php } ?>
                                 </select>
                                  <!--<span class="input-group-addon pointer" data-toggle="modal" data-target="#category_modal" title="Add Category"><i class="fa fa-plus-square-o text-primary fa-lg"></i></span>
                                    </div>-->
                                 <span id="category_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="subcategory_id">Sub Category <span class="text-danger">*</span></label>
                                 <select onchange="$('#childcategory_id option').hide();$('.childopt'+this.value).show()" class="form-control" id="subcategory_id" name="subcategory_id"  style="width: 100%;"  value="<?= $subcategory_id; ?>">
                                    <?php
                                       $query1="select * from db_subcategory where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0){  echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1){
                                            $selected = ($subcategory_id==$res1->id)? 'selected' : '';
                                            echo "<option $selected value='".$res1->id."' class='subopt".$res1->category_id."'>".$res1->subcategory_name."</option>";
                                          }
                                        }else{
                                           ?>
                                    <option value="">No Records Found</option>
                                    <?php } ?>
                                 </select>
                                  <span id="subcategory_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="childcategory_id">Child Category <span class="text-danger">*</span></label>
                                 <select class="form-control" id="childcategory_id" name="childcategory_id"  style="width: 100%;"  value="<?= $childcategory_id; ?>">
                                    <?php
                                       $query1="select * from db_childcategory where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0){  echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1){
                                            $selected = ($childcategory_id==$res1->id)? 'selected' : '';
                                            echo "<option $selected value='".$res1->id."' class='childopt".$res1->subcategory_id."'>".$res1->childcategory_name."</option>";
                                          }
                                        }else{
                                           ?>
                                    <option value="">No Records Found</option>
                                    <?php } ?>
                                 </select>
                                  <span id="childcategory_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="unit_id" class="control-label"><?= $this->lang->line('unit'); ?><span class="text-danger">*</span></label>
                                 <div class="input-group">
                                 <select class="form-control select2" id="unit_id" name="unit_id"  style="width: 100%;" >
                                    <?php
                                       $query1="select * from db_units where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {
                                         echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1)
                                          {
                                            $selected = ($res1->id==$unit_id)? 'selected' : '';
                                            echo "<option $selected value='".$res1->id."'>".$res1->unit_name."</option>";
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
                                 <span class="input-group-addon pointer" data-toggle="modal" data-target="#unit_modal" title="Add Unit"><i class="fa fa-plus-square-o text-primary fa-lg"></i></span>
                                    </div>
                                 <span id="unit_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4 hidden">
                                 <label for="sku">SKU</label>
                                 <input type="text" class="form-control" id="sku" name="sku" placeholder="" value="<?php print $sku; ?>" >
                                 <span id="sku_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4 hidden">
                                 <label for="hsn" ><?= $this->lang->line('hsn'); ?></label>
                                 <input type="text" class="form-control" id="hsn" name="hsn" placeholder="" value="<?php print $hsn; ?>" >
                                 <span id="hsn_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4 hidden">
                                 <label for="alert_qty" ><?= $this->lang->line('minimum_qty'); ?></label>
                                 <input type="number" class="form-control no_special_char" id="alert_qty" name="alert_qty" placeholder="" min="0"  value="<?php print $alert_qty; ?>" >
                                 <span id="alert_qty_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4 hidden">
                                 <label for="lot_number" ><?= $this->lang->line('lot_number'); ?></label>
                                 <input type="text" class="form-control no_special_char" id="lot_number" name="lot_number" placeholder=""  value="<?php print $lot_number; ?>" >
                                 <span id="lot_number_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="custom_barcode" ><?= $this->lang->line('barcode'); ?></label>
                                 <input type="text" class="form-control" id="custom_barcode" name="custom_barcode" placeholder=""  value="<?php print $custom_barcode; ?>" >
                                 <span id="custom_barcode_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="item_image" class="form-label"><?= $this->lang->line('select_image'); ?></label>
                                 <input type="file" class="form-control" name="item_image" id="item_image">
                                 <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
                                 <?php if($item_image){ ?>
                                    <a href="<?= base_url($item_image) ?>" target="_blank">
                                       <img src="<?= base_url($item_image) ?>" alt="" width="50px">
                                    </a>
                                 <?php } ?>
                              </div>
                              <div class="form-group col-md-4">
                                 <!-- <label for="expire_date" ><?= $this->lang->line('expire_date'); ?></label> -->
                                 <div class="input-group date">
                                  <!-- <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                                  </div> -->
                                  <input type="hidden" class="form-control pull-right datepicker" id="expire_date" name="expire_date" value="00-00-0000">
                                </div>
                                 <span id="expire_date_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <!-- <div class="form-group col-md-4">
                                 <label for="item_image" class="form-label">Image two</label>
                                 <input type="file" class="form-control" name="item_image_two" id="item_image_two">
                                 <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
                                 <?php if($item_image_two){ ?>
                                    <a href="<?= base_url($item_image_two) ?>" target="_blank">
                                       <img src="<?= base_url($item_image_two) ?>" alt="" width="50px">
                                    </a>
                                 <?php } ?>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="item_image" class="form-label">Image three</label>
                                 <input type="file" class="form-control" name="item_image_three" id="item_image_three">
                                 <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
                                 <?php if($item_image_three){ ?>
                                    <a href="<?= base_url($item_image_three) ?>" target="_blank">
                                       <img src="<?= base_url($item_image_three) ?>" alt="" width="50px">
                                    </a>
                                 <?php } ?>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="item_image" class="form-label">Image four</label>
                                 <input type="file" class="form-control" name="item_image_four" id="item_image_four">
                                 <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
                                 <?php if($item_image_four){ ?>
                                    <a href="<?= base_url($item_image_four) ?>" target="_blank">
                                       <img src="<?= base_url($item_image_four) ?>" alt="" width="50px">
                                    </a>
                                 <?php } ?>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="item_image" class="form-label">Image five</label>
                                 <input type="file" class="form-control" name="item_image_five" id="item_image_five">
                                 <span id="item_image_msg" style="display:block;" class="text-danger">Max Width/Height: 1000px * 1000px & Size: 1MB </span>
                                 <?php if($item_image_five){ ?>
                                    <a href="<?= base_url($item_image_five) ?>" target="_blank">
                                       <img src="<?= base_url($item_image_five) ?>" alt="" width="50px">
                                    </a>
                                 <?php } ?>
                              </div> -->
                           </div>
                           <hr>
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <label for="price"><?= $this->lang->line('price'); ?><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control only_currency" id="price" name="price" placeholder="Price of Item without Tax"  value="<?php print $price; ?>" >
                                 <span id="price_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="purchase_price"><?= $this->lang->line('purchase_price'); ?><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control only_currency" id="purchase_price" name="purchase_price" placeholder="Total Price with Tax Amount"  value="<?php print $purchase_price; ?>" readonly='' >
                                 <span id="purchase_price_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="profit_margin"><?= $this->lang->line('profit_margin'); ?>(%) <i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $this->lang->line('based_on_purchase_price'); ?>" data-html="true" data-trigger="hover" data-original-title="">
                                  <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                                </i></label>
                                 <input type="text" class="form-control only_currency" id="profit_margin" name="profit_margin" placeholder="Profit in %"  value="<?php print $profit_margin; ?>" >
                                 <span id="profit_margin_msg" style="display:none" class="text-danger"></span>
                              </div>
                           </div>
                           <!-- /row -->
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <label for="sales_price" class="control-label"><?= $this->lang->line('sales_price'); ?><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control only_currency " id="sales_price" name="sales_price" placeholder="Sales Price"  value="<?php print $sales_price; ?>" >
                                 <span id="sales_price_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="final_price" class="control-label"><?= $this->lang->line('final_price'); ?><span class="text-danger">*</span></label>
                                 <input type="text" class="form-control only_currency " id="final_price" name="final_price" placeholder="Final Price"  value="<?php print $final_price; ?>" readonly >
                                 <span id="final_price_msg" style="display:none" class="text-danger"></span>
                              </div>
							         <div class="form-group col-md-4">
                                 <label for="old_price" class="control-label">Old price (For E-commerce)<span class="text-danger">*</span></label>
                                 <input type="text" class="form-control only_currency " id="old_price" name="old_price" placeholder="Old Price"  value="<?php print $old_price; ?>" >
                              </div>
                           </div>
                           <div class="row">
							         <div class="form-group col-md-4">
                                 <label for="weight" class="control-label">Weight</label>
                                 <input type="text" class="form-control " id="weight" name="weight"   value="<?php print $weight; ?>" >
                                 <span id="weight_msg" style="display:none" class="text-danger"></span>
                              </div>
							         <div class="form-group col-md-4">
                                 <label for="slied" class="control-label">Is Popular Product<span class="text-danger"></label>
                                 <select class="form-control" name="is_feature" id="is_feature" >
                                 <?php
                                    $yes_selected=$no_selected='';
                                    if($is_feature =='1') { $yes_selected='selected'; }
                                    if($is_feature =='0') { $no_selected='selected'; }

                                  ?>
                                    <option <?= $no_selected ?> value="0">No</option>
                                    <option <?= $yes_selected ?> value="1">Yes</option>

                                 </select>
                              </div>
							         <div class="form-group col-md-4">
                                 <label for="slied" class="control-label">Is Latest<span class="text-danger"></label>
                                 <select class="form-control" name="is_latest" id="is_latest" value="<?php print $is_latest; ?>">
                                 <?php
                                    $yes_selected=$no_selected='';
                                    if($is_latest =='1') { $yes_selected='selected'; }
                                    if($is_latest =='0') { $no_selected='selected'; }

                                  ?>
                                    <option <?= $no_selected ?> value="0">No</option>
                                    <option <?= $yes_selected ?> value="1">Yes</option>

                                 </select>
                              </div>
							         <div class="form-group col-md-4">
                                 <label for="slied" class="control-label">Is offer Product<span class="text-danger"></label>
                                 <select class="form-control" name="is_top" id="is_top" value="<?php print $is_top; ?>">
                                 <?php
                                    $yes_selected=$no_selected='';
                                    if($is_top =='1') { $yes_selected='selected'; }
                                    if($is_top =='0') { $no_selected='selected'; }

                                  ?>
                                    <option <?= $no_selected ?> value="0">No</option>
                                    <option <?= $yes_selected ?> value="1">Yes</option>

                                 </select>
                              </div>
							         <div class="form-group col-md-4">
                                 <label for="slied" class="control-label">Is Review<span class="text-danger"></label>
                                 <select class="form-control" name="is_review" id="is_review" value="<?php print $is_review; ?>">
                                 <?php
                                    $yes_selected=$no_selected='';
                                    if($is_review =='1') { $yes_selected='selected'; }
                                    if($is_review =='0') { $no_selected='selected'; }

                                  ?>
                                    <option <?= $no_selected ?> value="0">No</option>
                                    <option <?= $yes_selected ?> value="1">Yes</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group col-md-4">
                                 <!-- <label for="tax_id" ><?= $this->lang->line('tax'); ?><span class="text-danger">*</span></label> -->
                                 <div class="input-group">
                                 <input type="hidden" name="tax_id" value="1">
                                 <!-- <select class="form-control select2" id="tax_id" name="tax_id"  style="width: 100%;" >
                                    <?php
                                       $query1="select * from db_tax where status=1";
                                       $q1=$this->db->query($query1);
                                       if($q1->num_rows($q1)>0)
                                        {
                                            echo '<option data-tax="0" value="">-Select-</option>';
                                            foreach($q1->result() as $res1)
                                          {
                                            $selected = ($tax_id==$res1->id)? 'selected' : '';
                                            echo "<option $selected data-tax='".$res1->tax."' value='".$res1->id."'>".$res1->tax_name."(".$res1->tax."%)</option>";
                                          }
                                        }
                                        else
                                        {
                                           ?>
                                    <option value="">No Records Found</option>
                                    <?php
                                       }
                                       ?>
                                 </select> -->
                                 <!-- <span class="input-group-addon pointer" data-toggle="modal" data-target="#tax_modal" title="Add Tax"><i class="fa fa-plus-square-o text-primary fa-lg"></i></span> -->
                                    </div>
                                 <span id="tax_id_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <!-- <label for="tax_type"><?= $this->lang->line('tax_type'); ?><span class="text-danger">*</span></label> -->
                                 <input type="hidden" name="tax_type" value="Exclusive">
                                 <!-- <select class="form-control select2" id="tax_type" name="tax_type"  style="width: 100%;" >
                                  <?php
                                    $inclusive_selected=$exclusive_selected='';
                                    if($tax_type =='Inclusive') { $inclusive_selected='selected'; }
                                    if($tax_type =='Exclusive') { $exclusive_selected='selected'; }

                                  ?>
                                    <option <?= $exclusive_selected ?> value="Exclusive">Exclusive</option>
                                    <option <?= $inclusive_selected ?> value="Inclusive">Inclusive</option>
                                 </select> -->
                                 <span id="tax_type_msg" style="display:none" class="text-danger"></span>

                              </div>

                              <div class="form-group col-md-4">
                                 <!-- <label for="wholesale_price" class="control-label">Wholesale price<span class="text-danger">*</span></label> -->
                                 <input type="hidden" class="form-control only_currency " id="wholesale_price" name="wholesale_price" placeholder="Whole sale Price"  value="0" >
                                 <span id="wholesale_price_msg" style="display:none" class="text-danger"></span>
                              </div>
                           <!-- /row -->
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <label for="custom_barcode" ><?= $this->lang->line('description'); ?></label>
                                 <textarea type="text" class="form-control summernote" id="description" name="description" placeholder=""><?php print $description; ?></textarea>
                                 <span id="description_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="short_description" >Additional Information </label>
                                 <textarea type="text" class="form-control summernote" id="short_description" name="short_description"><?php print $short_description; ?></textarea>
                                 <span id="description_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="long_description" >Long Description</label>
                                 <textarea type="text" class="form-control summernote" id="long_description" name="long_description"><?php print $long_description; ?></textarea>
                                 <span id="description_msg" style="display:none" class="text-danger"></span>
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <label for="current_opening_stock"><?= $this->lang->line('current_opening_stock'); ?></label>
                                 <input type="text" class="form-control only_currency" id="current_opening_stock" name="current_opening_stock" placeholder="" readonly=""  value="<?php print $stock; ?>" >
                                 <span id="current_opening_stock_msg" style="display:none" class="text-danger"></span>
                              </div>
                              <div class="form-group col-md-4">
                                 <label for="new_opening_stock"><?= $this->lang->line('adjust_stock'); ?> <i class="hover-q " data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $this->lang->line('stock_adjustment_msg'); ?>" data-html="true" data-trigger="hover" data-original-title="">
                                  <i class="fa fa-info-circle text-maroon text-black hover-q"></i>
                                </i></label>
                                 <input type="text" class="form-control" id="new_opening_stock" name="new_opening_stock" placeholder="-/+"  value="<?php print $new_opening_stock; ?>" >
                                 <span id="new_opening_stock_msg" style="display:none" class="text-danger"></span>
                              </div>
                            <div class="form-group col-md-4">
                                <label for="warehouse_id">Warehouse</label>
                                <select class="form-control select2" id="warehouse_id" name="warehouse_id"  style="width: 100%;"  >
                                    <?php
                                        $query1="select * from db_warehouse where status=1";
                                        $q1=$this->db->query($query1);
                                        if($q1->num_rows($q1)>0){  echo '<option value="">-Select-</option>';
                                            foreach($q1->result() as $res1){
                                                $selected = ($res1->id==$warehouse_id)? 'selected' : '';
                                                echo "<option $selected value='".$res1->id."'>".$res1->warehouse_name."</option>";
                                            }
                                        } else {
                                    ?>
                                    <option value="">No Records Found</option>
                                    <?php } ?>
                                </select>
                                <span id="warehouse_id_msg" style="display:none" class="text-danger"></span>
                            </div>
                              <div class="form-group col-md-4">
                                 <label for="adjustment_note" ><?= $this->lang->line('adjustment_note'); ?></label>
                                 <textarea type="text" class="form-control" id="adjustment_note" name="adjustment_note" placeholder=""><?php print $adjustment_note; ?></textarea>
                                 <span id="adjustment_note_msg" style="display:none" class="text-danger"></span>
                              </div>
                           </div>
                           <!-- /row -->
                           <!-- /.box-body -->
                           <div class="box-footer">
                              <div class="col-sm-8 col-sm-offset-2 text-center">
                                 <!-- <div class="col-sm-4"></div> -->
                                 <?php
                                    if($item_name!=""){
                                         $btn_name="Update";
                                         $btn_id="update";
                                         ?>
                                 <input type="hidden" name="q_id" id="q_id" value="<?php echo $q_id;?>"/>
                                    <?php } else{
                                            $btn_name="Save";
                                            $btn_id="save";
                                    } ?>
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
                     <?= form_close(); ?>
                     </div>
                     <!-- /.box -->
                  </div>
                  <!--/.col (right) -->
               </div>
               <div class="col-md-12">

                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title text-blue"><?= $this->lang->line('opening_stock_adjustment_records'); ?></h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body table-responsive no-padding">

                        <table class="table table-bordered table-hover " id="report-data" >
                          <thead>
                          <tr class="bg-gray">
                            <th style="">#</th>
                            <th style=""><?= $this->lang->line('entry_date'); ?></th>
                            <th style=""><?= $this->lang->line('stock'); ?></th>
                            <th style=""><?= $this->lang->line('note'); ?></th>
                            <!--<th style=""><?= $this->lang->line('action'); ?></th>-->
                          </tr>
                          </thead>
                          <tbody>
                              <?php
                                if(isset($q_id)){
                                  $q3 = $this->db->query("select * from db_stockentry where item_id=$q_id");
                                  if($q3->num_rows()>0){
                                    $i=1;
                                    $total_paid = 0;
                                    foreach ($q3->result() as $res3) {
                                      echo "<td>".$i."</td>";
                                      echo "<td>".show_date($res3->entry_date)."</td>";
                                      echo "<td>".$res3->qty."</td>";
                                      echo "<td>".$res3->note."</td>";
                                      //echo '<td><i class="fa fa-trash text-red pointer" onclick="delete_stock_entry('.$res3->id.')"> Delete</i></td>';
                                      echo "</tr>";
                                      $i++;
                                    }
                                  }
                                  else{
                                    echo "<tr><td colspan='5' class='text-center text-bold'>No Previous Stock Entry Found!!</td></tr>";
                                  }
                                }
                                else{
                                  echo "<tr><td colspan='5' class='text-center text-bold'>No Previous Stock Entry Found!!</td></tr>";
                                }
                              ?>
                           </tbody>
                        </table>


                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
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
      <script>
            $('#subcategory_id option').hide();
            $('#childcategory_id option').hide();
          $('.subopt<?= $category_id ?>').show()
          $('.childopt<?= $subcategory_id ?>').show()
      </script>
      <script src="<?php echo $theme_link; ?>js/items.js?v=5889"></script>
      <script src="<?php echo $theme_link; ?>js/modals.js"></script>
      <!-- Make sidebar menu hughlighter/selector -->
      <script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
      <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
      <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
      <script>
    $(document).ready(function() {
        $('.summernote').summernote('code');
    });
  </script>
   </body>
</html>
