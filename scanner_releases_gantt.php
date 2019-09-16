<?php

  $nav_selected = "SCANNER"; 
  $left_buttons = "YES"; 
  $left_selected = "RELEASESGANTT"; 

  include("./nav.php");
  global $db;
 
  $con = mysqli_connect("localhost", "root", ""); 
  mysqli_select_db($con, "bom");
  

  

?>
<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Scanner -> System Releases Gantt</h3>

    
        
<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['gantt']});
    google.charts.setOnLoadCallback(drawChart);

    function daysToMilliseconds(days) {
      return days * 24 * 60 * 60 * 1000;
    }

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Task ID');
      data.addColumn('string', 'Task Name');
	  data.addColumn('string', 'Resource');
      data.addColumn('date', 'Start Date');
      data.addColumn('date', 'End Date');
      data.addColumn('number', 'Duration');
      data.addColumn('number', 'Percent Complete');
      data.addColumn('string', 'Dependencies');

      data.addRows([
	   
	
	<?php
	  $query = "SELECT * FROM releases ORDER BY open_date ASC";
	  $exec = mysqli_query($con,$query);
	  while($row = mysqli_fetch_array($exec)){
		  
		  $id = $row['id'];
		  $name = $row['name'];
		  
		  
		  //!-------------USE 'open_date' || 'dependency_date' HERE-------------!
		  $start_date = $row['open_date'];
		  
		  
		  $rtm_date = $row['rtm_date'];
		  $type = $row['type'];
		  
		  echo "['".$id."','".$name."','".$id."',new Date('".$start_date."'),new Date('".$rtm_date."'),null,50,null],";
	}	
	  ?>
      ]);

      var options = {
		width: 2000,
		height: data.getNumberOfRows() * 100,
		gantt: {
			trackHeight:50,
			labelMaxWidth: 600
		}
      };

      var chart = new google.visualization.Gantt(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
  </script>
</head>
<body>
  <div id="chart_div"></div>
</body>
</html>

        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
