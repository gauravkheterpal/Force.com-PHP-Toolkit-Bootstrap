<?php
session_start();
 try {

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
      
    <link href="css/jquery.datepick.css" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<div id="content" class="container-fluid">  
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
                //$id=$_REQUEST['id'];
            $Id=$_GET['Id'];
                require_once ('soapclient/SforceEnterpriseClient.php');
                    define("USERNAME", $email2);
                    define("PASSWORD", $password2);
                    define("SECURITY_TOKEN", $security2);
            
                   
                    $mySforceConnection = new SforceEnterpriseClient();
                    $mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
                    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);
                    

    if($Id!='')
    {

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
        
        $AssistantName=$_GET['Assistant'];
        
        $BirthDate=$_GET['Birthdate'];
        
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
        
        $Languages=$_GET['Languages'];
        
        $Level=$_GET['Level'];
        
        $Description=$_GET['Description'];
        

    }
    else
    {
        $Salutation='';
        $FirstName='';
        $LastName='';
        $Phone='';
        $HomePhone='';
        $OtherPhone='';
        $MobilePhone='';
        $Title='';
        $Fax='';
        $Email='';
        $Department='';
        $AssistantName='';
        $BirthDate='';
        $AssistantPhone='';
        $LeadSource='';
        $MailingStreet='';
        $OtherStreet='';
        $MailingCity='';
        $OtherCity='';
        $MailingState='';
        $OtherState='';
        $MailingPostalCode='';
        $OtherPostalCode='';
        $MailingCountry='';
        $OtherCountry='';
        $Languages='';
        $Level='';
        $Description='';
                      
    }
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
            <div class="contact_container">
            
                <div class="row toppadding">
                    <div class="col-lg-11 col-xs-12">
                        <div class="contact clearfix">
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <p><strong>New Contact</strong></p>
                                </div><!-- col-lg-4 -->
                            </div><!-- row-->
                            <hr class="contact_hr">

                            <div class="row text-center">
                                    <span id="error_show_upper" class="error_color_upper"></span>
                            </div>

                            <form method="post" role="form" id="testform" action="">

                            <div class="row contact_info">
                                <div class="col-lg-5 contact_heading">
                                    <p>Contact Information</p>
                                </div>
                                <div class="col-lg-2 pull-right">
                                    <p class="req_info red_line"> * = Required Information</p>
                                </div>
                            </div><!--row contact_info row-->

                            <div class="row form_fields">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="First Name" class="lablecol col-lg-5 control-label">First Name</label>
                                
                                        <div class="col-lg-5"  >
                                            <div class="col-lg-6 suffix">
                                                <select class="selectpicker" id="Salutation">

                                                    <option value="None"<?php if($Salutation == 'None'): ?> selected="selected"<?php endif; ?>>--None--</option>
                                                    <option value="Mr."<?php if($Salutation == 'Mr.'): ?> selected="selected"<?php endif; ?>>Mr.</option>
                                                    <option value="Ms."<?php if($Salutation == 'Ms.'): ?> selected="selected"<?php endif; ?>>Ms.</option>
                                                    <option value="Mrs."<?php if($Salutation == 'Mrs.'): ?> selected="selected"<?php endif; ?>>Mrs.</option>
                                                    <option value="Dr."<?php if($Salutation == 'Dr.'): ?> selected="selected"<?php endif; ?>>Dr.</option>
                                                    <option value="Prof."<?php if($Salutation == 'Prof.'): ?> selected="selected"<?php endif; ?>>Prof.</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="text" class="form-control textbox_height textbox_width" id="FirstName" size="10" value="<?php echo $FirstName;?>">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- First Name-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Phone" class="lablecol col-lg-5 control-label">Phone</label>
                                    
                                        <div class="col-lg-5" >
                                            <input type="phone" class="form-control textbox_height" id="Phone" size="20" value="<?php echo $Phone;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Phone-->
                        </div><!-- 1row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                   
                                    <label for="Last Name" class="lablecol col-lg-5 control-label ">Last Name</label>
                                    <div class="col-lg-5" >
                                        <div class="red_line_textbox">
                                            <input type="text" class="form-control textbox_height  error_textbox" id="LastName" size="20" value="<?php echo $LastName;?>">
                                            <div class="row">
                                                <span id="error_show_contact" class="error_show_contact"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Last Name-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Home Phone" class="lablecol col-lg-5 control-label">Home Phone</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="phone" class="form-control textbox_height" id="HomePhone" size="20" value="<?php echo $HomePhone;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Home Phone-->
                        </div><!-- 2row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other Phone" class="lablecol col-lg-5 control-label">Other Phone</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="OtherPhone" size="20" value="<?php echo $OtherPhone;?>">
                                        </div>
                                    </div>   
                            </div>
                            <!-- Other Phone-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mobile" class="lablecol col-lg-5 control-label">Mobile</label>
                                    
                                        <div class="col-lg-5" >
                                            <input type="mobile" class="form-control textbox_height" id="MobilePhone" size="20" value="<?php echo $MobilePhone;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Mobile-->
                        </div><!-- 3row-->

                        <div class="row form_fields">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Title" class="lablecol col-lg-5 control-label">Title</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="Title" size="20" value="<?php echo $Title;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Title-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Fax" class="lablecol col-lg-5 control-label">Fax</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="Fax" size="20" value="<?php echo $Fax;?>">
                                        </div>
                                    </div> 
                            </div>
                            <!-- Fax-->
                        </div><!-- 4row-->

                        <div class="row form_fields">
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Email" class="lablecol col-lg-5 control-label">Email</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="Email" size="20" value="<?php echo $Email;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Email-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Department" class="lablecol col-lg-5 control-label">Department</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="Department" size="20" value="<?php echo $Department;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Department-->
                        </div><!-- 5row-->

                        <div class="row form_fields">
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Assistant" class="lablecol col-lg-5 control-label">Assistant</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="AssistantName" size="20" value="<?php echo $AssistantName;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Assitant-->
                             <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Asst. Phone" class="lablecol col-lg-5 control-label">Asst. Phone</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="AssistantPhone" size="20" value="<?php echo $AssistantPhone;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Asst.Phone-->
                        </div><!-- 6row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="BirthDate" class="lablecol col-lg-5 control-label">Birthdate</label>
                             
                                    <div class="col-lg-5" >
                                        
                                        <input type="text" class="form-control textbox_height" id="popupDatepicker" size="20" value="<?php echo $BirthDate;?>">
                                        
                                        
                                </div>
                            </div>
                        </div>
                            <!-- Birthdate-->
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label for="LeadSource" class="lablecol col-lg-5 control-label">Lead Source</label>
                             
                                    <div class="col-lg-5" >
                                  
                                        <select class="selectpicker" id="LeadSource1">
                                            <option value="None"<?php if($LeadSource == 'None'): ?> selected="selected"<?php endif; ?>>--None--</option>
                                            <option value="Web"<?php if($LeadSource == 'Web'): ?> selected="selected"<?php endif; ?>>Web</option>
                                            <option value="Phone Inquiry"<?php if($LeadSource == 'Phone Inquiry'): ?> selected="selected"<?php endif; ?>>Phone Inquiry</option>
                                            <option value="Partner Referral"<?php if($LeadSource == 'Partner Referral'): ?> selected="selected"<?php endif; ?>>Partner Referral</option>
                                            <option value="Purchased List"<?php if($LeadSource == 'Purchased List'): ?> selected="selected"<?php endif; ?>>Purchased List</option>
                                            <option value="Other"<?php if($LeadSource == 'Other'): ?> selected="selected"<?php endif; ?>>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Lead Source-->
                        </div><!-- 7row-->
                        
                        <div class="row form_fields">
                            
                      
                        </div><!-- 9row-->
   
                        <div class="row contact_info">
                            
                            <div class="col-lg-5 contact_heading">
                                <p>Address Information</p>
                            </div>
                            <div class="col-lg-4 pull-right req_info">
                                <a href="">Copy Mailing Address to Other AddressAddress Information</a>
                            </div>
                       
                        </div><!--row address_info -->
                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mailing Street" class="lablecol col-lg-5 control-label">Mailing Street</label>
                             
                                    <div class="col-lg-5" >
                                        <textarea  class="form-control textbox_height" id="MailingStreet" size="20" value="<?php echo $MailingStreet;?>"><?php echo $MailingStreet;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other Street" class="lablecol col-lg-5 control-label">Other Street</label>
                                   
                                        <div class="col-lg-5" >
                                            <textarea  class="form-control textbox_height" id="OtherStreet" size="20" value="<?php echo $OtherStreet;?>"><?php echo $OtherStreet;?></textarea>
                                        </div>
                                    </div>
                            </div>
                            <!-- Other street-->
                        </div><!-- 10row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mailing City" class="lablecol col-lg-5 control-label">Mailing City</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="MailingCity" size="20" value="<?php echo $MailingCity;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other City" class="lablecol col-lg-5 control-label">Other City</label>
                                   
                                        <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="OtherCity" size="20" value="<?php echo $OtherCity;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Other City-->
                        </div><!-- 11row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mailing State" class="lablecol col-lg-5 control-label">Mailing State/Province</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="MailingState" size="20" value="<?php echo $MailingState;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Mailing State-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other State" class="lablecol col-lg-5 control-label">Other State/Province</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="OtherState" size="20" value="<?php echo $OtherState;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Other State-->
                        </div><!-- 12row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mailing Zip" class="lablecol col-lg-5 control-label">Mailing Zip/Postal Code</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="MailingPostalCode" size="20" value="<?php echo $MailingPostalCode;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Mailing Zip-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other Zip" class="lablecol col-lg-5 control-label">Other Zip/Postal Code</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="OtherPostalCode" size="20" value="<?php echo $OtherPostalCode;?>">
                                        </div>
                                    </div>
                             </div>
                             <!-- Other Zip-->
                        </div><!-- 13row-->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Mailing Country" class="lablecol col-lg-5 control-label">Mailing Country</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="MailingCountry" size="20" value="<?php echo $MailingCountry;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Mailing Country-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Other Country" class="lablecol col-lg-5 control-label">Other Country</label>
                                   
                                        <div class="col-lg-5" >
                                            <input type="text" class="form-control textbox_height" id="OtherCountry" size="20" value="<?php echo $OtherCountry;?>">
                                        </div>
                                    </div>
                            </div>
                            <!-- Other Country-->
                        </div><!-- 14row-->

                         <div class="row form_fields">
                            <!-- for space-->
                      
                        </div><!-- 15row-->

                        <div class="row contact_info">
                            <div class="col-lg-5 contact_heading">
                                <p>Address Information</p>
                            </div>
                            <div class="col-lg-4 pull-right req_info">
                                <a href="">Copy Mailing Address to Other AddressAddress Information</a>
                            </div>
                        </div><!--row additional info -->

                        <div class="row form_fields">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Languages" class="lablecol col-lg-5 control-label">Languages</label>
                             
                                    <div class="col-lg-5" >
                                        <input type="text" class="form-control textbox_height" id="Languages" size="20" value="<?php echo $Languages;?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Languages-->
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Level" class="lablecol col-lg-5 control-label">Level</label>
                                   
                                        <div class="col-lg-5" >
                                            <select class="selectpicker" id="Level">
                                                <option value="None"<?php if($Level == 'None'): ?> selected="selected"<?php endif; ?>>--None--</option>
                                                <option value="Secondary"<?php if($Level == 'Secondary'): ?> selected="selected"<?php endif; ?>>Secondary</option>
                                                <option value="Tertiary"<?php if($Level == 'Tertiary'): ?> selected="selected"<?php endif; ?>>Tertiary</option>
                                                <option value="Primary"<?php if($Level == 'Primary'): ?> selected="selected"<?php endif; ?>>Primary</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <!-- Level-->
                        </div><!-- 16row-->

                        <div class="row form_fields">
                            <!-- for space-->
                      
                        </div><!-- 17row-->

                        <div class="row contact_info">
                            <div class="col-lg-5 contact_heading">
                                <p>Description Information</p>
                            </div>
                            <div class="col-lg-4 pull-right req_info">
                                <a href="">Copy Mailing Address to Other AddressAddress Information</a>
                            </div>
                        </div><!--row additional info -->

                        <div class="row form_fields">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="Description" class="lablecol col-lg-5 control-label">Description</label>
                                    <input type="hidden" id="ids" value="<?php echo $Id;?>">
                                    <div class="col-lg-5" >
                                        <textarea  class="form-control textbox_height" id="Description" size="20" value="<?php echo $Description;?>"><?php echo $Description;?></textarea>
                                    </div>
                                </div>
                            </div>
                        <!-- Description and hidden Id-->
                        </div><!-- 18row-->

                        <div class="row form_fields">
                            <!-- for space-->
                      
                        </div><!-- 19row-->

                        <div class="border">
                        <div class="row form_fields">

                            <div class="col-md-4">
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                   <div class="col-lg-2" >
                                        <input type="submit" id="save" value="Save">
                                    </div>

                                    <div class="col-lg-3" >
                                        <input type="submit" id="save" value="Save & New">
                                    </div>

                                    <div class="col-lg-3" >
                                        <input type="submit" id="cancel" value="Cancel">
                                    </div>
                                </div>
                            </div>
                            <!-- Save, Save & New and Cancel-->
                        </div><!-- 16row-->
                        </div><!-- border-->
                    </form>
                    </div><!--contact-->
                </div><!--col-lg-11-->
            </div><!--main row-->
        </div><!--container-->
    </div><!--wrapper-->
