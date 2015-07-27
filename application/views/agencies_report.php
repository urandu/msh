<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Commodities per agency</h2>
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

        <table  class="table" border="1">

<thead>
<th>Commodity</th>
<th>Agency total</th>
</tr>
</thead>

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
</table>


    </div>

<?php require_once("includes/footer.php"); ?>