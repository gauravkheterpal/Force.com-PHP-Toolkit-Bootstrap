
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
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Force.com Php Tool Kit</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
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
        <?php
                $id=$_REQUEST['Id'];
                $Salutation=$_REQUEST['Salutation'];
                if($Salutation=='None')
                {
                    $Salutation='';
                }
                $LastName=$_REQUEST['LastName'];
                $FirstName=$_REQUEST['FirstName'];
                $Phone=$_REQUEST['Phone'];
                $HomePhone=$_REQUEST['HomePhone'];  
                $BirthDate=$_REQUEST['BirthDate'];
                $MobilePhone=$_REQUEST['MobilePhone'];
                $OtherPhone=$_REQUEST['OtherPhone'];
                $Title=$_REQUEST['Title'];
                $Fax=$_REQUEST['Fax'];
                $Department=$_REQUEST['Department'];
                $Email=$_REQUEST['Email'];
                $AssistantName=$_REQUEST['AssistantName'];
                $AssistantPhone=$_REQUEST['AssistantPhone'];
                $LeadSource=$_REQUEST['LeadSource'];
                $MailingStreet=$_REQUEST['MailingStreet'];
                $OtherStreet=$_REQUEST['OtherStreet'];
                $MailingCity=$_REQUEST['MailingCity'];
                $OtherCity=$_REQUEST['OtherCity'];
                $MailingState=$_REQUEST['MailingState'];
                $OtherState=$_REQUEST['OtherState'];
                $MailingPostalCode=$_REQUEST['MailingPostalCode'];
                $OtherPostalCode=$_REQUEST['OtherPostalCode'];
                $MailingCountry=$_REQUEST['MailingCountry'];
                $OtherCountry=$_REQUEST['OtherCountry'];
                $Languages=$_REQUEST['Languages'];
                $Level=$_REQUEST['Level'];
                $Description=$_REQUEST['Description'];


                $records = array();
                $records[0] = new stdclass();
                $records[0]->Id = $id;
                $records[0]->Salutation = $Salutation;
                $records[0]->FirstName = $FirstName;
                $records[0]->LastName = $LastName;
                $records[0]->Phone = $Phone;
                $records[0]->HomePhone = $HomePhone;
                if($BirthDate!='')
                {
                    $records[0]->Birthdate = $BirthDate;
                }
                $records[0]->MobilePhone = $MobilePhone;
                $records[0]->OtherPhone = $OtherPhone;
                $records[0]->Title = $Title;
                $records[0]->Fax = $Fax;
                $records[0]->Department = $Department;
                $records[0]->Email = $Email;
                $records[0]->AssistantName = $AssistantName;
                $records[0]->LeadSource = $LeadSource;
                $records[0]->AssistantPhone = $AssistantPhone;
                //Mailing Address
                $records[0]->MailingStreet = $MailingStreet;
                $records[0]->MailingCity = $MailingCity;
                $records[0]->MailingState = $MailingState;
                $records[0]->MailingPostalCode = $MailingPostalCode;
                $records[0]->MailingCountry = $MailingCountry;
                //Other Address
                $records[0]->OtherStreet = $OtherStreet;
                $records[0]->OtherCity = $OtherCity;
                $records[0]->OtherState = $OtherState;
                $records[0]->OtherPostalCode =$OtherPostalCode;
                $records[0]->OtherCountry = $OtherCountry;

                if($id!='')
                {
                    $response = $mySforceConnection->update($records, 'Contact');
                }
                else
                {
                    $response = $mySforceConnection->create($records, 'Contact');
                }
                $ids = array();
            ?>
             
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
        <div class="container contact_container">
            <div class="row toppadding">
                <div class="col-lg-11">
                    <div class="clearfix">
                        <div class="row">
                            <div class="col-lg-4 ">
                                <p><strong>Contact Detail</strong></p>
                            </div><!-- col-lg-4 -->
                            
                        </div><!-- row-->

                        <div class="row form_fields">
                            <div class="col-md-12">
                                <?php

                                    foreach ($response as $i => $result) {
                                        $return_value = array('Id' => $result->id,'Salutation' => $records[$i]->Salutation, 'FirstName' => $records[$i]->FirstName, 'LastName' => $records[$i]->LastName, 'Phone' => $records[$i]->Phone, 'HomePhone' => $records[$i]->HomePhone, 'OtherPhone' => $records[$i]->OtherPhone, 'MobilePhone' => $records[$i]->MobilePhone, 'Title' => $records[$i]->Title, 'Fax' => $records[$i]->Fax, 'Email' => $records[$i]->Email, 'Department' => $records[$i]->Department, 'Assistant' => $records[$i]->AssistantName, 'Birthdate' => $records[$i]->Birthdate, 'AssistantPhone' => $records[$i]->AssistantPhone, 'LeadSource' =>$records[$i]->LeadSource,'MailingStreet' => $records[$i]->MailingStreet,'OtherStreet' => $records[$i]->OtherStreet, 'MailingCity' => $records[$i]->MailingCity, 'OtherCity' => $records[$i]->OtherCity, 'MailingState' => $records[$i]->MailingState, 'OtherState' => $records[$i]->OtherState, 'MailingPostalCode' => $records[$i]->MailingPostalCode, 'OtherPostalCode' =>$records[$i]->OtherPostalCode, 'MailingCountry' =>$records[$i]->MailingCountry, 'OtherCountry' => $records[$i]->OtherCountry, 'Languages' =>$records[$i]->Languages__c, 'Level' => $records[$i]->Level__c, 'Description' => $records[$i]->Description);
                                    echo ($result->success == 1) 
                                    ? "<table class='col-md-12' ><tr><th><label for='First Name' class='lablecol col-lg-10 control-label'>Name</label></th><td>".$records[$i]->Salutation." ".$records[$i]->FirstName." ".$records[$i]->LastName."</td><th><label for='Phone' class='lablecol col-lg-10 control-label'>Phone</label></th><td>".$records[$i]->Phone."</td></tr><tr class='contact_hr'>
                                    <th><label for='Home Phone' class='lablecol col-lg-10 control-label'>Home Phone</label></th><td>".$records[$i]->HomePhone."</td><th><label for='Mobile Phone' class='lablecol col-lg-10 control-label'>Mobile Phone</label></th><td>".$records[$i]->MobilePhone."</td></tr><tr class='contact_hr'>
                                    <th><label for='Title' class='lablecol col-lg-10 control-label'>Title</label></th><td>".$records[$i]->Title."</td><th><label for='Other Phone' class='lablecol col-lg-10 control-label'>Other Phone</label></th><td>".$records[$i]->OtherPhone."</td>
                                    </tr><tr class='contact_hr'><th><label for='Department' class='lablecol col-lg-10 control-label'>Department</label></th><td>".$records[$i]->Department."</td><th><label for='Fax' class='lablecol col-lg-10 control-label'>Fax</label></th><td>".$records[$i]->Fax."</td></tr>
                                    <tr class='contact_hr'><th><label for='Birth Date' class='lablecol col-lg-10 control-label'>Birth Date</label></th><td>".$records[$i]->Birthdate."</td><th><label for='Email' class='lablecol col-lg-10 control-label'>Email</label></th><td>".$records[$i]->Email."</td></tr>
                                    <tr class='contact_hr'><th><label for='Assistant' class='lablecol col-lg-10 control-label'>Assistant</label></th><td>".$records[$i]->AssistantName."</td><th><label for='Lead Source' class='lablecol col-lg-10 control-label'>Lead Source</label></th><td>".$records[$i]->LeadSource."</td></tr>
                                    <tr class='contact_hr'><th><label for='Mailing Address' class='lablecol col-lg-10 control-label'>Mailing Address</label></th><td>".$records[$i]->MailingStreet." ".$records[$i]->MailingCity." ".$records[$i]->MailingState." ".$records[$i]->MailingPostalCode." ".$records[$i]->MailingCountry. "</td><th><label for='Other Address' class='lablecol col-lg-10 control-label'>Other Address</label></th><td>".$records[$i]->OtherStreet." ".$records[$i]->OtherCity." ".$records[$i]->OtherState." ".$records[$i]->OtherPostalCode." ".$records[$i]->OtherCountry. "</td></tr>
                                    <tr class='contact_hr'><th><label for='Languages' class='lablecol col-lg-10 control-label'>Languages</label></th><td>".$records[$i]->Languages__c."</td><th><label for='Level' class='lablecol col-lg-10 control-label'>Level</label></th><td>".$records[$i]->Level__c."</td></tr>
                                    <tr class='contact_hr'><th><label for='Description' class='lablecol col-lg-10 control-label'>Description</label></th><td>".$records[$i]->Description."</td></tr></table><div class='row'><div class='col-lg-12'><div class='col-lg-6'><form method='post' class='text-center' id='delform' action='delete_contact.php?id=".$result->id."'><input type='submit' name='delcontact' value='Delete'></form></div><div class='col=lg-6'><form method='post' id='editform' action='contact_form.php?".http_build_query($return_value)."'>
                                    <input type='submit' name='editcontact' value='Edit'></form></div></div></div>"
                                        : "Please Check again somthing goes wrong!".$result->errors->message."<br/>\n";
                                        array_push($ids, $result->id);
                                    }
                                ?>
                            </div><!-- End col-md-12-->
                        </div><!--End form_fields-->
                    </div><!--End clearfix-->
                </div><!--End col-lg-11-->
            </div><!--End row-->
        </div><!--End contact_container-->
    </div><!-- End wrapper-->
</div><!--End content-->
<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <!-- Menu Toggle Script -->
    </body>

</html>
