<?php class ProjectEngine extends CodonData{

	/*
	* Create Project, cleans variables, and sends it to DB, nice & sweet.
	*/
	public function create($nonprofit, $name, $timeframe, $details, $howtoapply, $expectations, $expiry, $category, $category_other=''){
	/*
	* @PARAMS - Those that might be confusing
	* $nonprofit: The ID of the nonprofit organization
	* $name: Project Title
	* $category: Project falls into one of many categories
	* $category_other: If Project is not in any of the specified categories 
	*/
	
	//clean variables, only for those where symbols may be used
	$details = Util::cleanString($details);
	$howtoapply = Util::cleanString($howtoapply);
	$expectations = Util::cleanString($expectations);

	//formulate query
	$sql = "INSERT INTO `projects` (`id`, `nonprofit_id`, `name`, 
			`date_posted`, `status`, `timeframe`, `details`, `howtoapply`,
			`expectations`, `expiry`, `category`, `category_other`)
			VALUES(NULL, '$nonprofit', '$name', CURRENT_TIMESTAMP, 1,
			'$timeframe', '$details', '$howtoapply', '$expectations',
			'$expiry', '$category', '$category_other')";
	//execute query
	$query = DB::query($sql);
	return $query;
	}

	/*
	*	Edits a project based on the ID passed in
	*	Warning: User cannot change ALL the DB Columns
	*	Returns: 1 - Success; 0 - Fail
	*/
	public function edit($id, $name, $timeframe, $details, $howtoapply, $expectations){
		//clean variables, wheere symbols may be used
		$details = Util::cleanString($details);
		$howtoapply = Util::cleanString($howtoapply);
		$expectations = Util::cleanString($expectations);
		
		//formulate query
		$sql = "UPDATE FROM `projects` SET `name`='$name', `timeframe`='$timeframe',
				`details`='$details', `howtoapply`='$howtoapply', `expectations`='$expectations'
				WHERE `id`='$id'";
		return DB::query($sql);
	}

	/*
	* Modify status of a project
	* 0 = Inactive
	* 1 = Active
	* 2 = Awarded
	*/
	public function setStatus($id, $status){
		$sql = "UPDATE FROM `projects` SET `status`='$status' WHERE `id`='$id'";
		return DB::query($sql);
	}

	/*
	* Get all active projects with certain status
	* getProjects(1) will get active projects
	* getProjects(0) will get inactive projects
	* getProjects() will get ALL projects
	*/
	public function getProjects($status=''){
		$sql = "SELECT * FROM `projects` WHERE `status`='$status'";

		//If no parameter, default to all projects
		if($status == ''){
			$sql = "SELECT * FROM `projects`";
		}
		return DB::get_results($sql);
	}

	/*
	* Get Projects Posted For Non-Profit
	*/
	public function getProjectsForNonprofit($nid){
		return DB::get_results("SELECT * FROM `projects` WHERE `nonprofit_id` ='$nid'");
	}

	/*
	* Retrieves a specific project w/ id as a parameter
	*/
	public function getProject($id){
		$sql = "SELECT * FROM `projects` WHERE `id`='$id'";
		return DB::get_row($sql);
	}

	/*
	* ################### APPLICATION FUNCTIONS #####################
	* The following functions are for the communications between the
	* nonprofit and the freelancer, for the nonprofit to initially
	* find a developer
	*/

	/*
	* Interested user posts an application
	*/
	public function apply($pid, $fid, $comment){
		//clean variables
		$comment = Util::cleanString($comment);
		//formulate sql query
		if(checkIfAppExists($pid, $fid) == 1){
			return -1; //App already exists
		}
		$sql = "INSERT INTO `projects_apps` (`id`, `freelancer_id`, `project_id`, `date_posted`, `comment`, `status`) 
				VALUES (NULL, '$fid', '$pid', CURRENT_TIMESTAMP, '$comment', 1)";
		return DB::query($sql);
	}

	/*
	* Check if an application already exists for user in project
	*/
	public function checkIfAppExists($pid, $fid){
		return DB::get_row("SELECT * FROM `projects_apps` WHERE `project_id`='$pid' AND `freelancer_id`='$fid'");
		//Return 1 = App exists
		//Return 0 = App doesn't exist.
	}
	/*
	* Retrieves applications for a specific project
	*/
	public function getApplications($pid){
		$sql = "SELECT * FROM `project_apps` WHERE `project_id`='$pid'";
		return DB::get_results($sql);
	}
	
	/*
	* Deletes an appplication for a specific project
	*/
	public function deleteApplication($aid){
		$sql = "DELETE FROM `project_apps` WHERE `id`='$aid'";
		return DB::query($sql);
	}

	/*
	* Change status of project to 2(Awarded)
	* Change status of user application to 2(Awarded)
	*/
	public function awardProject($fid, $pid){
		//Change status of user application
		$sql = "UPDATE FROM `projects_apps` SET `status`=2 WHERE `freelancer_id`='$fid' AND `project_id`='$pid'";
		$exec_user_app = DB::query($sql);
		//Change status of project
		$sql = "UPDATE FROM `projects` SET `status`=2 WHERE `id`='$pid'";
		$exec_project = DB::query($sql);
		if($exec_user_app+$exec_project == 2){
			return 1; //All succesful
		}else{
			return 0; //Issue somewhere
		}
	}



}