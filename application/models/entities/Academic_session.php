<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the academic_session table.
	*/ 

class Academic_session extends Crud {

protected static $tablename = "Academic_session"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('status');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'session_name';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('session_name');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('session_name' => 'varchar','start_date' => 'date','end_date' => 'date','status' => 'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','session_name' => '','start_date' => '','end_date' => '','status' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '0');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('enable'=>'getEnabled','delete'=>'delete/academic_session','edit'=>'edit/academic_session');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getSession_nameFormField($value = ''){
	return "<div class='form-group'>
				<label for='session_name'>Session Name</label>
				<input type='text' name='session_name' id='session_name' value='$value' class='form-control' required />
			</div>";
} 
 function getStart_dateFormField($value = ''){
	return "<div class='form-group'>
				<label for='start_date'>Start Date</label>
				<input type='text' name='start_date' id='start_date' value='$value' class='form-control' required />
			</div>";
} 
 function getEnd_dateFormField($value = ''){
	return "<div class='form-group'>
				<label for='end_date'>End Date</label>
				<input type='text' name='end_date' id='end_date' value='$value' class='form-control' required />
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

public function enable($id=null,&$db=null)
{
	//disable all to enable another one, one session must be active at  a time
	if ($id==NULL && !isset($this->array['ID'])) {
		throw new Exception("object does not have id");
	}
	if ($id ==NULL) {
		$id = $this->array["ID"];
	}
	$db=$this->db;
	$db->trans_begin();
	$query="update academic_session set status=0";
	if (!$db->query($query)) {
		$db->trans_rollback();
		return false;
	}
	return $this->setEnabled($id,1,$db);
}


 
}

?>
