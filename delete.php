<?php
include("setting.php");
$obj=new settings();
$id=$_GET['ID'];
$done=$obj->DeleteOneRow("client","IDE",$id);
if($done){
	 echo "<script>alert('client with ID $id is successfully removed!'); window.location.href ='adminpage.php';</script>";
} else {
    echo "<script>alert('Failed to remove client with ID $id.');
     window.location.href = 'index.php';</script>";
}

?>