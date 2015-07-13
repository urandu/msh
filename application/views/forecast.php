<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage forecasts</h2>
            
        </div>
        <div class="col-sm-8">
             <div class="title-action">
                <div data-toggle="modal" data-target="#save_forecast_data" class="btn btn-primary">Add Forecast Commodity Data</div>
            </div>
        </div>
    </div>

   <div class="wrapper wrapper-content">
        
   

<div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>forecast/index">
    <select name="date" class="form-control">
        <option  selected>--SELECT PERIOD--</option>

        <?php foreach ($dates as $date): ?>
            <option value="<?php echo $date->forecast_start_date; ?>"  ><?php echo $date->forecast_start_date; ?></option>
        <?php endforeach; ?>
    </select>
        <input class="btn btn-primary" type="submit" value="Get Commodities">
        </form>
</div>
 
</div>



<?php

if (isset($period)) {

    //print_r($period);


?>


<div class="row">
<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Forecast Commodities Data for period: <?php echo $date->forecast_start_date; ?></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" >
                                    <i class="fa fa-wrench"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-hover">
                                <thead>
                                <tr>

                             
            <th>
                Commodity name
            </th>
        
            <th>
                Forecast Start Date
            </th>
            <th>
               Forecast Period 
            </th>
            <th>
                Forecast Monthly Consumption
            </th>
        </tr>
                                </thead>
                                <tbody>
                   
        <?php

        if(!empty($period)) {

        foreach($period as $p)
        {


            echo("<tr>");
            ?>
            
            <td>
                <?php

                echo $p->commodity_name;


                ?>
            </td>
            
            <td>
                <?php

                echo $p->forecast_start_date;

                ?>
            </td>

            <td>
                <?php
                echo $p->forecast_period;


                ?>
            </td>
            <td>
                <?php


                echo $p->forecast_monthly_consumption;

                ?>
            </td>


        <?php
        echo("</tr>");

        }
        // endforeach;


        ?>


        <?php
        }
        ?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<?php

}





?>



</div>

<?php require_once("includes/footer.php"); ?>