<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the guardian table.
	*/ 

class Guardian extends Crud {

protected static $tablename = "Guardian"; 
/* this array contains the field that can be null*/ 
static $nullArray = array('email','address','img_path','status');
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'student_biodata_id';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('student_biodata_id');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('title_id' => 'int','student_biodata_id' => 'int','surname' => 'varchar','firstname' => 'varchar','email' => 'varchar','phone_num' => 'varchar','address' => 'text','img_path' => 'varchar','status' => 'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','student_biodata_id' => '','title_id' => '','surname' => '','firstname' => '','email' => '','phone_num' => '','address' => '','img_path' => '','status' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array("img_path"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'guardian/','preserve'=>false,'max_width'=>'500','max_height'=>'500')); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array('student_biodata' => array('student_biodata_id','id')
,'title' => array('title_id','id')
);
static $tableAction = array('profile' => 'vc/guardian/profile','edit' => 'edit/guardian','delete' => 'delete/guardian');
function __construct($array = array())
{
	parent::__construct($array);
}
 
function getStudent_biodata_idFormField($value = ''){
	$query = "select id,concat(surname,' ',firstname,' ',middlename,'(',registration_number,')') as value from student_biodata";
	$result ="<div class='form-group'>
		<label for='student_biodata_id'>Student</label>";
		$option = buildOptionFromQuery($this->db,$query,null,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='student_biodata_id' id='student_biodata_id' class='form-control'>
		<option value=''>..choose....</option>
			$option
		</select>";
	$result.="</div>";
	return  $result;
}
 function getTitle_idFormField($value = ''){
	$fk = array('table'=>'title','display'=>'title_name'); 
 	//change the value of this variable to array('table'=>'title','display'=>'title_name'); if you want to preload the value from the database where the display key is the name of the field to use for display in the table.[i.e the display key is a column name in the table specify in that array it means select id,'title_name' as value from 'title' meaning the display name must be a column name in the table model].It is important to note that the table key can be in this format[array('table' => array('title', 'another table name'))] provided that their is a relationship between these tables. The value param in the function is set to true if the form model is used for editing or updating so that the option value can be selected by default;

		if(is_null($fk)){
			return $result = "<input type='hidden' name='title_id' id='title_id' value='$value' class='form-control' />";
		}

		if(is_array($fk)){
			
			$result ="<div class='form-group'>
			<label for='title_id'>Title</label>";
			$option = $this->loadOption($fk,$value);
			//load the value from the given table given the name of the table to load and the display field
			$result.="<select name='title_id' id='title_id' class='form-control'>
						$option
					</select>";
		}
		$result.="</div>";
		return $result;
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
 function getEmailFormField($value = ''){
	return "<div class='form-group'>
				<label for='email'>Email</label>
				<input type='text' name='email' id='email' value='$value' class='form-control' />
			</div>";
} 
 function getPhone_numFormField($value = ''){
	return "<div class='form-group'>
				<label for='phone_num'>Phone Num</label>
				<input type='text' name='phone_num' id='phone_num' value='$value' class='form-control' required />
			</div>";
} 
 function getAddressFormField($value = ''){
	return "<div class='form-group'>
				<label for='address'>Address</label>
				<input type='text' name='address' id='address' value='$value' class='form-control' />
			</div>";
} 
function getImg_pathFormField($value=''){
	$path=  ($value != '') ? base_url($value) : "";
	return "<div class='form-group'>
	<img src='$path' alt='guardian pic' width='150' height='150' />
	<label for='img_path' >Guardian Picture</label>
		<input type='file' name='img_path' id='img_path' value='$value' class='form-control'  />
</div> ";

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
 protected function getTitle(){
	$query ='SELECT * FROM title WHERE id=?';
	if (!isset($this->array['title_id'])) {
		return null;
	}
	$id = $this->array['title_id'];
	$result = $this->db->query($query,array($id));
	$result = $result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Title.php');
	$resultObject = new Title($result[0]);
	return $resultObject;
}

 
}

?>
