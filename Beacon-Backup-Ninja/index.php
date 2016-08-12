<?php require "assets/header.php"; ?>
			<div class="alert">
				<div class="success-alert">
					User has been successfully added to database.
				</div>
			</div>
			
			<div class="alert">
				<div class="error-alert">
					Error #EC577: User could not be found in the database.
				</div>
			</div>
			
			<h2>Welcome to the Backup Dashboard</h2>
			<p>
				Here's how to use the script. iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa iahhdahdkjashdkjasgiugdiuag sfuasgfiuvngafuvnafnha haflhsdlf fahsdfkgsdkfasfahslfsafdhsdfhejfiohsafsafsdaihf;ashfsa
			</p>
				<form>
					Site URL: <input><br/>
					cPanel Username: <input><br/>
					cPanel Password: <input><br/>
					cPanel Host: <input><br/>
					Comments:<br/>
					<textarea>
					</textarea><br/>
					Backup:
					<select>
						<option>System Preference</option>
						<option>Once every two weeks</option>
						<option>On Specific Day</option>
					</select>
					<br/><br/>
					(FTP is optional for backing up to a different server. Leave blank to use default FTP. Location must already exist on the server in order for backup to work.)<br/>
					FTP Username: <input><br/>
					FTP Password: <input><br/>
					FTP Host: <input><br/>
					Save Location: <input><br/>
					<input type="submit">
				</form>
				<br/><br/>
				Trade Database Design:<br/><br/>
				-fbpbs_users<br/>
				--user_id (Generate through script, for security. Set as primary table.)<br/>
				--user_name<br/>
				--user_password<br/>
				--user_permission_level<br/><br/>
				-fbpbs_sites<br/>
				--site_id (Generate through scipt, for security. Set as primary table.)<br/>
				--site_url<br/>
				--site_info (Base_64 encode of username and password.)<br/>
				--site_host<br>
				--ftp_username<br/>
				--ftp_password<br/>
				--ftp_host<br/>
				--ftp_location<br/>
				--comments<br/>
				--backup_schedule<br/>
				--last_backup(unix time)<br/><br/>
				-fbpbs_configuration<br/>
				--config_id<br/>
				--config_name<br/>
				--config_info
				
			
		<?php require "assets/footer.php"; ?>