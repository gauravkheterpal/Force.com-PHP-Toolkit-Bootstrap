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
    <link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
     
         <link rel="stylesheet" href="css/theme.blue.css">
           <link rel="stylesheet" href="css/jquery.tablesorter.pager.css">
<link href="css/jquery.dataTables.css" rel="stylesheet">
    </head>
<!-- Page Content -->
<body id="pager-demo" class="" >
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
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="col-lg-3">
                    <h1 class="contact_mobile">Contact List</h1>
                </div>
                <div class="col-lg-3 export_excel">
                   <a href="#" class="export">Export into CSV</a>
                </div>
                 
                <div class="col-lg-1  new_contact_btn">
                    <form method="post" action="contact_form.php"><button type="submit"><img src="icons/plus.png"></button></form>
                </div>
                


            <div id="dvData">
                    <table class="table table-striped tablesorter table_mobile" id="table1">

                        <thead>
                            <tr id="trr">
                                <td style="display:none;">Contact ID</td>
                                <td style="display:none;">First Name</td>
                                <td style="display:none;">Last Name</td>
                                <td style="display:none;">Phone</td>
                                <td style="display:none;">CreatedDate</td>
                                <td style="display:none;">Home Phone</td>
                                <td style="display:none;">Other Phone</td>
                                <td style="display:none;">Mobile Phone</td>
                                <td style="display:none;">Title</td>
                                <td style="display:none;">Fax</td>
                                <td style="display:none;">Email</td>
                                <td style="display:none;">Department</td>
                                <td style="display:none;">Assistant</td>
                                <td style="display:none;">Birthdate</td>
                                <td style="display:none;">Assistant Phone</td>
                                <td style="display:none;">Lead Source</td>
                                <td style="display:none;">Mailing Street</td>
                                <td style="display:none;">Other Street</td>
                                <td style="display:none;">Mailing City</td>
                                <td style="display:none;">Other City</td>
                                <td style="display:none;">Mailing State</td>
                                <td style="display:none;">Other State</td>
                                <td style="display:none;">Mailing PostalCode</td>
                                <td style="display:none;">Other PostalCode</td>
                                <td style="display:none;">Mailing Country</td>
                                <td style="display:none;">Other Country</td>
                                <td style="display:none;">Languages</td>
                                <td style="display:none;">Level</td>
                                <td style="display:none;">Description</td>
                        </tr>
                            <tr>
                                <th>Contact ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>CreatedDate</th>
                                </tr>

                        </thead>


                       <tbody id='filltertable'>
                        
                  
                    <?php require_once ('contact_list_table.php');?>

                    </tbody>
                    </table>
            </div>
                <div class="pager">
                    <div class="row">
                            <div class="col-lg-12 col-xs-12 col-sm-12">
                                <div class="col-lg-2">
                                <form name="import" id="import" method="post" enctype="multipart/form-data" action="contact_list.php">
        <input type="file" name="file" id="file" />
    </form>
   
     
                                </div>
                                <div class="col-lg-10" >
                                    Page: <select class="gotoPage"></select>    
                                    
                                    <img src="icons/first.png" class="first" alt="First" title="First page" />
                                    <img src="icons/prev.png" class="prev" alt="Prev" title="Previous page" />
                                   

                                    <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                              
                                    <img src="icons/next.png" class="next" alt="Next" title="Next page" />
                                    <img src="icons/last.png" class="last" alt="Last" title= "Last page" />
                                    <select class="pagesize">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                    </select>
                                </div><!--Pager col-lg-12 col-xs-12 col-sm-12-->
                                
                            </div>
                            </div><!--Pager row-->
                        </div><!--pager-->
                    </div><!--toppading col-lg-12 col-sm-6 col-md-6 col-xs-4-->
                </div><!--row toppadding-->
            </div><!--wrapper-->
        </div><!--content-->
    </div><!--container-fluid-->
