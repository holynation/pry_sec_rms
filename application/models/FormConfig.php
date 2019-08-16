<?php 
/**
* this class help save the configuration needed by the form in order to use a single file for all the form code.
* you only need to include the configuration data that matters. the default value will be substituted for other configuration value that does not have a key  for a particular entity.
*/
class FormConfig extends CI_Model
{
	private  $insertConfig;
	private $updateConfig;
	public $currentRole;
	
	function __construct($currentRole=false)
	{
		$this->currentRole=$currentRole;
		if ($currentRole) {
			$this->buildInsertConfig();
			$this->buildUpdateConfig();
		}
		
	}
	/**
	 * this is the function to change when an entry for a particular entitiy needed to be addded. this is only necessary for entities that has a custom configuration for the form.Each of the key for the form model append insert option is included. This option inculde:
	 * form_name the value to set as the name and as the id of the form. The value will be overridden by the default value if the value if false.
	 * has_upload this field is used to determine if the form should include a form upload section for the table form list
	 * hidden this  are the field that should be pre-filled. This must contain an associative array where the key of the array is the field and the value is the value to be pre-filled on the value.
	 * showStatus field is used to show the status flag on the form. once the value is true the status field will be visible on the form and false otherwise.
	 * exclude contains the list of entities field name that should not be shown in the form. The filed for this form will not be display on the form.
	 * submit_label is the label that is going to be displayed on the submit button
	 * 	table_exclude is the list of field that should be removed when displaying the table.
	 * table_action contains an associative arrays action to be displayed on the action table and the link to perform the action.
	 * the query paramete is used to specify a query for getting the data out of the entity
	 * upload_param contains the name of the function to be called to perform
	 * 
	 */ 
	private function buildInsertConfig()
	{
		$this->insertConfig= array
		(
		'student_biodata'=>array
			(
				'exclude'=>array('img_path'),
				'has_upload'=>true,
				'hidden'=>array(),
				'show_status'=>false,
				'submit_label'=>'Save',
				'table_exclude'=>array('img_path'),
				'table_action'=>array('delete'=>'delete/student_biodata','edit'=>'edit/student_biodata','profile'=>'vc/student/profile'),
				'search'=>array('firstname','middlename','surname','registration_number'),
				'query'=>"select distinct student.ID,surname,firstname,middlename,(select session_name from academic_session where id=student.academic_session_id) as entry_session,mode_of_entry,state_of_origin,lga_of_origin,dob as date_of_birth,email,phone_number,gender,address,registration_number from student_biodata student left join entry_mode on student.entry_mode_id = entry_mode.id left join school_class on school_class.id= student.school_class_id left join student_session_history on student.id=student_session_history.student_biodata_id left join academic_session on academic_session.id=student_session_history.academic_session_id "
			),
			'admin'=>array
			(
				'search'=>array('firstname','lastname','middlename')
			),
			'subject'=>array
			(
				'search'=>array('subject_title')

			),
			'role'=>array(
				'has_upload'=>false,
				'query'=>'select * from role where ID<>1',
				'has_export' => false
			),
			'configure_report' => array(
				'has_upload'=>false,
				'table_title' => 'Configuration Report Table',
				'has_export' => false
			),
			'signature' => array(
				'table_title' => 'Signature Table',
				'has_upload'=>false,
				'has_export' => false
			),
			'title'=>array(
				'has_upload'=>false
			),
			'guardian'=>array(
				'has_upload'=>false
			)
		//add new entry to this array
		);
	}

	private function getFilter($tablename)
	{
		$result= array(
			'student_biodata'=>array(
				array(
					'filter_label'=>'academic_session.ID',
					'filter_display'=>'session',
					'preload_query'=>'select id,session_name as value from academic_session order by ID desc',
				),
				array(
					'filter_label'=>'school_class.ID',
					'preload_query'=>'select id,class_name as value from school_class'
				)
				
			),
			'Subject'=>array
			(
				array(
					'filter_label'=>'school_class.ID',
					'preload_query'=>'select id,class_name as value  from school_class',
					'filter_display'=>'class'
				)
			)
		);
		if (array_key_exists($tablename, $result)) {
			return $result[$tablename];
		}
		return false;
	}
	/**
	 * This is the configuration for the edit form of the entities.
	 * exclude take an array of fields in the entities that should be removed from the form.
	 */
	private function buildUpdateConfig()
	{
		$this->updateConfig= array
		(
		'student_biodata'=>array
			(
				'exlude'=>array()		
			),
		'subject_score' => array
		(
			'exclude' => array('ca_total','score')
		)
		//add new entry to this array
		);
	}
	function getInsertConfig($entities)
	{
		if (array_key_exists($entities, $this->insertConfig)) {
			$result=$this->insertConfig[$entities];
			if (($fil=$this->getFilter($entities))) {
				$result['filter']=$fil;
			}
			return $result;
		}
		if (($fil=$this->getFilter($entities))) {
			return array('filter'=>$fil);
		}
		return false;
	}

	function getUpdateConfig($entities)
	{
		if (array_key_exists($entities, $this->updateConfig)) {
			$result=$this->updateConfig[$entities];
			if (($fil=$this->getFilter($entities))) {
				$result['filter']=$fil;
			}
			return $result;
		}
		if (($fil=$this->getFilter($entities))) {
			return array('filter'=>$fil);
		}
		return false;
	}
}
 ?>