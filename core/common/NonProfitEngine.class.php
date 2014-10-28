<?php class NonProfitEngine extends CodonData{

	/*
	*	Allows for a new non profit to register for an account
	* 	Implemented on 10/20/2014 forked from FreelancerEngine
	*/
	public function register($username, $nonprofit_name, $password, $email, $commonname, $user_title, $tax_id, $nonprofit_class, $foundation_type, $physical_address){
		//Strip tags, security check to prevent SQL injection.
		$nonprofit_age = "NULL";
		$username = Util::cleanString($username);
		$nonprofit_name = Util::cleanString($nonprofit_name);
		$email = Util::cleanString($email);
		$commonname = Util::cleanString($commonname);
		$user_title = Util::cleanString($user_title);
		$nonprofit_class = Util::cleanString($nonprofit_class);
		$foundation_type = Util::cleanString($foundation_type);
		$physical_address = Util::cleanString($physical_address);
		$password = Util::cleanString($password);
		$verified = 1;
		//Check if the email, or username already exists.
		if(NonProfitEngine::checkUsernameExists($username) == 1){
			return 1; //username exists
		}if(NonProfitEngine::checkEmailExists($email)){
			return 0; //email exists
		}

		//basic salt hash
		$salt = md5(date('ydm'));
		$newpass = md5($pass.$salt);
		$password = $newpass;

		//Prepare SQL Statement 
		$sql = "INSERT INTO `users_nonprofit` (`username`, `nonprofit_name`, `password`, `salt`, `email`, `commonname`, `user_title`, `nonprofit_age`, `tax_id`, `verified`, `nonprofit_classification`, `foundation_type`, `physicaladdress`)
				VALUES ('$username', '$nonprofit_name', '$password', '$salt', '$email', '$commonname', '$user_title', '$nonprofit_age', '$tax_id', '$verified', '$nonprofit_classification', '$foundation_type', '$physical_address')";
		if(DB::query($sql)){
			return 2; //Perfecto
		}else{
			return 3; //Something else went wrong
		}
	}

	/*
	* Login Function to authenticate account, checks if account is verified, 
	* Note: FUNCTION WILL NOT SAVE SESSION ID IN DB FOR SECURITY PURPOSES
	* Coded on 10/19/2014
	* Updated on 10/2014: Removed Session saving in database.
	*/
	public function login($user, $pass, $rememberme = 0){
		//Clean string to avoid SQL injection
		$user = Util::cleanString($user);
		$pass = Util::cleanString($pass);

		//delete any existing session
		$uniquesessionid = md5(uniqid());
		$ip = $_SERVER['REMOTE_ADDR'];
		DB::query("DELETE FROM `users_nonprofit_sessions` WHERE `ip`='$ip'");
		DB::query("DELETE FROM `users_freelancers_sessions` WHERE `ip`='$ip'");

		//SQL Statement for getting person with username.
		$sql = "SELECT * FROM `users_nonprofit` WHERE `username`='$user' AND `verified` = 1";

		//Check if username is in the database
		$dbUser = DB::get_row($sql);

		//Check if the remember me button is selected
		if($rememberme == 1){
			$expiry = date('Y-m-d',strtotime(date("Y-m-d") . " + 365 day"));
		}

		//If it is.
		if($dbUser){ 
			//Compare the passwords
			$actualpass = md5($pass.$dbUser->salt);
			if($actualpass == $dbUser->password){
				$query = DB::query("INSERT INTO `users_nonprofit_sessions` (`sess_id`, `user_id`, `last_logged`, `ip`, `expiry`) VALUES ('$uniquesessionid', '$dbUser->id', CURRENT_TIMESTAMP, '$ip', '$expiry')");
				if($query){
					//Session Created
					setcookie('npsess', serialize($uniquesessionid), time()+60*60*24*180);
					//CodonCache::write('sess', $uniquesessionid, 'annual');
					return 1; //All Succesful
				}else{
					return 2; //User/password correct, Verified Account, but user wasn't able to be logged in.
				}
			}else{
				return -1;
				//Password ain't right.
			}
		}else{
			return 0;
			//Username doesn't exist.
		}
	}
	/*
	* Checks if user is logged
	*/
	public function logged(){
		$sess_id = $_COOKIE['npsess'];
		$sess_id = unserialize($sess_id);
		//Gets session id for non-profits
		if($sess_id != null || $sess_id != ""){
			return true;
		}
		return false;
	}

	/*
	* Gets logged in user information
	*/
	public function loginfo(){
		$sess_id = $_COOKIE['npsess'];
		$sess_id = unserialize($sess_id);
		if($sess_id != null || $sess_id != ""){
			NonProfitEngine::get_sess($sess_id);
		}
		return false;
	}

	private function get_sess($id){
		$sql = "SELECT * FROM `users_nonprofit_sessions` WHERE `sess_id` = '$id'";
		$uid = DB::get_row($sql)->user_id;

		$sql = "SELECT * FROM `users_nonprofit` WHERE `id`='$uid'";
		return DB::get_row($sql);
	}

	//Returns | 0 = Username doesn't exist, 1 = username exists.
	private function checkUsernameExists($username){
		$res = DB::get_results("SELECT * FROM `users_nonprofit` WHERE `username`='$username'");
		if($res == null){
			return 0;
		}else{
			return 1;
		}
	}

	//Returns | 0 = No emails exists, 1 = emails exists
	private function checkEmailExists($email){
		$res = DB::get_results("SELECT * FROM `users_nonprofit` WHERE `email`='$email'");
		if($res == null){
			return 0;
		}else{
			return 1;
		}
	}	
}