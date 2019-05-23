<?php 

/**
* The controller that validate forms that should be inserted into a table based on the request url.
each method wil have the structure validate[modelname]Data
*/
class ModelControllerDataValidator extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('webSessionManager');
	}

	public function validateSubject_scoreData(&$data,$type,&$message)
	{
		if (!@$data['ca_total'] && !@$data['exam_score']) {
			$message='empty value not allowed';
			return false;
		}
		loadClass($this->load,'subject_score');
		if ($type=='update') {
			$temp = $this->subject_score->getWhere(array('student_subject_registration_id'=>$data['student_subject_registration_id']),$c,0,null,false);
			$temp = @$temp[0];
			if ($temp->ca_total==$data['ca_total'] && $temp->exam_score==$data['exam_score']) {
				$message='no changes made...';
				return false;
			}
		}
		$ca1 = $data['ca_score1'];
		$ca2 = $data['ca_score2'];
		$exam = $data['exam_score'];
		$caTotal = $ca1 + $ca2;
		$total=$caTotal+$exam;
		if ($total > 100) {
			$message="Invalid result score, score must not be more than 100";
			return false;
		}
		$data['score']=$total;
		$data['ca_total'] = $caTotal;
		return true;
	}

	public function validateStudent_subject_registrationData(&$data,$type,&$message='')
	{
		# check 
		loadClass($this->load,'session_term');
		$student = $data['student_biodata_id'];
		$sessionTerm = @$data['session_term_id'];
		$session= $data['academic_session_id'];
		if (!$session || !$sessionTerm || !$student) {
			$message='error occured some data appeared not to be available, kindly refresh the page and try again';
			return false;
		}
		$this->session_term->ID=$sessionTerm;
		$data['term_id']=$this->session_term->term->ID;
		return true;
	}
}
 ?>