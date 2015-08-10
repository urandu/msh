<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Forecast Variance Tracker</h2>
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
                <form class="form" method="post" action="<?php echo(base_url()); ?>reports/variance_tracker">
                    <select name="date" class="form-control">
                        <option value="000000" selected>--SELECT PERIOD--</option>
                        <?php foreach ($dates as $date): ?>
                            <option value="<?php echo $date->period; ?>"  ><?php echo $date->period; ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>
            
            <div class="col-lg-3">
                <input class="btn btn-primary" type="submit" value="Get Forecast Variance">
                </form>
            </div>

        </div>
        <?php

        if (!empty($period)) {

             //print_r($period);


            ?>

            <div class="row">
                <div id="page-content" class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <h5>Forecast Variance Tracker from period: <?php $last_period=subtract_date($p,5);echo "<font color= #33CC99>$last_period </font>"?> to <?php echo "<font color= #33CC99> $p </font>" ?></h5>
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


                                    <th>
                                        Commodity Name
                                    </th>
                                    
                                    <th>
                                     
                                    </th>
                            
                                    <th style="text-align:right">
                                       <?php
                                       $month = subtract_date($p,5); 
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName; 

                                       ?> 
                                    </th>
                                    <th style="text-align:right">
                                       <?php 
                                       $month = subtract_date($p,4); 
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName;

                                        ?> 
                                    </th>
                                    <th style="text-align:right">
                                       <?php 
                                       $month = subtract_date($p,3);
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName;

                                      ?> 
                                    </th>
                                    <th style="text-align:right">
                                    <?php 
                                    $month = subtract_date($p,2); 
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName;
                                      ?> 
                                    </th>
                                    <th style="text-align:right">
                                     <?php 
                                     $month = subtract_date($p,1); 
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName;?>
  
                                    </th>
                                    <th style="text-align:right">

                                      <?php 
                                      $month = $p; 
                                      $date = DateTime::createFromFormat('Ym', $month);  
                                      $monthName = $date->format('MY'); // will get Month name
                                      echo $monthName; ?>  
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

                                        <th rowspan="4" scope="rowgroup">
                                            <?php

                                            echo $p->commodity_name;


                                            ?>
                                            <th scope="row"> Forecasted Consumption
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));?></td>
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));?></td>
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));?></td>
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));?></td>
                                             <td scope="row"> <?php 
                                             $fmc=ceil($p->forecast_monthly_consumption);
                                             echo(number_format($fmc));?></td>
                                            </th>

                                            <tr><th scope="row"> Actual Consumption
                                
                                             <td scope="row"> <?php 
                                             $ac5=ceil(( $p->actual_consumption5/$p->reporting_rate_value5)*100);
                                             echo(number_format($ac5));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $ac4=ceil( ($p->actual_consumption4/$p->reporting_rate_value4)*100);
                                              echo(number_format($ac4));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $ac3=ceil( ($p->actual_consumption3/$p->reporting_rate_value3)*100);
                                              echo(number_format($ac3));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $ac2=ceil(( $p->actual_consumption2/$p->reporting_rate_value2)*100);
                                             echo(number_format($ac2));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $ac1=ceil( ($p->actual_consumption1/$p->reporting_rate_value1)*100);
                                              echo(number_format($ac1));
                                             ?></td>
                                             <td scope="row"> <?php 
                                             $ac=ceil( ($p->actual_consumption/$p->reporting_rate_value)*100);
                                              echo(number_format($ac));
                                             ?></td>

                                            </th></tr>
                                           <tr><th scope="row"> Variance : quantity
                                         
                                           <td scope="row"> <?php 
                                           $vq5=ceil((($p->actual_consumption5/$p->reporting_rate_value5)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq5));
                                           ?></td>
                                           <td scope="row"> <?php 
                                           $vq4=ceil( (($p->actual_consumption4/$p->reporting_rate_value4)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq4));
                                           ?></td>
                                           <td scope="row"> <?php 
                                           $vq3=ceil( (($p->actual_consumption3/$p->reporting_rate_value3)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq3));
                                           ?></td>
                                           <td scope="row"> <?php 
                                           $vq2=ceil( (($p->actual_consumption2/$p->reporting_rate_value2)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq2));
                                           ?></td>
                                           <td scope="row"> <?php 
                                           $vq1=ceil( (($p->actual_consumption1/$p->reporting_rate_value1)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq1));
                                           ?></td>
                                           <td scope="row"> <?php 
                                           $vq=ceil((($p->actual_consumption/$p->reporting_rate_value)*100)-$p->forecast_monthly_consumption);
                                           echo(number_format($vq));
                                           ?></td>



                                           </th></tr>
                                           <tr style="background-color: #33CC99"> <th scope="row"> Variance : percentage
                     
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption5/$p->reporting_rate_value5)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption4/$p->reporting_rate_value4)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption3/$p->reporting_rate_value3)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption2/$p->reporting_rate_value2)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption1/$p->reporting_rate_value1)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           <td scope="row"> <?php echo(round((((($p->actual_consumption/$p->reporting_rate_value)*100-$p->forecast_monthly_consumption)/($p->forecast_monthly_consumption))* 100),1));?><?php echo "%"?></td>
                                           </th></tr>
                                            
                                        </th>
                                        


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