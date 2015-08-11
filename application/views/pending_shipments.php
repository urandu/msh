<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-4">
            <h2>Pending shipments</h2>
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
                <div data-toggle="modal" data-target="#save_pending_shipments" class="btn btn-primary">Add new shipment</div>
            </div>
        </div>
    </div>




    <div class="wrapper wrapper-content">

    <div class="row">

        <div class="col-lg-12">


            <form action="<?= base_url();?>pending_shipments/show_pending_shipments" method="post" enctype="multipart/form-data" autocomplete="on">

                <div class="form-group"><label class="col-sm-2 control-label">Select Period</label>

                    <div class="col-sm-5"><select class="form-control m-b" name="pending_shipments_period">
                            <option selected>--SELECT PERIOD--</option>
                            <?php foreach ($ALL_SHIPMENTS as $pending_shipment):?>
                                <option> <?php echo $pending_shipment->period;?></option>
                            <?php endforeach; ?>
                        </select></div>
                    <div class="col-sm-5"><button type="submit" class="btn btn-primary">Get Shipments for the selected period</button></div>


            </form>


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pending Shipments </h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>

                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Commodity</th>
                            <th>Unit of measure</th>
                            <th>Funding agency</th>
                            <th>Pending delivery</th>
                            <th>Expected date of arrival</th>
                            <th>Period</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php $count=1; ?>

                        <?php if(isset($pending_shipment_successfully_retrieved)){?>  <!--CHECK IF DATA IS THERE-->
                            <?php //if(isset($period)){?>  <!--CHECK IF DATA IS THERE-->

                            <?php $done = array() ?>
                            <?php foreach ($PSTOCKS as $pending_stocks): ?>


                                <tr>
                                    <td><?php echo $count; ?></td>

                                    <td>
                                        <?php
                                        foreach($COMMODITY as $COMM):

                                            if ($pending_stocks->commodity_id==$COMM->commodity_id){
                                                echo $COMM->commodity_name;
                                            }
                                        endforeach; ?>
                                    </td>

                                    <td><?php echo $pending_stocks->unit_of_measure; ?></td>

                                    <td>
                                        <?php foreach($FUNDING as $FA):
                                            if ($pending_stocks->funding_agency_id==$FA->funding_agency_id)

                                            {
                                                echo $FA->funding_agency_name;
                                            }
                                        endforeach; ?>
                                    </td>
                                    <td><?php echo $pending_stocks->quantity; ?></td>
                                    <td><?php echo $pending_stocks->expected_time_of_arrival; ?></td>

                                    <td><?php echo $pending_stocks->period; ?></td>


                                    <td data-toggle="modal" data-target="#myModal_<?php echo $pending_stocks->pending_shipment_id?>" ><i class="fa fa-wrench"></i></td>
                                    <td><a href="<?php echo(base_url()."pending_shipments/delete_pending_shipment/".$pending_stocks->pending_shipment_id); ?>"><i class="fa fa-trash"></i></a></td>

                                    <div class="modal inmodal" id="myModal_<?php echo $pending_stocks->pending_shipment_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content animated bounceInRight">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <i class="fa fa-laptop modal-icon"></i>
                                                    <h4 class="modal-title">Edit Pending shipment</h4>

                                                </div>
                                                <div class="modal-body">


                                                    <form action="<?= base_url();?>index.php/pending_shipments/update_pending_shipment_id" method="post" name="Pendingshipment" onsubmit="return validatePendingshipment() enctype="multipart/form-data" autocomplete="on">

                                                    <input type="hidden" name="pending_sipment_id" value="<?php echo $pending_stocks->pending_shipment_id; ?>">

                                                    <label>Commodity Name :</label>

                                                    <select name="commodity_name" class="form-control">
                                                        <?php foreach($COMMODITY as $COM):?>

                                                            <option name="commodity_name" <?php if ($pending_stocks->commodity_id==$COM->commodity_id) {echo "Selected";
                                                            } ?> ><?php echo $COM->commodity_name;?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <div class="form-group">
                                                        <label>Unit of measure :</label>
                                                        <input type="text" name="unit_of_measure" class="form-control" value="<?php echo $pending_stocks->unit_of_measure; ?>">

                                                    </div>


                                                    <label>Funding Agency :</label>


                                                    <select name="funding_agency" class="form-control">
                                                        <?php foreach($FUNDING as $FA):?>


                                                            <option name="funding_agency" <?php if ($pending_stocks->funding_agency_id==$FA->funding_agency_id) {echo "Selected";
                                                            } ?> ><?php echo $FA->funding_agency_name;?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <div class="form-group">
                                                        <label>Period :</label>
                                                        <input type="text" required name="period" class="form-control" value="<?php echo $pending_stocks->period; ?>"<div class="form-group">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Quantity :</label>
                                                            <input type="text" required name="quantity" class="form-control" value="<?php echo $pending_stocks->quantity; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Expected date of delivery :</label>
                                                            <input type="text" required name="expected_date_delivery" class="form-control" value="<?php echo $pending_stocks->expected_time_of_arrival; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Comment :</label>
                                                            <input type="text" name="pddescription" class="form-control" value="<?php echo $pending_stocks->comments; ?>">
                                                        </div>

                                                        <!--                                                        <input type="submit" class"btn btn-primary" id="submit" name="dsubmit" value="Update">-->



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                                        <button id="update" type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                </tr>
                                <?php $count++;endforeach; ?>
                        <?php }?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal inmodal" id="save_pending_shipments" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Add new shipment</h4>

                </div>
                <div class="modal-body">


                    <form action="<?= base_url();?>index.php/pending_shipments/save_pending_shipment" method="post"  id="form" name="Pendingshipment" onsubmit="return validatePendingshipment() enctype="multipart/form-data" autocomplete="on">

                    <label>Commodity Name :</label>
                    <select name="commodity_name" class="form-control">
                        <?php foreach($COMMODITY as $COM):?>
                            <option name="commodity_name"> <?php echo $COM->commodity_name;?> </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="form-group">
                       <label>Unit of measure :</label>
                       <input type="text" name="unit_of_measure" class="form-control" placeholder="unit of measure">

                    </div>


                    <label>Funding Agency :</label>
                    <select name="funding_agency" class="form-control">
                        <?php foreach($FUNDING as $FA):?>
                            <option name="funding_agency"> <?php echo $FA->funding_agency_name;?> </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="form-group">
                        <div class="form-group">
                            <label>Period :</label>
                            <!--<input type="text" name="period" class="form-control" placeholder="Period" >-->
                            <input type="text" required name="period" class="form-control"  data-mask="9999-99" placeholder="Period">
                            <span class="help-block">yyyy-mm</span>

                        </div>

                        <div class="form-group">
                            <label>Quantity :</label>
                            <input type="text" required name="quantity" class="form-control" placeholder="Quantity">
                        </div>

                        <div class="form-group">
                            <label>Expected date of arrival :</label>
                            <input id="txtDate" type="text" required name="expected_time_of_arrival" class="form-control"  data-mask="9999-99-99" placeholder="Expected time of arrival">
                            <span class="help-block">yyyy-mm-dd</span>

                            <!--<input type="text"  class="form-control" >-->
                        </div>

                        <div class="form-group">
                            <label>Comment :</label>
                            <input type="text" name="pddescription" class="form-control" placeholder="Comment">
                        </div>

                        <!-- <input type="submit" class"btn btn-primary" id="submit" name="dsubmit" value="Update">-->



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary">Save data</button>
                    </div>
                    </form>
                </div>
                >
            </div>
        </div>
    </div>
    </div>





    </div>


<?php require_once("includes/footer.php"); ?>