<?php
session_start();
        
 try {
$cache_ext  = '.html'; //file extension
$cache_time     = 3600;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder   = 'cache/'; //folder to store Cache files
$ignore_pages   = array('', '');

$dynamic_url    = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; // requested dynamic page (full url)
$cache_file     = $cache_folder.md5($dynamic_url).$cache_ext; // construct a cache file
$ignore = (in_array($dynamic_url,$ignore_pages))?true:false; //check if url is in ignore list

$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);

if (!$ignore && file_exists($cache_file) && time() - $cache_time < filemtime($cache_file)) { //check Cache exist and it's not expired.
    ob_start('ob_gzhandler'); //Turn on output buffering, "ob_gzhandler" for the compressed page with gzip.
    readfile($cache_file); //read Cache file
    echo '<!-- cached page - '.date('l jS \of F Y h:i:s A', filemtime($cache_file)).', Page : '.$dynamic_url.' -->';
    ob_end_flush(); //Flush and turn off output buffering
    exit(); //no need to proceed further, exit the flow.
}
//Turn on output buffering with gzip compression.
ob_start('ob_gzhandler');


$email2=$_SESSION['email1'];
$password2=$_SESSION['password1'];
$security2=$_SESSION['security1'];

if( (!isset($_SESSION['email1'])) && (!isset($_SESSION['password1'])) && (!isset($_SESSION['security1'])) )

