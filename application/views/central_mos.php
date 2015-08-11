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
            <div class="title-action">
                <a class="word-export" href="javascript:void(0)"> Export to word </a>
            </div>
        </div>
    </div>

    <div  class="wrapper wrapper-content">


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
<div id="page-content" class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">

                            <h5>Central Level MOS for period: <?php echo "<font color= #33CC99> $p</font> ";?></h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>



                            </div>
                        </div>
                        <div class="ibox-content">

                            <table style="text-align: right;" class="table table-hover">
                                <thead>
                                <tr >

                             
            <th style="text-align:right">
                Commodity Name
            </th>
        
            <th style="text-align:right">
                Adjusted Facility AMC
            </th>
            <th style="text-align:right">
               Stocks at central level
            </th>
            <th style="text-align:right">
               Pending Shipments
            </th>
            <th style="text-align:right">
                Central Level MOS
            </th>
            <th style="text-align:right">
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


                if($p->adjusted_facility_amc==0)
                {
                    $p->adjusted_facility_amc=1;
                }

               $amc=ceil($p->adjusted_facility_amc);
                echo(number_format($amc));
                ?>
            </td>

            <td>
                <?php
                $pc=ceil($p->central_stock);
                 echo(number_format($pc));

                ?>
            </td>
             <td>
                <?php
                $ps=ceil($p->pending_shipment);
                echo(number_format($ps));

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


