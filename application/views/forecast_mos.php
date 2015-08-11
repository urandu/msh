<?php require_once("includes/header.php"); ?>



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Forecast Data MOS</h2>
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

    <div class="wrapper wrapper-content">


        <div class="row">
            <div class="col-lg-3">
                <form class="form" method="post" action="<?php echo(base_url()); ?>reports/forecast_mos">
                    <select name="date" class="form-control">
                        <option  selected>--SELECT PERIOD--</option>

                        <?php foreach ($dates as $date): ?>

                            <option value="<?php echo $date->period; ?>"  ><?php echo $date->period; ?></option>

                        <?php endforeach; ?>
                    </select>
            </div>
            <div class="col-lg-3">
                <input class="btn btn-primary" type="submit" value="Get Forecast MOS Report">
                </form>
            </div>

        </div>
        <?php

        if (isset($period)) {

            //print_r($period);


            ?>

            <div class="row">
                <div id="page-content" class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <h5>Forecast Commodities Data MOS for period: <?php echo "<font color= #33CC99>$pe</font>"; ?></h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>


                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-hover" style="text-align:right">
                                <thead>
                                <tr>


                                    <th style="text-align:right">
                                        Commodity name
                                    </th>

                                    <th style="text-align:right">
                                        Forecast Monthly Consumption
                                    </th>
                                    <th style="text-align:right">
                                        Stock on Hand
                                    </th>
                                    <th style="text-align:right">
                                        Forecast Month of Stock(mos)
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if(!empty($period)) {

                                 
                                    foreach($period as $p)
                                    {  
                                      $pd=add_date($p->forecast_start_date,$p->forecast_period * 12);
                                       

                                       if($pe<=$pd) 


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

                                            $fmc=ceil($p->forecast_monthly_consumption);
                                            echo(number_format($fmc));
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            $pc=ceil($p->physical_count);
                                            echo(number_format($pc));

                                            ?>
                                        </td>
                                        <td>
                                            <?php



                                            echo(round(($p->physical_count)/($p->forecast_monthly_consumption),1));


                                            ?>
                                        </td>

                                        <?php
                                        echo("</tr>");

                                       
                                    }
                                     

                                     else  echo (" <font color='red'> The forecast period has expired,please adjust the period and forecast start date in the forecast option under settings.</font>");


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