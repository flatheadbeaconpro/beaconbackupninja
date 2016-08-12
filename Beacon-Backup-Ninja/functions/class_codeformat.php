<?php

class codeformat{
	public function last_backup($lbtime){
		if($lbtime != 0){
			return date('h:iA d/m/y',$lbtime);
		}else{
			return "None";
		}
	}
	
	public function backup_schedule($schedule){
		switch($schedule){
			case 1:
				return "Bi-Weekly";
				break;
			case 2:
				return "Weekly";
				break;
			default:
				return "Monthly";
				break;
		}
	}
	
	public function backup_active_button($buactive, $siteid){
		switch($buactive){
			case 0:
				return "<a href='sites.php?backupactive=1&siteid=" . $siteid . "'>ACTIVATE</a>";
				break;
			case 1:
				return "<a href='sites.php?backupactive=0&siteid=" . $siteid . "'>SUSPEND</a>";
				break;
			default:
				return "<a href='sites.php?backupactive=1&siteid=" . $siteid . "'>ACTIVATE</a>";
				break;
		}
	}
	
	public function backup_active_style($buactive){
		switch($buactive){
			case 0:
				return "site_suspended";
				break;
			case 1:
				return "site_active";
				break;
			default:
				return "site_suspended";
				break;
		}
	}
	
	public function user_permission_level($user_level){
		switch($user_level){
			case 1:
				return "Read/Add";
				break;
			case 2:
				return "Admin";
				break;
			default:
				return "Read";
				break;
		}
	}
	
	public function generate_alert($type, $text){
		if($type == "success"){
			$alert = "<div class='alert'>
				<div class='success-alert'>
					" . $text . "
				</div>
			</div>";
		}else if($type == "error"){
			$alert = "<div class='alert'>
				<div class='error-alert'>
					Error: " . $text . "
				</div>
			</div>";
		}else{
			$alert = "<div class='alert'>
				<div class='error-alert'>
					Error: Unknown
				</div>
			</div>";
		}
		
		return $alert;
	}
}

?>