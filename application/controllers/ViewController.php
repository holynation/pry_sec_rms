<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ViewController extends CI_Controller{

//field definition section
  private $needId= array();

  private $needMethod=array();
  private $errorMessage; // the error message currently produced from this cal if it is set, it can be used to produce relevant error to the user.
  private $access = array();
  private $schoolData;
//
  function __construct(){
		parent::__construct();
		$this->load->model("modelFormBuilder");
		$this->load->model("tableViewModel");
    $this->load->helper('string');
    $this->load->helper('array');
    $this->load->model('webSessionManager');
    $this->load->model('queryHtmlTableModel');
    if (!$this->webSessionManager->isSessionActive()) {
      header("Location:".base_url());exit;
    }
    loadClass($this->load,'school');
    $this->schoolData =$this->school->all($total,false);
    if ($this->schoolData) {
      $this->schoolData = $this->schoolData[0];
    }
	}
//// bootsrapping functions 
  public function view($model,$page='index',$other=''){
    if ( !(file_exists("application/views/$model/") && file_exists("application/views/$model/$page".'.php')))
    {
      show_404();
    }

    $defaultArgNum =3;
    $tempTitle = removeUnderscore($model);
    $title = $page=='index'?$tempTitle:ucfirst($page)." $tempTitle";
    //$schoolName = empty($this->session->userdata('schoolName'))?//till the school name getter is added
    $data['id'] = $other;
    if (func_num_args() > $defaultArgNum) {
      $args = func_get_args();
      $this->loadExtraArgs($data,$args,$defaultArgNum);
    }

    // if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
    //   //check for the permission for the admin here
    // }

    $exceptions = array();//pages that does not need active session
    if (!in_array($page, $exceptions)) {
      if (!$this->webSessionManager->isSessionActive()) {
        redirect(base_url());exit;
      }
    }

    //get the name of the school set on the system
    $data['school']=$this->schoolData;
    if (method_exists($this, $model)) {
      $this->$model($page,$data);
    }
    $methodName = $model.ucfirst($page);

    if (method_exists($this, $model.ucfirst($page))) {
      $this->$methodName($data);
    }

    $data['model'] = $page;
    $data['message']=$this->session->flashdata('message');
    sendPageCookie($model,$page);

    return $this->load->view("$model/$page", $data);
  }

  private function admin($page,&$data)
  {
    $role_id=$this->webSessionManager->getCurrentUserProp('role_id');
    if (!$role_id) {
      show_404();
    }

    $this->load->model('custom/adminData');
    $role=false;
    loadClass($this->load,'admin');
    $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
    $this->admin->load();
    $data['admin']=$this->admin;
    $role = $this->admin->role;
    $data['currentRole']=$role;
    if (!$role) {
      show_404();exit;
    }
    // this is done to permit the admin to access the following page apart from the role permission code
    $path ='vc/admin/'.$page;
    if($page=='permission') {
      $path ='vc/add/role';
    }

    if ($page=='report') {
      $path ='vc/admin/result_option';
    }

    if (!$role->canView($path)) {
      show_access_denied();exit;
    }

    $sidebarContent=$this->adminData->getCanViewPages($role);
    // print_r($sidebarContent);exit;
    $data['canView']=$sidebarContent;

  }

  private function adminDashboard(&$data)
  {
   $data = array_merge($data,$this->adminData->loadDashboardData());
  }

  private function adminPermission(&$data)
  {
    if (!isset($data['id']) || !$data['id'] || $data['id']==1) {
      show_404();exit;
    }
    $newRole = new Role(array('ID'=>$data['id']));
    $newRole->load();
    $data['role']=$newRole;
    $data['allPages']=$this->adminData->getAdminSidebar();
    $sidebarContent=$this->adminData->getCanViewPages($data['role']);
    // print_r($sidebarContent);exit;
    $data['permitPages']=$sidebarContent;
    $data['allStates']=$data['role']->getPermissionArray();
  }

  private function adminProfile(&$data)
  {
    loadClass($this->load,'admin');
    $admin = new Admin();
    $admin->ID=$this->webSessionManager->getCurrentUserProp('user_table_id');
    $admin->load();
    $data['admin']=$admin;
  }

  private function adminStudent_result(&$data)
  {
    if (isset($_GET['reg']) && $_GET['reg'] && isset($_GET['session']) && $_GET['session'] && isset($_GET['term']) && $_GET['term']) {
      loadClass($this->load,'student_biodata');
      $student = $this->student_biodata->getWhere(array('registration_number'=>$_GET['reg']),$c,0,null,false);
      if($student){
        $student = @$student[0];
        $data['student']=$student;
        $data['result']=$student->getStudentResult($_GET['session'],$_GET['term']);
      }
      
    }
  }

  private function adminStudent_registration(&$data)
  {
    if (@$_GET['l'] && $_GET['session'] && @$_GET['term']) {
      loadClass($this->load,'student_biodata');
      $students=array();
      if (@$_GET['reg']) {
        $students = $this->student_biodata->getWhere(array('registration_number'=>$_GET['reg']),$c,0,null,false);
      }

      $result = array();
      if(empty($students)){
        $data['model'] = "Student_registration";
        $data['message'] = "Sorry, the student with the reg number " ."<b>".$_GET['reg'] ."</b>"." does not exist in the system...";
        $data['backLink'] = base_url("vc/admin/student_registration");
        $this->load->view('errorreport',$data);return;
      }

      foreach ($students as $student) {
        $result[]=array($student,$student->getRegistration($_GET['session'],$_GET['term']));
      }

      loadClass($this->load,'academic_session');
      $this->academic_session->ID=$_GET['session'];
      $this->academic_session->load();
      $sessionName = $this->academic_session->session_name;
      loadClass($this->load,'school_class');
      $this->school_class->ID=$_GET['l'];
      $this->school_class->load();
      $levelName=$this->school_class->class_name;
      loadClass($this->load,'term');
      $this->term->ID = $_GET['term'];
      $this->term->load();
      $termName = $this->term->term_name;
      $data['sessionName'] = $sessionName;
      $data['termName'] = $termName; 
      $data['className'] = $levelName;
      $data['header']=$levelName.' Class '.$sessionName .'('.$termName.' term)';
      $data['result']=$result;
    }
  }

  private function adminReport(&$data)
  {
    $session = @$_GET['session'];
    $level = @$_GET['l'];
    $reg= @$_GET['reg'];
    $sessionTerm = @$_GET['sessionTerm'];
    if (!$reg && !($session&&$level)) {
      $this->webSessionManager->setFlashMessage('message','please select all necessary information to continue');
      header("Location:".base_url('vc/admin/result_option'));exit;
    }
    loadClass($this->load,'student_biodata');
    $students = $reg?$this->student_biodata->getWhere(array('registration_number'=>$reg),$c,0,null,false):$this->student_biodata->getStudentIn($level,$session);
    if ($students==false) {
      $this->webSessionManager->setFlashMessage('message','can\'t find student records');
      header("Location:".base_url('vc/admin/result_option'));exit;
    }
    $sess = (isset($_GET['session']) && $_GET['session'])?$_GET['session']:$this->webSessionManager->getCurrentSession();
    loadClass($this->load,'academic_session');
    $this->academic_session->ID=$sess;
    $this->academic_session->load();
    $data['currentSession']=$this->academic_session->session_name;
    $data['sessionTerm'] = $sessionTerm;
    $data['currentClass'] = $level;
    $data['totalStudent'] = $this->student_biodata->countGetStudentIn($level,$session);
    $content=array();
    foreach ($students as $student) {
      $content[]=array('student'=>$student,'report'=>$this->adminData->getStudentResultData($student,$sess,$sessionTerm,$level,$extraReport,$resultCount,$totalPercentage),'extraReport'=>@$extraReport,'resultCount'=>@$resultCount,'totalPercentage'=>@$totalPercentage);
    }
    // print_r($content);exit;
    $data['reports']=$content;
  }


  private function adminUpload_history(&$data)
  {
    loadClass($this->load,'upload_history');
    $course = @$_GET['subject'];
    $ss = @$_GET['session'];
    $class = @$_GET['class'];
    loadClass($this->load,'session_term');
    $this->session_term->ID=$ss;
    if (!$course || !$ss) {
      $data['uploadHistory']=array();return;
    }
    $session =$this->session_term->academic_session->ID;
    $result = $this->upload_history->getDisplayHistory($course,$session,$class);
    $data['uploadHistory']=$result;
  }

  public function studentProfile(&$data)
  {
    if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
      $this->admin('profile',$data);
      if (!isset($data['id']) || !$data['id']) {
        show_404();exit;
      }
      loadClass($this->load,'student_biodata');
      $std = new Student_biodata(array('ID'=>$data['id']));
      if (!$std->load()) {
        show_404();exit;
      }
      $data['student']=$std;
    }
    
  }

  //function for loading edit page for general application
  function edit($model,$id){
    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if($userType == 'admin'){
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
      $role = $this->admin->role;
      $role->checkWritePermission();
    }else{
      $role = true;
    }
    
    $ref = @$_SERVER['HTTP_REFERER'];
    if ($ref&&!startsWith($ref,base_url())) {
      show_404();
    }
    $this->webSessionManager->setFlashMessage('prev',$ref);
    $exceptionList= array('user');//array('user','applicant','student','staff');
    if (empty($id) || in_array($model, $exceptionList)) {
      show_404();exit;
    }
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $configData=$formConfig->getUpdateConfig($model);
    $exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
     $formContent= $this->modelFormBuilder->start($model.'_edit')
        ->appendUpdateForm($model,true,$id,$exclude,'')
        ->addSubmitLink(null,false)
        ->appendSubmitButton('Update','btn btn-success')
        ->build();
        echo createJsonMessage('status',true,'message',$formContent);exit;
  }

  function extra($model,$id,$_1){
    $role = true;

    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if ($userType=='lecturer') {
      loadClass($this->load,'lecturer');
      $this->lecturer->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->lecturer->load();
    }
    else{
      loadClass($this->load,'admin');
      $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
      $this->admin->load();
    }

    $ref = @$_SERVER['HTTP_REFERER'];
    if ($ref&&!startsWith($ref,base_url())) {
      show_404();
    }

    $this->webSessionManager->setFlashMessage('prev',$ref);
    $exceptionList= array('user');//array('user','applicant','student','staff');
    if (empty($id) || in_array($model, $exceptionList)) {
      show_404();exit;
    }
    // this is to set the form id of the original form
    $extraParam = array(
        'extra_model' => $id,
        'extra_id'    => $_1
    );
    // $this->webSessionManager->setContent('extra_id',$id);
    $this->webSessionManager->setArrayContent($extraParam);
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $configData=$formConfig->getUpdateConfig($model);
    $exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
    $hidden = ($configData && array_key_exists('hidden', $configData))?$configData['hidden']:array();
    $showStatus = ($configData && array_key_exists('show_status', $configData))?$configData['show_status']:false;
    $submitLabel = ($configData && array_key_exists('submit_label', $configData))?$configData['submit_label']:"Save";

     $formContent= $this->modelFormBuilder->start($model.'_table')
        ->appendInsertForm($model,true,$hidden,'',$showStatus,$exclude)
        ->addSubmitLink()
        ->appendSubmitButton($submitLabel,'btn btn-success')
        ->build();
        echo createJsonMessage('status',true,'message',$formContent);exit;
  } 

  public function add($model)
  {

    $role_id=$this->webSessionManager->getCurrentUserProp('role_id');
    $userType=$this->webSessionManager->getCurrentUserProp('user_type');
    if($userType == 'admin'){
      if (!$role_id) {
        show_404();
      }
    }

    $role =false;
    loadClass($this->load,'admin');
    $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
    $this->admin->load();
    $role = $this->admin->role;
    $data['admin']=$this->admin;
    $data['currentRole']=$role;
    $path ='vc/add/'.$model;

    if (!$role->canView($path)) {
      show_access_denied($this->load);exit;
    }

    if (!$this->webSessionManager->isSessionActive()) {
      header("Location:".base_url());exit;
    }
    if ($model==false) {
      show_404();
    }

    if($userType == 'admin'){
      $this->load->model('custom/adminData');
      $sidebarContent=$this->adminData->getCanViewPages($role);
      $data['canView']=$sidebarContent;
    }

    loadClass($this->load,$model);
    $test = new $model();
    $this->load->model('Crud');
    $this->load->model('modelFormBuilder');
    if (!is_subclass_of($test ,'Crud')) {
      show_404();exit;
    }
    $this->load->model('formConfig');
    $formConfig = new formConfig($role);
    $data['configData']=$formConfig->getInsertConfig($model);
    $data['model']=$model;
    $data['school']=$this->schoolData;
    $this->load->view('add',$data);
  }

  function changePassword()
  {
    $id=$this->webSessionManager->getCurrentUserProp('ID');
    $this->load->model('entities/user');
    if(isset($_POST) && count($_POST) > 0 && !empty($_POST)){
      $curr_password = trim($_POST['data_current_password']);
      $new = trim($_POST['data_password']);
      $confirm = trim($_POST['data_confirm_password']);

      if (!isNotEmpty($curr_password,$new,$confirm)) {
        echo "empty field detected . please fill all required field and try again";
        return;
      }

      if($this->user->find($id)){
        $check = md5(trim($curr_password)) == $this->user->data()[0]['password'];
        // $check = $this->hash_created->decode_password(trim($curr_password), $this->user->data()[0]['password']);
        if(!$check){
          echo createJsonMessage('status',false,'message','your current password is not correct.','flagAction',false);
          return;
        }
      }

      if ($new !==$confirm) {
        echo createJsonMessage('status',false,'message','new password does not match with the confirmation password','flagAction',false);exit;
      }
      $new = md5($new);
      // $new = $this->hash_created->encode_password($new);
        $query = "update user set password = '$new' where ID=?";
        if ($this->db->query($query,array($id))) {
          $arr['status']=true;
          $arr['message']= 'operation successfull';
          $arr['flagAction'] = true;
          echo json_encode($arr);
          return;
        }
        else{
          $arr['status']=false;
          $arr['message']= 'error occured during operation...';
          $arr['flagAction'] = false;
          echo json_encode($arr);
          return;
        }
    }
    return false;
  }

}

?>
