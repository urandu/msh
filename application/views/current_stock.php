<?php require_once("includes/header.php"); ?>




<script>
  function myFunction() 
  {
      var base_url = "<?= base_url();?>";
      var item = document.getElementById("test");
      var itemIndex = item.selectedIndex;
      var itemSelected = item[itemIndex].value;
     var url = base_url+"current_stock/get_by_id";
     $.getJSON
      (
        url,
        {pending_shipment_id:itemSelected},
        function(dataReceived)
        {
          /*NOTES:
            0 - funding agency id
            1 - funding agency name
            2 - commodity id
            3 - commodity name
          */
          $("#selected_agency").html(dataReceived[1]);
          $("#selected_commodity").html(dataReceived[3]);
        }

      );
  }
</script>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Recieved stocks</h2>
            </div>
        <div class="col-sm-8">
            <div class="title-action">
              <a href="#"  data-toggle="modal" data-target="#central_level_data" class="btn btn-primary">Add received stock </a>
               
            </div>
        </div>
    </div>
    </br>
    <div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>current_stock/index">
    <select name="period" class="form-control">
        <option  selected>--SELECT PERIOD--</option>
        <?php foreach ($central_level as $cld): ?>
            <option value="<?php echo $cld->period; ?>"  ><?php echo $cld->period; ?></option>
        <?php endforeach; ?>
    </select>
    </br>
        <input class="btn btn-primary" type="submit" value="Get received stock(s) report">
        </form>
</div> 
</div>

<div class="wrapper wrapper-content">
  <div class="row">
       <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Received Stock(s) for: <?php echo $period ?></h5>
                        <div class="ibox-content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Comodity</th>                            
                                    <th>Supply agency</th>
                                    <th>Funding agency</th>
                                    <th>Quantity received</th>
                                    <th>Period</th>
                                    <th>Edit</th>                            
                                    <th>Delete</th>                            
                                    </tr>

                            </thead>
