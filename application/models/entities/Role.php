<?php 
defined("BASEPATH") OR exit("No direct script access allowed");
	require_once("application/models/Crud.php");

	/**
	* This class  is automatically generated based on the structure of the table. And it represent the model of the role table.
	*/ 

class Role extends Crud {

protected static $tablename = "Role"; 
/* this array contains the field that can be null*/ 
static $nullArray = array();
static $compositePrimaryKey = array();
static $uploadDependency = array();
/*this array contains the fields that are unique*/ 
static $displayField = 'role_title';// this display field properties is used as a column in a query if a their is a relationship between this table and another table.In the other table, a field showing the relationship between this name having the name of this table i.e something like this. table_id. We cant have the name like this in the table shown to the user like table_id so the display field is use to replace that table_id.However,the display field name provided must be a column in the table to replace the table_id shown to the user,so that when the other model queries,it will use that field name as a column to be fetched along the query rather than the table_id alone.;
static $uniqueArray = array('role_title');
/* this is an associative array containing the fieldname and the type of the field*/ 
static $typeArray = array('role_title' => 'varchar','status' => 'tinyint');
/*this is a dictionary that map a field name with the label name that will be shown in a form*/ 
static $labelArray = array('ID' => '','role_title' => '','status' => '');
/*associative array of fields that have default value*/ 
static $defaultArray = array('status' => '1');
 // populate this array with fields that are meant to be displayed as document in the format array("fieldname"=>array('type'=>array('jpeg','jpg','png','gif'),'size'=>'1048576','directory'=>'pastDeans/','preserve'=>false,'max_width'=>'1000','max_height'=>'500'))
//the folder to save must represent a path from the basepath. it should be a relative path,preserve filename will be either true or false. when true,the file will be uploaded with it default filename else the system will pick the current user id in the session as the name of the file.The max_width and max_height is use to check the dimension of upload files.By default,it value is 0 respectively.
static $documentField = array(); //array containing an associative array of field that should be regareded as document field. it will contain the setting for max size and data type.;
static $relation = array();
static $tableAction=array('enable'=>'getEnabled','delete'=>'delete/role','edit'=>'edit/role','permissions'=>'vc/admin/permission');
function __construct($array = array())
{
	parent::__construct($array);
	$this->createSuperUser();
}
 
function getRole_titleFormField($value = ''){
	return "<div class='form-group'>
				<label for='role_title'>Role Title</label>
				<input type='text' name='role_title' id='role_title' value='$value' class='form-control' required />
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

public function delete($id=null,&$db=null)
{
	if ($id==null) {
		$id=$this->ID;
	}
	if ($id==1) {
		return false;
	}
	return parent::delete($id,$db);
}

protected function getAdmin(){
	$query ='SELECT * FROM admin WHERE role_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Admin.php');
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new Admin($value);
	}

	return $resultObjects;
}


public function getDepartment($array=false)
	{
		$query =" select * from role_department where role_id=?";
		$result = $this->query($query,array($this->ID));
		if (!$result) {
			return false;
		}
		if ($array) {
			return $result;
		}
		loadClass($this->load,'department');
		$resultobjects = array();
		foreach ($result as  $value) {
			$resultObjects[] = new Department($value);
		}

		return $resultObjects;
	}
		
protected function getPermission(){
	$query ='SELECT * FROM permission WHERE role_id=?';
	$id = $this->array['ID'];
	$result = $this->db->query($query,array($id));
	$result =$result->result_array();
	if (empty($result)) {
		return false;
	}
	include_once('Permission.php');
	$resultobjects = array();
	foreach ($result as  $value) {
		$resultObjects[] = new Permission($value);
	}

	return $resultObjects;
}
public function getPermissionArray()
{
	$query = "select * from permission where role_id=?";
	$result = $this->query($query,array($this->ID));
	$toReturn = array();
	if (!$result) {
		return array();
	}
	foreach ($result as $res) {
		$toReturn[$res['path']]=$res['permission'];
	}
	return $toReturn;
}

public function processPermission($update,$remove)
{
	$id= $this->db->conn_id->escape_string($this->ID);
	$removeQuery=$this->buildRemoveQuery($remove,$id);
	$updateQuery = $this->buildUpdateQuery($update,$id);
	$this->db->trans_begin();
	if ($remove) {
		if (!$this->db->query($removeQuery)) {
				$this->db->trans_rollback();
				return false;
			}
	}
	if ($updateQuery) {
			if (!$this->db->query($updateQuery)) {
				$this->db->trans_rollback();
				return false;
			}
		}
	$this->db->trans_commit();
	return true;
}

