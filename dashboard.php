<?php 
  session_start();
   if(!isset($_SESSION["user"])){
	 header("location: index.php");
   }
 ?>
 <?php
	 include "link.php";
	 $cname = $_SESSION['user'];

 if(isset($_REQUEST["submit1"])){
	 $pname =$_POST["preaher"];
	 $message = $_POST["msg"];
	 $offer =$_POST["offer"];
	 $tithes =$_POST["tithes"];
	 $total =$_POST["total"]; 
	 $m =$_POST["male"];
	 $f =$_POST["female"];
	 $v =$_POST["visit"];
	 $c =$_POST["children"];
	 $to =$_POST["tot"];
	 $y =date("y");
	 $mon =$_POST["mon"];
	 $mon = strtolower($mon);
	 $iqry = "insert into `$mon` set offering='$offer', tithes='$tithes', messagetopic='$message', totalinc='$total', spastor='$pname', male='$m', female='$f', visit='$v', children='$c', totalmembers='$to', year='$y'";
	 mysqli_Query($link, $iqry);
 	header('location: dashboard.php');
 }
 else if(isset($_REQUEST['update1'])){
 	$areaper = $_POST["area"];
 	$churchper = $_POST['church'];
 	$central = $_POST['central'];
 	$updatequery = "UPDATE churchinfo SET areapercent='$areaper', churchpercent='$churchper', centralpercent='$central' WHERE churchname='$cname'";
 	mysqli_Query($link, $updatequery);
 	header('location: dashboard.php');
 }
 else if(isset($_REQUEST['update2'])){

 	$pname = $_POST['pname'];
 	$pnumber = $_POST['pnum'];
 	$psupport = $_POST['psup'];

 	$updquery = "UPDATE churchinfo SET pastor='$pname', `number`='$pnumber', support='$psupport' WHERE churchname='$cname'";
 	mysqli_query($link, $updquery);
 	header('location: dashboard.php');
 }
?>
 <?php
 if(isset($_POST["logout"])){
	session_destroy();
   header("location: index.php");
 }

 $query = "SELECT * FROM churchinfo WHERE churchname='$cname'";
 	$result = mysqli_Query($link, $query);
 	$row = mysqli_fetch_assoc($result);
 ?>
 <?php
 		$p = $msg = $of = $ti = $to = $ma = $fe = $vi = $ch = $ato = "";
 	if(isset($_GET['edit']) && $_GET != 0){
 			$id = $_GET['edit'];
 			$editquery = "SELECT * FROM `$mon` WHERE ID='$id' LIMIT 1";
 			$editdata = mysqli_Query($link, $editquery);
 			if(mysqli_num_rows($editdata) > 0){
 				$editrow = mysqli_fetch_assoc($editdata);
 				$p = $editrow['spastor'];
 				$msg = $editrow['messagetopic'];
 				$of = $editrow['offering'];
 				$ti =$editrow['tithes'];
 				$to = $editrow['totalinc'];
 				$ma = $editrow['male'];
 				$fe = $editrow['female'];
 				$vi = $editrow['visit'];
 				$ch = $editrow['children'];
 				$ato = $editrow['totalmembers'];
 			}
 			else
 				header('location: dashboard.php');
 	}
 ?>
 <head>
 <link rel="icon" type="image/png" href="image/fgmlogo.png">
 <title>FGM</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="css/bootstrap.theme.css">
 <link rel="stylesheet" href="foundicons/3.0.0/foundation-icons.css">
 <script src="js/bootstrap.min.js"></script>
 <script src="jquery/1.11.3/jquery.min.js"></script>
 <style>
 #mon{
	width:70px;
	font-size:30px;
	padding-left:8px;
	height:70px;
	border:0px;
	border-radius:100%;
	background:	#0000FF;
	color:white;
	box-shadow:2px 1px 15px grey;
}
#mon:hover{
	background:red;
	box-shadow:2px 1px 9px grey;
}
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
#loadtext{
  color:blue;
  font-size: 15px;
  position: absolute;
  left: 47%;
  top: 46.5%;
  z-index: 1
}
</style>
 <script>
 function dat(){
 }
 
