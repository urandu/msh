<?php require_once("includes/header.php"); ?>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Individual pending commodities</h2>

    </div>
    <div class="col-sm-8">
        <!--<div class="title-action">
            <a href="" class="btn btn-primary">This is action area</a>
        </div>-->
    </div>
</div>

     <div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/individual_commodity">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($select_period as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
        <input class="btn btn-primary" type="submit" value="Get period">
        </form>
      </div> 
      </div>

<div class="wrapper wrapper-content">
    <table  class="table">
        <thead>
            <tr>Period: <?php echo $period;?></tr>

        <tr>
            <th><b>#</b></th>

            <th><b>Commodity</b></th>
            <th><b>Source</b></th>
            <th><b>Quantity</b></th>
            <th><b>E.T.A</b></th>
            <th><b>Color code</b></th>
        </tr>
        </thead>
        <tbody>
        <?php $count=1;
        foreach ($PSTOCKS as $pendingstocks):?>
            <tr><td><?php echo($count);?></td>

                <td>
                    <?php /*echo $central_level_data->commodity_name;*/
                    foreach($COMMODITY as $COMM):

                        if ($COMM->commodity_id==$pendingstocks->commodity_id){
                            echo $COMM->commodity_name;
                            $commodity=$COMM->commodity_id;
                        }
                    endforeach;?>
                </td>
                <td><?php    foreach ($FUNDING as $FA) :
                        if ($FA->funding_agency_id==$pendingstocks->funding_agency_id) {
                            echo $FA->funding_agency_name;
                        }

                    endforeach;?></td>
                <td>
                    <?php echo $pendingstocks->quantity;?>
                </td>
                <td>
                    <?php  echo $pendingstocks->expected_time_of_arrival;?>
                </td>
                
                <?php if (get_months($pendingstocks->expected_time_of_arrival) < 3 || get_months($pendingstocks->expected_time_of_arrival) ==3) {
                    echo "<td style='background-color: #00FF00'>".""."</td>";  

                  }else if (get_months($pendingstocks->expected_time_of_arrival)> 3 && get_months($pendingstocks->expected_time_of_arrival) < 6 || get_months($pendingstocks->expected_time_of_arrival) ==6 ) {
                      echo "<td style='background-color: #FFFF00'>".""."</td>";
                  }else if (get_months($pendingstocks->expected_time_of_arrival) >6 && get_months($pendingstocks->expected_time_of_arrival) < 9 || get_months($pendingstocks->expected_time_of_arrival) ==9) {
                  echo "<td style='background-color: #008000'>".""."</td>";
                  } else{
                    echo "<td style='background-color: #FFFF00'>".""."</td>";
                  }?>
            </tr>

            <?php
            $count++;
        endforeach;?>
        </tbody>
    </table>
</div>

<?php require_once("includes/footer.php"); ?>




