<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the subject_score table.
	*/ 

class Subject_score extends Crud {

protected static $tablename = "Subject_score"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('ca_score1','ca_score2');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'ca_score1';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('ca_score1' => 'double','ca_score2' => 'double','ca_total' => 'int','exam_score' => 'double','score' => 'float','student_subject_registration_id' => 'int');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','ca_score1' => '','ca_score2' => '','ca_total' => '','exam_score' => '','score' => '','student_subject_registration_id' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('student_subject_registration' => array('student_subject_registration_id','id')
);
static $tableAction = array('delete' => 'delete/subject_score', 'edit' => 'edit/subject_score');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getCa_score1FormField($value = ''){
	return "<div class='form-group'>
				<label for='ca_score1'>Ca Score1</label>
				<input type='text' name='ca_score1' id='ca_score1' value='$value' class='form-control' required />
			</div>";
} 
 function getCa_score2FormField($value = ''){
	return "<div class='form-group'>
				<label for='ca_score2'>Ca Score2</label>
				<input type='text' name='ca_score2' id='ca_score2' value='$value' class='form-control' required />
			</div>";
} 
 function getCa_totalFormField($value = ''){
	return "<div class='form-group'>
				<label for='ca_total'>Ca Total</label>
				<input type='text' name='ca_total' id='ca_total' value='$value' class='form-control' required />
			</div>";
} 
 function getExam_scoreFormField($value = ''){
	return "<div class='form-group'>
				<label for='exam_score'>Exam Score</label>
				<input type='text' name='exam_score' id='exam_score' value='$value' class='form-control' required />
			</div>";
} 
 function getScoreFormField($value = ''){
	return "<div class='form-group'>
				<label for='score'>Score</label>
				<input type='text' name='score' id='score' value='$value' class='form-control' required />
			</div>";
} 
 function getStudent_subject_registration_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'student_subject_registration','display'=>'student_subject_registration_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'student_subject_registration_name' as value from 'student_subject_registration' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('student_subject_registration', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='student_subject_registration_id' id='student_subject_registration_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='student_subject_registration_id'>Student Subject Registration Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='student_subject_registration_id' id='student_subject_registration_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}

protected function getStudent_subject_registration(){
	$query ='SELECT * FROM student_subject_registration WHERE id=?';
	if (!isset($this->array['ID'])) {
		return null;
	}
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Student_subject_registration.php');
	$resultObject = new Student_subject_registration($result[0]);
	return $resultObject;
}

 
}

?>
