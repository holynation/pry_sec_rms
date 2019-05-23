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

	public function loadReport($session,$class,$term)
	{
		loadClass($this->load,'configure_report');
		$reportList = $this->configure_report->getConfig($session,$class,$term);
		if (!@$reportList) {
			return "";
		}
		return $reportList;
	}

	public function getStudentResultData($student,$endSession,$sessionTerm,$class,&$extraReport)
	{
		loadClass($this->load,'student_session_history');
		$allstudentSession = $student->getSpentSessionTill($endSession);
		$result = array();
		$extraReport = $this->loadReport($endSession,$class,$sessionTerm);
		foreach ($allstudentSession as $session){
			$result[$session['session_name']]=$student->getResultData($session['ID'],$sessionTerm);
		}
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