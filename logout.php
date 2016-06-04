<?php

session_start(); 
session_destroy(); //destroy the session
unset($_SESSION['email1']);
unset($_SESSION['password1']);
unset($_SESSION['security1']);
//delete cache files after logout
$files = glob('cache/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
echo "<meta http-equiv='refresh' content='0;url=index.php'>"; //to redirect back to "index.php" after logging out
exit();
?>