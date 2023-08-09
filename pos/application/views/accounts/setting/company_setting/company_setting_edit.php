
	<form method="post" action="<?= base_url() ?>setting/company_setting/company_save">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Company Edit</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="name">Name </label>
					<input type="hidden" name="id" id="id" value="<?= $companyData['id'] ?>" />
					<input type="text" name="name" id="name" class="form-control" value="<?= $companyData['name'] ?>" required />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="shortName">Name In Bangla</label>
					<input type="text" name="shortName" id="shortName" class="form-control" value="<?= $companyData['shortName'] ?>" required />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="country">Country </label>
					<select name="country" id="country" class="form-control">
						<?php if($countryList){ foreach($countryList as $cL){?>
						<option value="<?= $cL->id ?>" <?php if($companyData['country']==$cL->id) echo "selected"; ?>><?= $cL->name ?></option>
						<?php } } ?>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label for="address">Address </label>
					<textarea name="address" id="address" class="form-control"><?= $companyData['address'] ?></textarea>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="representativeName">Representative Name </label>
					<input type="text" name="representativeName" id="representativeName" class="form-control" value="<?= $companyData['representativeName'] ?>" />
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="designations">Designations</label>
					<input type="text" name="designations" id="designations" class="form-control" value="<?= $companyData['designations'] ?>" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="contact">Contact</label>
					<input type="text" name="contact" id="contact" class="form-control" value="<?= $companyData['contact'] ?>" />
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<label for="email">Email</label>
					<input type="text" name="email" id="email" class="form-control" value="<?= $companyData['email'] ?>" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<?php $professions=explode(',',$companyData['profession']); ?>
					<label for="profession">Profession </label>
					<select id="profession" class="form-control multiselect" multiple="">
						<?php if($professionList){ foreach($professionList as $pL){?>
						<option value="<?= $pL->id ?>" <?php if (in_array($pL->id, $professions)) echo 'selected'; ?>><?= $pL->name ?></option>
						<?php } } ?>
					</select>
					<input type="hidden" name="profession" class="professionedit" value="<?= $companyData['profession'] ?>"/>
				</div>
			</div>
		</div>
      </div>
	  
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
	</form>


<!-- inline scripts related to this page -->
<script type="text/javascript">

function get_all_selectededit(){
	var brands = $('.multiselect-selected .ace');
	var selected = [];
	$(brands).each(function(index, brand){
		selected.push([$(this).val()]);
	});
	$('.professionedit').val(selected);
}

		////////////////// Datatables Multiselect
		$('.multiselect').multiselect({
		 enableFiltering: true,
		 enableHTML: true,
		 selectedClass: 'multiselect-selected',
		 buttonClass: 'btn btn-white btn-primary',
		 onChange: function(option, checked, select) {
                get_all_selectededit();
            },
		 templates: {
			button: '<button style="width:100%" type="button" class="multiselect dropdown-toggle" data-toggle="dropdown"><span class="multiselect-selected-text"></span> &nbsp;<b class="fa fa-caret-down"></b></button>',
			ul: '<ul style="width:100%" class="multiselect-container dropdown-menu"></ul>',
			filter: '<li class="multiselect-item filter"><div class="input-group"><span class="input-group-addon"><i class="fa fa-search"></i></span><input class="form-control multiselect-search" type="text"></div></li>',
			filterClearBtn: '<span class="input-group-btn"><button class="btn btn-default btn-white btn-grey multiselect-clear-filter" type="button"><i class="fa fa-times-circle red2"></i></button></span>',
			li: '<li><a tabindex="0"><label></label></a></li>',
	        divider: '<li class="multiselect-item divider"></li>',
	        liGroup: '<li class="multiselect-item multiselect-group"><label></label></li>'
		 }
		});
	
</script>