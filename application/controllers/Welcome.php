<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('webSessionManager');
		$this->load->model('entities/school');
		$this->load->helper('string');
		$this->load->helper('url');
	}
	public function index()
	{
		if ($this->webSessionManager->isSessionActive()) {
			$userType= $this->webSessionManager->getCurrentUserProp('user_type');
			$userPage = $this->getUserPage($userType);
			header("Location:".base_url($userPage));exit;
		}
		$school =$this->school->all();
		$data['school'] = $school?$school[0]:false;
		if (!$this->hasAdmin()) {
			$this->load->view('create_admin',$data);return;
		}

		$this->load->view('welcome_message',$data);
	}

	private function hasAdmin()
	{
		$query="select * from role where ID=1";
		$result = $this->db->query($query);
		$result =$result->result_array();
		return $result;
	}

	private function getUserPage($user){
		$link= array('admin'=>'vc/admin/dashboard');
		return $link[$user];
	}

	public function setup()
	{
		loadClass($this->load,'role');
		$this->role->createSuperUser();
		loadClass($this->load,'admin');
		$password=$_POST['password'];
		$username=$_POST['email'];
		unset($_POST['enter']);
		unset($_POST['password']);
		unset($_POST['confirm']);
		$this->admin->setArray($_POST);
		$this->admin->role_id=1;
		$this->admin->insert();
		$last=$this->admin->getLastInsertId();
		loadClass($this->load,'user');
		$this->user->username=$username;
		$this->user->password=md5($password);
		$this->user->user_table_id=$last;
		$this->user->user_type='admin';
		if ($this->user->insert()) {
			$result['status']=true;
			$result['message']=base_url();
			echo json_encode($result);exit;
		}
		else{
			$result['status']=false;
			$result['message']="error occured while performing operation";
			echo json_encode($result);exit;
		}

	}
}
