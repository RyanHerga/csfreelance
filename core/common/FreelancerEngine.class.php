<?php class FreelancerEngine extends CodonData{
	/*
	* Originally Developed on 10/2/2014
	* Redeveloped on 10/14/2014 for 
	*/
	public function register($user, $pass, $email, $name){
		$user = Util::cleanString($user);
		$pass = Util::cleanString($pass);
		$email = Util::cleanString($email);
		$name = Util::cleanString($name);

		$salt = md5(date('ydm'));
		$newpass = md5($pass.$salt);

		if(FreelancerEngine::checkEmailExists($email) == 1){
			return 0; //email in use
		}else if(FreelancerEngine::checkUsernameExists($user) == 1){
			return 1; //username in use
		}else{
		    $register =	DB::query("INSERT INTO `users_freelancers` (`id`, `username`, `password`, `salt`, `commonname`, `email`) VALUES (NULL, '$user', '$newpass', '$salt', '$name', '$email')");
			if($register){
				return 2; //success
			}else{
				return 3; //other error
			}
		}
	}

	/*
	* Logs freelancers into the website, by creating a session id on the database, and allowing a rememberme feature.
	* Originally Developed on 10/2/2014
	* Redeveloped to take into account Email Comfirmations
	*/

	public function login($user, $pass, $rememberme){
		$user = Util::cleanString($user);
		$pass = Util::cleanString($pass);

		$sql = "SELECT * FROM `users_freelancers` WHERE `username`='$user'";
		$res = DB::get_row($sql);
		$expiry = date('Y-m-d');
		if($rememberme == 1){
			$expiry = date('Y-m-d',strtotime(date("Y-m-d") . " + 365 day"));
		}
		if($res->password == md5($pass.$res->salt) && $res->verified == 1){ //Check if passwords is credentials are correct, and if email is comfirmed
			//Session ID 
			$uniquesessionid = md5(uniqid());
			$ip = $_SERVER['REMOTE_ADDR'];
			//Remove prior existing sessions
			$query = DB::query("DELETE FROM `users_freelancers_sessions` WHERE `ip`='$ip'");
			if($query){
				unset($_COOKIE['sess']);
				//clear vars
			}
			//Create new session
			$query = DB::query("INSERT INTO `users_freelancers_sessions` (`sess_id`, `user_id`, `ip`, `expiry`) VALUES ('$uniquesessionid', '$res->id', '$ip', '$expiry')");
			if($query){
				//Session Created
				setcookie('sess', serialize($uniquesessionid), time()+60*60*24*180);
				//CodonCache::write('sess', $uniquesessionid, 'annual');

				return 1; //All Succesful
			}else{
				return -2; //User/password correct, Email Comfirmed, but user wasn't able to be logged in.
			}
		}else if($res->password == md5($pass.$res->salt) && $res->verified != 1){
			return -1; // Email not verified
		}else{
			return 0; // User or password is incorrect
		}
	}

	/*
	* Checks if current session is active, and if the expiry date is before today.
	* Added on 10/15/2014
	*/
	public function islogged(){
		$sess_id = unserialize($_COOKIE['sess']);
		$res = DB::get_row("SELECT * FROM `users_freelancers_sessions` WHERE `sess_id` = '$sess_id'");
		try {
				if(strtotime($res->expiry) < date('Y-m-d')){
					// User is indeed logged in
					return 1; //Session is active
				}else{
					return 0; // Session expired
				}
		} catch (Exception $e) {
				return -1; //Session doesn't exist.
		}		
	}

	/*
	* Unsets the cookie, as well as deletes the session that's active.
	* Added on 10/15/2014
	*/
	public function logout(){
		$sess_id = unserialize($_COOKIE['sess']);
		DB::query("DELETE FROM `users_freelancers_sessions` WHERE `sess_id` = '$sess_id'");
		unset($_COOKIE['sess']);
		return true;
	}
	/*
	*	Added on 10/15/2014
	*	Update the link to resume of logged in user.
	*/
	public function update_resume($resume){
		$uid = $this->get_loggedin_info()->id;
		$sql = "UPDATE `users_freelancers` SET `resume`='$resume' WHERE `id`='$uid'";
		if(DB::query($sql)){
			return true;
		}
		return false;		
	}

	/*
	*	Added on 10/15/2014
	*	Modify Avatar of logged in user.
	*/
	public function update_avatar($avatar){
		$uid = $this->get_loggedin_info()->id;
		$sql = "UPDATE `users_freelancers` SET `avatar`='$avatar' WHERE `id`='$uid'";
		if(DB::query($sql)){
			return true;
		}
		return false;	
	}

	/*
	*	Added on 10/15/2014
	*	Updates the about of logged in user.
	*/
	public function update_about($about){
		$uid = $this->get_loggedin_info()->id;
		$sql = "UPDATE `users_freelancers` SET `about`='$about' WHERE `id`='$uid'";
		if(DB::query($sql)){
			return true;
		}
		return false;	
	}

	/*
	* get information for passed ID
	* Added on 10/15/2014
	* Modified on 10/16/2014: renamed to getuinfo, and implemented $id as a param.
	*/
	public function getuinfo($id = null){
		if($id == null){
		$sess_id = unserialize($_COOKIE['sess']);
		$quer = DB::get_row("SELECT * FROM `users_freelancers_sessions` WHERE `sess_id` = '$sess_id'");
		$id = $quer->id;
		}
		
		if($quer){
			$uinfo = DB::get_row("SELECT * FROM `users_freelancers` WHERE `id`= '$id'");
			return $uinfo;
		}else{
			return -1; // A session doesn't exist. User is not supposed to be logged in.
		}
		
	}

	/*
	* Added on 10/14/2014 - Allows for Accounts to be comfirmed via email
	*/
	public function verifyAccount($email){
		$token_id = uniqid();
		$sql = "INSERT INTO `users_emailverification` (`id`, `email`, `token`) VALUES (NULL, '$email', '$token_id')";
		if(DB::query($sql)){
			//Send Email with link to comfirm.
		}else{
			//Just comfirm the account
		}
	}

	public function approveAccount($email, $token_id){
		$res = DB::get_row("SELECT * FROM `users_emailverification` WHERE `email`='$email'");
		if($res->token == $token_id){
			// Comfirm
			return DB::query("UPDATE `users_freelancers` SET `verified`=1 WHERE `email`='$email'");
		}else{
			// Error?
		}
	}


	
	//Returns | 0 = No username exists, 1 = Username exists
	private function checkUsernameExists($username){
		$res = DB::get_results("SELECT * FROM `users_freelancers` WHERE `username`='$username'");
		if($res == null){
			return 0;
		}else{
			return 1;
		}
	}
	//Returns | 0 = No emails exists, 1 = emails exists
	private function checkEmailExists($email){
		$res = DB::get_results("SELECT * FROM `users_freelancers` WHERE `email`='$email'");
		if($res == null){
			return 0;
		}else{
			return 1;
		}
	}

	

	
}