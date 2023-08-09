<div class="animate-bottom">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>#SL</th>
				<th>Trans Date</th>
				<th>particulars</th>
				<th>Debit</th>
				<th>Credit</th>
				<th>Balance</th>
				<th>Details</th>
			</tr>
		</thead>
		<?php $balance_data=$accBalData['balance']; ?>
		<tbody>
			<tr>
				<td>1</td>
				<td><?= $startDate ?></td>
				<td>B/F</td>
				<td class="align-right"><?= $balance_data>=0?abs($balance_data):'' ?></td>
				<td class="align-right"><?= $balance_data<=0?abs($balance_data):'' ?></td>
				<td></td>
				<td>
					
				</td>
			</tr>
			<?php
				
				$i=2;
				$deb=0;
				$cre=0;
				$bal=0;
				//$accBalData['balance']<=0?$bal=$accBalData['balance']
				$bal=$balance_data;
				if($accData){ 
					foreach($accData as $ad){
					$deb+=$ad['dr'];
					$cre+=$ad['cr'];
					$bal+=$ad['dr'];
					$bal-=$ad['cr'];
				
			?>
			<tr>
				<td><?= $i ?></td>
				<td><?= date('d-m-Y',strtotime($ad['rec_date'])) ?></td>
				<td><?= $ad['journal_title'] ?></td>
				<td class="align-right"><?= $ad['dr'] ?></td>
				<td class="align-right"><?= $ad['cr'] ?></td>
				<td class="align-right"><?= $bal<0?abs($bal).' CR':$bal.' DR' ?></td>
				<td>
				    <?php if($ad['debit_voucher_id']){ ?>
					<a href="<?php echo base_url();?>accounts/debit_voucher_edit/<?php echo $ad['debit_voucher_id'];?>" title="Edit"><i class="fa fa-eye"></i></a>
				    <?php }else if($ad['credit_voucher_id']){ ?>
					<a href="<?php echo base_url();?>accounts/credit_voucher_edit/<?php echo $ad['credit_voucher_id'];?>" title="Edit"><i class="fa fa-eye"></i></a>
				    <?php }else if($ad['credit_voucher_id']){ ?>
					<a href="<?php echo base_url();?>accounts/journal_voucher_edit/<?php echo $ad['journal_voucher_id'];?>" title="Edit"><i class="fa fa-eye"></i></a>
					<?php } ?>
				</td>
			</tr>
			<?php $i++; }  ?>
			<?php }else{ ?>
				<tr>
					<td colspan="9"><center>No Data Found</center></td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="3" style="text-align:right">Total</th>
				<th class="align-right"><?= $deb ?></th>
				<th class="align-right"><?= $cre ?></th>
				<th class="align-right"><?= $bal<0?abs($bal).' CR':$bal.' DR' ?></th>
				<th></th>
			</tr>
		</tfoot>
	</table>
</div>