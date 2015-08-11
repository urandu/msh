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
            <div class="title-action">
                <a class="word-export" href="javascript:void(0)"> Export to word </a>
            </div>

        </div>
    </div>
    </br>
    <div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/stocks">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($select_period as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
    </br>
        <input class="btn btn-primary" type="submit" value="Get stocks report">
        </form>
      </div> 
      </div>


      <div class="ibox-content">


    <div id="page-content" class="wrapper wrapper-content">

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

        <?php if ($period>0){?>
        <tr>Period:<b><?php echo "<font color= #33CC99> $period </font>"; ?></b></tr>
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
       <?php }?>

    </table>

    </div>
</div>

<?php require_once("includes/footer.php"); ?>