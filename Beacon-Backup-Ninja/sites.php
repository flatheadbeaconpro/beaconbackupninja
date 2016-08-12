<?php require "assets/header.php"; ?>
<?php
$site = new site;

if(isset($_POST["submit"])){
	$site_info = $_POST["site_username"] . ":" . $_POST["site_password"];
	
	// Start Array
	$user_input = array();
	
	// Site Information
	$user_input["site_url"] = $_POST["site_url"];
	$user_input["site_info"] = base64_encode($site_info);
	$user_input["site_host"] = $_POST["site_host"];
	
	// FTP Information
	if(!empty($_POST["ftp_username"])){
		$user_input["ftp_username"] = $_POST["ftp_username"];
	}else{
		$user_input["ftp_username"] = "banana";
	}
	
	if(!empty($_POST["ftp_password"])){
		$user_input["ftp_password"] = $_POST["ftp_password"];
	}else{
		$user_input["ftp_password"] = "banana";
	}
	
	if(!empty($_POST["ftp_host"])){
		$user_input["ftp_host"] = $_POST["ftp_host"];
	}else{
		$user_input["ftp_host"] = "banana";
	}
	
	if(!empty($_POST["ftp_destination"])){
		$user_input["ftp_destination"] = $_POST["ftp_destination"];
	}else{
		$user_input["ftp_destination"] = "banana";
	}

	$user_input["comments"] = $_POST["comments"];
	$user_input["back_schedule"] = $_POST["backup_schedule"];
	
	
	if($site->add_site($db_conn, $user_input)){
		echo $codeformat->generate_alert("success", "Site added successfully.");
	}else{
		echo $codeformat->generate_alert("error", "Site was not added to database.");
	
	}
}

?>
			
			<h2>Sites</h2>
			<div class="container">
				<div class="container_header">
					<div class="container_header_left">ADD SITE</div>
					<div class="container_header_right" style="font-size:19px; font-weight:bold;">+</div>
					<div class="clear"></div>
				</div>
				<div class="container_main">
				<form action="sites.php" method="post">
					<div class="form_left">
					<div class="input_title">Site URL</div> <input type="text" name="site_url" id="site_url">
					<div class="clear"></div>
					<div class="input_title">cPanel Username</div> <input type="text" name="site_username" id="site_username">
					<div class="clear"></div>
					<div class="input_title">cPanel Password</div> <input type="text" name="site_password" id="site_password">
					<div class="clear"></div>
					<div class="input_title">cPanel Host</div> <input type="text" name="site_host" id="site_host">
					<div class="clear"></div>
					<div class="input_title">Backup</div>
					<select name="backup_schedule" id="backup_schedule">
						<option value="0">Monthly</option>
						<option value="1">Every two weeks</option>
						<option value="2">Once a week</option>
					</select>
					<div class="clear"></div>
					Comments:<br/>
					<textarea name="comments" id="comments">
					</textarea>
					
					
					</div>
					<div class="form_right">
					(FTP is optional for backing up to a different server. Leave blank to use default FTP. Location must already exist on the server in order for backup to work.)<br/>
					<div class="input_title">FTP Username</div> <input type="text" name="ftp_username" id="ftp_username">
					<div class="clear"></div>
					<div class="input_title">FTP Password</div> <input type="text" name="ftp_password" id="ftp_password">
					<div class="clear"></div>
					<div class="input_title">FTP Host</div> <input type="text" name="ftp_host" id="ftp_host">
					<div class="clear"></div>
					<div class="input_title">Save Location</div> <input type="text" name="ftp_destination" id="ftp_destination">
					<div class="clear"></div>
					</div>
					<div class="clear"></div>
					<input type="submit" name="submit" id="submit" value="Submit Site">
					<div class="clear"></div>
				</form>
				</div>
				</div>
				<table class="sites-table">
					<thead>
						<tr>
							<td>ID #</td>
							<td>URL</td>
							<td>cPanel Info Encoded</td>
							<td>cPanel Host</td>
							<td>Backup Schedule</td>
							<td>FTP Host</td>
							<td>Last Backup</td>
							<td>Comments</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
					<?php
	$siteArray = $site->select_sites($db_conn, $user_input);		
	
						
						foreach($siteArray as $site){
							echo "<tr class='" . $codeformat->backup_active_style($site['backup_active']) . "'>
								<td> ".$site['site_id']."</td>
								<td> ".$site['site_url']."</td>
								<td> ".$site['site_info']."</td>
								<td> ".$site['site_host']."</td>
								<td> ". $codeformat->backup_schedule($site['backup_schedule'])."</td>
								<td> Username: ".$site['ftp_username']."<br />
								Password: ".$site['ftp_password']."<br />
								Host: ".$site['ftp_host']."<br />
								Location: ".$site['ftp_destination']."</td>
								<td>" . $codeformat->last_backup($site['last_backup']) . "</td>
								<td> ".$site['comments']."</td>
								<td><!--<form action='edit.php' method='post'>
								<input typ='hidden' name='edit_id' id='edit_id' value='".$site['site_id']."' style='display:none;' hidden>
								<input type='submit' name='edit' id='edit' value='Edit'>
								</form>
								
								<form action='delete.php' method='post'>
								<input typ='hidden' name='delete_id' id='delete_id' value='".$site['site_id']."' style='display:none;' hidden>
								<input type='submit' name='delete' id='delete' value='Delete'>
								</form>-->
								<a href='edit_site.php?id=" . $site['site_id']. "'>EDIT</a> 
								<!--<a href='delete_site.php?id=" . $site['site_id']. "'>DELETE</a></td>-->
								" . $codeformat->backup_active_button($site['backup_active'], $site['site_id']) . "
							</tr>";
						}
						
					?>	
					</tbody>	
				</table>
				
				<br/><br/><br/>
				Proposed New Table Layout
				<br/><br/><br/>
				
				<table class="sites-table">
					<thead>
						<tr>
							<td>ID #</td>
							<td>URL</td>
							<td>cPanel Host</td>
							<td> FTP </td>
							<td>Information</td>
							<td>Actions</td>
						</tr>
					</thead>
					<tbody>
					<tr class="site_suspended">
								<td> #2</td>
								<td> montanalandandhomebozeman.com</td>
								<td> 67.227.190.113 </td>
								<td> Yes </td>
								
								<td>
								Backup Schedule: Monthly<br/>
								Last Backup: 07:40PM 06/06/06<br/>
								
								</td>
								<td style="text-align:center;">
								<a href="edit_site.php?id=2" class="action-links">EDIT</a> - <a href="sites.php?backupactive=1&amp;siteid=2" class="action-links">ACTIVATE</a> - <a href="#" class="action-links">View Information</a>
							</td>
							</tr>
							<tr>
							<td colspan="5">
							CFARDAdJAFOEHRHASJDHALKFHAKJGHAKLGKALGBAK
							</td>
							<td colspan="1">
							Host: banana<br>
								Username: banana<br>
								Password: banana<br>
								Location: banana</td>
					</tbody>	
				</table>
			
<?php require "assets/footer.php"; ?>