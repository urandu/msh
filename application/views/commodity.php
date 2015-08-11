<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage commodities</h2>

        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="#"  data-toggle="modal" data-target="#add_commodity" class="btn btn-primary">Add a commodity</a>


            </div>
        </div>
    </div>



     <div class="wrapper wrapper-content">
       <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Commodity</h5>
                        <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comodity</th>
                                    <th>Alt name</th>
                                    <th>Unit of Measure</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    </tr>

                            </thead>

                            <tbody>
                            <?php $count=1; ?>
                            <?php foreach ($commodity as $malaria_commodity): ?>

                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $malaria_commodity->commodity_name; ?></td>
                                    <td><?php echo $malaria_commodity->alt_name;?></td>
                                    <td><?php echo $malaria_commodity->unit_of_measure;?></td>
                                    <td><?php echo $malaria_commodity->commodity_description; ?></td>
                                   <td data-toggle="modal" data-target="#myModal_<?php echo $malaria_commodity->commodity_id; ?>"><i class="fa fa-wrench"></i>


                                         <div class="modal inmodal" id="myModal_<?php echo $malaria_commodity->commodity_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                               <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-laptop modal-icon"></i>
                                            <h4 class="modal-title">Edit commodity</h4>
                                            <small class="font-bold">Update and delete details about a particular commodity.</small>
                                        </div>

                                        <form action="<?= base_url();?>commodity/update_commodity" method="post" enctype="multipart/form-data">  
                                        <div class="modal-body">

                           <div class="form-group"><input type="hidden" name="commodity_id" value="<?php echo $malaria_commodity->commodity_id; ?>" class="form-control"></div>
                                        <div class="form-group"><label>Commodity: </label> <input type="text" name="commodity_name" value="<?php echo $malaria_commodity->commodity_name; ?>" class="form-control"></div>
                                        <div class="form-group"><label>Alternative name: </label> <input type="text" name="alt_name" value="<?php echo $malaria_commodity->alt_name; ?>" class="form-control"></div>
                                        <div class="form-group"><label>Unit of measure: </label> <input type="text" name="unit_of_measure" value="<?php echo $malaria_commodity->unit_of_measure; ?>" class="form-control"></div>
                                       <div class="form-group"><label>Description: </label> <input type="text" name="commodity_description" value="<?php echo $malaria_commodity->commodity_description; ?>" class="form-control"></div></div>
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary">Save changes</button>

                                             <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                           <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            </td> 
                                    <td>
                                        <a href="<?php echo(base_url()."commodity/delete_commodity/".$malaria_commodity->commodity_id); ?>"><i class="fa fa-trash"></i></a>
                                    </td></tr>
                                <?php $count++; endforeach; ?>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>


        </div>

    </div>
</div>


<div class="modal inmodal" id="add_commodity" tabindex="-1" role="dialog" aria-hidden="true">
                               <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-laptop modal-icon"></i>
                                            <h4 class="modal-title">Malaria commodity</h4>
                                            <small class="font-bold">Add a commodity here.</small>
                                        </div>
                                        <form action="<?= base_url();?>commodity/save_commodity" method="post" enctype="multipart/form-data">  
                                        <div class="modal-body">

                 

                                        <div class="form-group"><label>Commodity: </label> <input type="text" name="commodity_name" placeholder="Commodity" class="form-control"></div>
                                        <div class="form-group"><label>Alternative name: </label> <input type="text" name="alt_name" placeholder="Alternative name" class="form-control"></div>

                                        <div class="form-group"><label>Unit of measure: </label> <input type="text" name="unit_of_measure" placeholder="UoM" class="form-control"></div>
                                       <div class="form-group"><label>Description: </label> <input type="text" name="commodity_description" placeholder="Description" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary">Add commodity</button>

                                             <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                           <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
       
     



   


<?php require_once("includes/footer.php"); ?>