<?php
		require_once('application/models/Crud.php');
		/**
		* This class  is automatically generated based on the structure of the table. And it represent the model of the admin table.
		*/
		class Admin extends Crud
		{
protected static $tablename='Admin';
/* this array contains the field that can be null*/
static $nullArray=array('middlename' ,'email' ,'phone_number' ,'address' ,'dob' ,'role_id' ,'status' );
static $compositePrimaryKey=array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/
static $uniqueArray=array('email' ,'phone_number' );
/*this is an associative array containing the fieldname and the type of the field*/
static $typeArray = array('firstname'=>'varchar','middlename'=>'varchar','lastname'=>'varchar','email'=>'varchar','phone_number'=>'varchar','address'=>'text','dob'=>'date','role_id'=>'int','status'=>'tinyint','img_path'=>'varchar');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/
static $labelArray=array('ID'=>'','firstname'=>'','middlename'=>'','lastname'=>'','email'=>'','phone_number'=>'','address'=>'','dob'=>'','role_id'=>'','status'=>'','img_path'=>'');
/*associative array of fields that have default value*/
static $defaultArray = array('status'=>'1');
//populate this array with fields that are meant to be displayed as document in the format array('fieldname'=>array('filetype','maxsize',foldertosave','preservefilename'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.
static $documentField = array('img_path'=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'','preserve'=>false,'max_width'=>'500','max_height'=>'450'));//array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.
		
static $relation=array('role'=>array( 'role_id', 'ID')
,'admin_log'=>array(array( 'ID', 'admin_id', 1))
);
static $tableAction=array('enable'=>'getEnabled','delete'=>'delete/admin','edit'=>'edit/admin');
function __construct($array=array())
{
	parent::__construct($array);
}
function getFirstnameFormField($value=''){
	return "<div class='form-group'>
	<label for='firstname' >Firstname</label>
		<input type='text' name='firstname' id='firstname' value='$value' class='form-control' required />
</div> ";

}
function getMiddlenameFormField($value=''){
	return "<div class='form-group'>
	<label for='middlename' >Middlename</label>
		<input type='text' name='middlename' id='middlename' value='$value' class='form-control'  />
</div> ";

}
function getLastnameFormField($value=''){
	return "<div class='form-group'>
	<label for='lastname' >Lastname</label>
		<input type='text' name='lastname' id='lastname' value='$value' class='form-control' required />
</div> ";

}
function getImg_pathFormField($value='')
{
	return '';
}
function getEmailFormField($value=''){
	return "<div class='form-group'>
	<label for='email' >Email</label>
	<input type='email' name='email' id='email' value='$value' class='form-control'  />
</div> ";

}
function getPhone_numberFormField($value=''){
	return "<div class='form-group'>
	<label for='phone_number' >Phone Number</label>
		<input type='text' name='phone_number' id='phone_number' value='$value' class='form-control'  />
</div> ";

}
function getAddressFormField($value=''){
	return "<div class='form-group'>
	<label for='address' >Address</label>
<textarea id='address' name='address' class='form-control' >$value</textarea>
</div> ";

}
function getDobFormField($value=''){
	return "<div class='form-group'>
	<label for='dob' >Dob</label>
	<input type='date' name='dob' id='dob' value='$value' class='form-control'  />
</div> ";

}
	 function getRole_idFormField($value=''){
	$fk= array('table'=>'role','display'=>'role_title'); 

	if (is_null($fk)) {
		return $result="<input type='hidden' value='$value' name='role_id' id='role_id' class='form-control' />
			";
	}
	if (is_array($fk)) {
		$result ="<div class='form-group'>
		<label for='role_id'>Role</label>";
		$option = $this->loadOption($fk,$value);
		//load the value from the given table given the name of the table to load and the display field
		$result.="<select name='role_id' id='role_id' class='form-control'>
			$option
		</select>";
	}
	$result.="</div>";
	return  $result;

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
	
protected function getRole(){
	$query ='SELECT * FROM role WHERE id=?';
	if (!isset($this->array['role_id'])) {
		$this->load();
	}
	$id = $this->array['role_id'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Role.php');
	$resultObject = new Role($result[0]);
	return $resultObject;
}

public function delete($id=null,&$db=null)
{
	$db=$this->db;
	$db->trans_begin();
	if(parent::delete($id,$db)){
		$query="delete from user where user_table_id=? and user_type='admin'";
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