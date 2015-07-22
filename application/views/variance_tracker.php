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
            <!--<div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>-->
        </div>
    </div>

    <div class="wrapper wrapper-content">


        <div class="row">
            <div class="col-lg-3">
                <form class="form" method="post" action="<?php echo(base_url()); ?>reports/variance_tracker">
                    <select name="date" class="form-control">
                        <option  selected>--SELECT PERIOD--</option>
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

        if (isset($period)) {

            // print_r($period);


            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Forecast Variance from period: <?php echo $p; ?></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>


                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-hover">
                                <thead>
                                <tr>


                                    <th>
                                        Commodity Name
                                    </th>
                                    
                                    <th>
                                     
                                    </th>
                                    <th>
                                      <?php echo $p; ?>  
                                    </th>
                                    <th>
                                     <?php echo $p-1; ?>   
                                    </th>
                                    <th>
                                       <?php echo $p-2; ?> 
                                    </th>
                                    <th>
                                       <?php echo $p-3; ?> 
                                    </th>
                                    <th>
                                       <?php echo $p-4; ?> 
                                    </th>
                                    <th>
                                       <?php echo $p-5; ?> 
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

                                        <td rowspan="4" scope="rowgroup">
                                            <?php

                                            echo $p->commodity_name;


                                            ?>
                                            <td scope="row"> Forecasted Consumption</td>
                                            <tr><td scope="row"> Actual Consumption</td></tr>
                                           <tr><td scope="row"> Variance : quantity</td></tr>
                                           <tr> <td scope="row"> Variance : percentage</td></tr>
                                            
                                        </td>
                                        

                                        <td>
                                            <?php

                                            

                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                           


                                            ?>
                                        </td>
                                        <td>
                                            <?php


                                            

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