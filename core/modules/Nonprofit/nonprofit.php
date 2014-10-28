<?php class nonprofit extends CodonModule{
	
	public function index(){
		$this->render('nonprofit/index.tpl');
	}

	public function register(){
		if($this->post->action == 'register'){
			$username = $this->post->username;
			$nonprofit_name = $this->post->organizationname;
			$password = $this->post->password;
			$email = $this->post->email;
			$commonname = $this->post->fullname;
			//$user_title, $tax_id, $nonprofit_class, $foundation_type, $physical_address
			$user_title = $this->post->position;
			$tax_id = $this->post->tax_id;
			$nonprofit_class = $this->post->classification;
			$foundation_type = $this->post->organization_type;
			$physical_address = $this->post->address;

			$reg = NonProfitEngine::register($username, $nonprofit_name, $password, $email, $commonname, $user_title, $tax_id, $nonprofit_class, $foundation_type, $physical_address);
			if($reg == 2){
				MainController::run('frontpage', 'index');
				echo '<script>
					window.onload = function() {
						 swal("Perfecto!", "You\'re account will be reviewed for approval.", "info");
					};
					</script>';
			}else if($reg == 1){
					//render error for username exists.
					echo '<script>
					window.onload = function() {
						 swal("Oh no!", "The username you\'re using is already taken!", "warning");
					};
					</script>';
					//Record all variables as template variables
					$this->set('username', $username);
					$this->set('organizationname', $nonprofit_name);
					$this->set('password', $password);
					$this->set('email', $email);
					$this->set('fullname', $commonname);
					$this->set('position', $user_title);
					$this->set('tax_id', $tax_id);
					$this->set('classification', $nonprofit_class);
					$this->set('address', $physicall_address);
					//Render page again.
					$this->render('nonprofit/register.tpl');
			}else if ($reg == 0){
					//render error for email exists
				 	echo '<script>
					window.onload = function() {
						 swal("Oh no!", "The email you\'re using is already taken!", "warning");
					};
					</script>';
					//Record all variables as template variables
					$this->set('username', $username);
					$this->set('organizationname', $nonprofit_name);
					$this->set('password', $password);
					$this->set('email', $email);
					$this->set('fullname', $commonname);
					$this->set('position', $user_title);
					$this->set('tax_id', $tax_id);
					$this->set('classification', $nonprofit_class);
					$this->set('address', $physicall_address);
					//Render page again.
					$this->render('nonprofit/register.tpl');
			}else{
				echo '<script>
					window.onload = function() {
						 swal("Oh no!", "We honestly don\'t know what went wrong. The teach team has been notified of the error.", "error");
					};
					</script>';
				//unknown error
				//Record all variables as template variables
					$this->set('username', $username);
					$this->set('organizationname', $nonprofit_name);
					$this->set('password', $password);
					$this->set('email', $email);
					$this->set('fullname', $commonname);
					$this->set('position', $user_title);
					$this->set('tax_id', $tax_id);
					$this->set('classification', $nonprofit_class);
					$this->set('address', $physicall_address);
					//Render page again.
					$this->render('nonprofit/register.tpl');
			}
		}
		else{
			$this->render('nonprofit/register.tpl');
		}
	}
	/*
	*	Control Panel for Non-Profit
	*	
	*/
	public function cp(){
		//Check if logged in
		$bool = NonProfitEngine::logged();
		if($bool){
			$uinfo = NonProfitEngine::loginfo();
			$this->set('userinfo', $uinfo);
			$this->render('nonprofit/profile_main.tpl')
			//is logged in
		}else{
			MainController::Run('frontpage', 'index');
		}
	}
}