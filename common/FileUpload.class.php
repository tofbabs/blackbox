<?php

/*
**	FILE UPLOADER
**	Manage upload of File
*/

class FileUpload{

	private $uri;

	function __construct($uri){
		$this->uri = $uri;
	}

	function getFileSize(){
 		return $_FILES[$this->uri]['size'];
	}

	function getFileType(){
		$type = pathinfo(basename($_FILES[$this->uri]["name"]),PATHINFO_EXTENSION);
	    return $type;
	}
	
	function getTempFileName($filename){
		return $_FILES[$this->uri]['tmp_name'];
	}

	function setFileName($newfilename){

		move_uploaded_file($_FILES[$this->uri]['tmp_name'], $newfilename);

	}

	// static function create(){
	// 	$class_name = get_class_name();
	// 	$c = new $class_name();
	// 	return $c;
	// }

}

