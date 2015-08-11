<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Update stocks</h2>
            </div>
        <div class="col-sm-8">
            <div class="title-action">
              <a href="#"  data-toggle="modal" data-target="#central_level_data" class="btn btn-primary">Add current stock</a>
               
            </div>
        </div>
    </div>
    </br>

  <div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>update_stocks/show_current_stock">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($stock as $stck): ?>
            <option value="<?php echo $stck->period; ?>"  ><?php echo $stck->period; ?></option>
        <?php endforeach; ?>
    </select>
    </br>
        <input class="btn btn-primary" type="submit" value="Get current stock report">
        </form>
</div> 
</div>

   
<div class="wrapper wrapper-content">
  <div class="row">
       <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                       <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comodity</th>                            
                                    <th>Qty Received</th>
                                    <th>Qty Issued</th>
                                    <th>Stock on hand</th>
                                    <th>period</th>
                                    <th>Edit</th>                            
                                    <th>Remove</th>                            
                                    </tr>
                            </thead>

<?php if (isset($update_stock)) {?>
<tbody>
                                <?php $count=1; ?>
                                <?php foreach ($update_stock as $central_level_data): ?> 
                                 <tr>
                                    <td><?php echo $count; ?></td>
                                      <td><?php foreach ($commodity as $malaria_commodity):
                                      if ($malaria_commodity->commodity_id==$central_level_data->commodity_id) {
                                        echo $malaria_commodity->commodity_name;
                                      }
                                         endforeach;
                                      ?></td>
                                         <td><?php echo $central_level_data->PendingTotal;?></td>
                                        <td><?php echo $central_level_data->sum_issued;?></td>
                  <td><?php echo $central_level_data->soh;?></td>
                  <td><?php echo $central_level_data->period;?></td>
                                 
              
                  <td data-toggle="modal" data-target="#myModal_<?php echo $central_level_data->current_stock_id; ?>"><i class="fa fa-wrench"></i>

                     <div class="modal inmodal" id="myModal_<?php echo $central_level_data->current_stock_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Update stock</h4>
                        <small class="font-bold">Update and delete details about stocks currently held at the central level.</small>
                    </div>
                    <form action="<?= base_url();?>update_stocks/update_current_stock" method="post" enctype="multipart/form-data">  
                    <div class="modal-body">

                   <div class="form-group"><input type="hidden" name="current_stock_id" value="<?php echo $central_level_data->current_stock_id; ?>" class="form-control"></div>
                  <div class="form-group"><label>Commodity: </label><select class="form-control m-b" name="commodity_name" >
                    <?php foreach ($commodity as $malaria_commodity): ?>  
                      <option  value="<?php  echo $malaria_commodity->commodity_name;?>" <?php if ($malaria_commodity->commodity_id==$central_level_data->commodity_id){echo"selected";} ?>><?php  echo $malaria_commodity->commodity_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                 <div class="form-group"><label>Quantity received: </label> <input type="text" name="quantity_received" value="<?php echo $central_level_data->quantity_received; ?>" class="form-control"></div>
                  <div class="form-group"><label>Quantity Issued: </label> <input type="text" name="quantity_issued" value="<?php echo $central_level_data->quantity_issued; ?>" class="form-control"></div>
                  <div class="form-group"><label>Stock on hand: </label> <input type="text" name="soh" value="<?php echo $central_level_data->soh; ?>" class="form-control"></div>
                   <div class="form-group"><label>Period :</label>
                    <input type="text" required name="period" class="form-control"  data-mask="9999-99" value="<?php echo $central_level_data->period; ?>">
                    <span class="help-block">yyyy-mm</span>

                        </div>
                  </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save</button>
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                       <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                    </div>
                </form>
                </div>
            </div>
        </div>
      </td>
      <td> <a href="<?php echo(base_url()."update_stocks/delete_data/".$central_level_data->current_stock_id); ?>"><i class="fa fa-trash"></i></a>    
</td>
      </tr>
      <?php $count++; 
      endforeach; ?>
      </tbody>
      </table>
        <?php }?>

      </div>
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
                    <form action="<?= base_url();?>update_stocks/save_current_data" method="post" enctype="multipart/form-data">  
                    <div class="modal-body">

                  <div class="form-group"><label>Commodity: </label><select class="form-control m-b" name="commodity_name">
                    <?php foreach ($commodity as $malaria_commodity): ?>  
                      <option  value="<?php  echo $malaria_commodity->commodity_name;?>"><?php  echo $malaria_commodity->commodity_name;?></option>
                    <?php endforeach; ?>
                      </select></div>                   
                  <div class="form-group"><label>Quantity received: </label> <input type="text" name="quantity_received" placeholder="Quantity received"  class="form-control"></div>
                  <div class="form-group"><label>Quantity Issued: </label> <input type="text" name="quantity_issued" placeholder="Quantity issued" class="form-control"></div>
                  <div class="form-group"><label>Stock on hand: </label> <input type="text" name="soh"  placeholder="Stock on hannd" class="form-control"></div>
                    <div class="form-group"><label>Period :</label>
                            <input type="text" required name="period" class="form-control"  data-mask="9999-99" placeholder="Period">
                            <span class="help-block">yyyy-mm</span>

                        </div>                     
                       </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save</button>
                           <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                       <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->
                    </div>
                </form>
                </div>
            </div>
        </div>



<?php require_once("includes/footer.php"); ?>


