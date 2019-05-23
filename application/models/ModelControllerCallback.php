<?php 
	/**
	* This class contains  the method for performing extra action performed
	*/
	class ModelControllerCallback extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('webSessionManager');
			$this->load->helper('string');
			// $this->load->library('hash_created');
		}

		public function onadminInserted($data,$type,&$db,&$message)
		{
			//remember to remove the file if an error occured here
			//the user type should be student_biodata
			loadClass($this->load,'user');
			if ($type=='insert') {
				$param = array('user_type'=>'admin','username'=>$data['firstname'],'password'=>md5($data['lastname']),'user_table_id'=>$data['LAST_INSERT_ID']);
				$std = new User($param);
				if ($std->insert($db,$message)) {
					return true;
				}
				return false;
			}
			return true;
		}

		public function onSubject_scoreInserted($data,$type,&$db,&$message)
		{
			if($type == 'insert'){
				$query = "insert ignore into upload_history(user_id,academic_session_id,session_term_id,subject_id,school_class_id,user_type) select 1,academic_session_id,session_term_id,subject_id,school_class_id,'admin' from subject_score join student_subject_registration on student_subject_registration.id=subject_score.student_subject_registration_id where not exists (select * from upload_history where subject_id=student_subject_registration.subject_id and academic_session_id=student_subject_registration.academic_session_id)";
				if(!$db->query($query)){
					$message='error occured , please try again';
					return false;
				}
				return true;
			}
		}			
	}

 ?>