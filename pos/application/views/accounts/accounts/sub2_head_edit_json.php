<?php echo form_open('accounts/accounts/sub2_head_list','id=loanAssign'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update head</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label>Master Head</label>
					<input type="hidden" name="fcoa_bkdn_id" value="<?php echo $sub2_head_edit['fcoa_bkdn_id'];?>" />
					<input type="text" class="form-control" value="<?php echo $sub2_head_edit['master_code']."-".$sub2_head_edit['fcoa_master'];?>" readonly>
				</div>
				
				<div class="col-sm-6">
					<label>Sub1 Head</label>
					<input type="text" class="form-control" value="<?php echo $sub2_head_edit['fcoa']."-".$sub2_head_edit['fcoa_code'];?>" readonly>
					<input type="hidden" name="fcoa_id" value="<?php echo $sub2_head_edit['fcoa_id'];?>" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label>Sub2 Head Name <span style="color:red;">*</span></label>
					<input type="text" class="form-control" name="fcoa_bkdn" id="fcoa_bkdn" value="<?= $sub2_head_edit['fcoa_bkdn'];?>" required />
				</div>
				
				<div class="col-sm-6">
					<label>Sub2 Head Code <span style="color:red;">*</span></label>
					<input type="text" class="form-control" name="bkdn_code" id="bkdn_code" value="<?= $sub2_head_edit['bkdn_code'];?>" onkeyup="removeChar(this)" required />
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<label>Opening Balance</label>
					<input type="text" class="form-control" name="bkdn_balance" id="bkdn_balance" value="<?= $sub2_head_edit['bkdn_balance'];?>" onkeyup="removeChar(this)">
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
	</form>