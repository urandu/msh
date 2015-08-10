<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php if(!empty($title)){ echo($title); }?></title>

    <link href="<?php base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">

    <link href="<?php base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php base_url(); ?>assets/css/style.css" rel="stylesheet">

</head>

<!--<body class="gray-bg">-->
<body class="barclays-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                 <!--<img border="0" src="/img/moh.jpg" width="61" height="133">-->
                <span> <img alt="image" class="img image" src="assets/img/moh.jpg" /></span>

                <!--<h1 class="logo-name">MSH</h1>-->

            </div>
            <h3 style="color:white;font-size: 20px">Malaria Commodities Stock Monitoring Tool</h3>
           <!-- <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)
            </p>-->
            <p style="color:white;font-size: 18px" >Login in. To continue.</p>
            <form  method="post" role="form" action="<?php base_url(); ?>login/validate">
                <div class="form-group">
                    <input name="email" type="email" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input name="password" type="password" class="form-control" placeholder="Password" required="">
                </div>
                <input type="submit" class="btn btn-primary block full-width m-b" value="Login">

                <a href="#"><small style="color:white;font-size: 15px">Forgot password?</small></a>
               <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>-->
                <!--<a class="btn btn-sm btn-white btn-block" href="<?php /*base_url(); */?>register">Create an account</a>-->
            </form>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div>
            
             
                <!--<img alt="image" class="center" class="img image" src="assets/img/logo.jpg" />-->
            <!-- <div><marquee>This tool was developed for the Ministry of Health by USAID- funded Health Commodities & Services Management Program implemented by Management Sciences for Health. Contents do not necessarily reflect the views of USAID or the United States Government.</marquee></div>-->
            <p style="color:white;width:1000px;margin-left:-350px;font-size: 15px">This tool was developed for the Ministry of Health by USAID- funded Health Commodities 
               & Services Management Program implemented by Management Sciences for Health. 
               Contents do not necessarily reflect the views of USAID or the United States Government.</p> 

            <p style="color:white"> <small>MSH &copy; <?php echo(date("Y")); ?></small> </p>
            
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php base_url(); ?>assets/js/jquery-2.1.1.js"></script>
    <script src="<?php base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>

</html>