</div><!--content-->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        $(function() {
        $('#popupDatepicker').datepick();
        
        });

        function showDate(date) {
            alert('The date chosen is ' + date);
        }
</script>
<script>
        
        


        $('#save').click(function() {
   
        var id=$("#ids").val();
        var Salutation = $("#Salutation").val();
        var FirstName = $("#FirstName").val();
        var LastName = $("#LastName").val();
        var Phone = $("#Phone").val();
        var HomePhone = $("#HomePhone").val();
        var BirthDate = $("#popupDatepicker").val();
        var MobilePhone = $("#MobilePhone").val();
        var Account = $("#Account").val();
        var OtherPhone = $("#OtherPhone").val();
        var Title = $("#Title").val();
        var Fax = $("#Fax").val();
        var Department = $("#Department").val();
        var Email = $("#Email").val();
        var AssistantName = $("#AssistantName").val();
        var AssistantPhone = $("#AssistantPhone").val();
        var LeadSource1 = $("#LeadSource1").val();
        var MailingStreet = $("#MailingStreet").val();
        var OtherStreet = $("#OtherStreet").val();
        var MailingCity = $("#MailingCity").val();
        var OtherCity = $("#OtherCity").val();
        var MailingState = $("#MailingState").val();
        var OtherState = $("#OtherState").val();
        var MailingPostalCode = $("#MailingPostalCode").val();
        var OtherPostalCode = $("#OtherPostalCode").val();
        var MailingCountry = $("#MailingCountry").val();
        var OtherCountry = $("#OtherCountry").val();
        var Languages = $("#Languages").val();
        var Level = $("#Level").val();
        var Description = $("#Description").val();

            if(LastName=='') 
            {
            

                $('#error_show_contact').css("display","block");
                $('.error_textbox').css("border","2px solid #C00");
                $('#error_show_contact').html("<strong>Error:</strong> You must enter a value");

                $('#error_show_upper').html("Error: Invalid Data.<br>Review all error messages below to correct your data.");

                return false;
            } 
            else 
            {
                

                window.location = "save_contact.php?Id="+id+"&Salutation="+Salutation+"&FirstName="+FirstName+"&LastName="+LastName+"&Phone="+Phone+"&BirthDate="+BirthDate+"&HomePhone="+HomePhone+"&MobilePhone="+MobilePhone+"&OtherPhone="+OtherPhone+"&Title="+Title+"&Fax="+Fax+"&Department="+Department+"&Email="+Email+"&AssistantName="+AssistantName+"&AssistantPhone="+AssistantPhone+"&LeadSource="+LeadSource1+"&MailingStreet="+MailingStreet+"&OtherStreet="+OtherStreet+"&MailingCity="+MailingCity+"&OtherCity="+OtherCity+"&MailingState="+MailingState+"&OtherState="+OtherState+"&MailingPostalCode="+MailingPostalCode+"&OtherPostalCode="+OtherPostalCode+"&MailingCountry="+MailingCountry+"&OtherCountry="+OtherCountry+"&Languages="+Languages+"&Level="+Level+"&Description="+Description;
                return false;
            }
            
        });

