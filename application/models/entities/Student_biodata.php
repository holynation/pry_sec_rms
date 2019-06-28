<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the student_biodata table.
	*/ 

class Student_biodata extends Crud {

protected static $tablename = "Student_biodata"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('middlename','dob','email','phone_number','gender','address','state_of_origin','lga_of_origin','registration_number','img_path','nationality','religion','status');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'registration_number';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('registration_number');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('surname' => 'varchar','firstname' => 'varchar','middlename' => 'varchar','dob' => 'date','email' => 'text','phone_number' => 'text','gender' => 'varchar','address' => 'text','state_of_origin' => 'varchar','lga_of_origin' => 'varchar','registration_number' => 'varchar','school_class_id' => 'int','entry_mode_id'=>'int','academic_session_id' => 'int','img_path' => 'varchar','nationality' => 'varchar','status' => 'tinyint','religion' => 'enum');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','surname' => '','firstname' => '','middlename' => '','dob' => '','email' => '','phone_number' => '','gender' => '','address' => '','state_of_origin' => '','lga_of_origin' => '','registration_number' => '','school_class_id' => '','entry_mode_id'=>'','academic_session_id' => '','img_path' => '','nationality' => '','status' => '','religion' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array('img_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'student/','preserve'=>false,'max_width'=>'500','max_height'=>'450')); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('school_class' => array('school_class_id','id')
,'academic_session' => array('academic_session_id','id')
);
static $tableAction=array('delete'=>'delete/student_biodata','edit'=>'edit/student_biodata','profile'=>'vc/student/profile');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getSurnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='surname'>Surname</label>
				<input type='text' name='surname' id='surname' value='$value' class='form-control' required />
			</div>";
} 
 function getFirstnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='firstname'>Firstname</label>
				<input type='text' name='firstname' id='firstname' value='$value' class='form-control' required />
			</div>";
} 
 function getMiddlenameFormField($value = ''){
	return "<div class='form-group'>
				<label for='middlename'>Middlename</label>
				<input type='text' name='middlename' id='middlename' value='$value' class='form-control' />
			</div>";
} 
 function getDobFormField($value = ''){
	return "<div class='form-group'>
				<label for='dob'>Dob</label>
				<input type='text' name='dob' id='dob' value='$value' class='form-control' required />
			</div>";
} 
 function getEmailFormField($value = ''){
	return "<div class='form-group'>
				<label for='email'>Email</label>
				<input type='text' name='email' id='email' value='$value' class='form-control' required />
			</div>";
} 
 function getPhone_numberFormField($value = ''){
	return "<div class='form-group'>
				<label for='phone_number'>Phone Number</label>
				<input type='text' name='phone_number' id='phone_number' value='$value' class='form-control' required />
			</div>";
} 
function getGenderFormField($value=''){
	$arr =array('Male','Female');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='gender' >Gender</label>
		<select  name='gender' id='gender'  class='form-control'  >
		$option
		</select>
</div> ";

} 
 function getAddressFormField($value = ''){
	return "<div class='form-group'>
				<label for='address'>Address</label>
				<input type='text' name='address' id='address' value='$value' class='form-control' required />
			</div>";
} 
function getState_of_originFormField($value=''){
	$states = loadStates();
	$option = buildOptionUnassoc($states,$value);
	return "<div class='form-group'>
	<label for='state_of_origin' >State Of Origin</label>
		<select  name='state_of_origin' id='state_of_origin' value='$value' class='form-control autoload' data-child='lga_of_origin' data-load='lga'> 
		<option value=''>..select state..</option>
		$option
		</select>
</div> ";

}
function getLga_of_originFormField($value=''){
	$option='';
	if ($value) {
		$arr=array($value);
		$option = buildOptionUnassoc($arr,$value);
	}
	return "<div class='form-group'>
	<label for='lga_of_origin' >Lga Of Origin</label>
		<select type='text' name='lga_of_origin' id='lga_of_origin' value='$value' class='form-control'  >
		<option value=''></option>
		$option
		</select>
</div> ";

} 
 function getRegistration_numberFormField($value = ''){
	return "<div class='form-group'>
				<label for='registration_number'>Registration Number</label>
				<input type='text' name='registration_number' id='registration_number' value='$value' class='form-control' required />
			</div>";
} 
 function getSchool_class_idFormField($value = ''){
	$fk= array('table'=>'school_class','display'=>'class_name');  
 	//change the value of this variable to array('table'=>'school_class','display'=>'school_class_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'school_class_name' as value from 'school_class' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('school_class', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='school_class_id' id='school_class_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='school_class_id'>First Entry School Class</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='school_class_id' id='school_class_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
function getEntry_mode_idFormField($value=''){
	$fk= array('table'=>'entry_mode','display'=>'mode_of_entry'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='entry_mode_id' id='entry_mode_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='entry_mode_id'>Entry Mode</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='entry_mode_id' id='entry_mode_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

}
 function getAcademic_session_idFormField($value = ''){
	$fk=array('table'=>'academic_session','display'=>'session_name');

		if(is_null($fk)){
			return $result = "<input type='hidden' name='academic_session_id' id='academic_session_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='academic_session_id'>Academic Session</label>";
			$option = $this->loadOption($fk,$value,'','order by id desc');
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='academic_session_id' id='academic_session_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
function getImg_pathFormField($value=''){
	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
	<img src='$path' alt='student pic' width='200px'/>
	<label for='img_path' >Student Profile</label>
		<input type='file' name='img_path' id='img_path' value='$value' class='form-control'  />
</div> ";

} 
 function getNationalityFormField($value = ''){
	return "<div class='form-group'>
				<label for='nationality'>Nationality</label>
				<input type='text' name='nationality' id='nationality' value='$value' class='form-control' required />
			</div>";
} 
function getStatusFormField($value=''){
	return "<div class='form-group'>
	<label class='form-checkbox'>Status</label>
	<select class='form-control' id='status' name='status' >
		<option value='1'>Yes</option>
		<option value='0' selected='selected'>No</option>
	</select>
	</div> ";

}
function getReligionFormField($value=''){
	$arr =array('Christianity','Islam','Other');
	$option = buildOptionUnassoc($arr,$value);
	return "<div class='form-group'>
	<label for='religion' >Religion</label>
		<select  name='religion' id='religion'  class='form-control'  >
		$option
		</select>
</div> ";

}

protected function getSchool_class(){
	$query ='SELECT * FROM school_class WHERE id=?';
	if (!isset($this->array['school_class_id'])) {
		return null;
	}
	$id = $this->array['school_class_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('School_class.php');
	$resultObject = new School_class($result[0]);
	return $resultObject;
}
protected function getEntry_mode(){
	$query ='SELECT * FROM entry_mode WHERE id=?';
	if (!isset($this->array['entry_mode_id'])) {
		$this->load();
	}
	$id = $this->array['entry_mode_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Entry_mode.php');
	$resultObject = new Entry_mode($result[0]);
	return $resultObject;
}
protected function getAcademic_session(){
	$query ='SELECT * FROM academic_session WHERE id=?';
	$id = $this->array['academic_session_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Academic_session.php');
	$resultObjects = new Academic_session($result[0]);
	return $resultObjects;
}
public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='student_biodata'";
		if($this->query($query,array($id))){
			$db->trans_commit();
			return true;
		}
		else{
			$db->trans_rollback();
			return false;
		}
	}
	else{
		$db->trans_rollback();
		return false;
	}
}
function getFullname($capitalise=false)
{
	$surname = $capitalise?strtoupper($this->surname):$this->surname;
	$result = $surname.' '.$this->firstname.' '.$this->middlename;
	return $result;
}

function getShortname($capitalise=false)
{
	$surname = $capitalise?strtoupper($this->surname):$this->surname;
	$result = @$surname.'  '.ucfirst($this->firstname[0]).'. '.ucfirst($this->middlename[0]);
	return $result;
}

//intelligently select registering level without the need to keep increasing student level
public function getStudentRegisteringLevel($session)
{

	if (!@$this->surname) {
		$this->load();
	}
	if (!@$this->academic_session_id) {
		exit("student entry session must be set");
	}
	//get the new level based on entry session
	//no class found, student has not registered before, trying to register for the very first time
	$entryMode = @$this->entry_mode;
	$entryLevel= @$entryMode->school_class_id;

	if (!$entryLevel) {
		exit("entry mode not correctly set for student");
	}
	if ($session==$this->academic_session_id) {
		return $entryLevel;
	}

	$query="select count(*) as num from academic_session session where start_date between (select start_date from academic_session where id={$this->academic_session_id}) and (select start_date from academic_session where id =$session)";
	$res = $this->query($query);
	$count = $res[0]['num']-1;
	$query="select school_class.id from school_class where class_order <=((select class_order from school_class where id=$entryLevel)+$count) order by class_order desc limit 1";
	$result = $this->query($query);
	$id = $result[0]['id'];
	return ($id)?$id:1;
}

public function getClassAt($session,$id=null)
{
	$id = ($id) ? $id : $this->ID;
	$query="select distinct school_class_id from student_session_history where student_biodata_id=? and academic_session_id=?";
	$result = $this->query($query,array($id,$session));
	$currentLevel = @$result[0]['school_class_id'];
	return $currentLevel?$currentLevel:$this->getStudentRegisteringLevel($session);
}

//return the student result for a particular session
public function getStudentResult($session,$term)
{
	$session = $this->db->conn_id->escape_string($session);
	$term = $this->db->conn_id->escape_string($term);
	$query ="SELECT DISTINCT subject_score.ID, subject_title,ca_score1,ca_score2,exam_score,score,grade,point from student_subject_registration join subject sub on sub.id= student_subject_registration.subject_id join upload_history on upload_history.subject_id=sub.id and upload_history.academic_session_id=$session join subject_score on student_subject_registration.id = subject_score.student_subject_registration_id  left join grade_scale on score between min_score and max_score where student_subject_registration.academic_session_id=? and student_biodata_id=? and student_subject_registration.term_id = ? order by subject_title asc";
	$result = $this->query($query,array($session,$this->ID,$term));
	return $result;
}

public function getRegistration($session,$term)
{
	$query="select student_subject_registration.ID,subject_title from student_subject_registration join subject on subject.id=student_subject_registration.subject_id where student_biodata_id=? and student_subject_registration.academic_session_id=? and student_subject_registration.term_id = ? order by subject_title asc";
	$result = $this->query($query,array($this->ID,$session,$term));
	return $result;
}

public function getStudentIn($level,$session)
{
// http://206.189.22.83:3838/
	$query="select student_biodata.* from student_biodata join student_session_history on student_biodata.id=student_session_history.student_biodata_id where student_session_history.school_class_id=? and student_session_history.academic_session_id=? order by student_biodata.registration_number asc";
	$result = $this->query($query,array($level,$session));
	if (!$result) {
		return false;
	}
	$return = array();
	foreach ($result as $res) {
		$return[]= new Student_biodata($res);
	}
	return $return;
}

public function countGetStudentIn($level,$session)
{
	$query="SELECT count(*) as num from student_biodata join student_session_history on student_biodata.id=student_session_history.student_biodata_id where student_session_history.school_class_id=? and student_session_history.academic_session_id=?";
	$result = $this->query($query,array($level,$session));
	return ($result[0]['num']) ? $result[0]['num'] : 0;
}

public function getSpentSessionTill($session)
{
	$query = "select distinct academic_session.* from student_session_history join academic_session on academic_session.ID=student_session_history.academic_session_id join student_subject_registration scr on academic_session.ID=scr.academic_session_id  where exists (select * from subject_score where student_subject_registration_id =scr.ID) AND academic_session.start_date =(select start_date from academic_session where ID=?) and student_session_history.student_biodata_id=? order by start_date";
	return $this->query($query,array($session,$this->ID));
}

public function getStudentResultPerTerm($session,$sessionTerm,&$resultCount=0)
{
	$session = $this->db->conn_id->escape_string($session);
	$sessionTerm = $this->db->conn_id->escape_string($sessionTerm);
	$query ="SELECT DISTINCT subject_score.ID,subject_title,ca_score1,ca_score2,exam_score,score,grade,point from student_subject_registration join subject sub on sub.id= student_subject_registration.subject_id join upload_history on upload_history.subject_id=sub.id and upload_history.academic_session_id=$session join subject_score on student_subject_registration.id = subject_score.student_subject_registration_id  left join grade_scale on score between min_score and max_score where student_subject_registration.academic_session_id=? and student_subject_registration.term_id = ? and student_biodata_id=? order by subject_title asc";
	$result = $this->query($query,array($session,$sessionTerm,$this->ID));
	$resultCount = ($result) ? count($result) : 0;
	return $result;
}

public function getTotalPercentageScore($session,$sessionTerm,$resultCount)
{
	$totalScore = 0;
	$resultScore = $this->getStudentResultPerTerm($session,$sessionTerm,$resultCount);
	foreach($resultScore as $score){
		$totalScore +=$score['score'];
	}
	$generalScore = floatval(100 * @$resultCount);
	$result= number_format(($totalScore/$generalScore) * 100);
	return $result;
}

public function getResultData($session,$sessionTerm,&$resultCount=0,&$totalPercentage)
{
	$result=array();
	$result['result']=$this->getStudentResultPerTerm($session,$sessionTerm,$resultCount);
	$totalPercentage = $this->getTotalPercentageScore($session,$sessionTerm,$resultCount);
	return $result;
}

public function getStudentDistributionByGender()
{
	$query="select gender as label ,count(*) as value from student_biodata group by gender having gender is not null";
	$result = $this->query($query);
	return $result;
}
public function getStudentDistributionByClass()
{
	$query ="select class_name, count(student_biodata.id) as total from student_biodata join school_class on school_class.id = student_biodata.school_class_id group by class_name";
	$result = $this->query($query);
	return $result;
}
public function loadReport($session,$class,$term)
{
	loadClass($this->load,'configure_report');
	$reportList = $this->configure_report->getConfig($session,$class,$term,$this->ID);
	if (!@$reportList) {
		return "";
	}
	return $reportList;
}


 
}

?>