{
echo "<script>alert('Please Enter Credentials !!!!!')</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
exit;
}

        $Id=$_GET['Id'];
        $Salutation=$_GET['Salutation'];
        $FirstName=$_GET['FirstName'];
        $LastName=$_GET['LastName'];
        $Phone=$_GET['Phone'];
        $HomePhone=$_GET['HomePhone'];
        $OtherPhone=$_GET['OtherPhone'];
        $MobilePhone=$_GET['MobilePhone'];
        $Title=$_GET['Title'];
        $Fax=$_GET['Fax'];
        $Email=$_GET['Email'];
        $Department=$_GET['Department'];
        $Assistant=$_GET['Assistant'];
        $Birthdate=$_GET['Birthdate'];
        $AssistantPhone=$_GET['AssistantPhone'];
        $LeadSource=$_GET['LeadSource'];
        $MailingStreet=$_GET['MailingStreet'];
        $OtherStreet=$_GET['OtherStreet'];
        $MailingCity=$_GET['MailingCity'];
        $OtherCity=$_GET['OtherCity'];
        $MailingState=$_GET['MailingState'];
        $OtherState=$_GET['OtherState'];
        $MailingPostalCode=$_GET['MailingPostalCode'];
        $OtherPostalCode=$_GET['OtherPostalCode'];
        $MailingCountry=$_GET['MailingCountry'];
        $OtherCountry=$_GET['OtherCountry'];
        $Languages=$_GET['Languages__c'];
        $Level=$_GET['Level__c'];
        $Description=$_GET['Description'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Force.com Php Tool Kit</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
     
<link rel="stylesheet" href="css/style.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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
</div class="container">
<div id="content" class="page-container">
   <div id="wrapper">
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
                         </a>
                           <a class="navbar-brand" href="#">Force.com Php Tool Kit</a>
                    </div>
                   </div>
                </div>
    
                <!-- Sidebar -->
                <div id="sidebar-wrapper"  role="navigation">
                         <ul class="sidebar-nav nav" id="sidebar-nav" >
                        <li class="sidebar-brand">
                            
                        </li>
                        <li>
                           <p> <?php echo $email2;?></p>
                        </li>
                        <li>
                            <a href="index.php">Enterprise</a>

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
        

            
        <div class="row toppadding">
            <div class="col-lg-11">
                <div class="clearfix">
                    <div class="row pageheading">
                        <div class="col-lg-12 ">
                            <div class="col-lg-4 ">
                                    <h1>Contact Detail</h1>
                            </div><!-- col-lg-4 -->
                            <!-- Back Button-->
                            <div class="col-lg-8" style="padding:22px;">
                                 <INPUT TYPE="button" VALUE="Back" onClick="location.href='contact_list.php'"/>
                            </div><!-- col-lg-8 -->
                            <!-- Back Button-->
                        </div>
                    </div><!-- row-->
                        
                        
                        
                    <div class="row form_fields">
                        <div class="col-md-12">
                            <table class="table tableresponse" >
                                <tr>
                                    <th>
                                        <label for='First Name' class='lablecol control-label'>Name</label>
                                    </th>
                                    <td>
                                        <?php echo $Salutation." ".$FirstName." ".$LastName;?>
                                    </td>
                                    <th>
                                        <label for='Phone' class='lablecol control-label'>Phone</label>
                                    </th>
                                    <td>
                                        <?php echo $Phone;?>
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                <th>
                                    <label for='Home Phone' class='lablecol control-label'>Home Phone</label>
                                </th>
                                <td>
                                    <?php echo $HomePhone;?>
                                </td>
                                <th>
                                    <label for='Mobile Phone' class='lablecol control-label'>Mobile Phone</label>
                                </th>
                                <td>
                                    <?php echo $MobilePhone;?>
                                </td>
                            </tr>
                            <tr class='contact_hr'>
                                <th>
                                    <label for='Title' class='lablecol control-label'>Title</label>
                                </th>
                                <td>
                                    <?php echo $Title;?>
                                </td>
                                <th>
                                    <label for='Other Phone' class='lablecol control-label'>Other Phone</label>
                                </th>
                                <td>
                                    <?php echo $OtherPhone;?>
                                </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Department' class='lablecol control-label'>Department</label>
                                    </th>
                                    <td>
                                        <?php echo $Department;?>
                                    </td>
                                    <th>
                                        <label for='Fax' class='lablecol control-label'>Fax</label>
                                    </th>
                                    <td>
                                        <?php echo $Fax;?>
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Birth Date' class='lablecol control-label'>Birth Date</label>
                                    </th>
                                    <td>
                                        <?php echo $Birthdate;?>
                                    </td>
                                    <th>
                                        <label for='Email' class='lablecol control-label'>Email</label>
                                    </th>
                                    <td>
                                        <?php echo $Email;?>
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Assistant' class='lablecol control-label'>Assistant</label>
                                    </th>
                                    <td>
                                        <?php echo $Assistant;?>
                                    </td>
                                    <th>
                                        <label for='Lead Source' class='lablecol  control-label'>Lead Source</label>
                                    </th>
                                    <td>
                                        <?php echo $LeadSource;?>
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Mailing Address' class='lablecol control-label'>Mailing Address</label>
                                    </th>
                                    <td>
                                        <?php echo $MailingStreet." ".$MailingCity." ".$MailingState." ".$MailingPostalCode." ".$MailingCountry;?>
                                    </td>
                                    <th>
                                        <label for='Other Address' class='lablecol control-label'>Other Address</label>
                                    </th>
                                    <td>
                                        <?php echo $OtherStreet." ".$OtherCity." ".$OtherState." ".$OtherPostalCode." ".$OtherCountry;?>
                                        
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Languages' class='lablecol control-label'>Languages</label>
                                    </th>
                                    <td>
                                        <?php echo $Languages;?>
                                    </td>
                                    <th>
                                        <label for='Level' class='lablecol control-label'>Level</label>
                                    </th>
                                    <td>
                                        <?php echo $Level;?>
                                    </td>
                                </tr>
                                <tr class='contact_hr'>
                                    <th>
                                        <label for='Description' class='lablecol control-label'>Description</label>
                                    </th>
                                    <td>
                                        <?php echo $Description;?>
                                    </td>
                                </tr>
                            </table>
                                <div class="col-lg-12">
                                    <div class="col-lg-6 col-xs-4">
                                        <form method='post' class='text-center' id='delform' action='delete_contact.php?id=<?php echo $Id;?>'>
                                            <input type='submit' name='delcontact' value='Delete'>
                                        </form>
                                    </div>
                                    <div class="col-lg-6">
<?php 
$FirstName= htmlspecialchars($FirstName, ENT_QUOTES);
$LastName= htmlspecialchars($LastName, ENT_QUOTES);
$Phone= htmlspecialchars($Phone, ENT_QUOTES);
$HomePhone= htmlspecialchars($HomePhone, ENT_QUOTES);
$OtherPhone= htmlspecialchars($OtherPhone, ENT_QUOTES);
$MobilePhone= htmlspecialchars($MobilePhone, ENT_QUOTES);
$Title=htmlspecialchars($Title, ENT_QUOTES);
$Fax= htmlspecialchars($Fax, ENT_QUOTES);
$Email= htmlspecialchars($Email, ENT_QUOTES);
$Department= htmlspecialchars($Department, ENT_QUOTES);
$Assistant= htmlspecialchars($Assistant, ENT_QUOTES);
$Birthdate= htmlspecialchars($Birthdate, ENT_QUOTES);
$AssistantPhone= htmlspecialchars($AssistantPhone, ENT_QUOTES);
$MailingStreet= htmlspecialchars($MailingStreet, ENT_QUOTES);
$OtherStreet= htmlspecialchars($OtherStreet, ENT_QUOTES);
$MailingCity= htmlspecialchars($MailingCity, ENT_QUOTES);
$OtherCity= htmlspecialchars($OtherCity, ENT_QUOTES);
$MailingState= htmlspecialchars($MailingState, ENT_QUOTES);
$OtherState= htmlspecialchars($OtherState, ENT_QUOTES);
$MailingPostalCode= htmlspecialchars($MailingPostalCode, ENT_QUOTES);
$OtherPostalCode= htmlspecialchars($OtherPostalCode, ENT_QUOTES);
$MailingCountry= htmlspecialchars($MailingCountry, ENT_QUOTES);
$OtherCountry= htmlspecialchars($OtherCountry, ENT_QUOTES);
$Languages= htmlspecialchars($Languages, ENT_QUOTES);
$Description= htmlspecialchars($Description, ENT_QUOTES);


 ?>
                                            <form method='post' class='text-center' id='delform' action='contact_form.php?Id=<?php echo $Id;?>&FirstName=<?php echo $FirstName;?>&Salutation=<?php echo $Salutation;?>&LastName=<?php echo $LastName;?>&Phone=<?php echo $Phone;?>&HomePhone=<?php echo $HomePhone;?>&OtherPhone=<?php echo $OtherPhone;?>&MobilePhone=<?php echo $MobilePhone;?>&Title=<?php echo $Title;?>&Fax=<?php echo $Fax;?>&Email=<?php echo $Email;?>&Department=<?php echo $Department;?>&Assistant=<?php echo $Assistant;?>&Birthdate=<?php echo $Birthdate;?>&AssistantPhone=<?php echo $AssistantPhone;?>&LeadSource=<?php echo $LeadSource;?>&MailingStreet=<?php echo $MailingStreet;?>&OtherStreet=<?php echo $OtherStreet;?>&MailingCity=<?php echo $MailingCity;?>&OtherCity=<?php echo $OtherCity;?>&MailingState=<?php echo $MailingState;?>&OtherState=<?php echo $OtherState;?>&MailingPostalCode=<?php echo $MailingPostalCode;?>&OtherPostalCode=<?php echo $OtherPostalCode;?>&MailingCountry=<?php echo $MailingCountry;?>&OtherCountry=<?php echo $OtherCountry;?>&Languages=<?php echo $Languages;?>&Level=<?php echo $Level;?>&Description=<?php echo $Description;?>'>
                                            <input type='submit' name='editcontact' value='Edit'>
                                            </form>                 
                                    </div>           
                                </div>
                            </div><!--col-md-12-->
                        </div><!--row form_fields-->
                    </div><!--clearfix-->
                </div><!--col-lg-11-->
            </div><!--row toppadding-->
        </div><!--wrapper-->
    </div><!--content-->
</div><!--container-->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <!-- Menu Toggle Script -->
</body>

</html>
<?php
if (!is_dir($cache_folder)) { //create a new folder if we need to
    mkdir($cache_folder);
}
if(!$ignore){
    $fp = fopen($cache_file, 'w');  //open file for writing
    fwrite($fp, ob_get_contents()); //write contents of the output buffer in Cache file
    fclose($fp); //Close file pointer
}
ob_end_flush(); //Flush and turn off output buffering
}
 
catch (Exception $e) {
    
    if($e->faultstring)
    {
             echo "<script>alert('Invalid Credentials')</script>";
             echo "<meta http-equiv='refresh' content='0;url=index.php'>";
         }
            }
      
?>