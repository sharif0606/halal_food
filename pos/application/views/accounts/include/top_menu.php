<div id="sidebar" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
	<script type="text/javascript">
		try{ace.settings.loadState('sidebar')}catch(e){}
	</script>

	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<button class="btn btn-success">
				<i class="ace-icon fa fa-signal"></i>
			</button>

			<button class="btn btn-info">
				<i class="ace-icon fa fa-pencil"></i>
			</button>

			<button class="btn btn-warning">
				<i class="ace-icon fa fa-users"></i>
			</button>

			<button class="btn btn-danger">
				<i class="ace-icon fa fa-cogs"></i>
			</button>
		</div>

		<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
			<span class="btn btn-success"></span>

			<span class="btn btn-info"></span>

			<span class="btn btn-warning"></span>

			<span class="btn btn-danger"></span>
		</div>
	</div><!-- /.sidebar-shortcuts -->

	<ul class="nav nav-list">
		<li class="hover <?php if($this->uri->segment(1)=="dashboard") {echo 'active open';}?>">
			<a href="<?= base_url() ?>">
				<i class="menu-icon fa fa-tachometer"></i>
				<span class="menu-text">POS</span>
			</a>
			<b class="arrow"></b>
		</li>
		
		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fa fa-cogs"></i>
				<span class="menu-text">
					Settings
				</span>
				</a>
				<b class="arrow fa fa-angle-down"></b>
				<ul class="submenu">
					<li class="">
						<a href="<?= base_url('accounts/');?>db_backup/Backup">
							<i class="menu-icon  fa fa-database"></i>
							BackUp Database
						</a>
					    <b class="arrow"></b>
					</li>
					<li class="">
						<a href="<?= base_url('accounts/');?>cornjob">
							<i class="menu-icon  fa fa-database"></i>
							POS to Accounts
						</a>
					    <b class="arrow"></b>
					</li>
				</ul>
		</li>
		
		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fas fa-calculator"></i>
				<span class="menu-text">Accounts</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

				<ul class="submenu">
				<li class="<?php //if(!in_array("mHead", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>accounts/master_head_list">
						<i class="menu-icon fa fa-caret-right"></i>
						<span class="menu-text"> Master Head </span>
					</a>
				</li>
				<li class="<?php //if(!in_array("s1Head", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>accounts/sub1_head_list">
						<i class="menu-icon fa fa-caret-right"></i>
						<span class="menu-text"> Sub1 Head </span>
					</a>
				</li>
				<li class="<?php //if(!in_array("s2Head", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>accounts/sub2_head_list">
						<i class="menu-icon fa fa-caret-right"></i>
						<span class="menu-text"> Sub2 Head </span>
					</a>
				</li>
				<li class="<?php //if(!in_array("s3Head", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>accounts/sub3_head_list">
						<i class="menu-icon fa fa-caret-right"></i>
						<span class="menu-text"> Sub3 Head </span>
					</a>
				</li>
				<li class="<?php //if(!in_array("nvHead", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>accounts/navigation_head_view">
						<i class="menu-icon fa fa-caret-right"></i>
						<span class="menu-text"> Navigation Head View </span>
					</a>
				</li>
				<li>
					<a href="#" class="dropdown-toggle">
						<!--<i class="menu-icon fa fa-pencil orange"></i>-->
						Voucher
						<b class="arrow fa fa-angle-down"></b>
					</a>

					<b class="arrow"></b>

					<ul class="submenu">
						<li class="<?php //if(!in_array("vEntry", $accArea) && $sup!=1){ echo "hidden"; } ?>  hover">
							<a href="<?= base_url('accounts/');?>accounts/debit_voucher_list">
								<i class="menu-icon fa fa-caret-right"></i>
								Payment Voucher
							</a>

							<b class="arrow"></b>
						</li>
						<li class="<?php //if(!in_array("vEntry", $accArea) && $sup!=1){ echo "hidden"; } ?>  hover">
							<a href="<?= base_url('accounts/');?>accounts/credit_voucher_list">
								<i class="menu-icon fa fa-caret-right"></i>
								Receive Voucher
							</a>

							<b class="arrow"></b>
						</li>
						<li class="<?php //if(!in_array("vEntry", $accArea) && $sup!=1){ echo "hidden"; } ?>  hover">
							<a href="<?= base_url('accounts/');?>accounts/journal_voucher_list">
								<i class="menu-icon fa fa-caret-right"></i>
								Journal Voucher
							</a>

							<b class="arrow"></b>
						</li>
					</ul>
				</li>
			</ul>
		
		</li>
		
		
		<li class="hover">
			<a href="#" class="dropdown-toggle">
				<i class="menu-icon fas fa-list"></i>
				<span class="menu-text">Accounts report</span>

				<b class="arrow fa fa-angle-down"></b>
			</a>

			<b class="arrow"></b>

				<ul class="submenu">
				<li class="<?php //if(!in_array("vList", $accArea) && $sup!=1){ echo "hidden"; } ?> hover" >
					<a href="<?= base_url('accounts/');?>accounts/trial_balance">
						<i class="menu-icon fa fa-caret-right"></i>
						Trial Balance
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?php //if(!in_array("vList", $accArea) && $sup!=1){ echo "hidden"; } ?> hover" >
					<a href="<?= base_url('accounts/');?>report/acc_head_report">
						<i class="menu-icon fa fa-caret-right"></i>
						Account Head Report
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?php //if(!in_array("vList", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>report/profit_loss_report">
						<i class="menu-icon fa fa-caret-right"></i>
						Profit Loss Report
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?php //if(!in_array("vList", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>report/receipt_payment_report">
						<i class="menu-icon fa fa-caret-right"></i>
						Receipt Payment Report
					</a>
					<b class="arrow"></b>
				</li>
				<li class="<?php //if(!in_array("vList", $accArea) && $sup!=1){ echo "hidden"; } ?> hover">
					<a href="<?= base_url('accounts/');?>report/balance_sheet_report">
						<i class="menu-icon fa fa-caret-right"></i>
						Balance Sheet Report
					</a>
					<b class="arrow"></b>
				</li>
				
			</ul>
		
		</li>
		
		
			<div class="hidden-sm hidden-xs pull-right">
				<button type="button" class="sidebar-collapse btn btn-white btn-primary" data-target="#sidebar">
					<i class="ace-icon fa fa-angle-double-up" data-icon1="ace-icon fa fa-angle-double-up" data-icon2="ace-icon fa fa-angle-double-down"></i>
						Collapse/Expand Menu
				</button>
			</div>
	</ul><!-- /.nav-list -->
</div>