<div class="row">
    <div  class="col-lg-12">
        <div  class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Central Level months of stock chart</h5>
                <div class="pull-right">

                </div>


            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">

                        <script>
                            WebFontConfig = {
                                google: {families: ["Open Sans", ]}, active: function () {
                                    DrawTheChart(ChartData, ChartOptions, "chart-01", "HorizontalStackedBar")
                                }
                            };
                        </script>
                        <script asyn src="<?php echo(base_url()); ?>assets/js/webfont.js">
                                </script>
                                <script src="<?php echo(base_url()); ?>assets/js/Chart.min.js"></script>
                        <script>
                            function DrawTheChart(ChartData, ChartOptions, ChartId, ChartType) {
                                eval('var myLine = new Chart(document.getElementById(ChartId).getContext("2d")).' + ChartType + '(ChartData,ChartOptions);document.getElementById(ChartId).getContext("2d").stroke();')
                            }
                        </script>


                        <canvas id="chart-01" width="700" height="400"></canvas>
                        <script> function MoreChartOptions() {
                            }
                            var ChartData = {




                                <?php

                                if (!empty($period)) {


                                        $y_axis="";
                                        $x_axis1="";
                                        $x_axis2="";
                                        $x_axis3="";
                                    foreach ($period as $p) {






                               // echo $p->commodity_name;
                                $y_axis=$y_axis.'"'.get_commodity_alias($p->com_id).'"'.",";


                                             if($p->adjusted_facility_amc==0)
                                            {
                                                $p->adjusted_facility_amc=1;
                                            }

                            $central_mos = ($p->central_stock) / ($p->adjusted_facility_amc);
                            //echo(round($central_mos, 1));

$x_axis1=$x_axis1.(round($central_mos, 1)).",";

                            $pending_mos = ($p->pending_shipment) / ($p->adjusted_facility_amc);

                            //echo(round($pending_mos, 1));
                            $x_axis2=$x_axis2.(round($pending_mos, 1)).",";



                           // $facility_mos = ($p->physical_count) / ($p->adjusted_facility_amc);
                           // echo(round($facility_mos, 1));

                           //$x_axis3=$x_axis3.(round($facility_mos, 1)).",";

                            //$national_mos = ($central_mos + $pending_mos + $facility_mos);
                           // echo $national_mos;



                        }
                        // endforeach;


                                }
                                ?>



                                labels: [<?php echo($y_axis); ?> ],
                                datasets: [

                                    {fillColor: "rgba(171,56,56,0.99)", strokeColor: "rgba(209,12,12,0.93)", pointColor: "rgba(52,152,219,1)", markerShape: "circle", pointStrokeColor: "rgba(255,255,255,1.00)",
                                        data: [<?php echo($x_axis1); ?> ], title: "STOCKS AT CENTRAL LEVEL"},
                                    {fillColor: "rgba(49,95,212,0.91)", strokeColor: "rgba(36,141,240,1)", pointColor: "rgba(46,204,113,1)", markerShape: "circle", pointStrokeColor: "rgba(255,255,255,1.00)",
                                        data: [<?php echo($x_axis2); ?> ], title: "PENDING SHIPMENTS"}
                                ]};
                            ChartOptions = {canvasBackgroundColor: 'rgba(255,255,255,1.00)', spaceLeft: 12, spaceRight: 12, spaceTop: 12, spaceBottom: 12, canvasBorders: false, canvasBordersWidth: 1, canvasBordersStyle: "solid", canvasBordersColor: "rgba(0,0,0,1)", yAxisMinimumInterval: 'none', scaleShowLabels: true, scaleShowLine: true, scaleLineStyle: "solid", scaleLineWidth: 1, scaleLineColor: "rgba(0,0,0,1)", scaleOverlay: false, scaleOverride: true, scaleSteps: 12, scaleStepWidth: 2, scaleStartValue: 0, inGraphDataShow: true, inGraphDataTmpl: '<%=v3%>', inGraphDataFontFamily: "'Open Sans'", inGraphDataFontStyle: "normal bold", inGraphDataFontColor: "rgba(0,0,0,1)", inGraphDataFontSize: 12, inGraphDataPaddingX: 0, inGraphDataPaddingY: -0, inGraphDataAlign: "center", inGraphDataVAlign: "middle", inGraphDataXPosition: 2, inGraphDataYPosition: 2, inGraphDataAnglePosition: 2, inGraphDataRadiusPosition: 2, inGraphDataRotate: 0, inGraphDataPaddingAngle: 0, inGraphDataPaddingRadius: 0, inGraphDataBorders: false, inGraphDataBordersXSpace: 1, inGraphDataBordersYSpace: 1, inGraphDataBordersWidth: 1, inGraphDataBordersStyle: "solid", inGraphDataBordersColor: "rgba(0,0,0,1)", legend: true, maxLegendCols: 5, legendBlockSize: 15, legendFillColor: 'rgba(255,255,255,0.00)', legendColorIndicatorStrokeWidth: 1, legendPosX: -2, legendPosY: 4, legendXPadding: 0, legendYPadding: 0, legendBorders: false, legendBordersWidth: 1, legendBordersStyle: "solid", legendBordersColors: "rgba(102,102,102,1)", legendBordersSpaceBefore: 5, legendBordersSpaceLeft: 5, legendBordersSpaceRight: 5, legendBordersSpaceAfter: 5, legendSpaceBeforeText: 5, legendSpaceLeftText: 5, legendSpaceRightText: 5, legendSpaceAfterText: 5, legendSpaceBetweenBoxAndText: 5, legendSpaceBetweenTextHorizontal: 5, legendSpaceBetweenTextVertical: 5, legendFontFamily: "'Open Sans'", legendFontStyle: "normal normal", legendFontColor: "rgba(0,0,0,1)", legendFontSize: 14, showYAxisMin: false, rotateLabels: "smart", xAxisBottom: true, yAxisLeft: true, yAxisRight: false, scaleFontFamily: "'Open Sans'", scaleFontStyle: "normal normal", scaleFontColor: "rgba(0,0,0,1)", scaleFontSize: 10, pointLabelFontFamily: "'Open Sans'", pointLabelFontStyle: "normal normal", pointLabelFontColor: "rgba(102,102,102,1)", pointLabelFontSize: 12, angleShowLineOut: true, angleLineStyle: "solid", angleLineWidth: 1, angleLineColor: "rgba(0,0,0,0.1)", percentageInnerCutout: 50, scaleShowGridLines: false, scaleGridLineStyle: "solid", scaleGridLineWidth: 1, scaleGridLineColor: "rgba(0,0,0,0.08)", scaleXGridLinesStep: 1, scaleYGridLinesStep: 0, segmentShowStroke: true, segmentStrokeStyle: "solid", segmentStrokeWidth: 2, segmentStrokeColor: "rgba(255,255,255,1.00)", datasetStroke: true, datasetFill: true, datasetStrokeStyle: "solid", datasetStrokeWidth: 2, bezierCurve: true, bezierCurveTension: 0.4, pointDotStrokeStyle: "solid", pointDotStrokeWidth: 1, pointDotRadius: 3, pointDot: true, barShowStroke: true, barBorderRadius: 0, barStrokeStyle: "solid", barStrokeWidth: 1, barValueSpacing: 3, barDatasetSpacing: 0, scaleShowLabelBackdrop: true, scaleBackdropColor: 'rgba(255,255,255,0.75)', scaleBackdropPaddingX: 2, scaleBackdropPaddingY: 2, animation: true, onAnimationComplete: function () {
                                MoreChartOptions()
                            }};
                            DrawTheChart(ChartData, ChartOptions, "chart-01", "HorizontalStackedBar");</script>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>




    </div>

<?php require_once("includes/footer.php"); ?>