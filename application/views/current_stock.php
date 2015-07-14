<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Current stock</h2>
            </div>
        <div class="col-sm-8">
            <div class="title-action">
              <a href="#"  data-toggle="modal" data-target="#central_level_data" class="btn btn-primary">Add current stock</a>
               
            </div>
        </div>
    </div>

   <div class="wrapper wrapper-content">
       <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Current Stock</h5>
                        <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comodity</th>                            
                                    <th>Supply agency</th>
                                    <th>Funding agency</th>
                                    <th>Opening balance</th>
                                    <th>Supplier receipts</th>
                                    <th>Total issues</th>
                                    <th>Closing balance</th>
                                    <th>Expiry date</th>
                                    <th>Quantity expiring</th>  
                                    <th>Edit</th>                            
                                    </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; ?>
                                <?php foreach ($central_level as $central_level_data): ?> 
                                 <tr>
                                    <td><?php echo $count; ?></td>
                                      <td>  
                                        <?php foreach ($commodity as $malaria_commodity):
                                        if ($malaria_commodity->commodity_id==$central_level_data->commodity_id) 
                                            echo $malaria_commodity->commodity_name." ".$malaria_commodity->unit_of_measure;
                                         endforeach; ?></td>
                                         <td> <?php foreach ($supply_chain_agency as $supply):?>
                                            <?php 
                                            if ($supply->supply_chain_agency_id==$central_level_data->supply_agency_id)
                                             echo $supply->supply_chain_agency;?>
                                        <?php endforeach; ?> </td>
                                        <td>
                                            <?php foreach ($funding_agency as $agency): 
                                            if ($agency->funding_agency_id==$central_level_data->funding_agency_id)
                                                echo $agency->funding_agency_name;?>
                  <?php endforeach; ?></td>
                  <td> <?php echo $central_level_data->opening_balance;?></td>
                  <td><?php echo $central_level_data->total_receipts_from_suppliers;?></td>
                  <td><?php echo $central_level_data->total_issues_to_facilities;?></td>
                  <td><?php echo $central_level_data->soh_closing_balance;?></td>
                  <td><?php echo $central_level_data->earliest_expiry_date;?></td>
                  <td><?php echo $central_level_data->quantity_expiring;?></td>
                  <td data-toggle="modal" data-target="#myModal_<?php echo $central_level_data->central_level_stock_id; ?>"><i class="fa fa-wrench"></i>

                     <div class="modal inmodal" id="myModal_<?php echo $central_level_data->central_level_stock_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Edit current stock</h4>
                        <small class="font-bold">Update and delete details about stocks currently held at the central level.</small>
                    </div>
                    <form action="<?= base_url();?>current_stock/update_central_level" method="post" enctype="multipart/form-data">  
                    <div class="modal-body">

                   <div class="form-group"><input type="hidden" name="central_level_stock_id" value="<?php echo $central_level_data->central_level_stock_id; ?>" class="form-control"></div>
                  <div class="form-group"><label>Commodity: </label><select class="form-control m-b" >
                    <?php foreach ($commodity as $malaria_commodity): ?>  
                      <option name="commodity_name" <?php if ($malaria_commodity->commodity_id==$central_level_data->commodity_id){echo"selected";} ?>><?php  echo $malaria_commodity->commodity_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   <div class="form-group"><label>Funding agency: </label><select class="form-control m-b"  >
                    <?php foreach ($funding_agency as $agency): ?>  
                      <option name="funding_agency_name" <?php  if ($agency->funding_agency_id==$central_level_data->funding_agency_id){echo"selected";} ?>><?php echo $agency->funding_agency_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   
                <div class="form-group"><label>Supply chain agency: </label><select class="form-control m-b"  >
                    <?php foreach ($supply_chain_agency as $supply): ?>  
                      <option name="supply_chain_agency" <?php if($supply->supply_chain_agency_id==$central_level_data->supply_agency_id){echo"selected";} ?>><?php echo $supply->supply_chain_agency;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                       <div class="form-group"><label>Opening balance: </label> <input type="text" name="opening_balance" value="<?php echo $central_level_data->opening_balance; ?>" class="form-control"></div>
                     <div class="form-group"><label>Supplier receipts: </label> <input type="text" name="total_receipts_from_suppliers" value="<?php echo $central_level_data->total_receipts_from_suppliers; ?>" class="form-control"></div>
                    <div class="form-group"><label>Total issues: </label> <input type="text" name="total_issues_to_facilities" value="<?php echo $central_level_data->total_issues_to_facilities; ?>" class="form-control"></div>
                   <div class="form-group"><label>Closing balance: </label> <input type="text" name="soh_closing_balance" value="<?php echo $central_level_data->soh_closing_balance; ?>" class="form-control"></div>
                   <div class="form-group"><label>Expiry date: </label> <input type="text" name="earliest_expiry_date" value="<?php echo $central_level_data->earliest_expiry_date; ?>" class="form-control"></div>
                   <div class="form-group"><label>Quantity expiring: </label> <input type="text" name="quantity_expiring" value="<?php echo $central_level_data->quantity_expiring; ?>" class="form-control"></div>
                 
                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save changes</button>
 <a href="<?php echo(base_url()."current_stock/delete_central_level_data/".$central_level_data->central_level_stock_id); ?>"><i class="fa fa-trash"></i></a>    
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                       <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                    </div>
                </form>
                </div>
            </div>
        </div>
      </td>
      </tr>
      <?php $count++; endforeach; ?>
      </tbody>
      </table>
      </div>
      </div>
      </div>
      </div>
    </div>





