<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage zones</h2>
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
                <div data-toggle="modal" data-target="#save_zone" class="btn btn-primary">Add new zone</div>

            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">

                <div class="col-lg-10">

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
                                    <th>Zone</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php $count=1; ?>
                                <?php foreach ($zones as $zone): ?>
                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $zone->zone; ?></td>
                                        <td data-toggle="modal" data-target="#myModal_<?php echo $zone->zone_id?>" ><i class="fa fa-wrench"></i></td>
                                        <td><a href="<?php echo(base_url()."zone/delete_zone/".$zone->zone_id); ?>"><i class="fa fa-trash"></i></a></td>

                                        <div class="modal inmodal" id="myModal_<?php echo $zone->zone_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content animated bounceInRight">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                        <i class="fa fa-laptop modal-icon"></i>
                                                        <h4 class="modal-title">Add new zone</h4>

                                                    </div>
                                                    <div class="modal-body">


                                                        <form action="<?= base_url();?>index.php/zone/update_zone_id1" method="post" enctype="multipart/form-data" autocomplete="on">

                                                            <div class="form-group">
                                                                <input type="hidden" name="zone_id" class="form-control" value="<?php echo $zone->zone_id; ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>zone Name :</label>
                                                                <input type="text" required name="zone_name" class="form-control" value="<?php echo $zone->zone; ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Description :</label>
                                                                <input type="text" name="zone_comment" class="form-control" value="<?php echo $zone->comment; ?>">
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



        <div class="modal inmodal" id="save_zone" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Edit zone</h4>

                    </div>
                    <div class="modal-body">


                        <form action="<?= base_url();?>index.php/zone/save_zone" method="post" enctype="multipart/form-data" autocomplete="on">

                            <div class="form-group">
                                <input type="hidden" name="zone_id" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>zone Name :</label>
                                <input type="text" required name="zone_name" class="form-control" placeholder="Zone name">
                            </div>

                            <div class="form-group">
                                <label>Description :</label>
                                <input type="text" name="zone_comment" class="form-control" placeholder="Zone description">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

<?php require_once("includes/footer.php"); ?>