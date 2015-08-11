<?php require_once("includes/header.php"); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Manage Forecast Commodity Data</h2>
            
        </div>
        <div class="col-sm-8">
             <div class="title-action">
                <div data-toggle="modal" data-target="#save_forecast_commodity_data" class="btn btn-primary">Add Forecast Commodity Data</div>
            </div>
        </div>
    </div>


   <div class="wrapper wrapper-content">
        
   

<div class="row">
    <div class="col-lg-3">
    <form class="form" method="post" action="<?php echo(base_url()); ?>forecast/index">
    <select name="date" class="form-control">
        <option  selected>--SELECT PERIOD--</option>

        <?php foreach ($dates as $date): ?>
            <option value="<?php echo $date->forecast_start_date; ?>"  ><?php echo $date->forecast_start_date; ?></option>
        <?php endforeach; ?>
    </select>
        <input class="btn btn-primary" type="submit" value="Get Commodities">
        </form>
</div>
 
</div>



<?php

if (isset($period)) {

    //print_r($period);


?>


<div class="row">
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">

             <h5>Forecast Commodities Data for period: <?php echo $selected_period; ?></h5>

             <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Commodity name</th>
                                <th>Forecast Start Date</th>
                                <th>Forecast Period </th>
                                <th>Forecast Monthly Consumption</th>
                                <th>Edit</th>
                                <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($period)) { foreach($period as $p):
                                     echo("<tr>");?>
                                     <td><?php echo $p->commodity_name; ?> </td>
                                     <td><?php echo $p->forecast_start_date;?></td>
                                     <td><?php echo $p->forecast_period; ?></td>
                                     <td><?php echo $p->forecast_monthly_consumption; ?></td>
                                     <td data-toggle="modal" data-target="#myModal_<?php echo $p->commodity_forecast_data_id; ?>"><i class="fa fa-wrench"></i></td>
                                     <td><a href="<?php echo(base_url()."forecast/delete_forecast/".$p->commodity_forecast_data_id); ?>"><i class="fa fa-trash"></i></a></td>

                                     <div class="modal inmodal" id="myModal_<?php echo $p->commodity_forecast_data_id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                      <div class="modal-dialog">
                                            <div class="modal-content animated bounceInRight">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <i class="fa fa-laptop modal-icon"></i> <h4 class="modal-title">Edit Forecast Data</h4>
                                                    <small class="font-bold">Edit details of the forecast here.</small>
                                                    </div>
                                                    <div class="modal-body">
                  <form action="<?= base_url();?>forecast/update_forecast_commodity_data" method="post" enctype="multipart/form-data" autocomplete="on">
                <!-- commodity_forecast_data_id -->
                 <div class="form-group"><input type="hidden" name="id" value="<?php echo $p->commodity_forecast_data_id; ?>" class="form-control"></div>

                <div class= "form-group"><label>Forecast Start Date:</label><input type="text" class="form-control" name="forecast_start_date" value="<?php echo $p->forecast_start_date; ?>"></div>
                <div class "form-group"><label>Forecast Period: </label><input type="text" class="form-control" name="forecast_period" value="<?php echo $p->forecast_period;?>"></div> 

                <div class="form-group"><label> Commodity Name: </label><select class="form-control m-b" name="commodity_name">
                  <?php foreach($commodity as $COMM):?>
                  <option name="<?php echo $COMM->commodity_name;?>" <?php if ($COMM->commodity_id==$p->cid){ echo "selected";}?>><?php echo $COMM->commodity_name;?></option>
                  <?php endforeach; ?> 
                 </select>              
              </div>
          
               <div class "form-group">
                <label>Forecast Monthly Consumption: </label>

                  <input type="text" class="form-control" name="forecast_monthly_consumption" value="<?php echo $p->forecast_monthly_consumption; ?>">


                                      
              </div> 

              <?php if(isset($message)){?>
    <div class="col-lg-12"><div class="alert alert-success"><div class="col-lg-3"></div><?=$message?></div></div>
<?php }?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Save changes</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>

</div>


        <?php
        echo("</tr>");

           
        endforeach;


        ?>


        <?php
        }
        ?>
                               </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

<?php

}





?>



</div>



 <div class="modal inmodal" id="save_forecast_commodity_data" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Add Forecast Commodities Data</h4>
                        <small class="font-bold">Add forecast commodities data here.</small>
                    </div>
                    <div class="modal-body">


                 <form action="<?= base_url();?>forecast/save_forecast_commodity_data" method="post" enctype="multipart/form-data" autocomplete="on">

                 
                <div class= "form-group">
                <label>Forecast Start Date:</label>

              <input type="text" class="form-control" name="forecast_start_date" data-mask="9999-99" placeholder="Forecast start date">
                <span class="help-block">yyyy-mm</span>
                </div>
               <div class "form-group">
                <label>Forecast Period: </label>        
                  <input type="text" class="form-control" name="forecast_period" placeholder="Forecast period">

               </div> 
               

               <div class="form-group">
               <label> Commodity Name: </label>
                <select name="commodity_name" class="form-control">
                  <?php foreach($commodity as $COMM):?>
                  <option value="<?php echo $COMM->commodity_name;?>"> <?php echo $COMM->commodity_name;?> </option>
                  <?php endforeach; ?> 
                 </select>
              
              </div>

               <div class "form-group">
                <label>Forecast Monthly Consumption: </label>

                  <input type="text" class="form-control" name="forecast_monthly_consumption" placeholder="Forecast Mothly Consupmtion">

                                      
              </div> 

              <?php if(isset($message)){?>
    <div class="col-lg-12"><div class="alert alert-success"><div class="col-lg-3"></div><?=$message?></div></div>
<?php }?>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary">Save changes</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
</div>





<?php require_once("includes/footer.php"); ?>