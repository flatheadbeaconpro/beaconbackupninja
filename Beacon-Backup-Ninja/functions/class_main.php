<?php

class site{

	// Add site to Database
	public function add_site($db_conn, $user_input){
	
	$sql_write = "INSERT INTO sites (site_url, site_info, site_host, ftp_username, ftp_password, ftp_host, ftp_destination, comments, backup_schedule, last_backup)
                            VALUES(?,?,?,?,?,?,?,?,?,0, 1)";
    $prep_sql = $db_conn->prepare($sql_write);
    $prep_sql->bind_param("ssssssssi", $site_url, $site_info, $site_host, $ftp_username,$ftp_password, $ftp_host, $ftp_destination, $comments, $backup_schedule);

		$site_url = $user_input["site_url"];
		$site_info = $user_input["site_info"];
		$site_host = $user_input["site_host"];
		$ftp_username = $user_input["ftp_username"];
		$ftp_password = $user_input["ftp_password"];
		$ftp_host = $user_input["ftp_host"];
		$ftp_destination = $user_input["ftp_destination"];
		$comments = $user_input["comments"];
		$backup_schedule = $user_input["backup_schedule"];
		
		/*
$site_url = "banana";
		$site_info = "banana";
		$site_host = "banana";
		$ftp_username = "banana";
		$ftp_password = "banana";
		$ftp_host = "banana";
		$ftp_destination = "banana";
		$comments = "banana";
		$backup_schedule = "banana";
*/
		
		if($prep_sql->execute()){
			$prep_sql->close();
			return true;
		} else {
			$prep_sql->close();
			return false;
			//should we add $db_conn->close();
		}
		}


		// Select Sites From Database
		public function select_sites($db_conn, $user_input){
        
	        $sql_parms = "site_id, site_url, site_info, site_host, ftp_username, ftp_password, ftp_host, ftp_destination, comments, backup_schedule, last_backup, backup_active";
	        $sql_select = "SELECT " . $sql_parms . " FROM sites ORDER BY site_url ASC";
	
	        $prep_sql = $db_conn->query($sql_select);
	
	        $site_array = array();
	        $countr = 0;
	
	        while ($row = $prep_sql->fetch_assoc()) {
	            $site_array[$countr]["site_id"] = $row["site_id"];
	            $site_array[$countr]["site_url"] = $row["site_url"];
	            $site_array[$countr]["site_info"] = $row["site_info"];
	            $site_array[$countr]["site_host"] = $row["site_host"];
	            $site_array[$countr]["ftp_username"] = $row["ftp_username"];
	            $site_array[$countr]["ftp_password"] = $row["ftp_password"];
	            $site_array[$countr]["ftp_host"] = $row["ftp_host"];
	            $site_array[$countr]["ftp_destination"] = $row["ftp_destination"];
	            $site_array[$countr]["comments"] = $row["comments"];
	            $site_array[$countr]["backup_schedule"] = $row["backup_schedule"];
	            $site_array[$countr]["last_backup"] = $row["last_backup"];
	            $site_array[$countr]["backup_active"] = $row["backup_active"];
	            $countr++;
	        }
	        $prep_sql->free();
	        //$prep_sql->close();
	
	        return $site_array;
		}
		
		
		// Grab Information from Specific Site
		public function site_information($db_conn, $user_input){
		$sql_parms = "site_id, site_url, site_info, site_host, ftp_username, ftp_password, ftp_host, ftp_destination, comments, backup_schedule, last_backup, backup_active";
	        $sql_select = "SELECT " . $sql_parms . " FROM sites WHERE site_id='" . $user_input['site_id'] . "'";
	
	        $prep_sql = $db_conn->query($sql_select);
	
	        $site_array = array();
	        $countr = 0;
	
	        while ($row = $prep_sql->fetch_assoc()) {
	            $site_array["site_id"] = $row["site_id"];
	            $site_array["site_url"] = $row["site_url"];
	            $site_array["site_info"] = $row["site_info"];
	            $site_array["site_host"] = $row["site_host"];
	            $site_array["ftp_username"] = $row["ftp_username"];
	            $site_array["ftp_password"] = $row["ftp_password"];
	            $site_array["ftp_host"] = $row["ftp_host"];
	            $site_array["ftp_destination"] = $row["ftp_destination"];
	            $site_array["comments"] = $row["comments"];
	            $site_array["backup_schedule"] = $row["backup_schedule"];
	            $site_array["last_backup"] = $row["last_backup"];
	            $site_array["backup_active"] = $row["backup_active"];
	        }

	        $prep_sql->free();
	        //$prep_sql->close();
	
	        return $site_array;
		}
		
		// Update Website Information
		public function site_update($db_conn, $site_information){
			$site_info = base64_encode($site_information['site_username' . ":" . $site_information['site_password']]);
			
			$sql_update[] = "UPDATE sites SET site_url='" . $site_information['site_url'] . "' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET site_info='" . $site_info . "' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET site_host='" . $site_information['site_host'] . "' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET site_host='" . $site_information['site_host'] . "' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET ftp_username='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET ftp_passowrd='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET ftp_host='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET ftp_destination='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET comments='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	$sql_update[] = "UPDATE sites SET backup_schedule='' WHERE site_id='" . $site_information['site_id'] . "'";
	        	
	        	foreach($sql_update as $sql_update_statement){
	        		$prep_update = $db_conn->prepare($sql_update_statement);
	        		$prep_update->execute();
	        		$prep_update->close();
	        	}
	        	
	        	return true;
		}
		
		// Update Website Information
		public function site_active($db_conn, $user_input){
			$sql_update = "UPDATE sites SET backup_active='" . $user_input['updateto'] . "' WHERE site_id='" . $user_input['site_id'] . "'";
			echo $sql_update;
	        	$prep_update = $db_conn->prepare($sql_update);
	        	if($prep_update->execute()){
	        		$prep_update->close();
	        		return true;
	        	}else{
	        		$prep_update->close();
	        		return false;
	        	}
		}

}

?>