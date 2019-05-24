<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the configure_report table.
	*/ 

class Configure_report extends Crud {

protected static $tablename = "Configure_report"; 
/* this array contains the field that can be null*/ 
static $nullArray = array();
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = ''; // this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('student_biodata_id'=>'int','academic_session_id' => 'int','term_id' => 'int','school_class_id' => 'int','times_school_open' => 'int','time_present' => 'int','teacher_comment' => 'text','head_teacher_comment' => 'text','next_term_begins' => 'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','student_biodata_id'=>'','academic_session_id' => '','term_id' => '','school_class_id' => '','times_school_open' => '','time_present' => '','teacher_comment' => '','head_teacher_comment' => '','next_term_begins' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('academic_session' => array('academic_session_id','id')
,'term' => array('term_id','id')
,'school_class' => array('school_class_id','id')
);
static $tableAction = array('delete' => 'delete/configure_report', 'edit' => 'edit/configure_report');
function __construct($array = array())
{
	parent::__construct($array);
}
function getStudent_biodata_idFormField($value = ''){
	$query = "select id,concat_ws(' ',surname,' ',firstname,' ',middlename,' (',registration_number,')') as value from student_biodata";
	$result ="<div class='form-group'>
		<label for='student_biodata_id'>Student</label>";
		$option = buildOptionFromQuery($this->db,$query,null,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='student_biodata_id' id='student_biodata_id' class='form-control' required>
		<option value=''>..choose....</option>
					$option
				</select>";
	$result.="</div>";
	return $result;
}
function getAcademic_session_idFormField($value = ''){
	$fk = array('table'=>'academic_session','display'=>'session_name');
 	//change the value of this variable to array('table'=>'academic_session','display'=>'academic_session_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'academic_session_name' as value from 'academic_session' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('academic_session', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

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
 function getTerm_idFormField($value = ''){
	$fk = array('table'=>'term','display'=>'term_name');
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
 function getSchool_class_idFormField($value = ''){
	$fk = array('table'=>'school_class','display'=>'class_name');
 	//change the value of this variable to array('table'=>'school_class','display'=>'school_class_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'school_class_name' as value from 'school_class' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('school_class', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

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
 function getTimes_school_openFormField($value = ''){
	return "<div class='form-group'>
				<label for='times_school_open'>Number of Times School Open</label>
				<input type='text' name='times_school_open' id='times_school_open' value='$value' class='form-control' required />
			</div>";
} 
 function getTime_presentFormField($value = ''){
	return "<div class='form-group'>
				<label for='time_present'>Number of Time Present</label>
				<input type='text' name='time_present' id='time_present' value='$value' class='form-control' required />
			</div>";
} 
 function getTeacher_commentFormField($value = ''){
	return "<div class='form-group'>
				<label for='teacher_comment'>Class Teacher's Comment</label>
				<textarea name='teacher_comment' id='teacher_comment' class='form-control' required>$value</textarea>
			</div>";
} 
 function getHead_teacher_commentFormField($value = ''){
	return "<div class='form-group'>
				<label for='head_teacher_comment'>Head Teacher's Comment</label>
				<textarea name='head_teacher_comment' id='head_teacher_comment' class='form-control' required>$value</textarea>
			</div>";
} 
 function getNext_term_beginsFormField($value = ''){
	return "<div class='form-group'>
				<label for='next_term_begins'>Next Term Begins</label>
				<input type='text' name='next_term_begins' id='next_term_begins' value='$value' class='form-control' required />
			</div>";
} 

protected function getAcademic_session(){
	$query ='SELECT * FROM academic_session WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
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
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Term.php');
	$resultObject = new Term($result[0]);
	return $resultObject;
}
 protected function getSchool_class(){
	$query ='SELECT * FROM school_class WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('School_class.php');
	$resultObject = new School_class($result[0]);
	return $resultObject;
}

public function getConfig($session,$class,$term,$studentID)
{
	$query="select * from configure_report where academic_session_id=? and school_class_id=? and term_id=? and student_biodata_id = ?";
	$result = $this->db->query($query,array($session,$class,$term,$studentID));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	$report = $result[0];
	return $report;
}

 
}

?>
