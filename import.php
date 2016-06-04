<?php
    session_start();
    require_once ('soapclient/SforceEnterpriseClient.php');

    $email2=$_SESSION['email1'];
    $password2=$_SESSION['password1'];
    $security2=$_SESSION['security1'];

    define("USERNAME", $email2);
    define("PASSWORD", $password2);
    define("SECURITY_TOKEN", $security2);

    $mySforceConnection = new SforceEnterpriseClient();
    $mySforceConnection->createConnection("soapclient/enterprise.wsdl.xml");
    $mySforceConnection->login(USERNAME, PASSWORD.SECURITY_TOKEN);

?>
<?php 
$mimes = array('csv');
if(in_array($_FILES['file']['type'],$mimes)){
  
//if(isset($_POST["importbtn"]))
//{
 //$file = $_FILES['file']['tmp_name'];
 //echo $file;
//$filename=$_REQUEST['filename'];
 $file = $_FILES['file']['tmp_name'];
 $requiredHeaders = array('Contact ID', 'First Name', 'Last Name','Phone','CreatedDate','Home Phone','Other Phone','Mobile Phone','Title','Fax','Email','Department','Assistant','Birthdate','Assistant Phone','Lead Source','Mailing Street','Other Street','Mailing City','Other City','Mailing State','Other State','Mailing PostalCode','Other PostalCode','Mailing Country','Other Country','Languages','Level','Description'); //headers we expect
        $handle = fopen($file, "r");
        $firstLine = fgets($f); //get first line of csv file
        $c = 0;
        $i=0;
        
        $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

if ($foundHeaders !== $requiredHeaders) {
   echo '<script>alert("Headers do not match:")</script>';
    echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
   //die();
}
            while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
            if($i==0) { $i++; continue; }  // to exclude first line in the csv file.
        $field_csv['FirstName']= $filesop[1];
        $field_csv['LastName']= $filesop[2];
        $field_csv['Phone']= $filesop[3];
        $field_csv['HomePhone']= $filesop[5];
        $field_csv['OtherPhone']= $filesop[6];
        $field_csv['MobilePhone']= $filesop[7];
        $field_csv['Title']= $filesop[8];
        $field_csv['Fax']= $filesop[9];
        
        $field_csv['Email']= $filesop[10];
        $field_csv['Department']= $filesop[11];
        $field_csv['AssistantName']= $filesop[12];


        //$field_csv['Birthdate']= $filesop[13];
        if($filesop[13]!='')
                {
                    $field_csv['Birthdate']=$filesop[13];
                }
        $field_csv['AssistantPhone']= $filesop[14];
        $field_csv['LeadSource']= $filesop[15];
        $field_csv['MailingStreet']= $filesop[16];
        $field_csv['OtherStreet']= $filesop[17];

        $field_csv['MailingCity']= $filesop[18];
        $field_csv['OtherCity']= $filesop[19];
        $field_csv['MailingState']= $filesop[20];
        $field_csv['OtherState']= $filesop[21];
        $field_csv['MailingPostalCode']= $filesop[22];
        $field_csv['OtherPostalCode']= $filesop[23];
        $field_csv['MailingCountry']= $filesop[24];
        $field_csv['OtherCountry']= $filesop[25];
        $field_csv['Languages__c']= $filesop[26];
        $field_csv['Level__c']= $filesop[27];
        $field_csv['Description']= $filesop[28];


           
$response = $mySforceConnection->create(array($field_csv), 'Contact');
//console.log($response);
 }
 //print_r($response);
 if($response){
 //echo "<script>alert('You database has imported successfully')</script>";
 echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
 }else{
 echo "<script>alert('Sorry! There is some problem.')</script>";
 }      
 
} else {
  echo "<script>alert('Sorry, mime type not allowed')</script>";
  echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
}
//}
?>