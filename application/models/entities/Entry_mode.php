<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the entry_mode table.
	*/ 

class Entry_mode extends Crud {

protected static $tablename = "Entry_mode"; 
/* this array contains the field that can be null*/ 
static $nullArray = array();
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'mode_of_entry';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('mode_of_entry');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('mode_of_entry' => 'varchar','school_class_id' => 'int','description' => 'text');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','mode_of_entry' => '','school_class_id' => '','description' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('school_class' => array('school_class_id','id')
);
static $tableAction = array('delete' => 'delete/entry_mode', 'edit' => 'edit/entry_mode');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getMode_of_entryFormField($value = ''){
	return "<div class='form-group'>
				<label for='mode_of_entry'>Mode Of Entry</label>
				<input type='text' name='mode_of_entry' id='mode_of_entry' value='$value' class='form-control' required />
			</div>";
} 
 function getDescriptionFormField($value = ''){
	return "<div class='form-group'>
				<label for='description'>Description</label>
				<input type='text' name='description' id='description' value='$value' class='form-control' required />
			</div>";
} 
 function getSchool_class_idFormField($value = ''){
	$fk=array('table'=>'school_class','display'=>'class_name');
 	//change the value of this variable to array('table'=>'school_class','display'=>'school_class_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'school_class_name' as value from 'school_class' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('school_class', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='school_class_id' id='school_class_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='school_class_id'>Start School Class</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='school_class_id' id='school_class_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
}

protected function getStudent_biodata(){
	$query ='SELECT * FROM student_biodata WHERE entry_mode_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Student_biodata.php');
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new Student_biodata($value);
	}

	return $resultObjects;
}
 
}

?>
