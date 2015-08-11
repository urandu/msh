<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading" xmlns="http://www.w3.org/1999/html">
        <div class="col-sm-4">
            <h2>Planned procurements</h2>
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
                <div data-toggle="modal" data-target="#save_planned_procurements" class="btn btn-primary">Add new planned procurement</div>
            </div>
        </div>
    </div>




    <div class="wrapper wrapper-content">

        <div class="row">

            <div class="col-lg-12">


             <form action="<?= base_url();?>index.php/planned_procurements/show_planned_procurements_from_selected_planned_delivery_date" method="post" enctype="multipart/form-data" autocomplete="on">

                <div class="form-group"><label class="col-sm-2 control-label">Select Planned procurement date</label>

                    <div class="col-sm-5"><select class="form-control m-b" name="planned_procurements_planned_delivery_date">
                            <option>--SELECT PLANNED PROCUREMENT DATE--</option>
                            <?php foreach ($ALL_SHIPMENTS as $planned_procurement):?>
    <option name="planned_procurements_planned_delivery_date"> <?php echo $planned_procurement->planned_delivery_date;?></option>
<?php endforeach; ?>
                        </select></div>
                    <div class="col-sm-5"><button type="submit" class="btn btn-primary">Get planned procurements for this planned delivery date</button></div>


             </form>


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Supply Chain </h5>

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
                                <th>Quantity</th>
                                <th>Planned procurement date</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php $count=1; ?>

<?php if(isset($planned_procurement_successfully_retrieved)){?>  <!--CHECK IF DATA IS THERE-->

    <?php $done = array() ?>
    <?php foreach ($PSTOCKS as $planned_procurements): ?>


        <tr>
            <td><?php echo $count; ?></td>

            <td>

                <?php
                foreach($COMMODITY as $COMM):

                    if ($planned_procurements->commodity_id==$COMM->commodity_id){
                        echo $COMM->commodity_name;
                    }
                endforeach; ?>
            </td>


            <td><?php echo $planned_procurements->unit_of_measure; ?></td>


            <td>
                <?php foreach($FUNDING as $FA):
                    if ($planned_procurements->funding_agency_id==$FA->funding_agency_id)

                    {
                        echo $FA->funding_agency_name;
                    }
                endforeach; ?>
            </td>
            <td><?php echo $planned_procurements->quantity; ?></td>

            <td><?php echo $planned_procurements->planned_delivery_date; ?></td>


            <td data-toggle="modal" data-target="#myModal_<?php echo $planned_procurements->planned_procurement_id?>" ><i class="fa fa-wrench"></i></td>
            <td><a href="<?php echo(base_url()."planned_procurements/delete_planned_procurement/".$planned_procurements->planned_procurement_id); ?>"><i class="fa fa-trash"></i></a></td>

            <div class="modal inmodal" id="myModal_<?php echo $planned_procurements->planned_procurement_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <i class="fa fa-laptop modal-icon"></i>
                            <h4 class="modal-title">Edit Pending planned procurement</h4>

                        </div>
                        <div class="modal-body">


                            <form action="<?= base_url();?>index.php/planned_procurements/update_planned_procurement_id" method="post" enctype="multipart/form-data" autocomplete="on">

                                <input type="hidden" name="planned_procurement_id" value="<?php echo $planned_procurements->planned_procurement_id; ?>">

                                <label>Commodity Name :</label>

                                <select name="commodity_name" class="form-control">
                                    <?php foreach($COMMODITY as $COM):?>

                                        <option name="commodity_name" <?php if ($planned_procurements->commodity_id==$COM->commodity_id) {echo "Selected";
                                        } ?> ><?php echo $COM->commodity_name;?></option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="form-group">
                                    <label>Unit of measure :</label>
                                    <input type="text" name="unit_of_measure" class="form-control" value="<?php echo $planned_procurements->unit_of_measure; ?>">

                                </div>

                                <label>Funding Agency :</label>


                                <select name="funding_agency" class="form-control">
                                    <?php foreach($FUNDING as $FA):?>


                                        <option name="funding_agency" <?php if ($planned_procurements->funding_agency_id==$FA->funding_agency_id) {echo "Selected";
                                        } ?> ><?php echo $FA->funding_agency_name;?></option>
                                    <?php endforeach; ?>
                                </select>

                                <div class="form-group">
                                    <label>Planned procurement date :</label>
                                    <input type="text" required name="planned_delivery_date" class="form-control" value="<?php echo $planned_procurements->planned_delivery_date; ?>"<div class="form-group">
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity :</label>
                                        <input type="text" required name="quantity" class="form-control" value="<?php echo $planned_procurements->quantity; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Comment :</label>
                                        <input type="text" name="ppdescription" class="form-control" value="<?php echo $planned_procurements->comment; ?>">
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



    <div class="modal inmodal" id="save_planned_procurements" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Add new planned procurement</h4>

                </div>
                <div class="modal-body">


                    <form action="<?= base_url();?>index.php/planned_procurements/save_planned_procurement" method="post" enctype="multipart/form-data" autocomplete="on">

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
                            <label>Planned procurement date :</label>
                            <!--<input type="text" name="planned_delivery_date" class="form-control" placeholder="Planned procurement date" >-->
                                <input type="text" required name="planned_delivery_date" class="form-control"  data-mask="9999-99-99" placeholder="Planned procurement date">
                                <span class="help-block">yyyy-mm-dd</span>

                            </div>

                            <div class="form-group">
                                <label>Quantity :</label>
                                <input type="text" required name="quantity" class="form-control" placeholder="Quantity">
                            </div>

                            <div class="form-group">
                                <label>Comment :</label>
                                <input type="text" name="ppdescription" class="form-control" placeholder="Comment">
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