<?php 
  session_start();
   if(!isset($_SESSION["user"])){
	 header("location: index.php");
   }
	 include "../link.php";
	 $cname = $_SESSION['user'];
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
        			<h1 class='page-header text-danger' style="padding-left: 0px; font-weight: bold;">Search Panel</h1>
        			<div class="row">


                  <!--search body ---->
                  <div class="col-md-8">
                    <div class="form-group">
                      <form class="form-horizontal" role="form">
                        <div class="col-md-12">
                           <input list="name" class="form-control" size="60" name="name" id="ind_name" type="text" placeholder="Enter Member Name" required>
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
                      </form>
                    </div>
                  </div>

                  <!-- Submit Button -->
              <div class="form-group">
                <br/>
            <div class="col-md-6 col-md-offset-5">
              <button type="button" class="btn btn-success" id="showDetail">
                <span><i class="fa fa-btn fa-user"></i></span> Show Details
              </button>
            </div>
          
              <div class="row" id="details" style="visibility:hidden;">
                <table class="table table-stripped">
                  <thead>
                    <tr>
                      <th>Name:</th>
                      <th>Phone Number</th>
                      <th>Resident</th>
                      <th>Leadership Position</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Group</th>

                    </tr>
                  </thead>
                  <tbody id="rdata">
                  </tbody>
                 
                </table>
                 <div class="row" id="singleResult" style="margin:0px 0px 0px 370px;">
                </div>
                <div id="Error" class="row" >
                </div>
              </div>
              </div>
        			</div>
        		</div>
        	</div>
        </div>
        
 </div>
  <script type="text/javascript">
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 3000);
}
function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}


/*$("#showDetail").click(function(){
 // if($("#ind_name").val!=""){
    $.post("backbone/searchdisp.php?search",{
      name: $("#ind_name").val();
    },
    function(datas){
      alert(datas);
    });
  //}
});*/

//for single analysis
$("#showDetail").click(function(){
  document.getElementById('details').style.visibility="visible";
  if($("#ind_name").val!=""){
   
   // $("#body").show("slow");
    $("#rdata").show("slow");
      $.post("backbone/searchdisp.php?search",{
      name: $("#ind_name").val(),
    
  },
      function(datas){
    //  alert(datas);
    var some=JSON.parse(datas);
    switch(some.stat){
      case 1:
      $("#details").show("slow");
      $("#rdata").show('slow');
      $("#Error").show("slow");
      $("#singleResult").show("slow");

if(some.leadership!=""){
  //alert(123);
  //alert(some.leadership);
   $("#Error").show("slow");
   //$("#Error").html(""+datas);
      $("#rdata").html("<tr><td>"+some.namef+"</td><td>"+some.phone_num+"</td>"+
            "<td>"+some.resident+"</td>"+
            "<td>"+some.leadership+"</td>"+
            "<td>"+some.gender+"</td>"+
             "<td>"+some.email+"</td>"+
            "<td>"+some.groupId+"</td>"+
            "</tr>");
      /*if(some.gender=="male"){
      $("#singleResult").html("<img src='../image/male1_ico.png' />");
      }
      else if(some.gender=="female"){
       $("#singleResult").html("<img src='../image/female_ico.jpg' />"); 
      }*/
      //used to switch the icons for both Male and Female
      switch(some.gender){
        case 'female':
        $("#singleResult").html("<img src='../image/female_ico.jpg' />"); 
        break;
        case 'male':
        $("#singleResult").html("<img src='../image/male1_ico.png' />");
        break;

      }

      }
      else {
       // alert(456);
        $("#rdata").html("<tr><td>"+some.namef+"</td><td>"+some.phone_num+"</td>"+
            "<td>"+some.resident+"</td>"+
            "<td> N/A</td>"+
            "<td>"+some.gender +"</td>"+
             "<td>"+some.email +"</td>"+
            "<td>"+some.groupId+"</td>"+
            "</tr>");
      }
      break;
      case 2:
      $("#details").hide("slow");
      $("#rdata").hide('slow');
      $("#Error").show("slow");
      
      $("#singleResult").hide("slow");

      $("#Error").html("<b>"+some.message+"</b>");
      break;
    }
     
      });
}



});





$('#ind_name').on({
  keyup:function(){
    var x=document.getElementById("ind_name").value;
    //alert(x);
    $.get("backbone/check.php?name=" + x,function(data,status){
      $("datalist").html(""+data);
      $(".status").text(""+status);
      $("#tdata").hide("slow");
    });
  },

  keydown: function(){
$("#tdata").hide("slow");
    $.get("backbone/check.php?names=" + $("ind_name").val(),function(datas,statu){
      $("id").attr(
        "value",""+datas
        );
    });
  }
});




</script>
</html>