private function buildUpdateQuery($update,$id)
{
	$query="insert into permission(role_id,path,permission) values ";
	$additional='';
	foreach ($update as $value) {
		$path = $this->db->conn_id->escape_string($value['path']);
		$permission = $this->db->conn_id->escape_string($value['permission']);
		$additional.=$additional?",($id,'$path','$permission')":"($id,'$path','$permission')";
	}
	if (!$additional) {
		return false;
	}
	return $query.$additional.' on duplicate key update permission=values(permission) ';
}

private function buildRemoveQuery($remove,$id)
{
	$content = implode(',', $remove);
	if ($content) {
		$content=str_replace(',', "','", $content);
		$content = "'$content'";
	}
	$result="delete from permission where path in ($content) and role_ID={$this->ID}";
	return $result;
}

public function canView($path)
{
	$path = $this->db->conn_id->escape_string($path);
	$query="select * from permission where role_id=? and '$path' like concat('%',path,'%')";
	$result = $this->query($query,array($this->ID));
	return $result;
}

public function canWrite($path)
{
	$path = $this->db->conn_id->escape_string($path);
	$query="select * from permission where role_id=? and '$path' like concat('%',path,'%') and permission='w'";
	$result = $this->query($query,array($this->ID));
	return $result;
}

public function checkWritePermission(){
		loadClass($this->load,'admin');
		$admin = new Admin();
		$admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
		$admin->load();
		$role = $admin->role;
		//get the page referer and use it as the
		$path = $_SERVER['HTTP_REFERER'];
		$path = $this->extractBase($path);
		if (strpos($path, 'vc/lecturer/profile/')===false) {
			$path='vc/add/lecturer';
		}
		if (strpos($path, 'vc/admin/profile/')===false) {
			$path='vc/add/admin';
		}
		if (!$role->canWrite($path)) {
		  echo createJsonMessage('status',false,'message','sorry,you do not have permission to perform operation');exit;
		}
	}

private function extractBase($path)
	{
		$base =base_url();
		$ind = strpos($path, $base);
		if ($ind===false) {
			return false;
		}
		$result = substr($path, $ind+strlen($base));
		return $result;
	}


public function createSuperUser()
{
	$this->db->trans_begin();
	$query="insert into role(ID,role_title) values(1,'superadmin') on duplicate key update role_title=values(role_title)";
	if ($this->query($query)) {
		$modules = $this->getModules();
		$q="insert into permission(role_id,path,permission) values(?,?,?) on duplicate key update permission=values(permission)";
		$role_id=1;
		foreach ($modules as $val) {
			foreach ($val['children'] as $child) {
				if (!$this->query($q,array($role_id,$child,'w'))) {
					$this->db->trans_rollback();
					return false;
				}
			}
		}
		$this->db->trans_commit();
		return true;
	}
	else{
		$this->db->trans_rollback();
		return false;
	}
}

public function getModules()
{
	$result=array(
		'Dashboard'=>array(
			'class'=>'fa-dashboard',
			'children'=>array(
				'Home'=>"vc/admin/dashboard",
				'Profile'=>'vc/admin/profile'
			)
		),
		'Users'=>array(
			'class'=>'fa-users',
			'children'=>array(
				'Student'=>'vc/add/student_biodata',
				'Admin'=>'vc/add/admin'
			)
		),
		'School Setting'=>array(
			'class'=>'fa-graduation-cap',
			'children'=>array(
				'School'=>'vc/admin/school',
				'Academic Session'=>'vc/add/academic_session',
				'Term'=>'vc/add/term',
				'School Class' => 'vc/add/school_class',
				'Session Term' => 'vc/add/session_term',
				'Entry Mode' => 'vc/add/entry_mode'
			)
		),
		'Courses'=>array(
			'class'=>'fa-book',
			'children'=>array(
				'Subject'=>'vc/add/subject'
			)
		),
		'Result Setting'=>array(
			'class'=>'fa-cog',
			'children'=>array(
				'Grade Scale'=>'vc/add/grade_scale',
				'Upload Result'=>'vc/admin/upload_result',
				'View Result'=>'vc/admin/view_result',
				'Upload History'=>'vc/admin/upload_history'
			)
		),
		'Report'=>array(
			'class'=>'fa-bar-chart',
			'children'=>array(
				'Student Register' => 'vc/admin/student_registration',
				'Student Result'=>'vc/admin/student_result',
				'Student Report'=>'vc/admin/result_option',
				'Configure Report' => 'vc/add/configure_report'
			)
		)
	);
	return $result;
}


 
}

?>
