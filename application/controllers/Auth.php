<?php 
/**
* 
*/
class Auth extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('entities/user');
		$this->load->model('webSessionManager');
	}

	function web(){
		
		$isAjax =  isset($_POST['isajax']);
		// if (isset($_POST['login_btn'])) {
			$username = $this->input->post('username',true);
			$password = $this->input->post('password',true);
			if (!isNotEmpty($username,$password)) {
				echo "empty field detected . please fill all required field and try again";
			}
			$array = array('username'=>$username,'password'=>md5($password),'status'=>1);
			$user = $this->user->getWhere($array,$count,0,null,false," order by field(user_type,'admin','lecturer','student')");
			if ($user==false) {
				if ($isAjax) {
					$arr['status']=false;
					$arr['message']= "invalid username or password";
					echo  json_encode($arr);
					return;
				}
				else{
					redirect(base_url());
				}
				
			}
			else{
				$user = $user[0];
				$baseurl = base_url();
				$this->webSessionManager->saveCurrentUser($user,true);
				$baseurl.=$this->getUserPage($user);//'statics/sample';//redirect to the original dashboard page;
				if ($isAjax) {
					$arr['status']=true;
					$arr['message']= $baseurl;
					echo json_encode($arr);
					return;
				}else{
					redirect($baseurl);exit;
				}
			}
	}

	private function getUserPage($user){
		$link= array('admin'=>'vc/admin/dashboard','guardian'=>'vc/guardian/dashboard');
		$roleName = $user->user_type;
		return $link[$roleName];
	}

	//function for sending post http request using curl
	function sendPost($url,$post,&$errorMessage,$returnResult=false){
		$res = curl_init($url);
		curl_setopt($res, CURLOPT_POST,true);
		curl_setopt($res, CURLOPT_POSTFIELDS, $post);
		$certPath =str_replace( "application\helpers\MY_url_helper.php",'cacert.pem', __FILE__);
		curl_setopt($res, CURLOPT_CAINFO, $certPath);
		if ($returnResult) {
			curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
		}
		$referer = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		curl_setopt($res, CURLOPT_REFERER, $referer);
		$result = curl_exec($res);
		$errorMessage = curl_error($res);
		curl_close($res);
		return $result;
	}

	function mobile(){

	}
	
	function logout(){
		$link ='';
		$base = base_url();
		$this->webSessionManager->logout();
		// $this->application_log->log('logout','user logs out');
		$path = $base.$link;
		header("location:$path");exit;
	}

}
 ?>