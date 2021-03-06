<?php
/**
*
*/
class ModelFormBuilder extends CI_Model
{
private $cont ="mc";
	private $link;
	private $constructed;
	private $models= array();
	private $count =0;
	private $opened;
	private $generated;
	private $linked;
	private $formName;
	private $resetContent='';
	private $submitted;
	private $appendReset;
	private $parent;//the name of the parent table
	private $common='';//the name and value of the field that is common to all of the other fields excepts the parent field
	private $commonFieldSet;//this is the field that is common to all other tables except the parent table
	//once the parent is already set
	private $containsAmperSand=true;//check if the upload button has been taken care of
	private $extra;
	private $isAjax;
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('string');
	}
	private function createJSScript(){
		$result = "<script>
		\$(document).ready(function(){
			var fileType = \$('#{$this->formName}').find('input[type=\"file\"]');
			if(fileType){
				var fileID = fileType.attr('id');
				// console.log(fileID);
				\$('#' + fileID).change(function(){
					// console.log('got here');
					filePreview(\$(this));
				});
			}

			\$('#{$this->formName}').submit(function(e){
				e.preventDefault();
				submitAjaxForm(\$(this));
				// \$('#{$this->formName}').trigger('reset');

			});
			
		}
		);
		</script>";
		return $result;
	}
	public function start($name,$ajax=true){
		$this->isAjax = $ajax;
		if ($this->opened) {//if already opened do nothing
			return $this;
		}
		$this->constructed.="<form method='post' &&& name='$name' id='$name' action='###' >
		<fieldset>";
		$this->opened = true;
		$this->formName = $name;
		return $this;
	}
	/**
	 * This method help add additional html element to the button box for further processing
	 * @param  [string] $html [the html to add]
	 * @return [ModelFormBuilder]       [returned this object]
	 */
	public function addExtraToButtonSection($html){
		//make sure that the form submit button has been added
		$this->extra =$html;
		return $this;
	}
	public function appendExtra($html){
		$this->constructed.="\n$html";
		return $this;
	}
	public function addSubmitLink($link=null,$isInsert=true,$filter=true,$id=''){
		if (!($this->opened || $this->generated)) {
			throw new Exception("you can only link an opened form");
		}
		if ($isInsert  && $id) {
			throw new Exception("id must be present for update link ", 1);

		}
		if (is_null($link)) {
			# automatically generate the needed link
			$link =$this->generateLink($isInsert,$filter,$id);
			$this->constructed = str_replace('###', $link, $this->constructed);
		}
		else{
			$this->constructed = str_replace('###', $link, $this->constructed);
		}
		$this->linked= true;
		return $this;
	}

	// private function replaceLink($link){
	// 	$index = strpos($this->, needle)
	// }
	private function generateLink($insert,$filter,$id){
		$filterString=$filter?'1':'0';
		if (count($this->models)==1) {
			$keys = array_keys($this->models);
			$key = $keys[0];
			 $id=$insert?'':$this->models[$key][1].'/';
			$model = array_keys($this->models)[0];
			$method = $insert?'add':'update';
			$link=base_url().$this->cont."/$method/$model/".$id.$filterString;
			if ($this->isAjax) {
				$link.='?a=1';
			}
			return $link;
		}
		$method = $insert?'add':'update';
		$link=base_url().$this->cont."/$method/many/".$filterString;
		$modelComb = $this->generateModelCombination();
		$this->constructed.="<input type='hidden' name='combined-models' id='combined-models' value='$modelComb' />";
		if ($this->isAjax) {
			$link.='?a=1';
		}
		return $link;
		//when there are more than one model combined
	}
	//generate the string from $this->model
	private function generateModelCombination(){
		return json_encode($this->models);
	}
	private function createResetButton($value,$class){
		if ($this->submitted) {
			throw new Exception("you must appendResetButton before submitting", 1);

		}
		$this->resetContent = "<input type='reset' class='btn $class'  value='$value' />";
		return $this;
	}
	public function appendResetButton($value='Reset',$class=''){
		$this->createResetButton($value,$class);
		$this->appendReset=true;
		return $this;

	}
	//comes before submit
	public function prependResetButton($value='Reset',$class=''){
		$this->createResetButton($value,$class);
		$this->appendReset=false;
		return $this;

	}
	//comes after sumit
	public function appendsubmitButton($value='Submit',$class=''){
		if (!($this->opened || $this->generated)) {
			throw new Exception('form must be opened and generated before generating submission');
		}
		$parentString='';
		if (count($this->models) > 1 && !empty($this->parent)) {
			$parentString ="<input type='hidden' name='parent_generated' value='{$this->parent}' /> \n";
		}
		if ($this->appendReset) {
			$this->constructed.=" ****	$parentString <div class='form-group'>
					<input type='submit' class='btn $class'  value='$value' id='edu-submit' name='edu-submit' />
					{$this->resetContent}
				</div>";
		} else {
			$this->constructed.=" ****	$parentString <div class='form-group'>
					{$this->resetContent}
					<input type='submit' class='btn $class'  value='$value' id='edu-submit' name='edu-submit' />
				</div>";
		}
		$this->submitted=true;
		return $this;
	}
	public function build(){
		if (!$this->linked) {
			throw new Exception('you must provide action for the form');
		}
		// if (empty($this->parent)) {
		// 	throw new Exception("you must set the parent table", 1);

		// }
		if ($this->containsAmperSand) {
			$this->constructed = str_replace('&&&', '', $this->constructed);
		}

		$this->constructed= empty($this->extra)?$this->constructed =str_replace('****', '', $this->constructed):str_replace('****', $this->extra, $this->constructed);;

		//close the form and return
		$this->constructed.='</fieldset></form>';
		//clear the necessary variables
		$this->clearVariable();
		$result = $this->isAjax?$this->constructed."\n".$this->createJSScript():$this->constructed;
		$this->constructed='';
		return $result;
	}

	private function clearVariable(){
		$this->count=0;
		$this->link='';
		$this->linked=false;
		$this->generated = false;
		$this->opened = false;
		$this->models =array();
		$this->linked=false;
		$this->resetContent='';
		$this->submitted=false;
		$this->parent = '';
		$this->commonFieldSet=false;
		$this->containsAmperSand=true;
		$this->common = '';
	}
	public function addParentTable($model){
		if ($this->generated) {
			throw new Exception("The parent form must be generated first", 1);
		}
		if (!empty($this->parent)) {
			throw new Exception("a parent already exist,only one parent can be set for the many form", 1);
		}
		$this->parent = $model;
		$this->common =$model.'_ID';
		return $this;
	}
	private function addFormUploadProperty($model){
		if ($this->containsAmperSand && !empty($model::$documentField)) {
			# set the multipart
			$this->constructed = str_replace('&&&', "enctype='multipart/form-data'", $this->constructed);
			$this->containsAmperSand = false;
		}
	}
	function appendInsertForm($model,$isParent=false,$hidden=array(),$divider='',$showStatus=false,$rem=array()){
		if (!$this->opened) {
			throw new Exception('you must open form before you can generate');
		}
		if (!empty($this->models)  ) {
			if (empty($this->parent)) {
				throw new Exception("When combining multiple tables parent must be  set first");
			}
		}
		if ($isParent) {
			$this->addParentTable($model);
		}
		$this->constructed.=empty($divider)?'':"<div class='form-divider'>$divider</div>";
		// loadClass($this->load,$model);//load the needed model
		$this->load->model('entities/'.$model);
		$this->addFormUploadProperty($model);
		$fields = array_keys($model::$typeArray);
		$result='';
		foreach ($fields as  $field) {
			if ($field=='status' && !$showStatus) {
				continue;
			}
			if (in_array($field, $rem)) {
				continue;
			}
			// skip the id if stated in the type array
			if($field == 'ID'){
				continue;
			}
			//check that the model is not a parent and field is a parent field and that the form field has not be previously generated
			if ($model != $this->parent && $this->common ==$field ) {
				if ($this->commonFieldSet) {
					continue;
				}

				$this->commonFieldSet=true;
			}
			$method ='get'.ucfirst($field).'FormField';
			$val =$this->getHiddenValue($hidden,$field);
			if ($val ===null) {
				continue;
			}
			$temp=$this->$model->$method($val);
			$result.=$temp;//call this method correctly
			$result.="\n";
			if (!empty($temp)) {//disregard method that generates empty value
				$this->count++;
			}

		}
		$result.="\n";
		$this->constructed.=$result;
		$this->models[$model]=$this->count;
		$this->generated = true;
		// return $result;
		return $this;
	}

	private function getHiddenValue($array,$field){
		if (array_key_exists($field, $array)) {
			return $array[$field];
		}
		return '';
	}
	//the $title variable will help create a divided

	function appendUpdateForm($model,$isParent=false,$id,$ignore=array(),$divider=''){
		if (!$this->opened) {
			throw new Exception('you must open form before you can generate');
		}
		if (!empty($this->models) ) {
			if (empty($this->parent)) {
				throw new Exception("When combining multiple tables parent must be  set first");
			}
		}
		//set the divided here
		$this->constructed.=empty($divider)?'':"<div class='form-divider'>$divider</div>";
		if ($isParent) {
			$this->addParentTable($model);
		}
		$this->load->model('entities/'.$model);
		$this->addFormUploadProperty($model);
		if($id instanceof $model){
			$values=$id;
		}
		else{
			$this->$model->ID = $id;
			$this->$model->load();
			$values = $this->$model;
		}
		if (!$values || empty($values)) {
			return $this;
		}
		//$values =$values->toArray();
		$fields = array_keys($model::$typeArray);
		$result='';
		foreach ($fields as  $field) {
			if ($field=='status' || in_array($field, $ignore)) {
				continue;
			}
			if ($model != $this->parent && $this->common ==$field && empty($this->commonFieldSet) ) {//make sure there is no name conflict in the generated file
				continue;
			}
			$method ='get'.ucfirst($field).'FormField';
			$temp = @$values->$method(@$values->$field);//call this method correctly
			$result.=$temp;//call this method correctly
			$result.="\n";
			if (!empty($temp)) {//disregard method that generates empty value
				$this->count++;
			}
		}
		$result.="\n";
		$this->constructed.=$result;
		if ($model=='payment_log') {
			$this->models[$model]=array($this->count,$id->transaction_number);
		}
		else{
			$this->models[$model]=array($this->count,$id instanceof $model?$id->ID:$id);
		}
		// return $result;
		return $this;
	}


}
 ?>
