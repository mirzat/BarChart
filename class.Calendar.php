<?php

/****************************************************************************
*																			*
* 	This is the Controller Class. This passes the post data to the model	*
*	and creates a view with the data obtained from the model.			 	*												
*																			*
****************************************************************************/

class Calendar{
	
	// Declare variables
	private $print;
	private $model;
	private $data;
	
	
	public function __construct(){	
		
		// Get Database Connection Parameters
		include_once 'config.php';							

		if(isset($_POST) && !(empty($_POST))){
			
			//Create a new instance of the Model Class with the post data
			$this->model = new Model($_POST);
			
			//Print the calendar with the notes
			$this->print = new View($this->model->data);
		}
		
		else
			//Print a clean calendar
			$this->print = new View($this->data);
	}

}

?>