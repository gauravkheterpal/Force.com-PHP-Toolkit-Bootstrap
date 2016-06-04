<?php
session_start();
//settings
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


$email=$_POST['exampleInputEmail1'];
$password=$_POST['exampleInputPassword1'];
$security=$_POST['exampleInputSecurity1'];
$_SESSION['email1']=$email;
$_SESSION['password1']=$password;
$_SESSION['security1']=$security;

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
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

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
<div id="page-content-wrapper">
            <div class="container-fluid">
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
                         </a>
                           <a class="navbar-brand" href="#">Force.com Php Tool Kit</a>
                           
                      </div>
                       </div>
                    </div>
                    <div id="wrapper">

                    <?php
                    require_once ('soapclient/SforceEnterpriseClient.php');
                    define("USERNAME", $email2);
                    define("PASSWORD", $password2);
                    define("SECURITY_TOKEN", $security2);
                    $mySforceConnection = new SforceEnterpriseClient();
                    $mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
                    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
                    ?>

                    <!-- Sidebar -->
                    <div id="sidebar-wrapper"  role="navigation">
                         <ul class="sidebar-nav nav" id="sidebar-nav" >
                            <li class="sidebar-brand">
                            
                            </li>
                            <li>
                               <?php echo $email2;?>
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
                <div id="ajax_div">
                    <!-- Page Content -->

                        <div class="row toppadding">
                    
                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                                <h1>Enterprise</h1>
                                 <div class="panel-group" id="accordion">
                                    <div class="panel panel-default" >
                                        <div class="panel-heading" >
                                            <h4 class="panel-title">
                                                <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
            
                                                    <li ><a href="#contacts" data-toggle="tab">Contacts</a></li>
                                                    <li><a href="#accounts" data-toggle="tab">Accounts</a></li>
                                                    <li><a href="#lead" data-toggle="tab">Lead</a></li>
                                                    <li><a href="#opportunity" data-toggle="tab">Opportunity</a></li>   
                                                </ul>
                                            </h4>
                                        </div>

                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="tab-content">

                                                    <div class="tab-pane" id="contacts">
                                                        <h4>Results of Contacts</h4>
                                                        <table class="table table-stripped tableresponse" > 
                                                            <thead>
                                                                <tr>
                                                                    <th>Contact ID </th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name </th>
                                                                    <th>Phone </th>
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                                $query = "SELECT Id, FirstName, LastName, Phone from Contact";
                                                                $response = $mySforceConnection->query($query);
                                                                foreach ($response->records as $record)
                                                                    {   

                                                                        echo '<tbody><tr>
                                                                            <td data-label="Contact ID">'.$record->Id.'</td>
                                                                            <td data-label="First Name">'.$record->FirstName.'</td>
                                                                            <td data-label="Last Name">'.$record->LastName.'</td>
                                                                            <td data-label="Phone">'.$record->Phone.'</td>
                                                                            </tr></tbody>';
                                                                    }
                                                            ?>
                                                        </table>
                                                    </div>

                                                    <div class="tab-pane" id="accounts">
                                                        <h4>Results of Accounts</h4>
                                                   
                                                             <table class="table table-stripped tableresponse" >
                                                                <tr>
                                                                    <th>Account ID</th>
                                                                    <th>Name</th>
                                                                    <th>Phone </th>
                                                                </tr>
                                                                <?php
                                                                $query = "SELECT Id, Name, Phone from Account";
                                                                $response = $mySforceConnection->query($query);
                                                                foreach ($response->records as $record)
                                                                {

                                                                    echo '<tr>
                                                                        <td>'.$record->Id.'</td>
                                                                        <td>'.$record->Name.'</td>
                                                                        <td>'.$record->Phone.'</td>
                                                                        </tr>';
                                                                }
                                                                ?>
                                                            </table>
                                                   
                                                    </div>
                
                                                    <div class="tab-pane" id="lead">
                                                        <h4>Results of Lead</h4>
                                                        
                                                         <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Lead ID </th>
                                                                <th>First Name</th>
                                                                <th>Last Name </th>
                                                                <th>Phone </th>
                                                            </tr>
                                                            <?php
                                                            $query = "SELECT Id, FirstName, LastName, Phone from Lead";
                                                            $response = $mySforceConnection->query($query);
                                                            foreach ($response->records as $record)
                                                            {

                                                            echo '<tr>
                                                                <td>'.$record->Id.'</td>
                                                                <td>'.$record->FirstName.'</td>
                                                                <td>'.$record->LastName.'</td>
                                                                <td>'.$record->Phone.'</td>
                                                                 </tr>';
                                                             }

                                                            ?>
                                                        </table>
                                                    
                                                    </div>

                                                    <div class="tab-pane" id="opportunity">
                                                        <h4>Results of Opportunity</h4>
                                                         <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Opportunity ID </th>
                                                                <th>Name</th>
                                                                <th>Amount</th>
                                                            </tr>
                                                        <?php
                                                        $query = "SELECT Id, Name, Amount from  Opportunity";
                                                        $response = $mySforceConnection->query($query);
                                                        foreach ($response->records as $record)
                                                        {

                                                        echo '<tr>
                                                            <td>'.$record->Id.'</td>
                                                            <td>'.$record->Name.'</td>
                                                            <td>'.$record->Amount.'</td>
                                                             </tr>';
                                                         }

                                                         ?>
                                                        </table>
                                                    </div>
                                                </div><!-- tab content -->
                                            </div><!--panel-body-->
                                        </div><!--collapse1-->
                                    </div><!--panel-default-->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                        <!--
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                        -->
                                        <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                          <li ><a href="#createcontacts" data-toggle="tab">Contacts</a></li>
                                          <li><a href="#createaccounts" data-toggle="tab">Accounts</a></li>
                                          <li><a href="#createlead" data-toggle="tab">Lead</a></li>
                                          <li><a href="#createopportunity" data-toggle="tab">Opportunity</a></li>
                                        </ul>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                            
                                            <div class="tab-content">
                                                <div class="tab-pane " id="createcontacts">
                                                    <h4>Now, create some Contacts</h4>
                                                    <p>
                                                        <?php
                                                        $records = array();

                                                        $records[0] = new stdclass();
                                                        $records[0]->FirstName = 'John';
                                                        $records[0]->LastName = 'Smith';
                                                        $records[0]->Phone = '(510) 555-5555';
                                                        $records[0]->BirthDate = '1957-01-25';

                                                        $records[1] = new stdclass();
                                                        $records[1]->FirstName = 'Mary';
                                                        $records[1]->LastName = 'Jones';
                                                        $records[1]->Phone = '(510) 486-9969';
                                                        $records[1]->BirthDate = '1977-01-25';

                                                        $response = $mySforceConnection->create($records, 'Contact');

                                                        $ids = array();
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Contact ID </th>
                                                            <th>First Name</th>
                                                            <th>Last Name </th>
                                                            <th>Phone </th>
                                                            <th>Birthdate </th>
                                                        </tr>
                                                    <?php
                                
                                                    foreach ($response as $i => $result) {
                                                        echo ($result->success == 1) 
                                                                ? "<tr><td>".$result->id."</td><td>".$records[$i]->FirstName."</td><td>".$records[$i]->LastName
                                                                    ."</td><td>".$records[$i]->Phone."</td><td>".$records[$i]->BirthDate."</td></tr>"
                                                                
                                                                : "Error: ".$result->errors->message."<br/>\n";
                                                        array_push($ids, $result->id);
                                                    }

                                                    ?>
                                                    </table></p>
                                                </div>

                                                <div class="tab-pane" id="createaccounts">
                                                    <h4>Now, create some Accounts</h4>
                                                    <p>
                                                        <?php
                                                        $recordsacc = array();

                                                        $recordsacc[0] = new stdclass();
                                                        $recordsacc[0]->Name = 'John';
                                                        
                                                        $recordsacc[0]->Phone = '(510) 555-5555';
                                                        
                                                        $recordsacc[1] = new stdclass();
                                                        $recordsacc[1]->Name = 'Mary';
                                                       
                                                        $recordsacc[1]->Phone = '(510) 486-9969';
                                                        

                                                        $responseacc = $mySforceConnection->create($recordsacc, 'Account');

                                                        $idsacc = array();
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Account ID </th>
                                                            <th>Name </th>
                                                            <th>Phone </th>
                                                           
                                                        </tr>
                                                        <?php
                                                                        
                                                         foreach ($responseacc as $iacc => $resultacc) {
                                                         echo ($resultacc->success == 1) 
                                                         ? "<tr><td>".$resultacc->id."</td><td>".$recordsacc[$iacc]->Name."</td><td>".$recordsacc[$iacc]->Phone."</td></tr>"
                                                                                    
                                                         : "Error: ".$resultacc->errors->message."<br/>\n";
                                                         array_push($idsacc, $resultacc->id);
                                                        }

                                                        ?>
                                                    </table></p>
                                                </div>

                                                <div class="tab-pane" id="createlead">
                                                    <h4>Now, create some Leads</h4>
                                                     <p>
                                                        <?php
                                                        $recordslead = array();

                                                        $recordslead[0] = new stdclass();
                                                        $recordslead[0]->FirstName = 'Jackk';
                                                        $recordslead[0]->LastName = 'Smith';
                                                        $recordslead[0]->Phone = '(336) 222-8000';
                                                        

                                                        $recordslead[1] = new stdclass();
                                                        $recordslead[1]->FirstName = 'Jones';
                                                        $recordslead[1]->LastName = 'Smith';
                                                        $recordslead[1]->Phone = '(336) 222-7700';
                                                        
                                                        
                                                        $responselead = $mySforceConnection->create($recordslead, 'Lead');

                                                        $idslead = array();
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                    <tr>
                                                        <th>Lead ID </th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Phone</th>  
                                                    </tr>
                                                    <?php
                                    
                                                    foreach ($responselead as $ilead => $resultlead) {
                                                    echo ($resultlead->success == 1) ? "<tr><td>".$resultlead->id."</td><td>".$recordslead[$ilead]->FirstName."</td><td>".$recordslead[$ilead]->LastName."</td><td>".$recordslead[$ilead]->Phone."</td>"
                                                    ."</tr>": "Error: ".$resultlead->errors->message."<br/>\n";
                                                    array_push($idslead, $resultlead->id);
                                                    }

                                                    ?>
                                                    </table></p>
                                                </div>

                                                <div class="tab-pane" id="createopportunity">
                                                    <h4>Now, create some Opportunity</h4>
                                                    <p>
                                                        <?php
                                                        $recordsopp = array();

                                                        $recordsopp[0] = new stdclass();
                                                        $recordsopp[0]->Name = 'John';
                                                        
                                                        $recordsopp[1] = new stdclass();
                                                        $recordsopp[1]->Name = 'Mary';

                                                        $responseopp = $mySforceConnection->create($recordsopp, 'Opportunity');

                                                        $idsopp = array();
                                                        ?>
                                                      <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Opportunity ID </th>
                                                            <th>Name </th>
                                                            
                                                           
                                                        </tr>
                                                        <?php
                                                                        
                                                        foreach ($responseopp as $iopp => $resultopp) {
                                                            echo ($resultopp->success == 1) ? "<tr><td>".$resultopp->id."</td><td>".$recordsopp[$iopp]->Name."</td></tr>" : "Error: ".$resultopp->errors->message."<br/>\n";
                                                            array_push($idsopp, $resultopp->id);
                                                            }

                                                        ?>
                                                    </table>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse2-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                              <li ><a href="#retrievecontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#retrieveaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#retrievelead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#retrieveopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">
                        
                                            <div class="tab-content">
                                                <div class="tab-pane" id="retrievecontacts">
                                                    <h4>Retrieve the newly created contacts</h4>
                                                    <p>
                                                    <?php
                                                    $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone, Birthdate',
                                                                    'Contact', $ids);
                                                                    ?>
                                                                      <table class="table table-stripped tableresponse" >
                                                                    <tr>
                                                                        <th>Contact ID </th>
                                                                        <th>First Name</th>
                                                                        <th>Last Name </th>
                                                                        <th>Phone </th>
                                                                        <th>Birthdate </th>
                                                                    </tr>
                                                                    <?php
                                                    foreach ($response as $record) {
                                                        echo "<tr><td>".$record->Id."</td><td>".$record->FirstName."</td><td>"
                                                       .$record->LastName."</td><td>".$record->Phone."</td><td>".$record->Birthdate."</td></tr>";
                                                    }
                                                    ?>
                                                                    </table>
                                                    </p>
                                                </div>

                                                 <div class="tab-pane" id="retrieveaccounts">
                                                    <h4>Retrieve the newly created accounts</h4>
                                                    <p><?php
                                                        $responseacc = $mySforceConnection->retrieve('Id, Name, Phone',
                                                        'Account', $idsacc);
                                                        ?>
                                                         <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Account ID </th>
                                                                <th>Name</th>
                                                              
                                                                <th>Phone </th>
                                                                
                                                            </tr>
                                                        <?php
                                                            foreach ($responseacc as $recordacc) {
                                                            echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->Name."</td><td>".$recordacc->Phone."</td></tr>";
                                                            }
                                                        ?>
                                                        </table>
                                                    </p>
                                                </div>

                                                <div class="tab-pane" id="retrievelead">
                                                    <h4>Retrieve the newly created lead</h4>
                                                    <p>
                                                    <?php
                                                        $responselead = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone',
                                                        'Lead', $idslead);
                                                    ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Lead ID </th>
                                                            <th>First Name</th>
                                                            <th>Last Name </th>
                                                            <th>Phone </th>
                                                          
                                                        </tr>
                                                    <?php
                                                        foreach ($responselead as $recordlead) {
                                                        echo "<tr><td>".$recordlead->Id."</td><td>".$recordlead->FirstName."</td><td>"
                                                        .$recordlead->LastName."</td><td>".$recordlead->Phone."</td></tr>";
                                                        }
                                                    ?>
                                                    </table>
                                                    
                                                </div>

                                                <div class="tab-pane" id="retrieveopportunity">
                                                    <h4>Retrieve the newly created opportunity</h4>
                                                    <p>
                                                    <?php
                                                        $responseopp = $mySforceConnection->retrieve('Id, Name, Amount',
                                                        'Opportunity', $idsopp);
                                                    ?>
                                                          <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Opportunity ID </th>
                                                                <th>Name</th>
                                                                <th>Amount </th>
                                                              
                                                            </tr>
                                                    <?php
                                                        foreach ($responseopp as $recordopp) {
                                                        echo "<tr><td>".$recordopp->Id."</td><td>".$recordopp->Name."</td><td>"
                                                        .$recordopp->Amount."</td></tr>";
                                                        }
                                                    ?>
                                                        </table>
                                                    </p>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse3-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                              <li ><a href="#updatenewcontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#updatenewaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#updatenewlead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#updatenewopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                        
                                            <div class="tab-content">
                                                <div class="tab-pane " id="updatenewcontacts">
                                                    <h4>Update the new contacts</h4>
                                                    <p>
                                                        <?php
                                                        $records[0] = new stdclass();
                                                        $records[0]->Id = $ids[0];
                                                        $records[0]->Phone = '(415) 555-5555';

                                                        $records[1] = new stdclass();
                                                        $records[1]->Id = $ids[1];
                                                        $records[1]->Phone = '(415) 486-9969';
                                                        ?>
                                                         <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Contact ID </th>
                                                                
                                                            </tr>
                                                        <?php
                                                            $response = $mySforceConnection->update($records, 'Contact');
                                                            foreach ($response as $result) {
                                                            echo ($result->success == 1) 
                                                            ? "<tr><td>".$result->id."</td></tr>"
                                                            : "Error: ".$result->errors->message."<br/>\n";
                                                            }
                                                        ?>
                                                        </table>
                                                    </p>
                                                </div>

                                                <div class="tab-pane" id="updatenewaccounts">
                                                    <h4>Update the new accounts</h4>
                                                        <p>
                                                            <?php
                                                            $recordsacc[0] = new stdclass();
                                                            $recordsacc[0]->Id = $idsacc[0];
                                                            $recordsacc[0]->Phone = '(510) 555-5555';

                                                            $recordsacc[1] = new stdclass();
                                                            $recordsacc[1]->Id = $idsacc[1];
                                                            $recordsacc[1]->Phone = '(510) 486-9969';
                                                            ?>
                                                              <table class="table table-stripped tableresponse" >
                                                                <tr>
                                                                    <th>Account ID </th>
                                                                </tr>
                                                            <?php
                                                            $responseacc = $mySforceConnection->update($recordsacc, 'Account');
                                                            foreach ($responseacc as $resultacc) {
                                                                echo ($resultacc->success == 1) 
                                                                        ? "<tr><td>".$resultacc->id."</td></tr>"
                                                                        : "Error: ".$resultacc->errors->message."<br/>\n";
                                                            }
                                                            ?>
                                                        </table> </p>
                                                </div>

                                                <div class="tab-pane" id="updatenewlead">
                                                    <h4>Update the new lead</h4>
                                                        <p>
                                                            <?php
                                                            $recordslead[0] = new stdclass();
                                                            $recordslead[0]->Id = $ids[0];
                                                            $recordslead[0]->Phone = '(415) 555-5555';

                                                            $recordslead[1] = new stdclass();
                                                            $recordslead[1]->Id = $ids[1];
                                                            $recordslead[1]->Phone = '(415) 486-9969';
                                                            ?>
                                                              <table class="table table-stripped tableresponse" >
                                                                <tr>
                                                                    <th>Lead ID </th>
                                                
                                                                </tr>
                                                            <?php
                                                                $responselead = $mySforceConnection->update($recordslead, 'Lead');
                                                                foreach ($responselead as $resultlead) {
                                                                    echo ($resultlead->success == 1) 
                                                                            ? "<tr><td>".$resultlead->id."</td></tr>"
                                                                            : "Error: ".$resultlead->errors->message."<br/>\n";
                                                                }
                                                            ?>
                                                            </table>
                                                        </p>
                                                </div>
                                                <div class="tab-pane" id="updatenewopportunity">
                                                    <h4>Update the new Opportunity</h4>
                                                    <p></p>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse4-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                              <li ><a href="#updateretrievecontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#updateretrieveaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#updateretrievelead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#updateretrieveopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane" id="updateretrievecontacts">
                                                    <h4>Retrieve the updated contacts to check the update</h4>
                                                    <p>
                                                        <?php

                                                            $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone',
                                                            'Contact', $ids);
                                                        ?>
                                                      <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Contact ID </th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Phone</th>
                                                        </tr>
                                                        <?php
                                                            foreach ($response as $record) {
                                                            echo "<tr><td>".$record->Id."</td><td>".$record->FirstName."</td><td>"
                                                            .$record->LastName."</td><td>".$record->Phone."</td></tr>";
                                                            }

                                                        ?>
                                                    </table>
                                                    </p>
                                                </div>
                                                <div class="tab-pane" id="updateretrieveaccounts">
                                                    <h4>Retrieve the updated accounts to check the update</h4>
                                                    <p>
                                                        <?php

                                                            $responseacc = $mySforceConnection->retrieve('Id, Name, Phone',
                                                            'Account', $idsacc);
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Account ID </th>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                        
                                                        </tr>
                                                        <?php
                                                        foreach ($responseacc as $recordacc) {
                                                            echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->Name."</td><td>".$recordacc->Phone."</td></tr>";
                                                        }


                                                        ?>
                                                    </table>
                                                    </p>
                                                </div>

                                                <div class="tab-pane" id="updateretrievelead">
                                                    <h4>Retrieve the updated lead to check the update</h4>
                                                    <p></p>
                                                </div>
                                                <div class="tab-pane" id="updateretrieveopportunity">
                                                    <h4>Retrieve the updated opportunity to check the update</h4>
                                                    <p></p>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse5-->
                                </div><!--panel-default-->


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                              <li ><a href="#removecontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#removeaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#removelead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#removeopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                    
                                        </h4>
                                    </div>
                                    <div id="collapse6" class="panel-collapse collapse">
                                        <div class="panel-body">
                       
                                            <div class="tab-content">
                                                <div class="tab-pane " id="removecontacts">
                                                    <h4>Remove phone numbers from contacts</h4>
                                                    <p>
                                                        <?php
                                                            $records[0] = new stdclass();
                                                            $records[0]->Id = $ids[0];
                                                            $records[0]->fieldsToNull = 'Phone';

                                                            $records[1] = new stdclass();
                                                            $records[1]->Id = $ids[1];
                                                            $records[1]->fieldsToNull = 'Phone';
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Contact ID </th>
                                                
                                                        </tr>
                                                        <?php
                                                            $response = $mySforceConnection->update($records, 'Contact');
                                                            foreach ($response as $result) {
                                                             echo ($result->success == 1)
                                                              ? "<tr><td>".$result->id."</td></tr>"
                                                              : "Error: ".$result->errors->message."<br/>\n";
                                                              }
                                                        ?>

                                                    </table></p>
                                                </div>

                                                <div class="tab-pane" id="removeaccounts">
                                                    <h4>Remove phone numbers from accounts</h4>
                                                    <p>
                                                        <?php
                                                            $recordsacc[0] = new stdclass();
                                                            $recordsacc[0]->Id = $idsacc[0];
                                                            $recordsacc[0]->fieldsToNull = 'Phone';

                                                            $recordsacc[1] = new stdclass();
                                                            $recordsacc[1]->Id = $idsacc[1];
                                                            $recordsacc[1]->fieldsToNull = 'Phone';
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Account ID </th>
                                                
                                                        </tr>
                                                        <?php
                                                            $responseacc = $mySforceConnection->update($recordsacc, 'Account');
                                                            foreach ($responseacc as $resultacc) {
                                                            echo ($resultacc->success == 1)
                                                            ? "<tr><td>".$resultacc->id."</td></tr>"
                                                            : "Error: ".$resultacc->errors->message."<br/>\n";
                                                            }
                                                        ?>

                                                    </table></p>
                                                </div>

                                                <div class="tab-pane" id="removelead">
                                                    <h4>Remove phone numbers from lead</h4>
                                                    <p></p>
                                                </div>
                                                <div class="tab-pane" id="removeopportunity">
                                                    <h4>Remove phone numbers from opportunity</h4>
                                                    <p></p>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse6-->
                                </div><!--panel-default-->


                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                              <li ><a href="#retrieveagaincontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#retrieveagainaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#retrieveagainlead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#retrieveagainopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                        </h4>
                                    </div>
                                    <div id="collapse7" class="panel-collapse collapse">
                                        <div class="panel-body">
                        
                                            <div class="tab-content">
                                                <div class="tab-pane " id="retrieveagaincontacts">
                                                    <h4>Retrieve the updated contacts again to check the update</h4>
                                                    <p>
                                                        <?php

                                                            $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone','Contact', $ids);
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Contact ID </th>
                                                            <th>First Name</th>
                                                            <th>Last Name </th>
                                                           
                                                        </tr>
                                                        <?php
                                                            foreach ($response as $record) {
                                                             echo "<tr><td>".$record->Id."</td><td>".$record->FirstName."</td><td>"
                                                             .$record->LastName."</td></tr>";
                                                             }

                                                        ?>
                                                    </table>
                                                    </p>
                                                </div>

                                                <div class="tab-pane" id="retrieveagainaccounts">
                                                    <h4>Retrieve the updated accounts again to check the update</h4>
                                                    <p>
                                                        <?php

                                                            $responseacc = $mySforceConnection->retrieve('Id, Name','Account', $idsacc);
                                                        ?>
                                                     <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Account ID </th>
                                                            <th>Name</th>
                                                        </tr>
                                                        <?php
                                                            foreach ($responseacc as $recordacc) {
                                                            echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->Name."</td></tr>";
                                                            }

                                                        ?>
                                                    </table></p>
                                                </div>
                                                <div class="tab-pane" id="retrieveagainlead">
                                                    <h4>Retrieve the updated leads again to check the update</h4>
                                                    <p></p>
                                                </div>
                                                <div class="tab-pane" id="retrieveagainopportunity">
                                                    <h4>Retrieve the updated opportunity again to check the update</h4>
                                                    <p></p>
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse7-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                          <li ><a href="#deletecontacts" data-toggle="tab">Contacts</a></li>
                                          <li><a href="#deleteaccounts" data-toggle="tab">Accounts</a></li>
                                          <li><a href="#deletelead" data-toggle="tab">Lead</a></li>
                                          <li><a href="#deletenopportunity" data-toggle="tab">Opportunity</a></li>
                                        </ul>
                                    </h4>
                                  </div>
                                  <div id="collapse8" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        
                                        <div class="tab-content">
                                            <div class="tab-pane " id="deletecontacts">
                                                <h4>Delete the contacts</h4>
                                                <p><?php

                                                    $response = $mySforceConnection->delete($ids);
                                                    ?>
                                                    <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Contact ID </th>
                                                                
                                                            </tr>
                                                            <?php
                                                                            foreach ($response as $result) {
                                                                                echo ($result->success == 1) 
                                                                                        ? "<tr><td>".$result->id."</td></tr>"
                                                                                        : "Error: ".$result->errors->message."<br/>\n";
                                                                            }
                                                                        ?>
                                                    </table></p>
                                            </div>
                                    <div class="tab-pane" id="deleteaccounts">
                                        <h4>Delete the accounts</h4>
                                        <p><?php

                                            $responseacc = $mySforceConnection->delete($idsacc);
                                            ?>
                                                <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Account ID </th>
                                                                
                                                            </tr>
                                                        <?php
                                                                        foreach ($responseacc as $resultacc) {
                                                                            echo ($resultacc->success == 1) 
                                                                                    ? "<tr><td>".$resultacc->id."</td></tr>"
                                                                                    : "Error: ".$resultacc->errors->message."<br/>\n";
                                                                        }
                                                                    ?>
                                                </table></p>
                                    </div>
                                    <div class="tab-pane" id="deletelead">
                                        <h4>Delete the leads</h4>
                                        <p>hgfhfhg</p>
                                    </div>
                                    <div class="tab-pane" id="deletenopportunity">
                                        <h4>Delete the opportunity</h4>
                                        <p>sfgdfgf</p>
                                    </div>
                            </div><!-- tab content -->
                                    </div><!--panel-body-->
                                  </div><!--collapse8-->
                                </div><!--panel-default-->
                                <!-- /#End panels -->
                             </div> <!-- /#end-panel-group -->
                        </div><!-- /#end-column-->
                    </div><!-- /#end-row-->
                </div><!-- /#end-container-fluid-->
            </div><!-- /#page-content-wrapper -->    
        </div><!-- /#end-ajax-div -->

    </div><!-- /#end-wrapper -->
</div><!-- /#end-content -->



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
