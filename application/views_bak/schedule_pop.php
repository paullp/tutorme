<?php

	$day = 0;
	while($day < 7){
		if($day == 0){echo "Monday &nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Monday";}
		else if($day == 1){echo "Tuesday &nbsp&nbsp&nbsp&nbsp"; $name = "Tuesday";}
		else if($day == 2){echo "Wednesday"; $name = "Wednesday";}
		else if($day == 3){echo "Thursday&nbsp&nbsp&nbsp&nbsp"; $name = "Thursday";}
		else if($day == 4){echo "Friday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Friday";}
		else if($day == 5){echo "Saturday&nbsp&nbsp&nbsp&nbsp"; $name = "Saturday";}
		else if($day == 6){echo "Sunday&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; $name = "Sunday";}
		$index = 0;
		foreach($schedule_time as $st){
			echo "<input type='radio' ondblclick='uncheck(this)' name='$name'  value='$st->id'>$st->time";  
			$index++;
		}
		echo "</br>";
		$day++;
	}
?>