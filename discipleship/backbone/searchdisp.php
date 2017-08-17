<?php
include "../../link.php";
session_start();

$name=$_POST['name'];
$store=array();
//echo $name;
//echo "In";
if(isset($_REQUEST['search'])){
	
	
	$query="SELECT * FROM `memberinfo` WHERE `name`='$name'";
  $result=mysqli_query($link,$query);

	if(mysqli_num_rows($result)==1){
		$member=mysqli_fetch_assoc($result);
		//echo $member['name'];
		$store['stat']=1;
		$store['namef']=$member['name'];
		$store['phone_num']=$member['phonenumber'];
		$store['resident']=$member['resident'];
		$store['leadership']=$member['leadership_position'];	
		$store['gender']=$member['gender'];
		$store['email']=$member['email'];
		$store['groupId']=$member['groupId'];

		
	}
	else{
		$store['stat']=2;
		$store['message']="Error Name Not Found in Database";

		
	}
	
	echo json_encode($store);
	
}

?>