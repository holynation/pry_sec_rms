<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the signature table.
	*/ 

class Signature extends Crud {

protected static $tablename = "Signature"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('fullname');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'fullname';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array();
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('path' => 'varchar','fullname' => 'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','path' => '','fullname' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array();
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array('path' => array('type'=>array('jpeg','jpg','png'),'size'=>'1048576','directory'=>'signature/','preserve'=>false,'max_width'=>'72','max_height'=>'72')); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction = array('delete' => 'delete/signature', 'edit' => 'edit/signature');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getPathFormField($value = ''){
	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
				<label for='path'>Signature Image</label>
				<input type='file' name='path' id='path' value='$value' class='form-control' required />
				<img src='$path' alt='Signature image' width='18%'/>
			</div>";
} 
 function getFullnameFormField($value = ''){
	return "<div class='form-group'>
				<label for='fullname'>Fullname</label>
				<input type='text' name='fullname' id='fullname' value='$value' class='form-control' />
			</div>";
}

public function getSignature()
{
	$signature = new Signature();
	$sign = $signature->all();
	$signName = $sign?$sign[0]->fullname:'Name/signature';
	$signPath = base_url(@$sign[0]->path);
	$headSignature =@$sign[0]->path?"<img src='$signPath' width='72' height='68' style='margin-left:18.5px;' />":'';
	$html="
	<div style='position:relative'>
		<div class='hod'>
			$headSignature
			<h5>$signName</h5>
		</div>
		<div style='margin-bottom:10px;'>&nbsp;</div>
	</div>
	";
	return $html;
}


 
}

?>
