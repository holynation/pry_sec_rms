<?php 
/**
|	Helper class for generating the right directory for the upload process 
|	based on the model the entity is using.
|	Thus, it is useful for dynamic naming of directory for a model
*/
class UploadDirectoryManager extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

/**
 * @param  The paremeter sent through the form that is relevant to the file. in a post structure format.
 * @return [mixed] return the directory in which to save the file. or false if there is any problem with the operation
 */

	function getAdminDirectory($parameter){
		$result = "admin/profile_pictures/";
		return $result;
	}
}
 ?>