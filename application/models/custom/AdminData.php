<?php 
/**
* This is the class that manages all information and data retrieval needed by the admin section of this application.
*/
class AdminData extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function loadDashboardData()
	{
		//check the permmission first
		loadClass($this->load,'student_biodata');
		loadClass($this->load,'school_class');
		loadClass($this->load,'subject');
		loadClass($this->load,'term');
		$result['countData']=array('student'=>$this->student_biodata->totalCount(),'class'=>$this->school_class->totalCount(),'subject'=>$this->subject->totalCount(),'term'=>$this->term->totalCount());
		// //load the data needed to display graphical information
		$result['classDistribution']=$this->student_biodata->getStudentDistributionByClass();
		$result['genderDistribution']=$this->student_biodata->getStudentDistributionByGender();
		return $result;
	}

	public function getStudentResultData($student,$endSession,$sessionTerm,$class,&$extraReport='',&$resultCount=0,&$totalPercentage='')
	{
		$result = array();
		loadClass($this->load,'student_session_history');
		$allstudentSession = $student->getSpentSessionTill($endSession);
		$extraReport = $student->loadReport($endSession,$class,$sessionTerm,$student);
		foreach ($allstudentSession as $session){
			$result[$session['session_name']]=$student->getResultData($session['ID'],$sessionTerm,$resultCount,$totalPercentage,$class);
		}

		return $result;
	}

	public function getStudentTestData($student,$endSession,$sessionTerm,$class,$type='')
	{
		loadClass($this->load,'student_session_history');
		$allstudentSession = $student->getSpentSessionTill($endSession);
		$result = array();
		foreach ($allstudentSession as $session){
			$result[$session['session_name']]=$student->getTestData($session['ID'],$sessionTerm,$class,$type);
		}
		return $result;
	}

	public function getScoreFormatData($session,$sessionTerm,$level)
	{
		$result = array();
		loadClass($this->load,'academic_session');
		loadClass($this->load,'school_class');
		loadClass($this->load,'subject');
		if ($sessionTerm) {
			loadClass($this->load,'term');
			$term = new Term(array('ID'=>$sessionTerm));
			$term->load();
			$result['term']=strtoupper($term->term_name).' TERM ';
		}

		$subjectOffered = $this->subject->getSubjectOffered($session,$level,$sessionTerm);
		loadClass($this->load,'student_biodata');

		$students = $this->student_biodata->getStudentIn($level,$session);
		$result['students']=$students;
		$result['subjects']=$subjectOffered;
		$result['session']=$this->academic_session->getWhere(array('ID'=>$session));
		$result['level']=$this->school_class->getWhere(array('ID'=>$level));
		$result['sessionTerm'] = $sessionTerm;

		return $result;
	}

	public function getAdminSidebar()
	{
		loadClass($this->load,'role');
		$role = new Role();
		return $role->getModules();
	}
	public function getCanViewPages($role)
	{
		$result =array();
		$allPages =$this->getAdminSidebar();
		$permissions = $role->getPermissionArray();
		foreach ($allPages as $module => $pages) {
			$has = $this->hasModule($permissions,$pages,$inter);
			$allowedModule =$this->getAllowedModules($inter,$pages['children']);
			$allPages[$module]['children']=$allowedModule;
			$allPages[$module]['state']=$has;
		}
		return $allPages;
	}

	private function getAllowedModules($includesPermission,$children)
	{
		$result = $children;
		$result=array();
		foreach ($children as $key=>$child) {
			if (in_array($child, $includesPermission)) {
				$result[$key]=$child;
			}
		}
		return $result;
	}

	private function hasModule($permission,$module,&$res)
	{
		$res =array_intersect(array_keys($permission), array_values($module['children']));
		if (count($res)==count($module['children'])) {
			return 2;
		}
		if (count($res)==0) {
			return 0;
		}
		else{
			return 1;
		}

	}

}

 ?>