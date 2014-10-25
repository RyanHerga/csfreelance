<?php class freelancer extends CodonModule{
	
	public function index(){
		$this->render('freelancer/index.tpl');
	}

	public function register(){
		if($this->post->action == 'register'){
			//Call registration Functio
			$reg = FreelancerEngine::register($this->post->username, $this->post->password, $this->post->email, $this->post->fullname);
			if($reg == 2){
				//Registration was succesful, please check email.
				MainController::run('frontpage', 'index');
				echo '<script>
					window.onload = function() {
						 swal("Perfecto!", "You\'re now ready to access your acccount.", "success");
					};
					</script>';
				
			}else{
				//Registration was not succesful, do it all again.
				$this->set('username', $this->post->username);
				$this->set('password', $this->post->password);
				$this->set('email', $this->post->email);
				$this->set('fullname', $this->post->fullname);

				MainController::run('frontpage', 'index');
				if($reg == 1){ echo '<script>
					window.onload = function() {
						 swal("Oh no!", "Looks like the username you provided is already in use.", "error");
					};
					</script>';
				}
				if($reg == 0){ echo '<script>
					window.onload = function() {
						 swal("Oh no!", "Looks like the email you provided is already in use.", "error");
					};
					</script>';
				}
				if($reg == 3){ echo '<script>
					window.onload = function() {
						 swal("Oh no!", "Something went wrong, that\'s all we know.", "error");
					};
					</script>';
				}
			}
		}
	}

}