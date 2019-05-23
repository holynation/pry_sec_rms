<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the upload_history table.
	*/ 

class Upload_history extends Crud {

protected static $tablename = "Upload_history"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('user_id','document_path');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'user_id';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('user_id' => 'int','academic_session_id' => 'int','session_term_id'=> 'int','school_class_id'=>'int','subject_id' => 'int','document_path' => 'varchar','user_type' => 'varchar','date' => 'timestamp');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','user_id' => '','academic_session_id' => '','session_term_id'=>'','school_class_id'=>'','subject_id' => '','document_path' => '','user_type' => '','date' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('date' => 'current_timestamp()');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('user' => array('user_id','id')
,'academic_session' => array('academic_session_id','id')
,'session_term' => array('subject_id','id')
);
static $tableAction = array('delete' => 'delete/upload_history', 'edit' => 'edit/upload_history');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getUser_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'user','display'=>'user_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'user_name' as value from 'user' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('user', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='user_id' id='user_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='user_id'>User Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='user_id' id='user_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
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
 function getSession_term_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'academic_session','display'=>'academic_session_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'academic_session_name' as value from 'academic_session' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('academic_session', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='session_term_id' id='session_term_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='session_term_id'>Session Term</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='session_term_id' id='session_term_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getSchool_class_idFormField($value = ''){
	$fk = null; 
 	//change the value of this variable to array('table'=>'session_term','display'=>'session_term_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'session_term_name' as value from 'session_term' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('session_term', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

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
	$fk = null; 
 	//change the value of this variable to array('table'=>'session_term','display'=>'session_term_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'session_term_name' as value from 'session_term' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('session_term', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='subject_id' id='subject_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='subject_id'>Session Term Id</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='subject_id' id='subject_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}
 function getDocument_pathFormField($value = ''){
	return "<div class='form-group'>
				<label for='document_path'>Document Path</label>
				<input type='text' name='document_path' id='document_path' value='$value' class='form-control' required />
			</div>";
} 
 function getUser_typeFormField($value = ''){
	return "<div class='form-group'>
				<label for='user_type'>User Type</label>
				<input type='text' name='user_type' id='user_type' value='$value' class='form-control' required />
			</div>";
} 
 function getDateFormField($value = ''){
	return "<div class='form-group'>
				<label for='date'>Date</label>
				<input type='text' name='date' id='date' value='$value' class='form-control' required />
			</div>";
} 

protected function getUser(){
	$query ='SELECT * FROM user WHERE id=?';
	if (!isset($this->array['user_id'])) {
		return null;
	}
	$id = $this->array['user_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('User.php');
	$resultObject = new User($result[0]);
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

public function getDisplayHistory($ssc,$session,$class)
{	
	$query = "select upload_history.ID,username as uploader,date as date_uploaded,subject_title as upload_subject,document_path from upload_history join subject on subject.id=upload_history.subject_id join user on user.user_type=upload_history.user_type and upload_history.user_id=user.id where subject.id=? and upload_history.academic_session_id=? and school_class_id = ?";
	return $this->query($query,array($ssc,$session,$class));
}

 
}

?>
