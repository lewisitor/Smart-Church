<?php 
  session_start();
   if(!isset($_SESSION["user"])){
	 header("location: index.php");
   }
	 include "../link.php";
	 $cname = $_SESSION['user'];
 ?>
<?php
$memid=0;
  if(isset($_REQUEST['add'])){
$memid=0;
  $idquery = "SELECT * FROM `groups`";
  $result = mysqli_query($link, $idquery);
  $num = mysqli_num_rows($result);
  if($num > 0){
   $memid = $memid + $num;
  }
  echo($memid);
  }
?>


<?php
if(isset($_REQUEST['delete_id'])){

  //getting the member Id for group member to be deleted from db
  $memid=$_REQUEST['delete_id'];
  //echo $memid;
$val=0;
/*  echo "<script type='text/javascript'>
if(confirm('Are You Sure You want to Delete  from the Group'))
{
  
}
  else{
//  window.history.back();
  
  }
   </script>";*/

  $query_id="SELECT  * from `memberinfo` WHERE `memberId`=$memid";
  $result_id=mysqli_Query($link,$query_id);

  $name_id=mysqli_fetch_assoc($result_id);

  $grpid=$name_id['groupId'];
  $grpname=$name_id['name'];

  //echo $grpid;
  //echo $grpname;

  $query_id1="UPDATE `memberinfo` SET `groupId`='' WHERE `memberId`=$memid";
  $result_id1=mysqli_Query($link,$query_id1);

  if($result_id1){
   // echo "OK";
    header("Location:editgroup.php?groupadgrpid}");
  }


}


?>



<?php
if(isset($_REQUEST['leader_id']))
{
  $lead=$_REQUEST['leader_id'];

 // echo $lead;

  //echo $memid;
  $query_id="SELECT  * from `memberinfo` WHERE `memberId`=$lead";
  $result_id=mysqli_Query($link,$query_id);

  $name_id=mysqli_fetch_assoc($result_id);

  $grpid=$name_id['groupId'];
  $grpname=$name_id['name'];

  //echo $grpid;
  //echo $grpname;

  $query_id1="UPDATE `groups` SET `memberId`=$lead,`leadername`='$grpname' WHERE `groupId`=$grpid";
  $result_id1=mysqli_Query($link,$query_id1);

  if($result_id1){
   // echo "OK";
    header("Location:editgroup.php?group={$grpid}");
  }
 /* else{
    echo "Not Ok Lewis";
  }*/

}
/*else{
  echo "No way";
}*/
?>


<?php
//include "../link.php";
if(isset($_REQUEST['group'])){
  $group=$_REQUEST['group'];
  //echo $group;

  $query1="SELECT * FROM `groups` WHERE `groupId`='$group'";

  $result1=mysqli_Query($link,$query1);

  $name=mysqli_fetch_assoc($result1);
  


  $num_rows=mysqli_num_rows($result1);

  if($num_rows>0) {

  $leadername=$name['leadername'];
  $temp_group=$group;
  //echo $leadername;

        }
}
?>





<html>
<head>
 <link rel="icon" type="image/png" href="../image/fgmlogo.png">
 <title>FGM</title>
 <link href="../css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="../css/bootstrap.theme.css">
 <link rel="stylesheet" href="../foundicons/3.0.0/foundation-icons.css">
 <script src="../js/bootstrap.min.js"></script>
 <script src="../jquery/1.11.3/jquery.min.js"></script>
 <style>  
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
 </head>
 <body onload="myFunction()">
 	<div id="loader"></div>

 <div style="display:none;" id="myDiv" class="animate-bottom">
