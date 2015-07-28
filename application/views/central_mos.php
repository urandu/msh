<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Central Level MOS</h2>
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
    <form class="form" method="post" action="<?php echo(base_url()); ?>reports/central_mos">
    <select name="date" class="form-control">
        <option  selected>--SELECT PERIOD--</option>

        <?php foreach ($dates as $date): ?>
            <option value="<?php echo $date->period; ?>"  ><?php echo $date->period; ?></option>
        <?php endforeach; ?>
    </select>
    </div>
    <div class="col-lg-3">
        <input class="btn btn-primary" type="submit" value="Get Central Level MOS Report">
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

                            <h5>Central Level MOS for period: <?php echo $p; ?></h5>

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
               Central Stock on Hand KEMSA
            </th>
            <th>
               Pending Shipments
            </th>
            <th>
                Central Level MOS
            </th>
            <th>
                Pending Shipments MOS
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
                echo $p->central_stock;


                ?>
            </td>
             <td>
                <?php
                echo $p->pending_shipment;


                ?>
            </td>
            <td>
                <?php


if(!empty($p->central_stock) && !empty($p->adjusted_facility_amc))
{
    echo(round(($p->central_stock)/($p->adjusted_facility_amc),1));

}


                ?>
            </td>
            <td>
                <?php


            if(!empty($p->pending_shipment) && !empty($p->adjusted_facility_amc)) {
                echo(round(($p->pending_shipment) / ($p->adjusted_facility_amc), 1));
            }

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