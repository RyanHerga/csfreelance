<?php class MessageEngine extends CodonData{

		/*
		* Creates a new topic on table, messages_topics
		* USER TYPES - "fre" - Freelancers; "non" - NonProfit
		*/
		function createNewMessageTopic($receiver_type, $receiver_id, $title, $message){
			$message = Util::cleanString($message);
			//Finds Author Type, and ID
			$author_type = "fre";
			$author_id = FreelancerEngine::getuinfo()->id;
			if(NonProfitEngine::logged()){
				$author_type = "non";
				$author_id = NonProfitEngine::logInfo()->id;
			}

			//Queries for a new topic
			$sql = "INSERT INTO `messages_topics` (`id`, `author_type`, `author_id`, `receiver_type`, `receiver_id`, `title`)
					VALUES (NULL, '$author_type', '$author_id', '$receiver_type', '$receiver_id', '$title')";
			$topic_created = DB::query($sql);
			//Posts a message for topic id
			$message_posted = MessageEngine::postMessage($topic_id, $message);

			if($topic_created + $message_posted == 2){
				return 1;
			}
			return 0;
		}

		/*
		* Posts a message to a topic
		* Retrieves Author
		*/
		function postMessage($topic_id, $message){
			$message = Util::cleanString($message);
			$author_type = "fre";
			$author_id = FreelancerEngine::getuinfo()->id;
			if(NonProfitEngine::logged()){
				$author_type = "non";
				$author_id = NonProfitEngine::logInfo()->id;
			}

			$sql = "INSERT INTO `messages_posts` (`id`, `author_type`, `author_id`, `content`, `read`)
					VALUES (NULL, '$author_type', '$author_id', '$message', 1)";
			return DB::query($sql);
		}

		/*
		* Loads the topics available for the user to read
		* $id - user id
		*/
		function loadTopicsForUser($id = ''){
			
			$type = "fre";
			if($id == ''){$id = FreelancerEngine::getuinfo()->id;}
			if(NonProfitEngine::logged()){
				$type = "non";
				if($id == ''){$id = NonProfitEngine::logInfo()->id;}
			}
			$sql = "SELECT * FROM `messages_topics` WHERE (`author_id`='$id' AND `author_type`='$type')
					OR (`receiver_id`='$id' AND `receiver_type`='$type')";
			return DB::get_results($sql);
		}

		/*
		* Loads posts for a topic
		* If last post receiver is the one logged in, and is reading it, mark post as read.
		* $tid - Topic ID
		*/
		function loadPostsForTopic($tid){
			$sql = "SELECT * FROM `messages_posts` WHERE `topic_id` = '$tid'";
			return DB::get_results($sql);
		}

		/*
		* ADMIN COMMAND
		* Loads ALL Topics
		*/
		function loadAllTopics(){
			return DB::get_results("SELECT * FROM `messages_posts`");
		}

}