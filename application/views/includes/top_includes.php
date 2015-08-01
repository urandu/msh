<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php if(!empty($title)){ echo($title); }?></title>

<!--  <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script> -->



    <link href="<?php echo(base_url()); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Morris -->
    <link href="<?php echo(base_url()); ?>assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="<?php echo(base_url()); ?>assets/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo(base_url()); ?>assets/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <!-- Data Tables -->
    <link href="<?php echo(base_url()); ?>assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/jsTree/style.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/dropzone/dropzone.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/cropper/cropper.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/codemirror/codemirror.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/codemirror/ambiance.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
    <link href="<?php echo(base_url()); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/plugins/steps/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo(base_url()); ?>assets/css/style.css" rel="stylesheet">



    <!-- date-picker -->
    
    <link href="<?php echo(base_url()); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js" rel="stylesheet">

    <link  id='GoogleFontsLink' href='http://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css'>




    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            foreach ($item['counties'] as $county) {

                ?>


                <style>


                    <?php echo("#".$item['commodity_id']);  ?>

                    <?php echo("#".strtolower(trim(str_replace(" ","",str_replace("-","",str_replace("County","",$county["county_name"])))))); ?>
                    <?php
                     if($county["mos"]<=3)
                     {
                     ?>
                    {
                        fill: <?php echo(get_color(1)); ?>
                    ;
                        stroke: black
                    ;
                    }

                    <?php
                    }elseif($county["mos"]>3 && $county["mos"]<=6)
                    {

    ?>
                    {
                        fill: <?php echo(get_color(2)); ?>
                    ;
                        stroke: black
                    ;
                    }

                    <?php
                    }elseif($county["mos"]>6 && $county["mos"]<=9)
                    {
    ?>
                    {
                        fill: <?php echo(get_color(3)); ?>
                    ;
                        stroke: black
                    ;
                    }

                    <?php

                    }elseif($county["mos"]>9)
                    {

    ?>
                    {
                        fill: <?php echo(get_color(4)); ?>
                    ;
                        stroke: black
                    ;
                    }

                    <?php
                    }




                    ?>


                </style>


            <?php
            }
        }
    }

    ?>

</head>