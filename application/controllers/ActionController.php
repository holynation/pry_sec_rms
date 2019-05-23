<?php 
	/**
	* This class like other controller class will have full access control capability
	*/
	class ActionController extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();
			$this->load->model('crud');
			$this->load->model('webSessionManager');
			// basically the admin should be the one accessing this module
			if ($this->webSessionManager->getCurrentUserprop('user_type')=='admin') {
				loadClass($this->load,'role');
				$role = new Role();
				$role->checkWritePermission();
			}
		}

		public function edit($model,$id){

		}
		public function disable($model,$id){
			$this->load->model("entities/$model");
			//check that model is actually a subclass
			if ( empty($id)===false && is_subclass_of($this->$model,'Crud' )) {
				if($this->$model->disable($id,$this->db)){

					echo createJsonMessage('status',true,'message',"item disable successfully...",'flagAction',true);
				}else{
					echo createJsonMessage('status',false,'message',"cannot disable item...",'flagAction',true);
				}
			}
			else{
				echo createJsonMessage('status',false,'message',"cannot disable item...",'flagAction',true);
			}
		}
		public function enable($model,$id){
			$this->load->model("entities/$model");
			//check that model is actually a subclass
			if ( !empty($id) && is_subclass_of($this->$model,'Crud' ) && $this->$model->enable($id,$this->db)) {
				echo createJsonMessage('status',true,'message',"item enabled successfully...",'flagAction',true);
			}
			else{
				echo createJsonMessage('status',false,'message',"cannot enable item...",'flagAction',true);
			}
		}
		public function view($model,$id){

		}
		public function delete($model,$id){
			//kindly verify this action before performing it
			$this->load->model("entities/$model");
			//check that model is actually a subclass
			if ( !empty($id) && is_subclass_of($this->$model,'Crud' )&&$this->$model->delete($id)) {
				echo createJsonMessage('status',true,'message','item deleted successfully...','flagAction',true);
				return true;
			}
			else{
				echo createJsonMessage('status',false,'message','cannot delete item...','flagAction',true);
				return false;
			}
		}
		public function multipleDelete($model,$id){
			//kindly verify this action before performing it
			// 1 => success
			// 0 => not exists
			// 2 => failed
			$this->load->model("entities/$model");
			//check that model is actually a subclass
			if ( !empty($id) && is_subclass_of($this->$model,'Crud' )) {
				if(!$this->$model->exists($id)){
					$result = $this->$model->delete($id);
					return 'done'; // 1
				}else{
					return 'exists'; // 0
				}
			}
			else{
				return 'wrong'; // 2
			}
		}

		public function multipleAction($model){
			if($model != ''){
				if(isset($_GET['task'])){
					if($_GET['task'] === 'multipleDelete'){
						try{
							$model = $this->db->conn_id->escape_string(trim($model));
							$checkBoxData = json_decode($_GET['checkBoxAction'],true);
							if(empty($checkBoxData)){
								echo createJsonMessage('status',false,'message','You have not chosen any item to perform the operation upon...');
								exit;
							}

							$result = '';
							for($i=0; $i<count($checkBoxData); $i++){
								$id = $this->db->conn_id->escape_string($checkBoxData[$i]['checkBoxData']);
								$result .= $this->multipleDelete($model,$id);
							}

							if(strpos($result, 'done') !== false){
								echo createJsonMessage('status',true,'message','item(s) deleted successfully...','flagAction',true);
								return true;
							}else if(strpos($result, 'exists') !== false){
								echo createJsonMessage('status',false,'message','item(s) cannot be deleted...','flagAction',false);
								return false;
							}else{
								echo createJsonMessage('status',false,'message','error occured while performing the operation...','flagAction',false);
							}

						}catch(Exception $e){
							echo createJsonMessage('status',false,'message','error occured while performing the operation...','flagAction',false);
						}
					}
					
				}
				
			}else{
				echo createJsonMessage('status',false,'message','there is no model to perform operation upon...','flagAction',false);
			}
		}
	}
 ?>