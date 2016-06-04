<?php
session_start();
 

$email2=$_SESSION['email1'];
$password2=$_SESSION['password1'];
$security2=$_SESSION['security1'];

if( (!isset($_SESSION['email1'])) && (!isset($_SESSION['password1'])) && (!isset($_SESSION['security1'])) )

{
     echo "<script>alert('Please Enter Credentials !!!!!')</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
exit;
}
?>
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
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
            <?php
            require_once ('soapclient/SforceEnterpriseClient.php');
            define("USERNAME", $email2);
            define("PASSWORD", $password2);
            define("SECURITY_TOKEN", $security2);
       
            $mySforceConnection = new SforceEnterpriseClient();
            $mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
            $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

            ?>
<div id="content">
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper" >
            <ul class="sidebar-nav" id="nav" >
                <li class="sidebar-brand">
                    
                </li>
                
                <li>
                    <p> <?php echo $email2;?></p>
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
                <li>
                    <a href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
        <?php
            $id=$_REQUEST['id'];
            
            try
            {
                $response = $mySforceConnection->delete($id);
                        foreach ($response as $result) {
                       if($result->success == 1) 
                        {
                                echo "<script>alert('Contact Deleted Successfully')</script>";
                                echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
                            }
                            else
                            {

                             echo "<script>alert('Your attempt to delete ".$id." could not be completed.')</script>";
                             echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
                              }
                                
                            }
                        }
                        
                            catch (Exception $e) {
                        echo "Exception ".$e->faultstring."<br/><br/>\n";
                        echo "Last Request:<br/><br/>\n";
                        echo $mySforceConnection->getLastRequestHeaders();
                        echo "<br/><br/>\n";
                        echo $mySforceConnection->getLastRequest();
                        echo "<br/><br/>\n";
                        echo "Last Response:<br/><br/>\n";
                        echo $mySforceConnection->getLastResponseHeaders();
                        echo "<br/><br/>\n";
                        echo $mySforceConnection->getLastResponse();
            }
            

        ?>

        </div><!-- End Wrapper-->
</div><!-- End Content-->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    </body>

</html>
