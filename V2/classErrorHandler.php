<?php
/**
 * Takes errors from any page and prints the uniform error
 */
class ClassErrorHandler 
{
	public $error;
	function __construct($error)
	{
		$this->error = $error;
	}

	
	function get_Error(){

		$errorMSG = "<h2 class='text-warning text-center'>".$this->error."</h2>";
		unset($_SESSION['Error']);
		return $errorMSG;
	}
}

?>