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
                <td> <?php $total_stock = 0; foreach ($CENTRAL as $central_value): 
                if ($item->commodity_id == $central_value->commodity_id) {
                        $stock_available =  $central_value->central_total;
                        echo($stock_available);                   
                    }
                endforeach;
                ?></td>
                   <td>
                <?php
                foreach ($SORTED as $pending_value): 
                    if ($item->commodity_id == $pending_value->commodity_id) {
                        $item_total = $pending_value->PendingTotal;
                        echo($item_total);

                    }

                endforeach;
                ?>      
                    
                </td>
               
                 <td>
                    <table class="table" border="1">
        <thead>
            <th>Funding agency</th>            
            <th>Totals</th>
            </thead>
            <tbody>
              <?php foreach($FUNDING as $FA): ?>
              <tr><td><?php echo $FA->funding_agency_name;?></td>
                <td> <?php foreach($PSTOCKS as $ps):
                if (($ps->commodity_id==$item->commodity_id) && ($FA->funding_agency_id==$ps->funding_agency_id)) {
                  echo $ps->PendingTotal;
                  }                
                    endforeach;
                ?>
                </td>
              </tr>
            <?php endforeach;?>
            </tbody>
            
          </table></td>
            </tr>
            <?php endforeach;?>
       </tbody>
    </table>

    </div>

<?php require_once("includes/footer.php"); ?>