<?php
session_start();?>

<html>
	<head>
		 <link rel="icon" type="image/png" href="image/fgmlogo.png">
 <title>Discipleship</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="css/bootstrap.theme.css">
 <link rel="stylesheet" href="foundicons/3.0.0/foundation-icons.css">
 <script src="js/bootstrap.min.js"></script>
 <script src="jquery/1.11.3/jquery.min.js"></script>
	</head>
	<body>
	
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
 						<li><a href="#">Search</a></li>
 						<li><a href="discipleship_index.php">Discipleship</a></li>
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
        		<div class="col-md-9" id="churchinfo">
        			<div class="form-group ">
        				<label class="control-label col-md-4">Group</label>
        				<div class="col-md-8 collapse" id="churchinf">
        				<button class="btn-success col-md-3">Add Group</button>
        				<button class="btn-danger col-md-3">Edit Group</button>
        				</div>
        				
        			</div>
        			
        		</div>
        		<br/><br/>
        			<div class="col-md-9" id="churchattendance">
        			<div class="form-group">
        				<label class="control-label col-md-4">Group Attendance</label>
        				<div class="col-md-8 collapse" id="churchattend">
        				<button class="btn-success col-md-3">Edit Group Attendance</button>
        				
        				</div>
        			</div>
        			
        		</div>


        	</div>
        </div>
		</body>
		<script type="text/javascript">
		$(document).ready(function(){
    $("#churchinfo").click(function(){
        $("#churchinf").toggle("slow");
    });
});
$(document).ready(function(){
    $("#churchattendance").click(function(){
        $("#churchattend").toggle("slow");
    });
});
		</script>
</html>