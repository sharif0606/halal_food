<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
    #invoice{
    padding: 30px;
    }
    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
        padding: 15px
    }
    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }
    .invoice .company-details {
        text-align: right
    }
    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }
    .invoice .contacts {
        margin-bottom: 20px
    }
    .invoice .invoice-to {
        text-align: left
    }
    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }
    .invoice .invoice-details {
        text-align: right
    }
    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }
    .invoice main {
        padding-bottom: 50px
    }
    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }
    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }
    .invoice main .notices .notice {
        font-size: 1.2em
    }
    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }
    .invoice table td,.invoice table th {
        padding: 15px;
        /* background: #eee; */
        border-bottom: 1px solid #fff
    }
    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }
    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        /* color: #3989c6; */
        font-size: 1.2em
    }
    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }
    .invoice table .no {
        color: #130202;
        font-size: 1.6em;
        /* background: #3989c6 */
    }
    .invoice table .unit {
        /* background: #ddd */
    }
    .invoice table .total {
        /* background: #3989c6; */
        /* color: #140202 */
    }
    .invoice table tbody tr:last-child td {
        border: none
    }
    .invoice table tfoot td {
        /* background: 0 0; */
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }
    .invoice table tfoot tr:first-child td {
        border-top: none
    }
    .invoice table tfoot tr:last-child td {
        /* color: #3989c6; */
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }
    .invoice table tfoot tr td:first-child {
        border: none
    }
    .invoice footer {
        width: 100%;
        text-align: center;
        /* color: #777; */
        border-top: 1px solid #aaa;
        padding: 8px 0
    }
    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }
        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }
        .invoice>div:last-child {
            page-break-before: always
        }
    }
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<!------ Include the above in your HEAD tag ---------->

<div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info no-print"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info no-print" onclick="history.back()">Go Back</button>
            <!-- <a class="btn btn-info no-print" href="#">Back</a> -->
        </div>
        <hr>
    </div>
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="#">
                            <img src="<?= base_url('uploads/fsettings_image/'.$frontsettings->logo_img) ?>" height="60px" width="120px" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="#">
                                Albaik
                            </a>
                        </h2>
                        <div>khatunganj,Chittagong</div>
                        <div>0170000000</div>
                        <div>albaik@gmail.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to"><?= $billings->name ?></h2>
                        <div class="address"> <i class="fa fa-home" aria-hidden="true"></i> <?= $billings->address?></div>
                        <div class="phoneNumber"> <i class="fa fa-mobile" aria-hidden="true"></i><?= $billings->phone_number?></div>
                        <div class="email"><a href="#"> <i class="fa fa-envelope" aria-hidden="true"></i> <?= $billings->email?></a></div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE #<?php echo str_pad($billings->id,3,'0',STR_PAD_LEFT)?></h1>
                        <div class="date">Date of Invoice: <?php echo date('d/m/Y', strtotime($billings->created_at)); ?></div>
                        <!-- <div class="date">Due Date: {{ $order->created_at->format('d/m/Y') }}</div> -->
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr style="border-bottom: 2px solid;">
                            <th>#SL</th>
                            <th class="text-left">PRODUCT NAME</th>
                            <th class="text-right">QUANTITY</th>
                            <th class="text-right">UNIT PRICE</th>
                            <th class="text-right">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_details as $i=>$item){?>
                        <tr style="border-bottom: 2px solid;">
                            <td class="no"><?php echo ++$i; ?></td>
                            <td class="text-left">
                                <h3>
                                <?php echo $item->item_name; ?>
                                </h3>
                            </td>
                            <td class="qty"><?php echo $item->product_qty; ?></td>
                            <td class="unit"><?php echo $item->product_price; ?> BDT</td>
                            <td class="total"><?php echo $item->product_qty*$item->product_price; ?> BDT</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Discount </td>
                            <td colspan="2"> (-)<?php echo $orders?->discount_amount ; ?> BDT</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo $orders?->total ; ?> BDT</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo $orders?->total ; ?> BDT</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
            </main>
            <footer>
                Invoice was created on a computer and is invalid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
</div>
<script>
     $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data)
            {
                window.print();
                return true;
            }
        });
</script>
