<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage funding agencies</h2>
           </div>
        <div class="col-sm-8">
           <div class="title-action">
               <a href="#"  data-toggle="modal" data-target="#add_funding_agency" class="btn btn-primary">Add a funding agency</a>
           </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
       <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Funding Agency</h5>
                        <div class="ibox-content">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Funding Agency</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; ?>  
                                <?php foreach ($funding_agency as $agency): ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $agency->funding_agency_name; ?></td>
                                    <td><?php echo $agency->comment; ?></td>
                                    <td data-toggle="modal" data-target="#myModal_<?php echo $agency->funding_agency_id; ?>"><i class="fa fa-wrench"></i>


                                         <div class="modal inmodal" id="myModal_<?php echo $agency->funding_agency_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                               <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-laptop modal-icon"></i>
                                            <h4 class="modal-title">Edit agency</h4>
                                            <small class="font-bold">Update and delete details about a particular funding agency.</small>
                                        </div>

                                        <form action="<?= base_url();?>funding_agency/update_funding_agency" method="post" enctype="multipart/form-data">  
                                        <div class="modal-body">

                                       <div class="form-group"><input type="hidden" name="funding_agency_id" value="<?php echo $agency->funding_agency_id; ?>" class="form-control"></div>
                                        <div class="form-group"><label>Commodity: </label> <input type="text" name="funding_agency_name" value="<?php echo $agency->funding_agency_name; ?>" class="form-control"></div>
                                       <div class="form-group"><label>Description: </label> <input type="textarea" name="funding_agency_description" value="<?php echo $agency->comment; ?>" class="form-control"></div>
                                        </div>
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

                                <a href="<?php echo(base_url()."funding_agency/delete_funding_agency/".$agency->funding_agency_id); ?>"><i class="fa fa-trash"></i></a>    

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

        <div class="modal inmodal" id="add_funding_agency" tabindex="-1" role="dialog" aria-hidden="true">
                               <div class="modal-dialog">
                                    <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-laptop modal-icon"></i>
                                            <h4 class="modal-title">Funding agency</h4>
                                            <small class="font-bold">Add a funding agency here.</small>
                                        </div>

                                        <form action="<?= base_url();?>funding_agency/save_funding_agency" method="post" enctype="multipart/form-data">  
                                        <div class="modal-body">

                 
                                        <div class="form-group"><label>Funding agency: </label> <input type="text" name="funding_agency_name" placeholder="Funding agency"  class="form-control"></div>
                                       <div class="form-group"><label>Description: </label> <input type="textarea" name="funding_agency_description" placeholder="Description" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary">Add agency</button>

                                             <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                           <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
       
     

<?php require_once("includes/footer.php"); ?>