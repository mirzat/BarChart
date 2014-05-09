<?php

/****************************************************************************
 *																			*
* 	This is the View Class. It gets the data array from the controller		*
*	and prints the calendar. If the array is empty is prints the calendar	*
*	form.																	*
*																			*
****************************************************************************/


class View{
	
	// Declare Variables
	private $firstDay;
	private $month;
	private $year;
	private $noDays;
	private $data;
	
	public function __construct($data){
		$this->data = $data;
		$this->firstDay = mktime(0, 0, 0, date("m"), 1, date("Y"));
		$this->month = date('F');
		$this->year = date('Y');
		$this->firstDay = date('m/d/y', $this->firstDay);
		$this->noDays = date ('t');
		$this->printCalendar($this->data);
	}

	
	// Function that prints data to screen
	private function printCalendar($data){
		
		// Print Headers
		echo '<!doctype html><html><meta charset="UTF-8"><head><link rel="stylesheet" type="text/css" href="styles.css"></head><body>';	
		echo '<h1>'.$this->month.', '.$this->year.'</h1>';
	
		//When post data is empty print a form
		if(empty($data))
			echo '<form method="POST">';
		echo '<table>';
		echo '<tr>';
		
		// Print the days
		for ($i = 0; $i < 7; $i++)
			echo '<td class="days">'.date('l', strtotime($this->firstDay . "+$i days")).'</td>';
			
		echo '</tr><tr>';
		
		for ($day = 0; $day < $this->noDays; ++$day){
			if ($day % 7 == 0)
				echo '</tr><tr>';
				
				// Print the date
				$currentDate = date('m/d/y', strtotime($this->firstDay . "+$day days"));
				
				// Print input field
				if(empty($data)){
					echo '<td>'.$currentDate."<br />";
					echo "<input type='text' name='$currentDate' value='".INPUT_DEFAULT."' onclick=\"this.value='';\"></td>";
				}
				
				// Print notes
				else{
					$temp = strtotime($currentDate);
					$dateFormat = date('Y-m-d', $temp);
					echo "<td>".$currentDate."<br />";
					echo "<span id='$dateFormat'><span>";			
				}
			}
				
			echo '</table>';
			
			// Print submit button
			if(empty($data)){
				echo '<input type="submit" value="Save and Display">';
				echo '</form>';
			}
			
			// Print script to bind notes to cells
			else{
				echo '<script>';
				foreach ($data as $key => $value)
					echo "document.getElementById('".$value['date']."').innerHTML='".$value['note']."';";
				echo '</script>';
				echo '<br /><br /><a href="index.php">Click here to add more notes</a>';
			}
			
			echo '</body></html>';
	}
}
?>