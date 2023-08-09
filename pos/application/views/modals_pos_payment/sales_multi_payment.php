<?php 
$rowcount = $this->input->post('payment_row_count') +1;
?>
<div class="row mt-1 payments_div_<?=$rowcount?>">
    <div class="col-md-3">
        <label for="paid_amount"><?= $this->lang->line('amount'); ?></label>
        <input type="text" class="form-control text-right only_currency paid_amount" onkeyup="paid_cal(this)">
        <input type="hidden" class="form-control text-right paid_amt only_currency amount" name="amount_<?= $rowcount;?>" placeholder="" >
    </div>
        
    <div class="col-md-3">
      <div class="">
        <label for="payment_type"><?= $this->lang->line('payment_type'); ?></label>
        <select class="form-control select2" id='payment_type' name="payment_type_<?= $rowcount;?>">
            <option>Select</option>
          <?php
            $q1=$this->db->query("select * from db_paymenttypes where status=1");
            if($q1->num_rows()>0)
                foreach($q1->result() as $res1)
                    echo "<option value='".$res1->payment_type."'>".$res1->payment_type ."</option>";
            else
                echo "<option>None</option>";
            ?>
        </select>
      </div>
    </div>
    <div class="col-md-5">
        <div class="">
            <label><?= $this->lang->line('payment_note'); ?></label>
            <input type="text" class="form-control" name="payment_note_<?= $rowcount;?>" placeholder="" />
        </div>
    </div>
    <div class="col-md-1">
        <button type="button" class="btn btn-box-tool" onclick="remove_row('<?=$rowcount?>')"><i class="fa fa-times fa-2x"></i></button>
    </div>
    <div class="clearfix"></div>
</div>