<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage counties</h2>
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



        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">


                <div class="col-lg-8">

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>All counties </h5>
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
                                    <th>County Name</th>
                                    <th>Zone</th>
                                    <th>Edit</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php $count=1; ?>
                                <?php foreach ($counties as $county): ?>

                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $county->county_name; ?></td>

                                        <td>
                                        <?php foreach ($zones as $zone):?>
                                            <?php if($zone->zone_id==$county->zone) echo $zone->zone;?>
                                        <?php endforeach; ?>
                                        </td>

                                        <td data-toggle="modal" data-target="#myModal_<?php echo $county->county_id?>" ><i class="fa fa-wrench"></i></td>


                                        <div class="modal inmodal" id="myModal_<?php echo $county->county_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated bounceInRight">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">Edit County</h4>

                                                    </div>
                                                    <div class="modal-body">


                                                        <form action="<?= base_url();?>index.php/county/update_county_id1" method="post" enctype="multipart/form-data" autocomplete="on">

                                                            <div class="form-group">
                                                                <input type="hidden" name="county_id" class="form-control" value="<?php echo $county->county_id; ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>County Name :</label>
                                                                <input type="text" name="county_name" class="form-control" readonly value="<?php echo $county->county_name; ?>">
                                                            </div>


                                                            <label>Zone</label>
                                                            <select class="form-control m-b" name="zone_name">

                                                                <option>--SELECT ZONE--</option>

                                                                <?php foreach ($zones as $zone):?>
                                                                    <option name="zone_name" <?php if($zone->zone_id==$county->zone){echo"selected";} ?>><?php echo $zone->zone;?></option>

                                                                <?php endforeach; ?>

                                                            </select>

                                                            <div class="form-group">
                                                                <label>Description :</label>
                                                                <input type="text" name="county_comment" class="form-control" value="<?php echo $county->comment; ?>">
                                                            </div>

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


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>








<?php require_once("includes/footer.php"); ?>