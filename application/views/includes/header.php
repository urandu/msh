<?php
require_once("top_includes.php");
/**
 * Created by IntelliJ IDEA.
 * User: urandu
 * Date: 7/11/15
 * Time: 2:44 PM
 */

?>

<body>
<div id="wrapper">
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">

                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img image" src="<?php echo(base_url()); ?>assets/img/moh.jpg" />
                             </span>


                    <a> <span class="clear"> <span class="block m-t-xs" style="font-size:14px">Logged in as: <strong
                                    class="font-bold"> <?php echo($this->session->userdata('names')); ?></strong>
                             </span>  </span></a>
                    <!--<ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
                    </ul>-->
                </div>
                <div class="logo-element">
                    MSH
                </div>
            </li>
            <li>
                <a href="<?php echo(base_url()); ?>"><i class="fa fa-th-large"></i> <span
                        class="nav-label" style="font-size:16px">Home</span> </a>

            </li>


            <?php if($this->session->userdata('role')==-1 || $this->session->userdata('role')==1){ ?>
                <li>
                    <a href="#"><i class="fa fa-edit"></i> <span class="nav-label" style="font-size:16px">Stocks</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li><a style="font-size:15px" href="<?php echo(base_url()); ?>planned_procurements">Planned procurements</a></li>
                        <li><a style="font-size:15px" href="<?php echo(base_url()); ?>pending_shipments">Pending shipments</a></li>
                        <li><a style="font-size:15px" href="<?php echo(base_url()); ?>current_stock">Received stock</a></li>
                        <li><a style="font-size:15px" href="<?php echo(base_url()); ?>update_stocks">Update stock</a></li>


                </ul>
            </li>
<?php } ?>



            <li>
                <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label" style="font-size:16px" >Reports</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a style="font-size:15px" href="<?php echo(base_url()); ?>reports/central_mos">Central level MOS</a></li>
                    <li><a style="font-size:15px" href="<?php echo(base_url()); ?>reports/facility_mos">Facility level MOS</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/national_mos">National level MOS</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/county_mos">County level MOS</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/forecast_mos">Forecast data MOS</a></li>

                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/variance_tracker">Forecast Variance Tracker</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/stocks">Stocks</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/commodities">Pending Shipments</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/agencies">Commodities Report</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>reports/individual_commodity">Individual Shipments</a></li>
                </ul>
            </li>

            <?php if($this->session->userdata('role')==-1){

            ?>
            <li>
            <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label" style="font-size:16px">Settings</span><span
                        class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">

                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>funding_agency">Funding agencies</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>supply_chain">Supply chain agencies</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>commodity">Commodities</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>zone">Zones</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>county">Counties</a></li>
                    <li><a style="font-size:15px"href="<?php echo(base_url()); ?>forecast">Forecasts</a></li>
                    <li> <a style="font-size:15px"href="<?php echo(base_url()); ?>mos_color_codes">Manage MOS color codes</a></li>
                    <li> <a style="font-size:15px"href="<?php echo(base_url()); ?>users">Manage Users</a></li>
               <!-- <a href="<?php echo(base_url()); ?>settings/users"><i class="fa fa-user"></i> <span class="nav-label">Settings</span>
                </a>-->
                
             </ul>



            </li>
<?php
}
?>

        </ul>

    </div>
</nav>

<div id="page-wrapper" class="barclays-bg">
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>


            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Malaria Commodities Stock Monitoring Tool</span>
                </li>



                <li>
                    <a href="<?php echo base_url(); ?>login/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
    </div>
