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

    $query = "SELECT Id, Salutation,FirstName, LastName, Phone, HomePhone,OtherPhone,MobilePhone,Title,Fax,Email,Department,AssistantName,Birthdate,AssistantPhone,LeadSource,MailingStreet,OtherStreet,MailingCity,OtherCity,MailingState,OtherState,MailingPostalCode,OtherPostalCode,MailingCountry,OtherCountry,Languages__c,Level__c,Description,CreatedDate from Contact ORDER BY CreatedDate DESC";

    $response = $mySforceConnection->query($query);

          foreach ($response->records as $record)
    {   
        /* Array of Contact fields */
        $return_value = array('Id' => $record->Id, 'Salutation' => $record->Salutation, 'FirstName' => $record->FirstName, 'LastName' => $record->LastName, 'Phone' => $record->Phone, 'HomePhone' => $record->HomePhone, 'OtherPhone' => $record->OtherPhone, 'MobilePhone' => $record->MobilePhone, 'Title' => $record->Title, 'Fax' => $record->Fax, 'Email' => $record->Email, 'Department' => $record->Department, 'Assistant' => $record->AssistantName, 'Birthdate' => $record->Birthdate, 'AssistantPhone' => $record->AssistantPhone, 'LeadSource' => $record->LeadSource, 'MailingStreet' => $record->MailingStreet, 'OtherStreet' => $record->OtherStreet, 'MailingCity' => $record->MailingCity, 'OtherCity' => $record->OtherCity, 'MailingState' => $record->MailingState, 'OtherState' => $record->OtherState, 'MailingPostalCode' => $record->MailingPostalCode, 'OtherPostalCode' =>$record->OtherPostalCode, 'MailingCountry' =>$record->MailingCountry, 'OtherCountry' => $record->OtherCountry, 'Languages__c' =>$record->Languages__c, 'Level__c' => $record->Level__c, 'Description' => $record->Description, 'CreatedDate' => $record->CreatedDate );
        //$return_value1= array('Id' => $record->Id,'FirstName' => $record->FirstName, 'LastName' => $record->LastName, 'Phone' => $record->Phone);
        $tablehtml='<tr id="trr">
            <td><a href=show_contact.php?'.http_build_query($return_value).'>'.$record->Id.'<a/></td>
            <td>'.$record->FirstName.'</td>
            <td>'.$record->LastName.'</td>
            <td>'.$record->Phone.'</td>
            <td>'.$record->CreatedDate.'</td>
            <td style="display:none;">'.$record->HomePhone.'</td>
            <td style="display:none;">'.$record->OtherPhone.'</td>
            <td style="display:none;">'.$record->MobilePhone.'</td>
            <td style="display:none;">'.$record->Title.'</td>
            <td style="display:none;">'.$record->Fax.'</td>
            <td style="display:none;">'.$record->Email.'</td>
            <td style="display:none;">'.$record->Department.'</td>
            <td style="display:none;">'.$record->AssistantName.'</td>
            <td style="display:none;">'.$record->Birthdate.'</td>
            <td style="display:none;">'.$record->AssistantPhone.'</td>
            <td style="display:none;">'.$record->LeadSource.'</td>
            <td style="display:none;">'.$record->MailingStreet.'</td>
            <td style="display:none;">'.$record->OtherStreet.'</td>
            <td style="display:none;">'.$record->MailingCity.'</td>
            <td style="display:none;">'.$record->OtherCity.'</td>
            <td style="display:none;">'.$record->MailingState.'</td>
            <td style="display:none;">'.$record->OtherState.'</td>
            <td style="display:none;">'.$record->MailingPostalCode.'</td>
            <td style="display:none;">'.$record->OtherPostalCode.'</td>
            <td style="display:none;">'.$record->MailingCountry.'</td>
            <td style="display:none;">'.$record->OtherCountry.'</td>
            <td style="display:none;">'.$record->Languages__c.'</td>
            <td style="display:none;">'.$record->Level__c.'</td>
            <td style="display:none;">'.$record->Description.'</td>
            </tr>';

            echo $tablehtml;

    }       

?>
                                