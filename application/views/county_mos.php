<?php require_once("includes/header.php"); ?>



    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>County Level MOS</h2>
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
                <form class="form" method="post" action="<?php echo(base_url()); ?>reports/county_mos">
                    <select name="date" class="form-control">
                        <option selected>--SELECT PERIOD--</option>

                        <?php foreach ($dates as $date): ?>
                            <option value="<?php echo $date->period; ?>"><?php echo $date->period; ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>
            <div class="col-lg-3">
                <select name="county" class="form-control">
                    <option selected>--SELECT COUNTY--</option>

                    <?php foreach ($names as $name): ?>
                        <option value="<?php echo $name->county_id; ?>"><?php echo $name->county_name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="col-lg-3">
                <input class="btn btn-primary" type="submit" value="Get County Level MOS Report">
                </form>
            </div>

        </div>
        <?php

        if (!empty($period)) {

            //print_r($period);


            ?>



            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h4> County MOS Report for period <?php

                                //echo($p);

                                if ($p != "000000") {
                                    echo($p);
                                }

                                ?> || County name :<?php

                                if ($p != "000000") {
                                    echo(get_county_name($c));
                                }



                                ?></h4>

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
                                        Adjusted County AMC
                                    </th>
                                    <th>
                                        Stock on Hand
                                    </th>
                                    <th>
                                        County Level Month of Stock(mos)
                                    </th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                if (!empty($period)) {

                                    foreach ($period as $p) {


                                        echo("<tr>");
                                        ?>

                                        <td>
                                            <?php

                                            echo $p->commodity_name;


                                            ?>
                                        </td>

                                        <td>
                                            <?php

                                            echo $p->adjusted_county_amc;

                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            echo $p->physical_count;


                                            ?>
                                        </td>
                                        <td>
                                            <?php


                                            echo(round(($p->physical_count) / ($p->adjusted_county_amc), 1));

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