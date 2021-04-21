<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Controller_functions extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'string'));
		$this->load->database();
	}

	public function get_methods()
	{
		// Get the name of the subdir
		
		$this->CI = get_instance();
		
		//$controller = str_replace(dirname(__DIR__),"",$_REQUEST['controllerName']);
		
		//echo $controller = dirname(__DIR__).$_REQUEST['controllerName'];//'"\modules\Library\controllers\Library.php";
		
		$controller = $_REQUEST['controllerName'];
		//$controller = dirname(__DIR__)."\modules\Library\controllers\Library.php";
		$controllername = basename($controller, EXT);
		
		//echo $controllername;
		// Load the controller file in memory if it's not load already
		if(!class_exists($controllername)) 
		{
			
			//$controller = "E:\\xampp\htdocs\siegedata-permissions\application\modules\Library\controllers\Library.php";
			$this->CI->load->file($controller);
		}			
		// Add the controllername to the array with its methods
		$aMethods = get_class_methods($controllername);				
		$aUserMethods = array();
		foreach($aMethods as $method) 
		{
			if($method != '__construct' && $method != 'get_instance' && $method != $controllername && $method['0'] != '_') 
			{
				$aUserMethods[] = $method;
			}
		}
		echo implode(',',$aUserMethods);
		//$this->setControllerMethods($dirname,$controllername, $aUserMethods);					 					

	}
}