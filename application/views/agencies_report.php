<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Commodities per agency</h2>
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
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/agencies">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($period as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
    </br>
        <input class="btn btn-primary" type="submit" value="Get pending commodities per agency report">
        </form>
      </div> 
      </div>

      <div class="ibox-content">

    <div id="page-content" class="wrapper wrapper-content">

        <table  class="table table-hover" style="text-align:right" border="1">
          <tr>Pending Stock(s) for: <?php echo "<font color= #33CC99> $selected_period </font>"; ?></tr>
          <thead>
            <th>Commodity</th>
            <th>Agency total</th>
          </thead>
<?php if ($selected_period>0){?>

<?php foreach($COMMODITY as $COMM):?>
  <tr>
    <td>
      <?php echo $COMM->commodity_name; ?>
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
                if (($COMM->commodity_id==$ps->commodity_id) && ($FA->funding_agency_id==$ps->funding_agency_id)) {
                  echo $ps->PendingTotal;
                  }                
                    endforeach;
                ?>
                </td>
              </tr>
            <?php endforeach;?>
            </tbody>
          </table>

    </td>
  </tr>
<?php endforeach;?>

 <?php }?>
</table>
    </div>
  </div>

<?php require_once("includes/footer.php"); ?>