<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Commodities report</h2>
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
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/commodities">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($select_period as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
    
  </br>
        <input class="btn btn-primary" type="submit" value="Get commodities report">
        </form>
      </div> 
      </div>


<div class="ibox-content">

    <div id="page-content" class="wrapper wrapper-content">

       <table class="table">
 
  <thead>
    <tr>Period: <?php echo "<font color= #33CC99> $period </font>"; ?></tr>
    <tr >
     <th>Expected Stocks<br>Expected Shipments Totals</th>
   </tr>
  </thead>
  
  <thead>
     <tr>
    <td><b>commodity</b></td>
    <td><b>Totals</b></td>
   </tr>
  </thead>
<?php if($period>0){?>
  <tbody>

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

    <?php echo $pending_totals->PendingTotal;?>


  </td></tr>
<?php endforeach?>
</tbody>
<?php } ?>
  </table> 

    </div>
  </div>

<?php require_once("includes/footer.php"); ?>