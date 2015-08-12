<?php require_once("includes/header.php"); ?>


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2>Individual pending Shipments</h2>

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
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/individual_commodity">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($select_period as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
    </br>
        <input class="btn btn-primary" type="submit" value="Get individual pending shipments report">
        </form>
      </div> 
      </div>

<div class="ibox-content">

<div id="page-content" class="wrapper wrapper-content">
    <table   class="table">
        <thead>
  <span> <i style="color:<?php echo(get_color(1)); ?>;" class="fa fa-square"></i> <9 </span> || <span ><i style="color:<?php echo(get_color(2)); ?>;" class="fa fa-square"></i>  < 3</span> || <span ><i  style="color:<?php echo(get_color(3)); ?>;" class="fa fa-square"></i>  >6 to <=9</span> || <span ><i style="color:<?php echo(get_color(4)); ?>;" class="fa fa-square"></i>  >3 to < 6</span>

            <tr>Period: <?php echo "<font color= #33CC99> $period </font>";?></tr>

        <tr>
            <th><b>#</b></th>

            <th><b>Commodity</b></th>
            <th><b>Source</b></th>
            <th><b>Quantity</b></th>
            <th><b>E.T.A</b></th>
            <th><b>Color code</b></th>
        </tr>
        </thead>
        <?php if($period>0){?>
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
                
                <?php if (get_months($pendingstocks->expected_time_of_arrival) < 3 ||get_months($pendingstocks->expected_time_of_arrival)==3) {
                    echo "<td style='background-color: #00FF00'>".""."</td>";  

                  }elseif (get_months($pendingstocks->expected_time_of_arrival)> 3 && get_months($pendingstocks->expected_time_of_arrival) < 6 || get_months($pendingstocks->expected_time_of_arrival)==6) {
                    echo "<td style='background-color: #FFFF00'>".""."</td>";

                  }elseif (get_months($pendingstocks->expected_time_of_arrival) >6 && get_months($pendingstocks->expected_time_of_arrival) < 9|| get_months($pendingstocks->expected_time_of_arrival)==9) {
                     echo "<td style='background-color: #FF9900'>".""."</td>";
                  }else
                  {
                        echo "<td style='background-color: #FF0000 '>".""."</td>";
                  }
                  ?>
            </tr>

            <?php
            $count++;
        endforeach;?>
        </tbody>
        <?php } ?>
    </table>
</div>
</div>

<?php require_once("includes/footer.php"); ?>




