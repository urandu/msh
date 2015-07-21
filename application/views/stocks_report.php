<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Stock report</h2>
            <!--<ol class="breadcrumb">
                <li>
                    <a href="index.html">This is</a>
                </li>
                <li class="active">
                    <strong>Breadcrumb</strong>
                </li>
            </ol>-->
        </div>
        <div class="col-sm-8">
            <!--<div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>-->
        </div>
    </div>

    <div class="wrapper wrapper-content">

         <table class="table">
            <thead>
        <tr><h3>Central level stocks and Pending shipments</h3></tr>
        <br>
        <tr>
            <th>
                Stock on hand(SOH)

            </th>
            <th></th>
            <th></th>
            <th></th>

            <th>
                Pending Shipments
            </th>
        </tr>
        <tr>
            <th>Commodity</th>
            <th>Unit</th>
            <th>Central SOH</th>
            <th>Total</th>
            <th>Source: Quantity</th>
            </thead>
        </tr>
        <tbody>
        <?php foreach ($COMMODITY as $item): ?>
            <tr>
                <td><?php echo $item->commodity_name; ?></td>
                <td>Unit</td>
                <?php $total_stock = 0; foreach ($CENTRAL as $central_value): 
                if ($item->commodity_id == $central_value->commodity_id) {
                        $stock_available =  $central_value->soh_closing_balance;
                        $total_stock += $stock_available;
                    }
                endforeach;
                ?>
                <td>
                    <?php echo $total_stock; ?>
                </td>
                <td></td>
                <?php $item_total = 0;
                foreach ($PSTOCKS as $pending_value): 
                    if ($item->commodity_id == $pending_value->commodity_id) {
                        $item_total += $pending_value->quantity;}
                endforeach;
                ?>
                <td>
                    <?php echo $item_total; ?>
                </td>
                <td></td>
                <td>
                   
                        <table class="table">
                            <thead>
                                <tr>
                                <th>Agency</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($FUNDING as $FA): ?><tr>
                                <td> <?php echo $FA->funding_agency_name; ?></td>
                                <?php $sum = 0; foreach ($PSTOCKS as $ps):
                                if (($item->commodity_id == $ps->commodity_id) && $FA->funding_agency_id == $ps->funding_agency_id) {
                                    $sum = $sum + $ps->quantity;
                                    //$date = $ps->expected_date_delivery;
                                    }
                                endforeach;
                                ?>
                                <td>
                                    <?php echo $sum; ?>
                                </td>

                            </tr>
                                <?php endforeach;?>

                            </tbody>
                        </table>
                </td>
                </tr>

        <?php endforeach; ?>
        </tbody>
    </table>

    </div>

<?php require_once("includes/footer.php"); ?>