<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the student_subject_registration table.
	*/ 

class Student_subject_registration extends Crud {

protected static $tablename = "Student_subject_registration"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('date_registered');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = ''; // this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('student_biodata_id' => 'int','school_class_id'=> 'int','subject_id' => 'int','session_term_id' => 'int','date_registered' => 'timestamp','academic_session_id' => 'int','term_id' => 'int');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','student_biodata_id' => '','school_class_id'=> '','subject_id' => '','session_term_id' => '','date_registered' => '','academic_session_id' => '','term_id' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('date_registered' => 'current_timestamp()','term_id' => '0');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('student_biodata' => array('student_biodata_id','id')
,'subject' => array('subject_id','id')
,'session_term' => array('session_term_id','id')
,'academic_session' => array('academic_session_id','id')
,'term' => array('term_id','id')
);
static $tableAction = array('delete' => 'delete/student_subject_registration', 'edit' => 'edit/student_subject_registration');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getStudent_biodata_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'student_biodata','display'=>'student_biodata_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'student_biodata_name' as value from 'student_biodata' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('student_biodata', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='student_biodata_id' id='student_biodata_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='student_biodata_id'>Student Biodata Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='student_biodata_id' id='student_biodata_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
function getSchool_class_idFormField($value = ''){
	$fk = array('table'=>'school_class','display'=>'class_name'); 
 	//change the value of this variable to array('table'=>'student_biodata','display'=>'student_biodata_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'student_biodata_name' as value from 'student_biodata' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('student_biodata', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='school_class_id' id='school_class_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='school_class_id'>School Class</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='school_class_id' id='school_class_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getSubject_idFormField($value = ''){
	$fk = array('table'=>'subject','display'=>'subject_title'); 
 	//change the value of this variable to array('table'=>'subject','display'=>'subject_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'subject_name' as value from 'subject' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('subject', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='subject_id' id='subject_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='subject_id'>Subject</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='subject_id' id='subject_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getSession_term_idFormField($value = ''){
	$result ="<div class='form-group'>
		<label for='session_term_id'>Session Term</label>";
		$option = buildOptionFromQuery($this->db,"select session_term.id,concat(session_name,'(',term_name,')') as value from session_term join academic_session on academic_session.ID=session_term.academic_session_id join term on term.ID=session_term.term_id order by session_term.id desc");
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='session_term_id' id='session_term_id' class='form-control'>
			$option
		</select>";
	$result.="</div>";
	return  $result;
}
 function getDate_registeredFormField($value = ''){
	return "";
} 
 function getAcademic_session_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'academic_session','display'=>'academic_session_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'academic_session_name' as value from 'academic_session' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('academic_session', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='academic_session_id' id='academic_session_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='academic_session_id'>Academic Session Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='academic_session_id' id='academic_session_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getTerm_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'term','display'=>'term_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'term_name' as value from 'term' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('term', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='term_id' id='term_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='term_id'>Term</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='term_id' id='term_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}

protected function getStudent_biodata(){
	$query ='SELECT * FROM student_biodata WHERE id=?';
	if (!isset($this->array['student_biodata_id'])) {
		return null;
	}
	$id = $this->array['student_biodata_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Student_biodata.php');
	$resultObject = new Student_biodata($result[0]);
	return $resultObject;
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
 protected function getSubject(){
	$query ='SELECT * FROM subject WHERE id=?';
	if (!isset($this->array['subject_id'])) {
		return null;
	}
	$id = $this->array['subject_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Subject.php');
	$resultObject = new Subject($result[0]);
	return $resultObject;
}
 protected function getSession_term(){
	$query ='SELECT * FROM session_term WHERE id=?';
	if (!isset($this->array['session_term_id'])) {
		return null;
	}
	$id = $this->array['session_term_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Session_term.php');
	$resultObject = new Session_term($result[0]);
	return $resultObject;
}
 protected function getAcademic_session(){
	$query ='SELECT * FROM academic_session WHERE id=?';
	if (!isset($this->array['academic_session_id'])) {
		return null;
	}
	$id = $this->array['academic_session_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Academic_session.php');
	$resultObject = new Academic_session($result[0]);
	return $resultObject;
}
 protected function getTerm(){
	$query ='SELECT * FROM term WHERE id=?';
	if (!isset($this->array['term_id'])) {
		return null;
	}
	$id = $this->array['term_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Term.php');
	$resultObject = new Term($result[0]);
	return $resultObject;
}

//delete the course alongside with the registration;
public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from subject_score where student_subject_registration_id =?";
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

 
}

?>
