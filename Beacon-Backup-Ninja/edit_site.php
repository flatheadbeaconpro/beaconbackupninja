<?php require "assets/header.php"; ?>

<?php $id = $_GET["id"];
	
	$grab = new site;
	$user_input = array();
	$user_input["site_id"] = $id;
	
	$site = $grab->site_information($db_conn, $user_input);
	
	
	//if submit encode base 64
	
	
?>
		
		<form>
			<table class="edit-table">
				<colgroup>
					<col class="edit-col-1">
					<col class="edit-col-2">
				</colgroup>
				<tr>
					<td>ID #</td>
					<td><input type="text" name="site_id" value="<?php echo $site['site_id'] ?>" /></td>
				</tr>
				<tr>
					<td>URL</td>
					<td><input type="text" name="site_url" value="<?php echo $site['site_url'] ?>" /></td>
				</tr>
				<tr>
					<td>Username Encoded</td>
					<td><input type="text" name="site_id" value="Change Username?" /></td>
				</tr>
				<tr>
					<td>Password Info Encoded</td>
					<td><input type="text" name="site_id" value="Change Password?" /></td>
				</tr>
				<tr>
					<td>cPanel Host</td>
					<td><input type="text" name="site_id" value="<?php echo $site['site_host'] ?>" /></td>
				</tr>
				<tr>
					<td>Backup Schedule</td>
					<td><select name="backup_schedule" id="backup_schedule">
						<option value="<?php echo $site['backup_schedule']; ?>"><?php echo $codeformat->backup_schedule($site['backup_schedule']); ?> (Current)</option>
						<?php/*
							switch ($site['backup_schedule']) {
							    case 1:
							        echo "<option value='1' selected>Every two weeks (Current)</option>";
							        break;
							    case 2:
							        echo "<option value='2' selected>Once a week (Current)</option>";
							        break;
							    default:
							     	echo "<option value='0' selected>Monthly (Current)</option>";
							}*/
						?>
						<option disabled="--">-----------------</option>
						<option value="0">Monthly</option>
						<option value="1">Every two weeks</option>
						<option value="2">Once a week</option>
					</select></td>
				</tr>
				<tr>
					<td>FTP Host</td>
					<td><input type="text" name="site_id" value="<?php echo $site['ftp_host'] ?>" /></td>
				</tr>
				<tr>
					<td>FTP User</td>
					<td><input type="text" name="site_id" value="<?php echo $site['ftp_username'] ?>" /></td>
				</tr>
				<tr>
				</tr>
					<td>FTP Password</td>
					<td><input type="text" name="site_id" value="<?php echo $site['ftp_password'] ?>" /></td>
				<tr>
					<td>FTP Backup Destination</td>
					<td><input type="text" name="site_id" value="<?php echo $site['ftp_destination'] ?>" /></td>
				</tr>
				<tr>
					<td>Last Backup</td>
					<td><input type="text" name="site_id" value="<?php echo $site['last_backup'] ?>" /></td>
				</tr>	
				<tr>
					<td>Comments</td>
					<td><input type="text" name="site_id" value="<?php echo $site['comments'] ?>" /></td>
				</tr>
			</table>
		</form>
<?php require "assets/footer.php"; ?>