<?php include 'layout.php' ?>

        		<div class='col-md-9'>
        			<h1 class='page-header text-danger' style="padding-left: 0px; font-weight: bold;">Edit Group</h1>

        			<div id="groupid">

              <div class="row" >
              <form class="form-horizontal" role="form" action="editgroup.php?group" role="form" class="form-horizontal" method="POST">
                <div class="form-group">
                  <label class="col-md-4 control-label"><span style="font-size: 25px;">Group ID:<i class="fi-torsos-female-male"></i></span></label>

                  <div class="col-md-6">
                    <input type="text" name="group" placeholder="Enter Group Id">
                  </div>
                  
                </div>

                <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-success">
                <span><i class="fa fa-btn fa-user"></i></span>  Submit Info
              </button>
            </div>
          </div>
              </form>
              </div>
            </div>


                <div id="memid" >
              <div class="row" >

                <?php
                $quer = "SELECT * FROM `groups` WHERE `groupId`='$memid'";
                //$quer = "SELECT * FROM `test` WHERE `name` LIKE '$name%' LIMIT 5";
                $result = mysqli_query($link, $quer);

                $c1=mysqli_fetch_assoc(mysqli_query($link,$quer));

                ?>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Group Leader</label>
                  <input class="form-control" type="text" id="input" value=<?php echo $c1['leadername'];?> >
                </div>

                <!--new edit body ---->


              </div>
            </div>

            <div id="table" style="visibility:hidden;">
              <div class="form-group">
                <label class="col-sm-2 control-label">Group Leader</label>
                <div class>
                <input class="form-control"  id="leader" value="<?php echo $leadername;?>" disabled>
                </div>
              </div>
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                  </tr>
                </thead>
                
                <?php
               // echo $temp_group;
                $query2="SELECT * FROM `memberinfo` WHERE `groupId`='$temp_group'";
                $result2=mysqli_query($link,$query2);
                $num_rows1=mysqli_num_rows($result2);
                  
               /* while($num_rows1!=0){
                  
                  $name1=$data['name'];
                  echo $name1;
                }
*/              $i=1;
                while($data=mysqli_fetch_assoc($result2)){
                echo "<tr>";  
                //used for dynamically displaying all data concerning member for a group                 
                  echo "<td>{$i}</td>";
                  echo "<td>
                  {$data['name']}
                  <td><br/>";
                  $i++;
                  
                  

                  //query to check if a person is a group leader or not
                  $query3="SELECT *from `groups` WHERE `groupId`='$temp_group'
                   and leadername='{$data['name'] }'";
                  $result3=mysqli_query($link,$query3);
                  $ream=mysqli_fetch_assoc($result3);


                  if($data['name']==$ream['leadername']){
                  echo "<td><p class='btn btn-primary'>Group Leader</p></td>";
                  echo "<td>--</td>";
                  }
                  else{
                    echo "<td><a href='editgroup.php?leader_id={$data['memberId']}' class='btn btn-success'>Make Leader</a></td>";
                 
                    echo "<td><a href='editgroup.php?delete_id={$data['memberId']}' class='btn btn-danger'>Delete From  Group</a></td>";
                  }

                  echo "</tr>";
                }


                ?>
               <tr>
                <td><b href="#" class="btn btn-primary" id="addmenu" onclick="showaddmenu()">Add Member to Group</b></td>
               </tr>
              </table>
            </div> 

          <div id="addmember" style="visibility:hidden;" class="row">
              <form class="form-horizontal" role="form" action="editgroup.php?group" role="form" class="form-horizontal" method="POST">
                <div class="form-group">
                  <label class="col-md-4 control-label"><span style="font-size: 20px;">Member Name:<i class="fi-torsos-female-male"></i></span></label>

                  <div class="col-md-6">
                    <input  list="name" name="group" id="membergroup"  placeholder="Enter Member Name">
                    <datalist id="name">
                          </datalist>
                  </div>
                     <div class='label label-primary status'></div>
                </div>

                 <div class='form-group' style="display: none;">
                      <div class='col-md-10'>
                        <input type='text' class='form-control' id="id" name='memid' required>
                      </div>
                    </div>
                <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-success">
                <span><i class="fa fa-btn fa-user"></i></span>  Submit Info
              </button>
            </div>
          </div>
              </form>
          </div>

<?php
if(isset($leadername)){
  //echo 1234;
   echo "<script type='text/javascript'>
document.getElementById('table').style.visibility='visible';
  </script>"  ;
  //echo $leadername;
}
?>

<?php if( (isset($memid))&&(($memid!=0)) ){
  //echo "Hello Lewis";
  echo "<script type='text/javascript'>

//alert(document.documentElement.innerHTML);

  //alert('If');
  var x;
  //x='If';
  //alert(x);
/*
    x=document.querySelectorAll('div.rogerid');
    x.style.visibility='hidden';*/
  document.getElementById('memid').style.visibility='visible';

 // document.getElementById('table').style.visibility='hidden';
 
 //document.getElementById('rogerid').style.color='red';

 document.getElementById('groupid').style.visibility='hidden';
  
  
  
//alert('Itor');
  //alert(document.getElementById('memid').style.visibility);
  </script>";
}

else{
 // echo "Hello Lewis";
    echo "<script type='text/javascript'>
    //alert('Else');
 document.getElementById('groupid').style.visibility='visible';
 //document.getElementById('table').style.visibility='hidden';
 document.getElementById('memid').style.visibility='hidden';
    //alert('Lewis');
  </script>";

}

?>

        
        		</div>
        	</div>
   <!--      </div>
        
 </div> -->
  <script type="text/javascript">
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}
function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}

function showaddmenu(){
  document.getElementById('addmember').style.visibility="visible";


}

$(document).ready(function(){
  $('#membergroup').on({
    keyup:function(){
      var x=document.getElementById('membergroup').value;
     $.get("backbone/check.php?name=" + x, function(data, status){
          //alert(""+ data);
            $("datalist").html(""+ data);
            $(".status").text(""+ status);
            //alert("Data: " + data + "\nStatus: " + status);
           // alert(data);
        });

//alert(x);

    },

      keydown: function(){

        $.get("backbone/check.php?names=" + $("#membergroup").val(), function(datas, statu){
            $("#id").attr(
              "value", ""+ datas 
              );
            //alert("Data: " + data + "\nStatus: " + status);
            //alert(datas);
        });
  //alert("Am down Now");

      }

  });
}
  );
</script>
</body>
</html>