<?php
   require_once="config_connnection.php";
   $del=$_GET["shiftID"];
   
   
   $query="Delete FROM shifts WHERE shift_id=$del";
   
   if($result=mysqli_query($link,$query))
   {
	   echo"Shift delete";
   }
   else{
	   echo $query;
   }

?>