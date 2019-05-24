<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the term table.
	*/ 

class Term extends Crud {

protected static $tablename = "Term"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('is_last');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'term_name';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('term_name');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('term_name' => 'varchar','is_last' => 'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','term_name' => '','is_last' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('is_last' => '0');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => 'delete/term', 'edit' => 'edit/term');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getTerm_nameFormField($value = ''){
	return "<div class='form-group'>
				<label for='term_name'>Term Name</label>
				<input type='text' name='term_name' id='term_name' value='$value' class='form-control' required />
			</div>";
} 
function getIs_lastFormField($value=''){
	$arr = array(array('id'=>1,'value'=>'Yes'),array("id"=>0,'value'=>'No'));
	$option = buildOption($arr,$value);
	return "<div class='form-group'>
	<label for='is_last' >Is Last(in Session)</label>
	<select name='is_last' id='is_last' value='$value' class='form-control' required>
	<option>..choose..</option>
	$option
</select>
</div> ";

}

 protected function getSession_term(){
	$query ='SELECT * FROM session_term WHERE term_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Session_term.php');
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObject[] = new Session_term($value);
	}
	return $resultObject;
}


 
}

?>