function calc(){
	var x = document.getElementById("o").value;
	var y = document.getElementById("t").value;
	var z = 0;
	z =Number(x)+Number(y);
	document.getElementById("tot").value = parseFloat(z);
}
function calc1(){
	var m = document.getElementById("m").value;
	var f = document.getElementById("f").value;
	var v = document.getElementById("v").value;
	var c = document.getElementById("c").value;
	var z = 0;
	z = Number(m) + Number(f) + Number(v) + Number(c);
	document.getElementById("to").value = z;
} 
 </script>
 </head>
 <body onload="myFunction()">
 	<span id="loadtext">loading...</span>
 <div id="loader"></div>

 <div style="display:none;" id="myDiv" class="animate-bottom">
 <div class="container">
            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
						<span><img src="image/fgmlogo.png" style="width:25px; height:25px;">
						<?php $user = $_SESSION["user"]; echo $church = strtoupper($user);?></span>
 					 </a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="dashboard.php">Home</a></li>
 						<li><a href="statistics.php">Statistics</a></li>
 						<li><a href='submissionprev.php'>Submission</a></li>
 						<li><a href="discipleship/">Discipleship</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                    	<li>
			 				<form method="post" action="dashboard.php" enctype="multipart/form-data">
 								<input type="submit" name="logout" style="background:#FFF0F5; border-radius:10px; cursor:pointer; width:50px; height:30px; margin-top: 7px; margin-right:100px;" value="logout">
 							</form>
 						</li>
 					</ul>
                </div>
            </nav>
        </div>
 <div class="container">
 	<div class="row">
 		<div class="col-md-9">
 		<form method="post" action="dashboard.php?submit1" class="form-horizontal" role="form" enctype="multipart/form-data">
			<span>
				<span class="text-danger" style="padding-left: 100px; font-size: 60px;">Sunday Statistics</span>
	  			<input type="text" name="mon" class="pull-right" id="mon" required>
	  		</span>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="preacher">Name of Preacher</label>
 				<div class="col-md-8">
 					<input type="text" class="form-control" id="preacher" name="preaher" value="" placeholder="Name of Preacher..." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="msg">Message topic</label>
 				<div class="col-md-8">
 					<input type="text" class="form-control" id="msg" name="msg" value="" placeholder="Topic of message..." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="o">Offering</label>
 				<div class="col-md-8">
 					<input type="number" id="o" class="form-control" name="offer" value="" placeholder="enter offering..." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="t">Tithes</label>
 					<div class="col-md-8">
 						<input type="number" id="t" class="form-control" name="tithes" value="" onblur="calc()" placeholder="enter tithes..." required>
 					</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="tot">Total</label>
 				<div class="col-md-8">
 					<input type="number" id="tot" class="form-control" name="total" onfocus="calc()" value="" placeholder="Total..." readonly>
 				</div>
 			</div>
 			<div class="page-header" style="padding-left: 100px; padding-right: 100px;">
 				<h2 class="text-primary">ATTENDANCE</h2>
 			</div>
 		
 			<div class="form-group">
 				<label class="control-label col-md-4" for="m">Male</label>
 				<div class="col-md-8">
 					<input type="number" id="m" name="male" class="form-control" placeholder="Number of Male...." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="f">Female</label>
 				<div class="col-md-8">
 					<input type="number" id="f" name="female" class="form-control" value="" placeholder="Number of Female..." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="v">Visitors</label>
 				<div class="col-md-8">
 					<input type="number" id="v" name="visit" class="form-control" placeholder="Number of Visitors...." required>
 				</div>
 			</div>
 			<div class="form-group">
 				<label class="control-label col-md-4" for="c">Children</label>
 				<div class="col-md-8">
 					<input type="number" id="c" name="children" class="form-control" onblur="calc1()" value="" placeholder="Number of Children..." required>
 				</div>
 			</div>
 			<div class="form-group">
				<label class="control-label col-md-4" for="to">Total</label>
				<div class="col-md-8">
					<input type="number" id="to" class="form-control" name="tot" onfocus="calc1()" placeholder="Total...." readonly>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-4" for="submit"></label>
				<div class="col-md-8">
					<input type="submit" class="form-control btn btn-primary" id="submit" value="Submit">
				</div>
			</div>
		</form>
 		</div>
 		<div class="col-md-3">
 			<div class="page-header">
 				<h2>Advance Options<span class="fi-widget"></span></h2>
 			</div>
  			<a href="show.php" class="btn btn-default form-control">
  				<b>View sunday statistics<span style="font-size:25px;" class="pull-right fi-plus"></span></b>
  			</a>
  			<button type="submit" id="editperc" class="btn btn-default form-control">
  				<b>Edit percentages<span style="font-size:25px;" class="pull-right fi-plus"></span></b>
  			</button>

  			<div id="editp" class="collapse">
  				<form method="post" role="form" action="dashboard.php?update1" style="padding-left: 5px; padding-right: 5px;" enctype="multipart/form-data">
  					<div class="form-group">
  						<label class="control-label" for="area">Area Percentage</label>
  						<input type="number" id='area' name="area" value="<?= $row['areapercent'] ?>" class="form-control">
  						<label class="control-label" for="church">Church Percentage</label>
  						<input type="number" id='church' name="church" value="<?= $row['churchpercent'] ?>" class="form-control">
  						<label class="control-label" for="central">Central Fund Percentage</label>
  						<input type="number" id='central' name="central" value="<?= $row['centralpercent'] ?>" class="form-control">
  					</div>
  					<input type="submit" value="Update" class="btn btn-primary form-control">
  				</form>
  			</div>
  			<button class="btn btn-default form-control" id="editpastor">
  				<b>Edit pastor info<span style="font-size:25px;" class="pull-right fi-plus"></span></b>
  			</button>
  				<form method="post" id="editpa" role="form" action="dashboard.php?update2" class='collapse' style="padding-left: 5px; padding-right: 5px;" enctype="multipart/form-data">
  					<div class="form-group">
  						<label class="control-label" for="pname">Pastor name</label>
  						<input type="text" id='pname' name="pname" value="<?= $row['pastor'] ?>" class="form-control">
  						<label class="control-label" for="pnum">Pastor number</label>
  						<input type="number" id='pnum' name="pnum" value="<?= $row['number'] ?>" class="form-control">
  						<label class="control-label" for="support">Pastor Support</label>
  						<input type="number" id="support" name="psup" value="<?= $row['support'] ?>" class="form-control">
  					</div>
  					<input type="submit" value="Update" class="btn btn-primary form-control">
  				</form>
  		</div>
	</div>
 </div>
 </div>
 <script type="text/javascript">
$(document).ready(function(){
    $("#editperc").click(function(){
        $("#editp").toggle("slow");
    });
});
$(document).ready(function(){
    $("#editpastor").click(function(){
        $("#editpa").toggle("slow");
    });
});
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 5000);
}

function showPage() {
 	   var d = new Date();
	   var mon = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	   document.getElementById("mon").value = mon[d.getMonth()];
  document.getElementById("loader").style.display = "none";
  document.getElementById("loadtext").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
 </script>
</body>