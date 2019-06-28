<?php 
/**
* This is the class that manages all information and data retrieval needed by the guardian section of this application.
*/
class GuardianData extends CI_Model
{
	
	private $guardian;
	function __construct()
	{
		parent::__construct();
	}

	public function setGuardian($guardian)
	{
		$this->guardian=$guardian;
	}

	public function loadDashboardInfo()
	{
		loadClass($this->load,'student_biodata');
		loadClass($this->load,'school_class');
		loadClass($this->load,'subject');
		loadClass($this->load,'term');
		$session = $this->webSessionManager->getCurrentSession();
		$result['countData']=array('student'=>$this->student_biodata->totalCount(),'subject'=>$this->subject->totalCount(),'term'=>$this->term->totalCount());
		// //load the data needed to display graphical information
		$result['classDistribution']=$this->student_biodata->getStudentDistributionByClass();
		$result['genderDistribution']=$this->student_biodata->getStudentDistributionByGender();

		//get the level of courses registered by session spent by the student
		$studentID = $this->guardian->student_biodata_id;
		$tempLevel = $this->student_biodata->getClassAt($session,$studentID);
		$class = new School_class(array('ID'=>$tempLevel));$class->load();
		$result['currentClass']=$class->class_name;
        
		return $result;
	}

}

 ?>