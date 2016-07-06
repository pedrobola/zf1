<?php

class Guestbook_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected $moduleName="Guestbook";
	
	public function __construct($application)
	{
		parent::__construct($application);
	
		$this->modulePath = APPLICATION_PATH.'/modules/'.strtolower($this->moduleName).'/';
	
	}
}