<?php if (isset($period)) {?>
                            <tbody>

                                <?php $count=1; ?>
                                <?php foreach ($central_level_data_by_period as $central_level_data): ?> 
                                 <tr>


                                    <td><?php echo $count; ?></td>
                                    <td>
                                        <?php foreach ($commodity as $malaria_commodity):
                                            if ($malaria_commodity->commodity_id == $central_level_data->commodity_id)
                                                echo $malaria_commodity->commodity_name . " " . $malaria_commodity->unit_of_measure;
                                        endforeach; ?></td>
                                    <td> <?php foreach ($supply_chain_agency as $supply): ?>
                                            <?php
                                            if ($supply->supply_chain_agency_id == $central_level_data->supply_agency_id)
                                                echo $supply->supply_chain_agency;?>
                                        <?php endforeach; ?> </td>
                                    <td>
                                        <?php foreach ($funding_agency as $agency):
                                            if ($agency->funding_agency_id == $central_level_data->funding_agency_id)
                                                echo $agency->funding_agency_name;?>

                  <?php endforeach; ?></td>
                  <td><?php echo $central_level_data->soh_closing_balance;?></td>
                  <td><?php echo $central_level_data->period;?></td>
              
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
                  <div class="form-group"><label>Commodity: </label><select class="form-control m-b" name="commodity_name" >
                    <?php foreach ($commodity as $malaria_commodity): ?>  
                      <option  value="<?php  echo $malaria_commodity->commodity_name;?>" <?php if ($malaria_commodity->commodity_id==$central_level_data->commodity_id){echo"selected";} ?>><?php  echo $malaria_commodity->commodity_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   <div class="form-group"><label>Funding agency: </label><select class="form-control m-b" name="funding_agency_name" >
                    <?php foreach ($funding_agency as $agency): ?>  
                      <option  value="<?php echo $agency->funding_agency_name;?>" <?php  if ($agency->funding_agency_id==$central_level_data->funding_agency_id){echo"selected";} ?>><?php echo $agency->funding_agency_name;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                   
                <div class="form-group"><label>Supply chain agency: </label><select class="form-control m-b" name="supply_chain_agency" >
                    <?php foreach ($supply_chain_agency as $supply): ?>  
                      <option value="<?php echo $supply->supply_chain_agency;?>" <?php if($supply->supply_chain_agency_id==$central_level_data->supply_agency_id){echo"selected";} ?>><?php echo $supply->supply_chain_agency;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                  <div class="form-group"><label>Quantity received: </label> <input type="text" name="soh_closing_balance" value="<?php echo $central_level_data->soh_closing_balance; ?>" class="form-control"></div>
                  <div class="form-group"><label>Period :</label>
                    <input type="text" required name="period" class="form-control"  data-mask="9999-99" value="<?php echo $central_level_data->period; ?>">
                    <span class="help-block">yyyy-mm</span>

                        </div>

                    </div>
                    <div class="modal-footer">
                         <button type="submit" class="btn btn-primary">Save changes</button>
                          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                       <!--  <input type="submit" id="submit" name="dsubmit" value="Update"> -->

                    </div>
                </div>


            </div>
        </div>

      </td>
      <td> <a href="<?php echo(base_url()."current_stock/delete_central_level_data/".$central_level_data->central_level_stock_id); ?>"><i class="fa fa-trash"></i></a>    
</td>
      </tr>
      <?php $count++; endforeach; ?>
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
                    <form action="<?= base_url();?>current_stock/save_central_level" method="post" enctype="multipart/form-data">  
                    <div class="modal-body">

                    <div class="form-group"><label>Pending shipment: </label>
                      <span>Commodity name--source--period--quantity</span>
                      <select class="form-control m-b" name="pending_shipment_id" id="test" onchange = "javascript:myFunction();" required>
                    <option value = "">[Select]</option>
                    <?php foreach ($pending_shipment as $pending): ?>  
                    <option  value="<?php echo $pending->pending_shipment_id;?>">  <table border='1'> 
                      <tr><td><?php foreach ($commodity as $malaria_commodity):
                       if ($malaria_commodity->commodity_id == $pending->commodity_id){echo $malaria_commodity->commodity_name;}
                       endforeach;?>
                     </td><td>--</td><td>
                     <?php foreach ($funding_agency as $agency): 
                      if ($agency->funding_agency_id==$pending->funding_agency_id){
                      echo $agency->funding_agency_name;
                      }
                     endforeach;?> 
                    </td>--<td> <?php echo($pending->period);?></td><td>--</td><td><?php echo $pending->quantity;?></td></tr></table></option>
                    <?php endforeach; ?>
                    </select>
                  
                </div>


                  <div class="form-group"><label>Commodity: </label>
                      <div class="form-control m-b" id="selected_commodity"name="commodity_name">                  
                      </div>
                    </div>
                   <div class="form-group"><label>Funding agency: </label>
                      <div class="form-control m-b" id="selected_agency"name="funding_agency_name" >
                      </div>
                  </div>
                   
                <div class="form-group"><label>Supply chain agency: </label><select class="form-control m-b" name="supply_chain_agency"  >
                    <?php foreach ($supply_chain_agency as $supply): ?>  
                      <option  value="<?php echo $supply->supply_chain_agency;?>" ><?php echo $supply->supply_chain_agency;?></option>
                    <?php endforeach; ?>
                                        </select></div>
                  <div class="form-group"><label>Quantity received:</label>
                   <input type="text" name="soh_closing_balance"  placeholder="Closing balance" class="form-control"></div>
                      <div class="form-group"><label>Period :</label>
                            <input type="text" required name="period" class="form-control"  data-mask="9999-99" placeholder="Period">
                            <span class="help-block">yyyy-mm</span>

                        </div> 
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

<!--   <div class="form-group"><label>Pending shipment: </label><select class="form-control m-b" name="pending_shipment_id" >
                    <?php foreach ($pending_shipment as $pending): ?>  
                      <option  value="<?php echo $pending->pending_shipment_id;?>"><?php echo "<table><tr><td>".$pending->period."</td><tr></table>";?></option>
                    <?php endforeach; ?>
                                        </select></div> -->