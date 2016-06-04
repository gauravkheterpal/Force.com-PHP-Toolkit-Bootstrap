<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Force.com Php Tool Kit</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <div id="page-content-wrapper">
    <div class="container">
      <div id="content" class="page-container">
   
<!-- top navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top "  role="navigation">
       <div class="container">
          <div class="navbar-header">
            <a href="#menu-toggle" id="menu-toggle">
               <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".sidebar-nav">
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
               </button>
             </a><!--menu-toggle-->
            <a class="navbar-brand" href="#">Force.com Php Tool Kit</a>
           </div><!--navbar-header-->
       </div><!--container-->
    </div><!--navbar navbar-inverse navbar-fixed-top-->
            

    <div id="wrapper">
  
        <!-- Sidebar -->
        
        <div id="sidebar-wrapper"  role="navigation">
          
            <ul class="sidebar-nav nav" id="sidebar-nav" >
                <li class="sidebar-brand">
                    
                </li>
                <li>
                    <a href="index.php">Configuration</a>

                </li>
                <li>
                    <a href="enterprise.php">Enterprise</a>
                </li>
                <li>
                    <a href="partner.php">Partner</a>
                </li>
                <li>
                    <a href="contact_list.php">Contact List</a>
                </li>
            </ul>
       
        </div>


        <!-- /#sidebar-wrapper -->
        <div class="row signin">
          <div class="col-xs-12 col-sm-5" data-spy="scroll" data-target="#sidebar-nav">
              <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><strong>Sign In </strong></h3></div>
                <div class="panel-body">
                  <form role="form" id="loginform" method="post" action="enterprise.php">
                    <!--USERNAME-->
                      <div class="form-group">
                        <label for="exampleInputEmail1">USERNAME</label>
                        <input type="text" class="form-control required" id="exampleInputEmail1" name="exampleInputEmail1" placeholder="USERNAME" >
                        <span id="error_show" style="color:red;"></span>
                      </div>
                      <!--PASSWORD-->
                      <div class="form-group">
                        <label for="exampleInputPassword1">PASSWORD</label>
                        <input type="password" class="form-control required" id="exampleInputPassword1" name="exampleInputPassword1" placeholder="PASSWORD"  >
                        <span id="error_show1" style="color:red;"></span>
                      </div>
                      <!--SECURITY TOKEN-->
                      <div class="form-group">
                        <label for="exampleInputSecurity1">SECURITY TOKEN</label>
                        <input type="text" class="form-control required" id="exampleInputSecurity1" name="exampleInputSecurity1" placeholder="SECURITY TOKEN" >
                        <span id="error_show2" style="color:red;"></span>
                      </div>

                      <button type="submit" class="btn btn-sm btn-primary" id="login">Sign in</button>
                  </form><!--loginform-->
                </div><!--panel-body-->
              </div><!--panel panel-default-->
            </div><!--col-xs-12 col-sm-5-->
        </div><!--row signin-->
      </div><!--wrapper-->
    </div><!--content-->
  </div><!--main container-->
</div><!--page-content-wrapper-->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/script.js"></script>
    
<script>
$('#login').click(function() 
{
   var url = 'enterprise.php';
   var email = $("#exampleInputEmail1").val();
   var password = $("#exampleInputPassword1").val();
   var security = $("#exampleInputSecurity1").val();



    if(email=='' || email=='USERNAME') 
    {
        

      $('#error_show').html("Please fill Username...!!!!!!");

      return false;
    }

    else if(password=='' || password=='PASSWORD')
    {

        $('#error_show').html("");
        $('#error_show1').html("Please fill Password field...!!!!!!");
      
        return false;
    }

    else if(security=='' || security=='SECURITY TOKEN')
    {
      
        $('#error_show1').html("");
        $('#error_show2').html("Please fill security field...!!!!!!");
        return false;
    }
    else
    {
        $('#error_show2').html("");
    }
      
});
</script>


</body>

</html>



