<!DOCTYPE html>
<html>
<head>
<!-- FORM CSS CODE -->
<?php include"comman/code_css_form.php"; ?>
<!-- </copy> -->  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <?php include"sidebar.php"; ?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?= $this->lang->line('send_sms'); ?>
       <span style="display: inline-block;width: 84%;text-align: center;">Balance: <?= $balance ?></span>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $base_url; ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $this->lang->line('send_sms'); ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        
            <?php if($this->session->flashdata('message')){ ?>
                <?php echo $this->session->flashdata('message'); ?>
            <?php } ?>
        <div class="row">
          <!-- Horizontal Form  -->
            <div class="col-md-6">
             <div class="box box-primary">
                <!-- <form role="form" id="sms-form" onkeypress="return event.keyCode != 13;">  -->
                <form role="form" method="post" id="sms-form" action="<?= $base_url; ?>sms/bulksmsindv" onsubmit="return confirm('you are sending message to all customer. Are you sure?')">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                  <input type="hidden" id="base_url" value="<?php echo $base_url; ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="mobile"><?= $this->lang->line('mobile'); ?> <span class="text-danger">*</span></label>
                      <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Mobile 1,Mobile 2,...">
                      <span id="mobile_msg" style="display:none" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label for="message"><?= $this->lang->line('message'); ?> <span class="text-danger">*</span></label>
                      <textarea type="text" class="form-control" id="message" name="message" placeholder=""></textarea>
                      <b id="smsCount"></b> SMS (<b id="smsLength"></b>) Characters left
                      <span id="message_msg" style="display:none" class="text-danger"></span>
                    </div>
                  
                  </div>
                  <div class="box-footer">
                
                  <button type="submit" class="btn btn-success" title="Send SMS">Send</button>
                
                <a href='<?php echo $base_url; ?>dashboard'><button type="button" class="btn btn-danger" title="Go Dashboard">Close</button></a>
                  </div>
                </form>
              </div>
            </div>
     
<!-- Horizontal Form -->
          <div class="col-md-6">
         <div class="box box-primary">
           <h3 class="text-center" style="margin-bottom: 2px;">
               Customer SMS
                <br>
                Total customer: <?php $customer=$this->db->query("SELECT count(id) as tc FROM `db_customers` WHERE LENGTH(`mobile`) = 11")->row();
                    if($customer)
                        echo $customer->tc;
                ?>
           </h3>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" id="sms-form" action="<?= $base_url; ?>sms/bulksmscustomer" onsubmit="return confirm('you are sending message to all customer. Are you sure?')">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
              
              <div class="box-body">
                <div class="form-group">
                  <label for="message"><?= $this->lang->line('message'); ?> <span class="text-danger">*</span></label>
                  <textarea type="text" class="form-control" id="custmessage" name="message" placeholder=""></textarea>
                  <b id="smsCountcust"></b> SMS (<b id="smsLengthcust"></b>) Characters left
                  <span id="message_msg" style="display:none" class="text-danger"></span>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" id="send" class="btn btn-success" title="Send SMS">Send</button>
                  <a href='<?php echo $base_url; ?>dashboard'><button type="button" class="btn btn-danger" title="Go Dashboard">Close</button></a>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
          <div class="col-md-6">
         <div class="box box-primary">
           <h3 class="text-center">Supplier SMS
            <br>
                Total supplier: <?php $supplier=$this->db->query("SELECT count(id) as tc FROM `db_suppliers` WHERE LENGTH(`mobile`) = 11")->row();
                    if($supplier)
                        echo $supplier->tc;
                ?>
           </h3>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" id="sms-form" action="<?= $base_url; ?>sms/bulksmssupplier" onsubmit="return confirm('you are sending message to all customer. Are you sure?')">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
              
              <div class="box-body">
                <div class="form-group">
                  <label for="message"><?= $this->lang->line('message'); ?> <span class="text-danger">*</span></label>
                  <textarea type="text" class="form-control" id="supmessage" name="message" placeholder=""></textarea>
                  <b id="smsCountsup"></b> SMS (<b id="smsLengthsup"></b>) Characters left
                  <span id="message_msg" style="display:none" class="text-danger"></span>
                </div>
              
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" id="send" class="btn btn-success" title="Send SMS">Send</button>
                  <a href='<?php echo $base_url; ?>dashboard'><button type="button" class="btn btn-danger" title="Go Dashboard">Close</button></a>
              </div>
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

<script src="<?php echo $theme_link; ?>js/sms.js"></script>
<!-- Make sidebar menu hughlighter/selector -->
<script>$(".<?php echo basename(__FILE__,'.php');?>-active-li").addClass("active");</script>
<script>
   
(function($){
    $.fn.smsArea = function(options){

    var
    e = this,
    cutStrLength = 0,

    s = $.extend({

        cut: true,
        maxSmsNum: 3,
        interval: 400,

        counters: {
            message: $('#smsCount'),
            character: $('#smsLength')
        },

        lengths: {
            ascii: [160, 320, 480, 640, 800, 960, 1120, 1280],
            unicode: [70, 140, 210, 280, 350, 420, 490, 560]
        }
    }, options);


    e.keyup(function(){

        clearTimeout(this.timeout);
        this.timeout = setTimeout(function(){

            var
            smsType,
            smsLength = 0,
            smsCount = -1,
            charsLeft = 0,
            text = e.val(),
            isUnicode = false;

            for(var charPos = 0; charPos < text.length; charPos++){
                switch(text[charPos]){
                    case "\n": 
                    case "[":
                    case "]":
                    case "\\":
                    case "^":
                    case "{":
                    case "}":
                    case "|":
                    case "€":
                        smsLength += 2;
                    break;

                    default:
                        smsLength += 1;
                }


                if(text.charCodeAt(charPos) > 127 && text[charPos] != "€") isUnicode = true;
            }

            if(isUnicode){
                smsType = s.lengths.unicode;

            }else{
                smsType = s.lengths.ascii;
            }

            for(var sCount = 0; sCount < s.maxSmsNum; sCount++){

                cutStrLength = smsType[sCount];
                if(smsLength <= smsType[sCount]){

                    smsCount = sCount + 1;
                    charsLeft = smsType[sCount] - smsLength;
                    break
                }
            }

            if(s.cut) e.val(text.substring(0, cutStrLength));
            smsCount == -1 && (smsCount = s.maxSmsNum, charsLeft = 0);

            s.counters.message.html(smsCount);
            s.counters.character.html(charsLeft);

        }, s.interval)
    }).keyup()
}}(jQuery));

 $('#message').smsArea();
 $('#custmessage').smsArea({counters:{message:$('#smsCountcust'),character: $('#smsLengthcust')}});
 $('#supmessage').smsArea({counters:{message:$('#smsCountsup'),character: $('#smsLengthsup')}});
</script>
</body>
</html>
