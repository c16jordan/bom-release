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
	  /*
	  * When opening Scanner_Releaes_Gantt, prior to setup page being configured, these 5 config variables are initialized to some default * values. If they are set, they will be assigned to what ever is submitted on setup.php. These 5 variables are used in the SQL Query * to pull data with their various parameters. 
	  *
	  * config_start_toggle will switch between open_date and dependency_date. The query will make sure that the toggle date is greater 
	  * than the config_start_date. 
	  *
	  * rtm_date is a value from the database, the query ensures rtm_date doesn't exceed the config_end_date.
	  *
	  * To make Type and Status work correctly, we have to pass a set of values to pick from. The default set and the form's 'All' option 
	  * will pass a set of 4 items each. If a different option is selected on the form, it passes a set of one item.
	  */
	  
	  $config_start_toggle = (!isset($_POST['start_option']) ? 'open_date' : $_POST['start_option']);
	  $config_start_date = (!isset($_POST['start_date']) ? date("1970-01-01") : $_POST['start_date']);
	  $config_end_date = (!isset($_POST['end_date']) ? date("2070-01-01") : $_POST['end_date']);
	  $config_type = (!isset($_POST['type_option']) ? "('Async','Major','Minor','Patch')" : $_POST['type_option']);
	  $config_status = (!isset($_POST['status_option']) ? "('Active','Completed','Draft','Released')" : $_POST['status_option']);
	  
	  
	  $query = "SELECT * FROM releases WHERE $config_start_toggle > '$config_start_date' AND rtm_date < '$config_end_date' AND type IN $config_type AND status IN $config_status";
	  
	  $exec = mysqli_query($con,$query);
	  while($row = mysqli_fetch_array($exec)){
		  
		  $id = $row['id'];
		  $name = $row['name'];
		
		  $start_date = $row[$config_start_toggle];
		  
		  
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
