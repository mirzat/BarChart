<?php

/****************************************************************************
*																			*
* 	This is the Model Class. It gets the data from the controller, connetcs	*
*	to the database and obtains the notes. 									*
*																			*
****************************************************************************/


class Model{
		
		// Declare Variables
		private $input;
		public $data;
		private $dbh;   

	    public function __construct($d) {
	    
	    	$this->input = $d;
	    	$this->dbh = $this->createConnection();				// Connect to Database
	    	$this->storeData($this->input);						// Store the data
	    	$this->data = $this->getData();						// Obtain the complete data
	    	$this->dbh = $this->closeConnection();				// Close connection to Database
	
	    }

	   
	    // Creating database connection 
	    private static function createConnection()
	    {
	    	// Create an instance of the PDO class
	    	try {
	    			$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD, 
	    					array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	    		} 
	    	
	    	// Throw any exceptions
	    	catch (PDOException $e) {
	    		print "Error!: " . $e->getMessage() . "<br/>";
	    		die();
	    	}
	    	return $dbh;	
		}
		

		// Function to store data to table
		private function storeData($data){
		
			// Create the prepare statement to insert
			$query = $this->dbh->prepare("INSERT INTO calendar (`date`, `note`) VALUES (STR_TO_DATE(:date,'%m/%d/%Y'), :note)");
		
			// Bind the variable to the above prepared statement and execute
			foreach ($data as $key => $value){
				if (!empty($value) && $value != INPUT_DEFAULT){
					$query->bindParam(':date', $key, PDO::PARAM_STR);
					$query->bindParam(':note', $value, PDO::PARAM_STR);
					$query->execute();
				}
			}
			
		}
		
		
		// Function to obtain data from table
		private function getData(){
			$query = $this->dbh->prepare('SELECT * FROM calendar');
			$query->execute();
			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			return($result);	
		}
		

	    // Closing database connection  
	    private static function closeConnection()
	    {
	    	return null;
	    }
}

?>