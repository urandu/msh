<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage users</h2>
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
                <a href="#" data-toggle="modal" data-target="#add_user_modal" class="btn btn-primary">Add new user</a>
            </div>
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
            <h5>All users</h5>

            <div class="ibox-tools">



            </div>
        </div>
        <div class="ibox-content">

        <table class="table table-striped table-bordered table-hover dataTables-example">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>ID number</th>
            <th>Phone number</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php

        if(!empty($users))
        {
            foreach($users as $user)
            {
                ?>


                <tr class="gradeX">
                    <td><?php echo($user->names); ?></td>
                    <td><?php echo($user->email); ?></td>
                    <td><?php echo($user->national_id); ?></td>
                    <td><?php echo($user->phone_number); ?></td>
                    <td class="center"><a data-target="#edit_user_modal_<?php echo($user->user_id); ?>" data-toggle="modal" href="#">
                            <i class="fa fa-wrench"></i> Edit
                        </a>
                        <div class="modal inmodal" id="edit_user_modal_<?php echo($user->user_id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                        <h4 class="modal-title">Edit details for <strong><?php echo($user->names); ?></strong> </h4>
                                    </div>
                                    <div class="modal-body">
                                        <form style="color: black;" class="m-t" method="post" role="form" action="<?php echo(base_url()); ?>register/edit_user">
                                            <div class="form-group">
                                                <input name="names" type="text" class="form-control" placeholder="Names" value="<?php echo($user->names); ?>" required="">
                                            </div>
                                            <div class="form-group">
                                                <input name="email" type="email" class="form-control" placeholder="Email" value="<?php echo($user->email); ?>" required="">
                                            </div>
                                            <input type="hidden" name="user_id" value="<?php echo($user->user_id); ?>" >
                                            <div class="form-group">
                                                <input name="password" type="password" class="form-control" placeholder="Password" >
                                            </div>
                                            <div class="form-group">
                                                <input name="national_id" type="number" class="form-control" value="<?php echo($user->national_id); ?>" placeholder="National ID number" required="">
                                            </div>
                                            <div class="form-group">
                                                <input name="phone_number" type="tel" class="form-control" placeholder="Phone Number" value="<?php echo($user->phone_number); ?>" required="">
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
        <tfoot>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>ID number</th>
            <th>Phone number</th>
            <th></th>
        </tr>
        </tfoot>
        </table>

        </div>
        </div>
        </div>
        </div>
    </div>
    <div class="modal inmodal" id="add_user_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                    <h4 class="modal-title">Create new user</h4>
                </div>
                <div class="modal-body">
                    <form autocomplete="off" style="color: black;" class="m-t" method="post" role="form" action="<?php echo(base_url()); ?>register/create_user">
                        <div class="form-group">
                            <input name="names" type="text" class="form-control" placeholder="Names" required="">
                        </div>
                        <div class="form-group">
                            <input name="email" type="email" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="form-group">
                            <input name="password" type="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <div class="form-group">
                            <input name="national_id" type="number" class="form-control" placeholder="National ID number" required="">
                        </div>
                        <div class="form-group">
                            <label>User level</label>
                            <select name="role">
                                <option value="0">Regular user</option>
                                <option value="1">Editor</option>
                                <option value="-1">Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="phone_number" type="tel" class="form-control" placeholder="Phone Number" required="">
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

                    <input type="submit" class="btn btn-primary" value="Create user" >

                </div>
                </form>
            </div>
        </div>
    </div>
<?php require_once("includes/footer.php"); ?>