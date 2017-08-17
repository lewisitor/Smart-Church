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
 <script src="../js/Chart.min.js"></script>
<!-- <script src="../js/Chart.bundle.js"></script> -->
 <script src="../js/utils.js"></script>
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
 <body onload="myFunction()" >
 	<div id="loader"></div>

 <div style="display:none;" id="myDiv" class="animate-bottom">
<?php include 'layout.php' ?>
        		<div class='col-md-9'>
        			<h1 class='page-header text-danger' style="padding-left: 0px; font-weight: bold;">Analysis Panel</h1>
        			<div class="row">


                <!--new analysis body ---->
                <div class="row">
                  <div class="col-md-8">
                 
        		        <div class="form-group">
                       <label class="col-md-4 control-label"><span style="font-size: 25px;">Select Viewing Type:<i class="fi-torsos-female-male"></i></span> </label>
                      <select class="form-control" id="optionid" onchange="chooseOption()">
                        <option>Choose Viewing Type</option>
                        <option value="single">Individual</option>
                        <option value="group">Group</option>
                      </select>
                    </div>
                    <div id="optionSingle" style="visibility:hidden;">
                      <form class="form-horizontal" role="form" >
                      <div class="form-group">
                        <label for="individual" class="col-md-4 control-label">Name:</label>
                        <div class="col-md-6">
                          <input list="name" name="name" id="ind_name" type="text" placeholder="Enter Member Name" required>
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
                      
                      <div class="col-md-2">
                      <select  class="form-control" name="day" id="day">
                        <option >Day</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>

                      </div>


          <div class="col-md-2">
           <select class="form-control" name="month" id="month">
            <option>Month </option>
            <option value="1">January</option>
            <option value="2">February</option>
             <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
             <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
             <option value="11">November</option>
            <option value="12">December</option>
           </select>

          </div>

           <div class="col-md-3">
           <select class="form-control" name="year" id="year">
            <option>Year </option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
           </select>

          </div>

                    </div>
                     <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="button" class="btn btn-success" id="getResult">
                <span><i class="fa fa-btn fa-user"></i></span> Check Analysis
              </button>
            </div>
          </div>


          <div class="row" id="table_data">

            <table class='table table-striped'>
              <thead>
                <tr>
                  <th>No:</th>
                  <th>Name:</th>
                  <th>Attendance</th>
                  <th>On Time</th>
                  <th>Reasons</th>
                </tr>
              </thead>
              <tbody id="tdata">
                
              </tbody>
            <div class="row" id="singleResult">
                </div>
    </table>
   <div class="row" id="singleError">
   </div>
          </div>
                </form>
                    </div>


                    <div id="optionGroup" style="visibility:hidden;margin:-190px 0px 0px 0px;">
                     
                      <div class="form-group">

                          <div class="col-md-3 ">
                        <label for="groupId">Group:</label>
                        <input type="number"  id='groupId' name='groupid' placeholder='Group' class="form-control">
                      </div>
                      </div>


                             <div class="form-group">
                      
                      <div class="col-md-2">
                      <select  class="form-control" name="group_day" id="group_day">
                        <option >Day</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>

                      </div>


          <div class="col-md-3">
           <select class="form-control" name="group_month" id="group_month">
            <option>Month </option>
            <option value="1">January</option>
            <option value="2">February</option>
             <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
             <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
             <option value="11">November</option>
            <option value="12">December</option>
           </select>

          </div>

           <div class="col-md-3">
           <select class="form-control" name="group_year" id="group_year">
            <option>Year </option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
           </select>

          </div>

                    </div>
                     <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="button" class="btn btn-success" id="getGroup">
                <span><i class="fa fa-btn fa-user"></i></span> Check Analysis
              </button>
            </div>
          </div>

            <div onclick="graph()"><canvas id="myChart"></canvas>
              </div>

              <div onclick="graph()"><canvas id="myChart2"></canvas>
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

