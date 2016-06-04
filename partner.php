<?php
session_start();
 try {
//settings
$cache_ext  = '.html'; //file extension
$cache_time     = 3600;  //Cache file expires afere these seconds (1 hour = 3600 sec)
$cache_folder   = 'cache/'; //folder to store Cache files
$ignore_pages   = array('', '');

$dynamic_url    = 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']; // requested dynamic page (full url)
$cache_file     = $cache_folder.md5($dynamic_url).$cache_ext; // construct a cache file
$ignore = (in_array($dynamic_url,$ignore_pages))?true:false; //check if url is in ignore list

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
      <link href="css/jquery.dataTables.css" rel="stylesheet">

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
    
            <!-- Page Content -->
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

                require_once ('soapclient/SforcePartnerClient.php');
                define("USERNAME", $email2);
                define("PASSWORD", $password2);
                define("SECURITY_TOKEN", $security2);
                $mySforceConnection = new SforcePartnerClient();
                $mySforceConnection->createConnection("soapclient/partner.wsdl.xml");
                $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
            ?>
        <!-- Sidebar -->
        <div id="sidebar-wrapper"  role="navigation">
          
            <ul class="sidebar-nav nav" id="sidebar-nav" >
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
                <div class="row toppadding">
                    
                    <div class="col-lg-12">
                        <h1>Partner</h1>
                


                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                      <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                  <li class=""><a href="#contacts" data-toggle="tab">Contacts</a></li>
                                                  <li><a href="#accounts" data-toggle="tab">Accounts</a></li>
                                                  <li><a href="#lead" data-toggle="tab">Lead</a></li>
                                                  <li><a href="#opportunity" data-toggle="tab">Opportunity</a></li>
                                                </ul>
                                                <!--
                                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Results of query</a>
                                            -->
                                            </h4>
                                      </div>
                                    <div id="collapse1" class="panel-collapse collapse">
                                        <div class="panel-body">            
                                            <div class="tab-content">
                                                <div class="tab-pane " id="contacts">
                                                    <h4>Results of Contacts</h4>
                                                        <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Contact ID </th>
                                                                <th>First Name</th>
                                                                <th>Last Name </th>
                                                                <th>Phone </th>
                                                            </tr>
                                                            <?php
                                                            $query = "SELECT Id, FirstName, LastName, Phone from Contact";
                                                            $response = $mySforceConnection->query($query);
                                                            $queryResult = new QueryResult($response);

                                                            for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
                                                            $record = $queryResult->current();
                                                            // Id is on the $record, but other fields are accessed via
                                                            // the fields object
                                                            echo "<tr><td>".$record->Id."</td><td>".$record->fields->FirstName."</td><td>"
                                                                    .$record->fields->LastName."</td><td>"
                                                                    .$record->fields->Phone."</td></tr>";
                                                            }   
                                                            ?>
                                                        </table>
                                                </div>
                                                <div class="tab-pane" id="accounts">
                                                    <h4>Results of Accounts</h4>
                                                        <table class="table table-stripped tableresponse" >
                                                                    <tr>
                                                                        
                                                                        <th>Account Number</th>
                                                                        <th>Name</th>
                                                                        <th>Phone </th>
                                                                    </tr>
                                                                    <?php
                                                                    $query = "SELECT Id, Name, Phone from Account";
                                                                    $response = $mySforceConnection->query($query);
                                                                    $queryResult = new QueryResult($response);
                                                                    
                                                                    $response = $mySforceConnection->query($query);
                                                                    for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
                                                                            $record = $queryResult->current();

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
                                                                    $queryResult = new QueryResult($response);
                                                                    
                                                                    $response = $mySforceConnection->query($query);
                                                                    for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
                                                                        $record = $queryResult->current();

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
                                                                        <th>Account ID </th>
                                                                        <th>Name</th>
                                                                        <th>Amount</th>
                                                                    </tr>
                                                                    <?php
                                                                    $query = "SELECT Id, Name, Amount from  Opportunity";
                                                                    $response = $mySforceConnection->query($query);
                                                                    $queryResult = new QueryResult($response);
                                                                    
                                                                    $response = $mySforceConnection->query($query);
                                                                    for ($queryResult->rewind(); $queryResult->pointer < $queryResult->size; $queryResult->next()) {
                                                                        $record = $queryResult->current();

                                                                            echo '<tr>
                                                                                <td>'.$record->Id.'</td>
                                                                                <td>'.$record->Name.'</td>
                                                                                <td>'.$record->Amount.'</td>
                                                                                 </tr>';
                                                                             }
                                                                    ?>
                                                        </table>
                                                </div><!--tab-pane-->
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                    </div><!--collapse1-->
                                </div><!--panel-default-->
                                <div class="panel panel-default">
                                      <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                              <li class=""><a href="#createcontacts" data-toggle="tab">Contacts</a></li>
                                              <li><a href="#createaccounts" data-toggle="tab">Accounts</a></li>
                                              <li><a href="#creaetlead" data-toggle="tab">Lead</a></li>
                                              <li><a href="#createopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                           
                                        </h4>
                                      </div>
                                      <div id="collapse2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            
                                            <div class="tab-content">
                                                <div class="tab-pane " id="createcontacts">
                                                    <h4>Create some contacts</h4>
                                                        <?php

                                                            $records = array();

                                                            $records[0] = new SObject();
                                                            $records[0]->fields = array(
                                                                'FirstName' => 'John',
                                                                'LastName' => 'Smith',
                                                                'Phone' => '(510) 555-5555',
                                                                'BirthDate' => '1957-01-25'
                                                            );
                                                            $records[0]->type = 'Contact';

                                                            $records[1] = new SObject();
                                                            $records[1]->fields = array(
                                                                'FirstName' => 'Mary',
                                                                'LastName' => 'Jones',
                                                                'Phone' => '(510) 486-9969',
                                                                'BirthDate' => '1977-01-25'
                                                            );
                                                            $records[1]->type = 'Contact';

                                                            $response = $mySforceConnection->create($records);

                                                            $ids = array();
                                                            ?>
                                                           <table class="table table-stripped tableresponse" >
                                                                            <tr>
                                                                                <th>Contact ID </th>
                                                                                <th>First Name</th>
                                                                                <th>Last Name </th>
                                                                                <th>Phone </th>
                                                                            </tr>
                                                            <?php
                                                            foreach ($response as $i => $result) {
                                                                echo ($result->success == 1) 
                                                                        ? "<tr><td>".$result->id."</td><td>".$records[$i]->fields["FirstName"]."</td><td>"
                                                                            .$records[$i]->fields["LastName"]."</td><td>"
                                                                            .$records[$i]->fields["Phone"]
                                                                            ."</td></tr>"
                                                                        : "Error: ".$result->errors->message."<br/>\n";
                                                                array_push($ids, $result->id);
                                                            }
                                                    ?>
                                                    </table>
                                                </div><!--tab-pane-->
                                                <div class="tab-pane" id="createaccounts">
                                                    <h4>Create some accounts</h4>
                                                    <?php

                                                        $recordsacc = array();

                                                        $recordsacc[0] = new SObject();
                                                        $recordsacc[0]->fields = array(
                                                            'Name' => 'John',
                                                            'Phone' => '(510) 555-5555'
                                                           
                                                        );
                                                        $recordsacc[0]->type = 'Account';

                                                        $recordsacc[1] = new SObject();
                                                        $recordsacc[1]->fields = array(
                                                            'Name' => 'Mary',
                                                            'Phone' => '(510) 486-9969',
                                                            
                                                        );
                                                        $recordsacc[1]->type = 'Account';

                                                        $responseacc = $mySforceConnection->create($recordsacc);

                                                        $idsacc = array();
                                                        ?>
                                                        <table class="table table-stripped tableresponse" >
                                                                        <tr>
                                                                            <th>Account ID </th>
                                                                            <th>Name</th>
                                                                            
                                                                            <th>Phone </th>
                                                                        </tr>
                                                        <?php
                                                        foreach ($responseacc as $iacc => $resultacc) {
                                                            echo ($resultacc->success == 1) 
                                                                    ? "<tr><td>".$resultacc->id."</td><td>".$recordsacc[$iacc]->fields["Name"]."</td><td>"
                                                                        .$recordsacc[$iacc]->fields["Phone"]
                                                                        ."</td></tr>"
                                                                    : "Error: ".$resultacc->errors->message."<br/>\n";
                                                            array_push($idsacc, $resultacc->id);
                                                        }
                                                        ?>
                                                        </table>
                                                </div><!--tab-pane-->
                                                <div class="tab-pane" id="creaetlead">
                                                    <h4>Create some leads</h4>
                                                    
                                                </div>
                                                <div class="tab-pane" id="createopportunity">
                                                    <h4>Create some opportunity</h4>
                                                    
                                                </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                      </div><!--collapse2-->
                                </div><!--panel-default-->
                                <div class="panel panel-default">
                                      <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                                  <li class=""><a href="#retrievecontacts" data-toggle="tab">Contacts</a></li>
                                                  <li><a href="#retrieveaccounts" data-toggle="tab">Accounts</a></li>
                                                  <li><a href="#retrievelead" data-toggle="tab">Lead</a></li>
                                                  <li><a href="#retrieveopportunity" data-toggle="tab">Opportunity</a></li>
                                                </ul>
                                               
                                            </h4>
                                      </div>
                                      <div id="collapse3" class="panel-collapse collapse">
                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane " id="retrievecontacts">
                                                    <h4>Retrieve the newly created contacts</h4>
                                                       <?php
                                                        $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone',
                                                                            'Contact', $ids);
                                                        ?>
                                                        <table class="table table-stripped tableresponse" >
                                                                <tr>
                                                                    <th>Contact ID </th>
                                                                    <th>First Name</th>
                                                                    <th>Last Name </th>
                                                                    <th>Phone </th>
                                                                </tr>
                                                            <?php
                                                                    foreach ($response as $record) {
                                                                        echo "<tr><td>".$record->Id."</td><td>".$record->fields->FirstName."</td><td>"
                                                                                .$record->fields->LastName."</td><td> "
                                                                                .$record->fields->Phone."</td></tr>";
                                                                    }

                                                            ?>
                                                        </table>     
                                                </div><!-- tab-pane-->
                                        <div class="tab-pane" id="retrieveaccounts">
                                            <h4>Retrieve the newly created accounts</h4>
                                                    <?php
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
                                                                    echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->fields->Name."</td><td>"
                                                                    
                                                                            .$recordacc->fields->Phone."</td></tr>";
                                                                }

                                                            ?>
                                                </table>
                                        </div><!--tab-pane-->
                                        <div class="tab-pane" id="retrievelead">
                                            <h4>Retrieve the newly created leads</h4>
                                            
                                        </div>
                                        <div class="tab-pane" id="retrieveopportunity">
                                            <h4>Retrieve the newly created opportunity</h4>
                                            
                                        </div>
                                            </div><!-- tab content -->
                                        </div><!--panel-body-->
                                      </div><!--collapse3-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                      <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                  <li class=""><a href="#updatecontacts" data-toggle="tab">Contacts</a></li>
                                                  <li><a href="#updateaccounts" data-toggle="tab">Accounts</a></li>
                                                  <li><a href="#updatelead" data-toggle="tab">Lead</a></li>
                                                  <li><a href="#updateopportunity" data-toggle="tab">Opportunity</a></li>
                                                </ul>
                                                
                                            </h4>
                                      </div>
                                      <div id="collapse4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                             
                                            <div class="tab-content">
                                                <div class="tab-pane " id="updatecontacts">
                                                    <h4>Update the new contacts</h4>
                                                        <?php
                                                            $records[0] = new SObject();
                                                            $records[0]->Id = $ids[0];
                                                            $records[0]->fields = array(
                                                                'Phone' => '(415) 555-5555',
                                                            );
                                                            $records[0]->type = 'Contact';

                                                            $records[1] = new SObject();
                                                            $records[1]->Id = $ids[0];
                                                            $records[1]->fields = array(
                                                                'Phone' => '(415) 486-9969',
                                                            );
                                                            $records[1]->type = 'Contact';

                                                            $response = $mySforceConnection->update($records);
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
                                                    </table>
                                                </div><!--tab-pane-->
                                        <div class="tab-pane" id="updateaccounts">
                                            <h4>Update the new accounts</h4>
                                                    <?php
                                                        $recordsacc[0] = new SObject();
                                                        $recordsacc[0]->Id = $idsacc[0];
                                                        $recordsacc[0]->fields = array(
                                                            'Phone' => '(415) 555-5555',
                                                        );
                                                        $recordsacc[0]->type = 'Account';

                                                        $recordsacc[1] = new SObject();
                                                        $recordsacc[1]->Id = $idsacc[0];
                                                        $recordsacc[1]->fields = array(
                                                            'Phone' => '(415) 486-9969',
                                                        );
                                                        $recordsacc[1]->type = 'Account';

                                                        $responseacc = $mySforceConnection->update($recordsacc);
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
                                                    </table>
                                        </div>
                                        <div class="tab-pane" id="updatelead">
                                            <h4>Update the new leads</h4>
                                            
                                        </div>
                                        <div class="tab-pane" id="updateopportunity">
                                            <h4>Update the new opportunity</h4>
                                            
                                        </div>
                                            </div><!-- tab content -->

                                         </div><!--panel-body-->
                                      </div><!--collapse4-->
                                </div><!--panel-default-->

                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                        <h4 class="panel-title">
                                             <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                                  <li class=""><a href="#retrieveupdatecontacts" data-toggle="tab">Contacts</a></li>
                                                  <li><a href="#retrieveupdateaccounts" data-toggle="tab">Accounts</a></li>
                                                  <li><a href="#retrieveupdatelead" data-toggle="tab">Lead</a></li>
                                                  <li><a href="#retrieveupdateopportunity" data-toggle="tab">Opportunity</a></li>
                                            </ul>
                                            
                                        </h4>
                                  </div>
                                  <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">
                                       
                                        <div class="tab-content">
                                            <div class="tab-pane " id="retrieveupdatecontacts">
                                                <h4>Retrieve the updated contacts to check the update</h4>
                                                <?php
                                                $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone',
                                                                    'Contact', $ids);
                                                ?>
                                                <table class="table table-stripped tableresponse" >
                                                            <tr>
                                                                <th>Contact ID </th>
                                                                <th>First Name</th>
                                                                <th>Last Name </th>
                                                                <th>Phone </th>
                                                            </tr>
                                                        <?php
                                                        foreach ($response as $record) {
                                                            echo "<tr><td>".$record->Id."</td><td>".$record->fields->FirstName."</td><td>"
                                                           .$record->fields->LastName."</td><td>".$record->fields->Phone."</td></tr>";
                                                        }
                                                        ?>
                                                </table>
                                            </div><!--tab-pane-->
                                        <div class="tab-pane" id="retrieveupdateaccounts">
                                            <h4>Retrieve the updated accounts to check the update</h4>
                                                <?php
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
                                                        echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->fields->Name."</td><td>"
                                                       .$recordacc->fields->Phone."</td></tr>";
                                                    }
                                                    ?>
                                                </table>
                                        </div>
                                        <div class="tab-pane" id="retrieveupdatelead">
                                            <h4>Retrieve the updated leads to check the update</h4>
                                            
                                        </div>
                                        <div class="tab-pane" id="retrieveupdateopportunity">
                                            <h4>Retrieve the updated opportunity to check the update</h4>
                                            
                                        </div>
                                        </div><!-- tab content -->
                                        
                                   </div><!--panel-body-->
                                  </div><!--collapse5-->
                            </div><!--panel-default-->


                            <div class="panel panel-default">
                              <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                              <li class=""><a href="#removecontacts" data-toggle="tab">Contacts</a></li>
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
                                            <?php 
                                                $records[0] = new SObject();
                                                $records[0]->Id = $ids[0];
                                                $records[0]->fieldsToNull = 'Phone';
                                                $records[0]->type = 'Contact';

                                                $records[1] = new SObject();
                                                $records[1]->Id = $ids[1];
                                                $records[1]->fieldsToNull = 'Phone';
                                                $records[1]->type = 'Contact';

                                                $response = $mySforceConnection->update($records);
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
                                            </table>
                                        </div><!--tab-pane-->
                                <div class="tab-pane" id="removeaccounts">
                                    <h4>Remove phone numbers from accounts</h4>
                                            <?php 
                                            $recordsacc[0] = new SObject();
                                            $recordsacc[0]->Id = $idsacc[0];
                                            $recordsacc[0]->fieldsToNull = 'Phone';
                                            $recordsacc[0]->type = 'Account';

                                            $recordsacc[1] = new SObject();
                                            $recordsacc[1]->Id = $idsacc[1];
                                            $recordsacc[1]->fieldsToNull = 'Phone';
                                            $recordsacc[1]->type = 'Account';

                                            $responseacc = $mySforceConnection->update($recordsacc);
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
                                        </table>
                                </div><!--tab-pane-->
                                <div class="tab-pane" id="removelead">
                                    <h4>Remove phone numbers from lead</h4>
                                    
                                </div>
                                <div class="tab-pane" id="removeopportunity">
                                    <h4>Remove phone numbers from opportunity</h4>
                                    
                                </div>
                                </div><!-- tab content -->

                               </div><!--panel-body-->
                              </div><!--collapse6-->
                        </div><!--panel-default-->


                        <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title">
                                    <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                          <li class=""><a href="#retrieveagaincontacts" data-toggle="tab">Contacts</a></li>
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
                                            <?php

                                            $response = $mySforceConnection->retrieve('Id, FirstName, LastName, Phone',
                                                                'Contact', $ids);
                                            ?>
                                        <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Contact ID </th>
                                                            <th>First Name</th>
                                                            <th>Last Name </th>
                                                            
                                                        </tr>
                                                <?php
                                                    foreach ($response as $record) {
                                                        echo "<tr><td>".$record->Id."</td><td>".$record->fields->FirstName."</td><td>"
                                                       .$record->fields->LastName."</td></tr>";
                                                    }
                                                ?>
                                        </table>
                                </div><!--tab-pane-->
                                <div class="tab-pane" id="retrieveagainaccounts">
                                    <h4>Retrieve the updated accounts again to check the update</h4>
                                            <?php

                                                $responseacc = $mySforceConnection->retrieve('Id, Name',
                                                                'Account', $idsacc);
                                            ?>
                                        <table class="table table-stripped tableresponse" >
                                                        <tr>
                                                            <th>Account ID </th>
                                                            <th>Name</th>
                                                            
                                                        </tr>
                                            <?php
                                                foreach ($responseacc as $recordacc) {
                                                    echo "<tr><td>".$recordacc->Id."</td><td>".$recordacc->fields->Name."</td></tr>";
                                                   
                                                }
                                            ?>
                                        </table>
                                </div><!--tab-pane-->
                                <div class="tab-pane" id="retrieveagainlead">
                                    <h4>Retrieve the updated leads again to check the update</h4>
                                    
                                </div>
                                <div class="tab-pane" id="retrieveagainopportunity">
                                    <h4>Retrieve the updated opportunity again to check the update</h4>
                                    
                                </div>
                        </div><!-- tab content -->


                                </div><!--panel-body-->
                              </div><!--collapse7-->
                        </div><!--panel-default-->


                        <div class="panel panel-default">
                          <div class="panel-heading">
                                <h4 class="panel-title">
                                    <ul class="nav nav-tabs" data-toggle="collapse" data-parent="#accordion" href="#collapse8">
                                          <li class=""><a href="#deletecontacts" data-toggle="tab">Contacts</a></li>
                                          <li><a href="#deleteaccounts" data-toggle="tab">Accounts</a></li>
                                          <li><a href="#deletelead" data-toggle="tab">Lead</a></li>
                                          <li><a href="#deleteopportunity" data-toggle="tab">Opportunity</a></li>
                                    </ul>
                                    
                                </h4>
                          </div>
                          <div id="collapse8" class="panel-collapse collapse">
                            <div class="panel-body">
                                
                            <div class="tab-content">
                                <div class="tab-pane " id="deletecontacts">
                                    <h4>Delete the contacts</h4>
                                    <?php
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
                                    </table>
                                </div>
                            <div class="tab-pane" id="deleteaccounts">
                                <h4>Delete the accounts</h4>
                                <?php
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
                                    </table>
                            </div>
                            <div class="tab-pane" id="deletelead">
                                <h4>Delete the leads</h4>
                                
                            </div>
                            <div class="tab-pane" id="deleteopportunity">
                                <h4>Delete the opportunity</h4>
                                
                            </div>
                                </div><!-- tab content -->

                            </div><!--panel-body-->
                          </div><!--collapse8-->
                        </div><!--panel-default-->
                        <!-- /#End panels -->
                        </div> <!--panel-group-->
                    </div><!--col-lg-12-->
                </div><!--row main-->
            </div><!-- /#wrapper -->
        </div><!-- /#end-content -->
    </div><!--container-fluid-->
</div><!-- /#page-content-wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
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
