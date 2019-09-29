<?php
  $nav_selected = "SETUP";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");

  
 ?>

 <div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Configuration Options</h3>

    </div>
</div>

<div class = "form-submission">
	<form action = "scanner_releases_gantt.php" method = "POST">
	
	<h4>Select Date Option</h4>
	<select name = "start_option">
	<option value = "open_date"> Open Date</option>
	<option value = "dependency_date"> Dependency Date</option>
	</select><br>
	
	<h4>Start Date</h4>
	<input type = "date" name = "start_date" value = "1970-01-01"><br>
	
	<h4>End Date</h4>
	<input type = "date" name = "end_date" value = "2070-01-01"><br>
	
	<h4>Select Release Type</h4>
	<select name = "type_option">
	<option value = "('Async','Major','Minor','Patch')">All</option>
	<option value = "('Async')">Async</option>
	<option value = "('Major')">Major</option>
	<option value = "('Minor')">Minor</option>
	<option value = "('Patch')">Patch</option>
	</select><br>
	
	<h4>Select Release Status</h4>
	<select name = "status_option">
	<option value = "('Active','Completed','Draft','Released')">All</option>
	<option value = "('Active')">Active</option>
	<option value = "('Completed')">Completed</option>
	<option value = "('Draft')">Draft</option>
	<option value = "('Released')">Released</option>
	</select><br><br>
	
	<input type = "Submit" value = "Submit">
	</form>
	
	
</div>

<?php include("./footer.php");
