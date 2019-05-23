<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the school table.
	*/ 

class School extends Crud {

protected static $tablename = "School"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('school_name','school_logo','slogan','location','description','school_website','school_mail');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'school_name';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('school_name' => 'varchar','school_logo' => 'varchar','slogan' => 'text','location' => 'text','description' => 'text','school_website' => 'varchar','school_mail' => 'varchar','telephone1' => 'varchar','telephone2' => 'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','school_name' => '','school_logo' => '','slogan' => '','location' => '','description' => '','school_website' => '','school_mail' => '','telephone1' => '','telephone2' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array('school_logo'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'school/','preserve'=>false)); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => 'delete/school', 'edit' => 'edit/school');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getSchool_nameFormField($value = ''){
	return "<div class='form-group'>
				<label for='school_name'>School Name</label>
				<input type='text' name='school_name' id='school_name' value='$value' class='form-control' required />
			</div>";
} 
 function getSchool_logoFormField($value = ''){
	$logo= base_url($value);
	return "<div class='form-group'>
	<img src='$logo' alt='school logo comes here' class='img-responsive' width='25%'/> <br>
				<label for='school_logo'>Img Path</label>
				<input type='file' name='school_logo' id='school_logo' class='form-control' />
			</div>";
} 
 function getSloganFormField($value = ''){
	return "<div class='form-group'>
				<label for='slogan'>Slogan</label>
				<input type='text' name='slogan' id='slogan' value='$value' class='form-control' required />
			</div>";
} 
 function getLocationFormField($value = ''){
	return "<div class='form-group'>
				<label for='location'>Location</label>
				<textarea name='location' id='location' class='form-control' required>$value</textarea>
			</div>";
} 
 function getDescriptionFormField($value = ''){
	return "<div class='form-group'>
				<label for='description'>Description</label>
				<input type='text' name='description' id='description' value='$value' class='form-control' required />
			</div>";
} 
 function getSchool_websiteFormField($value = ''){
	return "<div class='form-group'>
				<label for='school_website'>System Name</label>
				<input type='text' name='school_website' id='school_website' value='$value' class='form-control' required />
			</div>";
} 
 function getSchool_mailFormField($value = ''){
	return "<div class='form-group'>
				<label for='school_mail'>School Mail</label>
				<input type='text' name='school_mail' id='school_mail' value='$value' class='form-control' required />
			</div>";
} 
 function getTelephone1FormField($value = ''){
	return "<div class='form-group'>
				<label for='telephone1'>Telephone1</label>
				<input type='text' name='telephone1' id='telephone1' value='$value' class='form-control' required />
			</div>";
} 
 function getTelephone2FormField($value = ''){
	return "<div class='form-group'>
				<label for='telephone2'>Telephone2</label>
				<input type='text' name='telephone2' id='telephone2' value='$value' class='form-control' required />
			</div>";
} 


 
}

?>
