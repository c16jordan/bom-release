<?php
  $nav_selected = "SETUP";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  global $db;
  
  /*http://form.guide/php-form/php-form-action-self.html
  <?php echo htmlentities($_SERVER['PHP_SELF']);?>*/
 ?>
<html>
<body onload="update_form()">

 <div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Configuration Options</h3>

    </div>
</div>

<div class = "form-submission">

	<form action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST">
	
	<h4>Select Date Option</h4>
	<select name = "start_option">
	<option id="start_opt" value = "open_date" selected>Default</option>
	<option value = "open_date"> Open Date</option>
	<option value = "dependency_date"> Dependency Date</option>
	</select><br>
	
	<h4>Start Date</h4>
	<input id="s_date" type = "date" name = "start_date" value = "1970-01-01"><br>
	
	<h4>End Date</h4>
	<input id="e_date" type = "date" name = "end_date" value = "2070-01-01"><br>
	
	<h4>Select Release Type</h4>
	<select name = "type_option">
	<option id="type_def" value = "All" selected>Default</option>
	<option value = "All">All</option>
	<option value = "Async">Async</option>
	<option value = "Major">Major</option>
	<option value = "Minor">Minor</option>
	<option value = "Patch">Patch</option>
	</select><br>
	
	<h4>Select Release Status</h4>
	<select name = "status_option">
	<option id="stat_def" value = "All" selected>Default</option>
	<option value = "All">All</option>
	<option value = "Active">Active</option>
	<option value = "Completed">Completed</option>
	<option value = "Draft">Draft</option>
	<option value = "Released">Released</option>
	</select><br><br>
	
	<input type = "Submit" name="submit" value = "Submit">
	</form>
	
	
</div> 

</body>
</html>

<?php
			if(isset($_POST['submit'])){
				$start_option = $_POST['start_option'];
				$start_date	  = $_POST['start_date'];
				$end_date 	  = $_POST['end_date'];
				$type 		  = $_POST['type_option'];
				$status 	  = $_POST['status_option'];
				
			//Call database to store new posted vals
			$sql = "UPDATE preferences 
			  SET open_date='".$start_date."',rtm_date='".$end_date."', status ='".$status."' ,type= '".$type."' ,sort_by='".$start_option."'
			  WHERE id='1'";
			 
			//Maybe check if query succeeded
			$result = $db->query($sql);	
			}/*
			else{
				//call javascript function  to call php to access database, put bits of php in option values to sub vals			}
	*/
?>

<script>
	
	function update_form(){
	
	   <?php
			$sql = "SELECT * FROM preferences WHERE id='1';";
			$result = $db->query($sql);
	
			 if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); 
			
				$db_start_option  = $row['sort_by'];
				$db_start_date	  = $row['open_date'];
				$db_end_date 	  = $row['rtm_date'];
				$db_type 		  = $row['type'];
				$db_status 		  = $row['status'];
             }
		?>;
		//https://stackoverflow.com/questions/5895842/how-to-assign-php-variable-value-to-javascript-variable
		
		document.getElementById("start_opt").value = '<?php echo $db_start_option;?>';
		document.getElementById("start_opt").innerHTML = switch_param('<?php echo $db_start_option;?>');
		
		document.getElementById("stat_def").value = '<?php echo $db_status;?>';
		document.getElementById("stat_def").innerHTML = '<?php echo $db_status;?>';
		
		document.getElementById("type_def").value = '<?php echo $db_type;?>';
		document.getElementById("type_def").innerHTML = '<?php echo $db_type;?>';
		
		
		document.getElementById("e_date").value = '<?php echo $db_end_date;?>';
		
		document.getElementById("s_date").value = '<?php echo $db_start_date;?>';
		
	
		//alert(returned);
}
</script>

<script>

// Function to convert open_date/dependency_date into better looking strings for the form input id="start_opt"

function switch_param(input){
	
	var vahr = input;
	
	if(vahr == "dependency_date"){
		vahr = "Dependency Date";
	}
	else if(vahr == "open_date"){
		vahr = "Open Date";
	}

	return vahr;
}
	
</script>


<?php include("./footer.php"); ?>
