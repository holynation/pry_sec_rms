<?php
	/**
	* model for loading extra data needed by pages through ajax
	*/
	class AjaxData extends CI_Controller
	{

		function __construct()
		{
			parent::__construct();
			$this->load->model("modelFormBuilder");
			$this->load->database();
			$this->load->model('webSessionManager');
			// $this->load->model('entities/application_log');
			$this->load->helper('string');
			$this->load->helper('array');
			if (!$this->webSessionManager->isSessionActive()) {
				echo "session expired please re login to continue";
				exit;
			}
			$exclude=array('changePassword','savePermission','approve','disapprove');
			$page = $this->getMethod($segments);
			if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin' && in_array($page, $exclude)) {
				loadClass($this->load,'role');
				$this->role->checkWritePermission();
			}
		}

		private function getMethod(&$allSegment)
		{
			$path = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$base = base_url();
			$left = ltrim($path,$base);
			$result = explode('/', $left);
			$allSegment=$result;
			return $result[0];
		}

		public function lga($state){
			$state = urldecode($state);
			$result = loadLga($state);
			echo $this->returnJSONFromNonAssocArray($result);
		}

		private function returnJSONTransformArray($query,$data=array()){
			$newResult=array();
			$result = $this->db->query($query,$data);
			if($result->num_rows() > 0){
				$result = $result->result_array();
				foreach($result as $value){
					$value['id'] = $value['value'];
					$newResult[] = $value;
				}
				return json_encode($newResult);
			}else{
				return "";
			}
		}

		private function returnJSONFromNonAssocArray($array){
			//process if into id and value then
			$result =array();
			for ($i=0; $i < count($array); $i++) {
				$current =$array[$i];
				$result[]=array('id'=>$current,'value'=>$current);
			}
			return json_encode($result);
		}

		protected function returnJsonFromQueryResult($query,$data=array(),$message=''){
			$result = $this->db->query($query,$data);
			if ($result->num_rows() > 0) {
				$result = $result->result_array();
				return  json_encode($result);
			}
			else{
				if($message != ''){
					$dataParam = array('value' => $message);
					return json_encode(array($dataParam));
				}
				return "";
			}
		}

		public function entryModeIn($entryMode){
			$entryMode  = trim($entryMode);
			$query = "SELECT school_class.id,class_name as value from entry_mode left join school_class on entry_mode.school_class_id = school_class.id where entry_mode.id = ?";
			echo $this->returnJsonFromQueryResult($query,array($entryMode));
		}

		public function studentIn($class,$session,$term='')
		{
			//the escaping is to prevent sql injection attack
			$class = $this->db->conn_id->escape_string($class);
			$session = $this->db->conn_id->escape_string($session);
			$term = $this->db->conn_id->escape_string($term);
			$query="SELECT student.registration_number as id, concat_ws(' ',surname,' ',firstname,' ',middlename,' (',registration_number,')') as value from student_biodata student join student_session_history on student.id=student_session_history.student_biodata_id where student_session_history.academic_session_id='$session' and student_session_history.school_class_id = '$class' order by student.registration_number asc";
			// and exists (select ssr.academic_session_id,session_term_id,student_biodata_id from student_subject_registration ssr join student_biodata on ssr.student_biodata_id = student_biodata.id where ssr.academic_session_id='$session' and ssr.session_term_id='$term' and ssr.school_class_id = '$class')
			echo $this->returnJsonFromQueryResult($query,array($class,$session));

		}
		public function studentAll($class,$session,$sessionTerm='')
		{
			//the escaping is to prevent sql injection attack
			$class = $this->db->conn_id->escape_string($class);
			$session = $this->db->conn_id->escape_string($session);
			$query="SELECT student.registration_number as id, concat_ws(' ',surname,' ',firstname,' ',middlename,' (',registration_number,')') as value from student_biodata student where student.school_class_id = $class order by student.registration_number asc";
			echo $this->returnJsonFromQueryResult($query,array($class,$session));

		}


		//function for changing the password for user.
		function changePassword(){
			// $this->application_log->log('profile module','changing password');
			if (isset($_POST['ajax-sub'])) {
				$old = $_POST['oldpassword'];
				$new = $_POST['newpassword'];
				$confirm = $_POST['confirmPassword'];
				if ($new !==$confirm) {
					// $this->application_log->log('profile module','password does not match');
					echo createJsonMessage('status',false,'message','new password does not match with the confirmaton','flagAction',false);exit;
				}
				//check that this user owns the password
				loadClass($this->load,'user');
				$this->user->user_ID = $this->webSessionManager->getCurrentUserProp('ID');
				$result = $this->user->changePassword($old,$new,$message);
				// $this->application_log->log('profile module',$message);
				echo createJsonMessage('status',$result,'message',$message,'flagAction',true);
			}
		}

		public function level($value='')
		{
			$query="select id,level_name as value from level";
			echo $this->returnJsonFromQueryResult($query);
		}
		public function savePermission()
		{
			
			if (isset($_POST['sub'])) {
				$role = $_POST['role'];
				if (!$role) {
					echo createJsonMessage('status',false,'message','error occured while saving permission','flagAction',false);
				}
				loadClass($this->load,'role');
				try {
					$removeList = json_decode($_POST['remove'],true);
					$updateList = json_decode($_POST['update'],true);
					$this->role->ID=$role;
					$result=$this->role->processPermission($updateList,$removeList);
					echo createJsonMessage('status',$result,'message','permission updated successfully','flagAction',true);
				} catch (Exception $e) {
					echo createJsonMessage('status',false,'message','error occured while saving permission','flagAction',false);
				}
				
			}
		}

	}
 ?>