<div class="modal inmodal" id="central_level_data" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Add to current stock</h4>
                        <small class="font-bold">Add details about stocks currently held at the central level.</small>
                    </div>
                    <form action="<?= base_url();?>current_stock/save_central_level" method="post" enctype="multipart/form-data">  
                    <div class="modal-body">

                   <div class="form-group"><input type="hidden" name="central_level_stock_id" value="<?php echo $central_level_data->central_level_stock_id; ?>" class="form-control"></div>
                  <div class="form-group"><label>Commodity: </label><select class="form-control m-b" >
                    <?php foreach ($commodity as $malaria_commodity): ?>  
                      <option name="commodity_name" ><?php  echo $malaria_commodity->commodity_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   <div class="form-group"><label>Funding agency: </label><select class="form-control m-b"  >
                    <?php foreach ($funding_agency as $agency): ?>  
                      <option name="funding_agency_name" ><?php echo $agency->funding_agency_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   
                <div class="form-group"><label>Supply chain agency: </label><select class="form-control m-b"  >
                    <?php foreach ($supply_chain_agency as $supply): ?>  
                      <option name="supply_chain_agency" ><?php echo $supply->supply_chain_agency;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                       <div class="form-group"><label>Opening balance: </label> <input type="text" name="opening_balance" placeholder="Opening balance" class="form-control"></div>
                     <div class="form-group"><label>Supplier receipts: </label> <input type="text" name="total_receipts_from_suppliers" placeholder="Supplier receipts" class="form-control"></div>
                    <div class="form-group"><label>Total issues: </label> <input type="text" name="total_issues_to_facilities" placeholder="Total issues" class="form-control"></div>
                   <div class="form-group"><label>Closing balance: </label> <input type="text" name="soh_closing_balance"  placeholder="Closing balance" class="form-control"></div>
                   <div class="form-group"><label>Expiry date: </label> <input type="text" name="earliest_expiry_date"  placeholder="Expiry date" class="form-control"></div>
                   <div class="form-group"><label>Quantity expiring: </label> <input type="text" name="quantity_expiring"  placeholder="Quantity expiring" class="form-control"></div>
                 
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





<?php require_once("includes/footer.php"); ?>


<!-- <div class="modal inmodal" id="add_commodity" tabindex="-1" role="dialog" aria-hidden="true">
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
                                        <div class="form-group"><label>Unit of measure: </label> <input type="text" name="unit_of_measure" placeholder="UoM" class="form-control"></div>
                                       <div class="form-group"><label>Description: </label> <input type="text" name="commodity_description" placeholder="Description" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                             <button type="submit" class="btn btn-primary">Add commodity</button>
                                             <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <input type="submit" id="submit" name="dsubmit" value="Update"> 
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div> -->