</div><!--page-content-wrapper-->

    <!-- jQuery -->
<?php 

if(isset($_FILES['file'])){ //this is just to check if isset($_FILE). Not required.
    //file selected

$mimes = array('text/csv');
if(in_array($_FILES['file']['type'],$mimes)){

 $file = $_FILES['file']['tmp_name'];
 
       
        $handle = fopen($file, "r");
        
 $requiredHeaders = array('Contact ID','First Name','Last Name','Phone','CreatedDate','Home Phone','Other Phone','Mobile Phone','Title','Fax','Email','Department','Assistant','Birthdate','Assistant Phone','Lead Source','Mailing Street','Other Street','Mailing City','Other City','Mailing State','Other State','Mailing PostalCode','Other PostalCode','Mailing Country','Other Country','Languages','Level','Description'); //headers we expect
$f = fopen($file, 'r');
        $firstLine = fgets($f); //get first line of csv file

        $foundHeaders = str_getcsv(trim($firstLine), ',', '"'); //parse to array

if ($foundHeaders !== $requiredHeaders) {
   echo '<script>alert("Headers do not match:")</script>';
    
   
}
else
{
        $c = 0;
        $i=0;
        
        
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


        $response = $mySforceConnection->create(array($field_csv), 'Contact');
        
         }
    if($response){
    echo "<meta http-equiv='refresh' content='0;url=contact_list.php'>";
    }else{
    echo "<script>alert('Sorry! There is some problem.')</script>";
    }      
 
}
}
else {
  echo "<script>alert('Sorry, mime type not allowed')</script>";
 }
}
?>
<script src="js/jquery.js"></script>
    <script src="js/script.js"></script>
   <script src="js/jquery-latest.min.js"></script>
    <script src="js/jquery.tablesorter.js"></script>
    <script src="js/jquery.tablesorter.pager.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.tablesorter.widgets.js"></script>
    <script id="js">$(function(){

        var $table = $('table'),
        // define pager options
        pagerOptions = {
        // target the pager markup - see the HTML block below
        container: $(".pager"),
        // output string - default is '{page}/{totalPages}'; possible variables: {page}, {totalPages}, {startRow}, {endRow} and {totalRows}
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})',

        //output: '{startRow:input} to {endRow} ({totalRows})',
        // if true, the table will remain the same height no matter how many records are displayed. The space is made up by an empty
        // table row set to a height to compensate; default is false
        fixedHeight: true,
        // remove rows from the table to speed up the sort of large tables.
        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
        removeRows: false,
        // go to page selector - select dropdown that sets the current page
        cssGoto: '.gotoPage'
        };

        // Initialize tablesorter
        // ***********************
        $table
            .tablesorter({
                theme: 'blue',
                headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
                widthFixed: true,
                widgets: ['zebra', 'filter']
            })




            // initialize the pager plugin
            // ****************************
            .tablesorterPager(pagerOptions);    

    });
</script>

<script>
    
    document.getElementById("file").onchange = function() 
{

    document.getElementById("import").submit();//import file Form submit
    
    var d = document.getElementById("pager-demo");//Disable click on body while importing
    d.className = "disb";
    
 }
 
    </script>

<script>


$(document).ready(function () {

    function exportTableToCSV($table, filename) {

        var $rows = $table.find('#trr:has(td)'),

            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',

            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                    $cols = $row.find('td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                        text = $col.text();
                        text= $.trim(text);//remove extra space from text
                    return text.replace(/"/g, '""'); // escape double quotes
                     //return text.replace( /,/g, "" ); // escape double quotes
                    
                   

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',

            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

        $(this)
            .attr({
            'download': filename,
                'href': csvData,
                'target': '_blank'
        });
    }

    // This must be a hyperlink
    $(".export").on('click', function (event) {
        // CSV
        exportTableToCSV.apply(this, [$('#dvData>table'), 'export.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });
});
</script>


</body>
</html>
