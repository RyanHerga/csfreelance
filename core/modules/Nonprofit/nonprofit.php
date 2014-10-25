<?php class nonprofit extends CodonModule{
	
	public function index(){
		$this->render('nonprofit/index.tpl');
	}

	public function register(){
		$this->render('nonprofit/register.tpl');
		
	}

}