function graph(absent,present,group_name){
  var ctx = document.getElementById('myChart').getContext('2d');
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
       // labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
       labels: ["Absent", "Present"],
        datasets: [{
            //label: '# of Votes',
            label:'Attendance',
            //data: [12, 19, 3, 5, 2, 3],
            data: [absent,present],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                //'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
                /*'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'*/
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}


function graph2(late,early,group_name){
  var ctx = document.getElementById('myChart2').getContext('2d');
var ctx = document.getElementById("myChart2");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
       // labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
       labels: ["Early", "Late"],
        datasets: [{
            //label: '# of Votes',
            label:'Punctuality',
            //data: [12, 19, 3, 5, 2, 3],
            data: [early,late],
            backgroundColor: [
               // 'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                //'rgba(255, 206, 86, 0.2)',
                //'rgba(75, 192, 192, 0.2)',
                //'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
               // 'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                //'rgba(255, 206, 86, 1)',
                //'rgba(75, 192, 192, 1)',
                //'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}





function chooseOption(){
var op=document.getElementById("optionid");
var others=op.options[op.selectedIndex].value;
//alert(others);

if(others=='single'){
  document.getElementById('optionSingle').style.visibility = 'visible';
  document.getElementById('optionGroup').style.visibility = 'hidden';
  document.getElementById('table_data').style.visibility="hidden";
}

else if(others=='group'){
 document.getElementById("optionSingle").style.visibility = "hidden";
  document.getElementById("optionGroup").style.visibility = "visible"; 
document.getElementById('table_data').style.visibility="hidden";
  }
}





$(document).ready(function(){
/*var op=document.getElementById("optionid");
var others=op.options[op.selectedIndex].value;
//alert(others);
if(others=="single")
  {alert("Am Ready");}*/
//document.getElementById('table_data').style.visibility="hidden";
//$("table_data").hide();

//for group analysis
$("#getGroup").click(function(){
if($("#groupId").val!=""){
  if($("#group_month").val!=""&& $("#group_year").val!="" && $("#group_day").val!=""){

    $.post("backbone/analysis.php?group",{
      groupid:$("#groupId").val(),
      group_day:$("#group_day").val(),
      group_month:$("#group_month").val(),
      group_year:$("#group_year").val()
    },  function(data){
      
      var some=JSON.parse(data);
     // alert(some.late);
     //alert(some.num);
     switch(some.num){
      case 0:
      alert("Invalid Group Inputed");
      $("#groupId").focus();
      break;
      case 1:
       var p=0,a=0,e=0,l=0;
      //used to loop thru the array to get those present
      for(var i=0;i<some.present.length;i++){
        if(some.present[i]=='1'){
          p++;
          //continue;
        }
        else if(some.present[i]=='0'){
          a++;
         // continue;
        }
      }
      //used to loop thru the array to get those present or late with 1 for late and 0 for early
      for(var k=0;k<some.late.length;k++){
        /*if(some.late[k]=='1'){
          l++;
          //continue;
        }
        else if(some.late[k]=='0'){
          e++;
         // continue;
        }*/
        switch(some.late[k]){
          case '0':
          e++;
          break;
          case '1':
          l++;
          break;
        }

      }

      //alert(" People present:"+ p +" People Absent: "+a);
      //alert(" People Early:"+ e +" People Late: "+l);

    graph(a,p,0);
   graph2(l,e,0);
      break;
      case 2:
      alert("No Entries For Inputed Date");
      $("#group_day").focus();
      break;
     }

     
      
/********************************************************
      Block Used to sum the Ids in the returning Array
      var k=0;
      for (var i = 0; i < some.val.length; i++) {
        //alert(some.val[i]);
        k+=parseInt(some.val[i]);
        
      };
      alert(k);
      //alert(data);

      *****************************************************/

    }
      );
  }
}
});


//for single analysis
$("#getResult").click(function(){
  document.getElementById('table_data').style.visibility="visible";
  if($("#ind_name").val!="" && $("#day").val!=""){
   if ($("#month").val!="" && $("#year").val!="") {
   // $("#body").show("slow");
    $("#table_data").show("slow");
      $.post("backbone/analysis.php?single",{
      name: $("#ind_name").val(),
      day : $("#day").val(),
      month: $("#month").val(),
      year: $("#year").val()
  },
      function(datas){
      
       // $("#tdata").html("" +datas.stat);
        var some=JSON.parse(datas);
        //alert(some.stat);
        switch(some.stat){
          case 0:
          /*$("#table_data").hide("slow");
          $("#singleResult").show("slow");
          $("#singleResult").html("" +some.record)*/
         // alert("Lewis 0");
          $("#table_data").hide("slow");
          $("#tdata").hide("slow");
          $("#singleError").html("" +some.record);
          break;

          case 1:
          //alert("Itor 1");
          $("#table_data").show("slow");
          $("#singleResult").show("slow");
          $("#singleError").hide("slow");
          $("#tdata").html("<tr><td>"+some.numb+"</td><td>"+some.namef+"</td>"+
            "<td>"+some.attend+"</td>"+
            "<td>"+some.punct+"</td>"+
            "<td>"+some.others+"</td>"+
            "</tr>");


          break;


        }
       // alert(datas.stat);
       //alert(datas);
       //document.getElementById("tdata").innerHTML(datas);
        //alert(<?php$_SESSION['val']?>);
      });
}

}

});

/*if($("#ind_name").val!="" && $("#day").val!=""){
   if ($("#month").val!="" && $("#year").val!="") {
   // $("#body").show("slow");
    $("#table_data").show("slow");
      $.post("backbone/analysis.php?single",{
      name: $("#ind_name").val(),
      day : $("#day").val(),
      month: $("#month").val(),
      year: $("#year").val()
  },
      function(datas,statu){
        $("#tdata").html("" +datas);
        //alert(datas.stat);
       // alert(<?php$_SESSION['val']?>);


      });
}

}
*/



$('#ind_name').on({
  keyup:function(){
    var x=document.getElementById("ind_name").value;
    //alert(x);
    $.get("backbone/check.php?name=" + x,function(data,status){
      $("datalist").html(""+data);
      $(".status").text(""+status);
    });
  },

  keydown: function(){

    $.get("backbone/check.php?names=" + $("ind_name").val(),function(datas,statu){
      $("id").attr(
        "value",""+datas
        );
    });
  }
});

});

$(".btn").click(function(){
  $.get("backbone/check.php?names=" + $("#membergroup").val(), function(datas, statu){
    $("#id").attr(
     "value", ""+ datas 
    );
    //alert("Data: " + datas + "\nStatus: " + statu);
 });
});

</script>
</html>