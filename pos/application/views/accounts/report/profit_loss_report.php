<style>
	
</style>
<div class="col-xs-12">
	<div class="clearfix">
		<div class="tableTools-container">
		<button class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold" onclick="printPageArea('display')"><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></button>
		</div>
	</div>
	<div class="table-header">
		আয় ব্যায় হিসাব
	</div>
	<!-- div.table-responsive -->
	<!-- div.dataTables_borderWrap -->
		<div id="display">
					<h4 class="vHide">Probati Somobay Somity Ltd</h4>
					<p class="vHide">Probati Laborer Co-Operative Organization</p>
					<p class="vHide">Jaker Tower(4th floor),Upzila Sadar, Boalkhali,Chittagong, Reg #12967, Established:2018</p>
					<p class="text-center vHide">আয় ব্যায় হিসাব</p>
			<table id="" class="table table-striped table-bordered table-hover" width="100%">
				<thead>
					<tr>
						<th>ব্যায় সমুহ</th>
						<th>চলতি মাসের</th>
						<th>চলতি বছরের</th>
						<th>আয় সমুহ</th>
						<th>চলতি মাসের</th>
						<th>চলতি বছরের</th>
					</tr>
				</thead>				
				<tbody>
					<tr>
						<td>বেতন ভাতা</td>
						<td></td>
						<td></td>
						<td>সার্ভিস চার্জ আদায়</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>অফিস ভাড়া</td>
						<td></td>
						<td></td>
						<td>ক্ষুদ্র  ঋণ মহিলা</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>মোবাইল ভাতা</td>
						<td></td>
						<td></td>
						<td>ক্ষুদ্র  উদ্যোগী ঋণ পুরুষ</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>বিদ্যুৎ বিল</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>আপ্যায়ন বিল</td>
						<td></td>
						<td></td>
						<td>মোট সার্ভিস চার্জ</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>ষ্টেশনারী বিল</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>ফটোকপি বিল</td>
						<td></td>
						<td></td>
						<td>অন্যান্য অ্যায়</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>ডাক বিল</td>
						<td></td>
						<td></td>
						<td>পাশ বই বিক্রি </td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>পত্রিকা বিল</td>
						<td></td>
						<td></td>
						<td>ভর্তি ফি আদায়</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>ঋণ ফরম ফি</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>অফিস রক্ষণাবেক্ষন </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>শেয়ার আমানত লাভ প্রধান </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
						<td>কম্পিউটার ব্যায়</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					</tr>
						<td>মোট ব্যায়</td>
						<td></td>
						<td></td>
						<td>মোট</td>
						<td></td>
						<td></td>
					</tr>
					</tr>
						<td>নীট লাভ</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					</tr>
						<td>মোট বায়</td>
						<td></td>
						<td></td>
						<td>মোট আয়</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<td>ম্যানেজার সাক্ষর</td>
					<td colspan="3"></td>
					<td>তারিখ এবং সময়</td>
					<td colspan="3"><?php $date = date('m/d/Y h:i:s a', time()); echo $date;?></td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
//print all report
	function printPageArea(areaID){
		var printContent = document.getElementById(areaID);
		var WinPrint = window.open('', '', 'width=900,height=650');
		WinPrint.document.write('<style type="text/css" media="print"> @page { font-size:12px; } table{font-size:12px;border-collapse: collapse;} table, td, th {border: 1px solid black;} table>thead>tr{border:none;} h4,p{text-align:center;padding:0;margin:0}</style>');
		WinPrint.document.write(printContent.innerHTML);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
	}
</script>