$('#cancel').click(function() {
        var id=$("#ids").val();
        var Salutation = $("#Salutation").val();
        var FirstName = $("#FirstName").val();
        var LastName = $("#LastName").val();
        var Phone = $("#Phone").val();
        var HomePhone = $("#HomePhone").val();
        var BirthDate = $("#popupDatepicker").val();
        var MobilePhone = $("#MobilePhone").val();
        var Account = $("#Account").val();
        var OtherPhone = $("#OtherPhone").val();
        var Title = $("#Title").val();
        var Fax = $("#Fax").val();
        var Department = $("#Department").val();
        var Email = $("#Email").val();
        var AssistantName = $("#AssistantName").val();
        var AssistantPhone = $("#AssistantPhone").val();
        var LeadSource1 = $("#LeadSource1").val();
        var MailingStreet = $("#MailingStreet").val();
        var OtherStreet = $("#OtherStreet").val();
        var MailingCity = $("#MailingCity").val();
        var OtherCity = $("#OtherCity").val();
        var MailingState = $("#MailingState").val();
        var OtherState = $("#OtherState").val();
        var MailingPostalCode = $("#MailingPostalCode").val();
        var OtherPostalCode = $("#OtherPostalCode").val();
        var MailingCountry = $("#MailingCountry").val();
        var OtherCountry = $("#OtherCountry").val();
        var Languages = $("#Languages").val();
        var Level = $("#Level").val();
        var Description = $("#Description").val();

        window.location = "show_contact.php?Id="+id+"&Salutation="+Salutation+"&FirstName="+FirstName+"&LastName="+LastName+"&Phone="+Phone+"&Birthdate="+BirthDate+"&HomePhone="+HomePhone+"&MobilePhone="+MobilePhone+"&OtherPhone="+OtherPhone+"&Title="+Title+"&Fax="+Fax+"&Department="+Department+"&Email="+Email+"&Assistant="+AssistantName+"&AssistantPhone="+AssistantPhone+"&LeadSource="+LeadSource1+"&MailingStreet="+MailingStreet+"&OtherStreet="+OtherStreet+"&MailingCity="+MailingCity+"&OtherCity="+OtherCity+"&MailingState="+MailingState+"&OtherState="+OtherState+"&MailingPostalCode="+MailingPostalCode+"&OtherPostalCode="+OtherPostalCode+"&MailingCountry="+MailingCountry+"&OtherCountry="+OtherCountry+"&Languages__c="+Languages+"&Level__c="+Level+"&Description="+Description;
                return false;

        });
</script>
<script src="js/jquery.plugin.js"></script>
<script src="js/jquery.datepick.js"></script>
<script src="js/script.js"></script>
</body>

</html>
<?php
}
catch (Exception $e) {
 
    if($e->faultstring)
    {
                echo "<script>alert('Invalid Credentials')</script>";
             echo "<meta http-equiv='refresh' content='0;url=index.php'>";
         }
            }
      
?>

