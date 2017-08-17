<?php
include "../../link.php";
session_start();

if(isset($_REQUEST['single'])){

$data = "";
$store=array();
$final=array();
 $name=$_POST['name'];
 // echo $name;
  $day=$_POST['day'];
  $month=$_POST['month'];
  $year=$_POST['year'];

   $query1="SELECT * FROM `memberinfo` WHERE `name`='$name'";
  $result1=mysqli_query($link,$query1);
  $nop=mysqli_fetch_assoc($result1);
  $memid=$nop['memberId'];

$memiddate=$memid.$day.$month.$year;
//echo $memiddate;
  $query2="SELECT * FROM  `attendance` WHERE `memberIdDate`='$memiddate'";
  $result2=mysqli_query($link,$query2);
$attend=mysqli_fetch_assoc($result2);


if(mysqli_num_rows($result2)==1){
switch($attend['present']){
	case 0://Absent

	switch($attend['late'])
	{
		case 0:
		if($attend['others']=""){
	
			$store['stat']=1;
			$store['numb']=1;
			$store['namef']=$name;
			$store['attend']="Absent";
			$store['punct']="Early";
			$store['others']="N/A";

		}

		else{
			
	
			$store['stat']=1;
			$store['numb']=1;
			$store['namef']=$name;
			$store['attend']="Absent";
			$store['punct']="Early";
			$store['others']=$attend['others'];
		}

		break;
	}
	break;

	case 1://present

	//echo "Lewis";
	switch($attend['late']){
		case 0:
		//echo "Itor";
		if($attend['others']="")
		{	
	

			$store['stat']=1;
			$store['numb']=1;
			$store['namef']=$name;
			$store['attend']="Present";
			$store['punct']="Late";
			$store['others']="N/A";
			//echo $data;
			//echo json_encode($out);
		}
		//echo json_encode($data);
		break;

		case 1:
		//echo "Willie";
		if($attend['others']=="")
		{
			
	

			$store['stat']=1;
			$store['numb']=1;
			$store['namef']=$name;
			$store['attend']="Present";
			$store['punct']="Late";
			$store['others']="N/A";
			//echo $data;
		}

		else{
			//print_r($attend);
			
			//$data .= 
			/*	
			$data = "
			<tr>
			<td>1</td>
			<td>{$name}</td>
			<td>Absent</td>
			<td>Late</td>
			<td>N/A</td>
			</tr>
			";*/

			$store['stat']=1;
			$store['numb']=1;
			$store['namef']=$name;
			$store['attend']="Present";
			$store['punct']="Late";
			$store['others']="N/A";
			//print_r($out);
			//echo $data;
		}
		//echo json_encode($data);
		break;
		default:
		$data ="Problem Dey";
		


		break;

	}
	break;

	}
//	echo $data;
	/*$final=array(
		'stat'=>1,
		'$record'=>$data
		);
	echo json_encode($final);*/
	echo json_encode($store);
}


else{
	$out=array(
		'stat'=>0,
		'record'=>"Error No Records Found In Database"
		);
	echo json_encode($out);
}

//echo json_encode($data);
//echo $data;
/*$out=array(
	$data
	);
echo json_encode($out);*/

}

else if(isset($_REQUEST['group'])){
	$groupid=$_POST['groupid'];
	$day=$_POST['group_day'];
	$month=$_POST['group_month'];
	$year=$_POST['group_year'];
/*
echo "Group ID: ". " ".$groupid;
echo "Day: ". " ".$day;
echo "Month "." ".$month;
echo "Year "." ".$year;
*/

$query="SELECT * FROM `memberinfo` WHERE `groupId`='$groupid'";
$result=mysqli_query($link,$query);

/*$data=mysqli_fetch_assoc($result);*/

/*print_r($data);
echo json_encode($data);*/

//array to store all memberid from a particular group
$keep=array();

$i=0;
$num_rows=mysqli_num_rows($result);
if($num_rows>0){

	while(($row=mysqli_fetch_assoc($result))){

		
		$keep[$i]=$row['memberId'];
			//$_SESSION['keep']=$keep['name'];
				$i++;
		}
//print_r($keep);

//echo json_encode($keep);
$store_id=array();
$store_present=array();
$store_late=array();

$k=0;
$j=0;

$flag=0;//used to check if input date has entries in the db

foreach ($keep as $key => $value) {
	# code...
	/*echo "Key: "." ".$key;
	echo "Value: "." ".$value;*/
	$memiddate=$value.$day.$month.$year;
	//echo $memiddate." ";
$query1="SELECT `present`,`late`,`memberId` FROM `attendance` WHERE `memberIdDate`='$memiddate'";
$result1=mysqli_query($link,$query1);

$num1=mysqli_num_rows($result1);
if ($num1==0) {
	$flag=0;
	# code...
}
else{$flag=1;}
$data=mysqli_fetch_assoc($result1);
//print_r($data);


$store_val[$j]=$data['memberId'];	
//$store_val['stat']=1;

$store_present[$j]=$data['present'];
//$store_present['stat']=2;

$store_late[$j]=$data['late'];
//$store_late['stat']=3;
$j++;
//$k++;
}


if($flag==1){
$final=array(
	'num'=>1,//everything Ok
	'val'=>$store_val,
	'present'=>$store_present,
	'late'=>$store_late
	);
echo json_encode($final);
}
else if($flag==0){
	$final=array(
		'num'=>2//No Entries for particular Date
		);
	echo json_encode($final);
}

}

else if($num_rows==0){
	$final=array(
		'num'=>0//Invalid Group
		);
	echo json_encode($final);
}





}





?>