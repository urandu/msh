<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Commodities report</h2>
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
    <tr >
     <th>Expected Stocks<br>Expected Shipments Totals</th>
   </tr>
  </thead>
  
  <thead>
     <tr>
    <td><b>commodity</b></td>
    <td><b>Totals</b></td>
   </tr>
  </thead><tbody>

    <?php foreach ($pendingConsignments as $pending_totals): ?>
   <tr>
    <td><?php
foreach($COMMODITY as $COMM):

if ($pending_totals->commodity_id==$COMM->commodity_id){
  echo $COMM->commodity_name; 
  }
  endforeach;   
  ?>

  </td>
    <td>
    <?php echo $pending_totals->quantity;?>

  </td></tr>
<?php endforeach?>
</tbody>
  </table> 
    </div>

<?php require_once("includes/footer.php"); ?>