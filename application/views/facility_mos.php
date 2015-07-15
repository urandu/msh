<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Facility Level MOS</h2>
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
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/facility_mos">
    <select name="date" class="form-control">
        <option  selected>--SELECT PERIOD--</option>

        <?php foreach ($dates as $date): ?>
            <option value="<?php echo $date->period; ?>"  ><?php echo $date->period; ?></option>
        <?php endforeach; ?>
    </select>
    </div>
    <div class="col-lg-3">
        <input class="btn btn-primary" type="submit" value="Get Facility Level MOS Report">
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
                            <h5>Facility Level MOS for period: <?php echo $date->period; ?></h5>
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
                Adjusted Facility AMC
            </th>
            <th>
               Stock on Hand
            </th>
            <th>
                Facility Level Month of Stock(mos)
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

                echo $p->adjusted_facility_amc;

                ?>
            </td>

            <td>
                <?php
                echo $p->physical_count;


                ?>
            </td>
            <td>
                <?php


             echo(round(($p->physical_count)/($p->adjusted_facility_amc),2));

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