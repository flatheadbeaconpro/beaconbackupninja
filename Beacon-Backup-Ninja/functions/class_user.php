<?php

class user{
	// Add user to Database
	public function add_user($db_conn, $user_input){
	
		$sql_write = "INSERT INTO users (user_name, user_password, user_permission_level)
                            VALUES(?,?,?)";
    		$prep_sql = $db_conn->prepare($sql_write);
    		$prep_sql->bind_param("ssi", $user_name, $user_password, $user_permission_level);

		$user_name = $user_input["user_name"];
		$user_password = hash("sha256", $user_input["user_password"]);
		$user_permission_level = $user_input["user_permission_level"];
		
		if($prep_sql->execute()){
			$prep_sql->close();
			return true;
		} else {
			$prep_sql->close();
			return false;
		}
		}


		// Select Users From Database
		public function select_users($db_conn, $user_input){
        
	        $sql_parms = "user_id, user_name, user_permission_level";
	        $sql_select = "SELECT " . $sql_parms . " FROM users ORDER BY user_name ASC";
	
	        $prep_sql = $db_conn->query($sql_select);
	
	        $user_array = array();
	        $countr = 0;
	
	        while ($row = $prep_sql->fetch_assoc()) {
	            $user_array[$countr]["user_id"] = $row["user_id"];
	            $user_array[$countr]["user_name"] = $row["user_name"];
	            $user_array[$countr]["user_permission_level"] = $row["user_permission_level"];
	            $countr++;
	        }
	        $prep_sql->free();
	
	        return $user_array;
		}
		
		
		// Grab Information from Specific User
		public function user_information($db_conn, $user_input){
		$sql_parms = "user_id, user_name, user_permission_level";
	        $sql_select = "SELECT " . $sql_parms . " FROM users WHERE user_id='" . $user_input['user_id'] . "'";
	
	        $prep_sql = $db_conn->query($sql_select);
	
	        $user_array = array();
	        $countr = 0;
	
	        while ($row = $prep_sql->fetch_assoc()) {
	            $user_array["user_id"] = $row["user_id"];
	            $user_array["user_name"] = $row["user_name"];
	            $user_array["user_permission_level"] = $row["user_permission_level"];
	        }

	        $prep_sql->free();
	
	        return $user_array;
		}
		
		// Update user Information
		public function user_update($db_conn, $user_information){
			
			$sql_update[] = "UPDATE users SET user_name='" . $user_information['user_name'] . "' WHERE user_id='" . $user_information['user_id'] . "'";
			
			if(!empty($user_information["user_password"])){
			$user_password = hash("sha256", $user_information['user_password']);
	        	$sql_update[] = "UPDATE users SET user_password='" . $user_password . "' WHERE user_id='" . $user_information['user_id'] . "'";
	        	}
	        	
	        	$sql_update[] = "UPDATE users SET user_permission_level='" . $user_information['user_permission_level'] . "' WHERE user_id='" . $user_information['user_id'] . "'";
	        	
	        	foreach($sql_update as $sql_update_statement){
	        		$prep_update = $db_conn->prepare($sql_update_statement);
	        		if($prep_update->execute()){
	        		}else{
	        			return false;
	        		}
	        		$prep_update->close();
	        	}
	        	
	        	return true;
		}
		
		// Activate or Suspend user
		public function user_active($db_conn, $user_input){
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