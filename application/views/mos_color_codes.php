
<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage MOS color codes</h2>
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
           <!-- <div class="title-action">
                <a href="#" data-toggle="modal" data-target="#add_user_modal" class="btn btn-primary">Add new user</a>
            </div>-->
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <!--<div class="middle-box text-center animated fadeInRightBig">
            <h3 class="font-bold">This is page content</h3>

            <div class="error-desc">
                You can create here any grid layout you want. And any variation layout you imagine:) Check out
                main dashboard and other site. It use many different layout.
                <br/><a href="index.html" class="btn btn-primary m-t">Dashboard</a>
            </div>
        </div>-->
        <div class="row">
        <div class="col-lg-12">
        <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Color codes</h5>

            <div class="ibox-tools">



            </div>
        </div>
        <div class="ibox-content">

        <table class="table table-striped table-bordered table-hover dataTables-example">
        <thead>
        <tr>
            <th>color code</th>
            <th>color</th>

            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php

        if(!empty($colors))
        {
            foreach($colors as $color)
            {
                ?>


                <tr class="gradeX">
                    <td><?php echo($color->color_id); ?></td>
                    <td><?php echo($color->color); ?></td>

                    <td class="center"><a data-target="#edit_color_modal_<?php echo($color->color_id); ?>" data-toggle="modal" href="#">
                            <i class="fa fa-wrench"></i> Edit
                        </a>
                        <div class="modal inmodal" style="color: black" id="edit_color_modal_<?php echo($color->color_id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                        <h4 class="modal-title">Edit color code</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="m-t" method="post" role="form" action="<?php echo(base_url()); ?>mos_color_codes/edit_color">
                                            <div class="form-group">
                                                <label>Color id</label>
                                                <input style="color: black" type="text" disabled class="form-control" placeholder="Names" value="<?php echo($color->color_id); ?>" required="">
                                            </div>

                                            <input type="hidden" name="color_id" value="<?php echo($color->color_id); ?>" >
                                            <div class="form-group">

                                                <input style="color: black" name="color" type="text" class="form-control" placeholder="Color eg. yellow" value="<?php echo($color->color); ?>"  >
                                            </div>


                                            <!--<div class="form-group">
                                                    <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Agree the terms and policy </label></div>
                                            </div>-->
                                            <!--                        <input type="submit" class="btn btn-primary block full-width m-b" value="Create User" >
                                            -->
                                            <!--<p class="text-muted text-center"><small>Already have an account?</small></p>
                                            <a class="btn btn-sm btn-white btn-block" href="login.html">Login</a>-->


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                        <input type="submit" class="btn btn-primary" value="Update" >
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

            <?php
            }
        }

        ?>









        </tbody>

        </table>

        </div>
        </div>
        </div>
        </div>
    </div>
<?php require_once("includes/footer.php"); ?>