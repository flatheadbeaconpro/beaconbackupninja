<?php require "assets/header.php"; ?>
<?php

if(isset($_POST["submit"])){
	
	// Start Array
	$user_input = array();
	
	// Site Information
	$user_input["user_name"] = $_POST["user_name"];
	$user_input["user_password"] = $_POST["user_password"];
	$user_input["user_permission_level"] = $_POST["user_permission_level"];
	
	
	if($user->add_user($db_conn, $user_input)){
		echo $codeformat->generate_alert("success", "User added succesfully.");
	}else{
		echo $codeformat->generate_alert("error", "User could not be added to database.");
	}
}

?>
			
			<h2>Users</h2>
			<div class="container">
				<div class="container_header">
					<div class="container_header_left">ADD USER</div>
					<div class="container_header_right" style="font-size:19px; font-weight:bold;">+</div>
					<div class="clear"></div>
				</div>
				<div class="container_main">
				<form action="users.php" method="post">

					<div class="input_title">Username</div> <input type="text" name="user_name" id="user_name">
					<div class="clear"></div>
					<div class="input_title">Password</div> <input type="text" name="user_password" id="user_password">
					<div class="clear"></div>
					<div class="input_title">Permission Level</div>
					<select name="user_permission_level" id="user_permission_level">
						<option value="0">Read</option>
						<option value="1">Read/Add</option>
						<option value="2">Admin</option>
					</select>
					<div class="clear"></div>
					
					<input type="submit" name="submit" id="submit" value="Submit User">
					<div class="clear"></div>
				</form>
				</div>
				</div>
				<table class="sites-table">
					<thead>
						<tr>
							<td>ID #</td>
							<td>Username</td>
							<td>Password</td>
							<td>Permission Level</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
					<?php
	$userArray = $user->select_users($db_conn, $user_input);		
	
						
						foreach($userArray as $user){
							echo 
							"<tr>
								<td> ".$user['user_id']."</td>
								<td> ".$user['user_name']."</td>
								<td> (Left Blank for the Moment.)".$user['user_password']."</td>
								<td> ".$codeformat->user_permission_level($user['user_permission_level'])."</td>
								<td><a href='edit_user.php?id=".$user['user_id']."'>EDIT</a> | <a href='#'>ACTIVATE</a></td>
							</tr>";
						}
						
					?>	
					</tbody>	
				</table>
			
<?php require "assets/footer.php"; ?>