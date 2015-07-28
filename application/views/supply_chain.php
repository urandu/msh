<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage supply chain agencies</h2>
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
                <div data-toggle="modal" data-target="#save_supply_chain_agency" class="btn btn-primary">Add a new
                    agency
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">


            <div class="col-lg-12">


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>All supply Chain agencies </h5>

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
                                <th>Name</th>
                                <th>Contact person</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tbody>


                            <?php $count = 1; ?>
                            <?php foreach ($agencies as $agency): ?>

                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $agency->supply_chain_agency; ?></td>
                                    <td><?php echo $agency->contact_person; ?></td>
                                    <td><?php echo $agency->email; ?></td>
                                    <td><?php echo $agency->contact_phone; ?></td>
                                    <td data-toggle="modal"
                                        data-target="#myModal_<?php echo $agency->supply_chain_agency_id ?>"><i
                                            class="fa fa-wrench"></i></td>
                                    <td>
                                        <a href="<?php echo(base_url() . "supply_chain/delete_supply_chain_agency/" . $agency->supply_chain_agency_id); ?>"><i
                                                class="fa fa-trash"></i></a></td>

                                    <div class="modal inmodal"
                                         id="myModal_<?php echo $agency->supply_chain_agency_id ?>" tabindex="-1"
                                         role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content animated bounceInRight">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span
                                                            aria-hidden="true">&times;</span><span
                                                            class="sr-only">Close</span></button>
                                                    <!--<i class="fa fa-laptop modal-icon"></i>-->
                                                    <h4 class="modal-title">Edit Supply Chain Agency -
                                                        <strong><?php echo $agency->supply_chain_agency; ?></strong>
                                                    </h4>
                                                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>-->
                                                </div>
                                                <div class="modal-body">


                                                    <form
                                                        action="<?= base_url(); ?>index.php/supply_chain/update_agency_id1"
                                                        method="post" name="supplychain" onsubmit="return validateSupplyAgency() enctype="multipart/form-data" autocomplete="on">

                                                    <div class="form-group">
                                                        <input type="hidden" name="supply_agency_id"
                                                               class="form-control"
                                                               value="<?php echo $agency->supply_chain_agency_id; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Agency Name :</label>
                                                        <input type="text" required name="supply_agency_name"
                                                               class="form-control"
                                                               value="<?php echo $agency->supply_chain_agency; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Contact Person :</label>
                                                        <input type="text" name="contact_person"
                                                               class="form-control"
                                                               value="<?php echo $agency->contact_person; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Email :</label>
                                                        <input type="email" name="email"
                                                               class="form-control"
                                                               value="<?php echo $agency->email; ?>">
                                                    </div>




                                                    <div class="form-group">
                                                        <label>Contact Phone :</label>
                                                        <input type="text" name="contact_phone" class="form-control"
                                                               value="<?php echo $agency->contact_phone; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Description :</label>
                                                        <input type="text" name="supply_agency_description"
                                                               class="form-control"
                                                               value="<?php echo $agency->comment; ?>">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-white" data-dismiss="modal">
                                                        Close
                                                    </button>
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



    <div class="modal inmodal" id="save_supply_chain_agency" tabindex="-1" role="dialog" aria-hidden="true" name="supplychain" onsubmit="return validateSupplyAgency()">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <i class="fa fa-laptop modal-icon"></i>
                    <h4 class="modal-title">Add Supply Chain Agency</h4>
                    <!--<small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting
                        industry.
                    </small>-->
                </div>
                <div class="modal-body">


                    <form action="<?= base_url(); ?>index.php/supply_chain/save_supply_chain_agency" method="post"
                          enctype="multipart/form-data" autocomplete="on">

                        <div class="form-group">
                            <label>Agency Name: </label>
                            <input type="text" required class="form-control" name="supply_agency_name"
                                   placeholder="Supply agency name"> <!--the form-control gives the form some styling-->
                        </div>

                        <div class="form-group">
                            <label">Contact person: </label>
                            <input type="text" class="form-control" name="contact_person" placeholder="Contact person">
                            <!--the form-control gives the form some styling-->
                        </div>

                        <div class="form-group">
                            <label">Email: </label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                            <!--the form-control gives the form some styling-->
                        </div>


                        <div class="form-group">
                            <label">Contact Phone </label>
                            <input id="txtPhone" type="text" class="form-control" name="contact_phone"
                                   placeholder="Contact phone">
                            <span id="spnPhoneStatus"><div></div></span>
                        </div>

                        <div class
                        "form-group">
                        <label> Description: </label>
                        <textarea class="form-control" rows="8" name="supply_chain_description"
                                  placeholder="Add description"></textarea>
                </div>

                <?php if (isset($message)) { ?>
                    <div class="col-lg-12">
                        <div class="alert alert-success">
                            <div class="col-lg-3"></div><?= $message ?></div>
                    </div>
                <?php } ?>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button id="submit" type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
    </div>

<?php require_once("includes/footer.php"); ?>