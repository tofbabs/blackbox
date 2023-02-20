<?php

/**
 * Site Index Controller
 */

class DncController extends ListController {

	protected $list_type;

	function __construct($_list_type='dnc') {
		parent::__construct($_list_type);
	}
   
}

?>