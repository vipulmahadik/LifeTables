<?php

$diagnosis = $_GET['diagnosis'];
$arg = $_GET['arg'];
$con = mysqli_connect('localhost','root','','6339');
if ($arg=="codes" || $arg=="codes01" || $arg=="codes02") {
	# code...
	$sql  = "SELECT distinct ADMISSION_DIAGNOSIS_CODE FROM patientsnew where ADMISSION_DIAGNOSIS_CODE LIKE '".$diagnosis."%'";
	$result = mysqli_query($con,$sql);
	// echo $sql;
	if ($sql=="SELECT distinct ADMISSION_DIAGNOSIS_CODE FROM patientsnew where ADMISSION_DIAGNOSIS_CODE LIKE '%'") {
		# code...
		return;
	}
	if ($arg=="codes") {
		$data="data";$fun="getdata";
	}
	if ($arg=="codes01") {
		$data="data01";$fun="checkboth";
	}
	if ($arg=="codes02") {
		$data="data02";$fun="checkboth";
	}
	while($row = mysqli_fetch_array($result)) {
	    echo "<tr><td id=".$row["ADMISSION_DIAGNOSIS_CODE"]." onclick=\"$fun('$data',this.id)\">".$row["ADMISSION_DIAGNOSIS_CODE"]."</td></tr>";
	}
}

if ($arg == "data"){


	$sql = "SELECT `AGE`, `SEX`, `DISCHARGE_STATUS`, `LENGTH_OF_STAY` FROM `patientsnew` WHERE ADMISSION_DIAGNOSIS_CODE='".$diagnosis."' AND DISCHARGE_STATUS='0'";
	$result = mysqli_query($con,$sql);
	$i=0;
	echo "<table class=\"table table-striped table-hover \" style=\"margin-top:10px;\"><tr><th>Age</th><th>Sex</th><th>Discharge Status</th><th>Length of Stay</th></tr><tbody>";
	while($row = mysqli_fetch_array($result)) {
		$res[$i] = $row;
	    echo "<tr><td> ".$row["AGE"]."</td><td>".$row["SEX"]."</td><td>".$row["DISCHARGE_STATUS"]."</td><td>".$row["LENGTH_OF_STAY"]."</td></tr>";
	    $i++;
	}
	echo "</tbody></table>";
	$max=0;
	$male= array();
	$female = array();
	for ($i=0; $i < 9; $i++) { 
		$age[$i] = array();
	}
	foreach ($res as $key => $value) {
		# code...
		if ($value[3] > $max) {
			# code...
			$max = $value[3];
		}
		if ($value[1]=="1") {
			# code...
			array_push($male, $value[3]);
		}
		else{
			array_push($female, $value[3]);
		}
		switch ($value[0]) {
			case '1':
				array_push($age[1-1], $value[3]);
				break;
			case '2':
				array_push($age[2-1], $value[3]);
				break;
			case '3':
				array_push($age[3-1], $value[3]);
				break;
			case '4':
				array_push($age[4-1], $value[3]);
				break;
			case '5':
				array_push($age[5-1], $value[3]);
				break;
			case '6':
				array_push($age[6-1], $value[3]);
				break;
			case '7':
				array_push($age[7-1], $value[3]);
				break;
			case '8':
				array_push($age[8-1], $value[3]);
				break;
			case '9':
				array_push($age[8], $value[3]);
				break;
			
			default:
				# code...
				break;
		}
	}
	echo "<h3>Life Table on the basis of Sex.</h3>";
	function debug_to_console( $data ) {

	    if ( is_array( $data ) )
	        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	    else
	        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

	    echo $output;
	}

	function countnum($array,$number)
	{
		$c=0;
		for ($i=0; $i < count($array); $i++) { 
			if ($number==$array[$i]) {
				$c++;
			}
		}
		return $c;
	}
	$malecount=count($male);
	$femalecount=count($female);
	$alivemen = count($male);
	$alivefemale = count($female);
	$agealive = array();
	for ($i=0; $i < 9; $i++) { 
		if (count($age[$i]) != 0) {
			$agealive[$i] = count($age[$i]);
		}
		else
			$agealive[$i] = 1;
		$agecount[$i] = count($age[$i]);
	}
	if ($alivefemale==0) {
		$alivefemale = 1;
	}
	if ($alivemen == 0) {
		$alivemen = 1;
	}
	for ($i=0; $i <= $max ; $i++) { 
		# code...
		if (in_array($i, $male)) {
			# code...
			$numc= countnum($male,$i);
			$malecount=$malecount-$numc;
			debug_to_console($numc."male".$i);
		}
		$dataset[0][$i] = $malecount/$alivemen * 100;

		if (in_array($i, $female)) {
			# code...
			$numc = countnum($female,$i);
			$femalecount= $femalecount-$numc;
			debug_to_console($numc."female".$i);
		}
		$dataset[1][$i] = $femalecount/$alivefemale * 100;

		for ($j=0; $j < 9; $j++) { 
			if (in_array($i, $age[$j])) {
				$numc = countnum($age[$j],$i);
				$agecount[$j] = $agecount[$j] - $numc;
			}
			$agedataset[$j][$i] = $agecount[$j]/$agealive[$j] * 100;
		}
	}
	$url0 = urlencode(serialize($dataset[0]));
	$url1 = urlencode(serialize($dataset[1]));
	$url= "graph.php?male=".$url0."&female=".$url1;
	echo "<a href=".$url." onclick=\"jQuery('html,body').animate({scrollTop:0},200);\" id=\"result\" target=\"graph\" class=\"btn btn-raised btn-danger\">Get Graph</a>";
	?>
	<script type="text/javascript">
	loadframe();
	</script>
	<?php	
	echo "<table class=\"table table-striped table-hover \" style=\"margin-top:10px;\"><tr><th>Day</th><th>Male</th><th>Female</th></tr><tbody>";
	for ($i=0; $i <= $max; $i++) { 
		# code...
		echo "<tr><td>".($i+1)."</td><td>".$dataset[0][$i]."</td><td>".$dataset[1][$i]."</td></tr>";
	}
	echo "</tbody></table>";
	echo "<h3>Life Table on the basis of Age.</h3>";

	echo "";
	for ($i=0; $i < 9; $i++) { 
		$ageurl[$i] = urlencode(serialize($agedataset[$i]));
		echo "<input type='text' value=".$ageurl[$i]." name='$i' hidden readonly>";
	}
	echo "<input type='submit' value='Get Graph' onclick=\"jQuery('html,body').animate({scrollTop:0},200);\" id=\"result\" formtarget=\"graph\" class=\"btn btn-raised btn-danger\"></form>";



	echo "<table class=\"table table-striped table-hover \" style=\"margin-top:10px;\"><tr><th>Day</th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th></tr><tbody>";
	for ($i=0; $i <= $max; $i++) { 
		# code...
		echo "<tr><td>".($i+1)."</td><td>".$agedataset[0][$i]."</td><td>".$agedataset[1][$i]."</td><td>".$agedataset[2][$i]."</td><td>".$agedataset[3][$i]."</td><td>".$agedataset[4][$i]."</td><td>".$agedataset[5][$i]."</td><td>".$agedataset[6][$i]."</td><td>".$agedataset[7][$i]."</td><td>".$agedataset[8][$i]."</td></tr>";
	}
	echo "</tbody></table>";
}

if ($arg=="diag_2") {
	$diag=explode('a', $diagnosis);
	$sql = "SELECT `ADMISSION_DIAGNOSIS_CODE`, `DISCHARGE_STATUS`, `LENGTH_OF_STAY` FROM `patientsnew` WHERE DISCHARGE_STATUS='0' and ADMISSION_DIAGNOSIS_CODE='".$diag[0]."' OR ADMISSION_DIAGNOSIS_CODE='".$diag[1]."'";
	$result = mysqli_query($con,$sql);
	$i=0;
	echo "<table class=\"table table-striped table-hover \" style=\"margin-top:10px;\"><tr><th>Admission Diagnosis Code</th><th>Discharge Status</th><th>Length of Stay</th></tr><tbody>";
	while($row = mysqli_fetch_array($result)) {
		$res[$i] = $row;
	    echo "<tr><td> ".$row["ADMISSION_DIAGNOSIS_CODE"]."</td><td>".$row["DISCHARGE_STATUS"]."</td><td>".$row["LENGTH_OF_STAY"]."</td></tr>";
	    $i++;
	}
	echo "</tbody></table>";
	$max=0;
	$male= array();
	$female = array();
	foreach ($res as $key => $value) {
		if ($value[2] > $max) {
			$max = $value[2];
		}
		if ($value[0]==$diag[0]) {
			array_push($male, $value[2]);
		}
		else{
			array_push($female, $value[2]);
		}
	}echo "<h3>Life Table on the basis of Diagnosis Code.</h3>";
	function countnum($array,$number)
	{
		# code...
		$c=0;
		for ($i=0; $i < count($array); $i++) { 
			# code...
			if ($number==$array[$i]) {
				# code...
				$c++;
			}
		}
		return $c;
	}
	$malecount=count($male);
	$femalecount=count($female);
	$alivemen = count($male);
	$alivefemale = count($female);
	if ($alivefemale==0) {
		$alivefemale = 1;
	}
	if ($alivemen == 0) {
		$alivemen = 1;
	}
	for ($i=0; $i <= $max ; $i++) { 
		# code...
		if (in_array($i, $male)) {
			# code...
			$numc= countnum($male,$i);
			$malecount=$malecount-$numc;
		}
		$dataset[0][$i] = $malecount/$alivemen * 100;

		if (in_array($i, $female)) {
			# code...
			$numc = countnum($female,$i);
			$femalecount= $femalecount-$numc;
		}
		$dataset[1][$i] = $femalecount/$alivefemale * 100;
	}
	$url0 = urlencode(serialize($dataset[0]));
	$url1 = urlencode(serialize($dataset[1]));
	$url= "graph.php?male=".$url0."&female=".$url1."&diag=1";
	echo "<a href=".$url." onclick=\"jQuery('html,body').animate({scrollTop:0},200);\" id=\"result\" target=\"graph1\" class=\"btn btn-raised btn-danger\">Get Graph</a>";
	?>
	<?php	
	echo "<table class=\"table table-striped table-hover \" style=\"margin-top:10px;\"><tr><th>Day</th><th>'$diag[0]'</th><th>'$diag[1]'</th></tr><tbody>";
	for ($i=0; $i <= $max; $i++) { 
		# code...
		echo "<tr><td>".($i+1)."</td><td>".$dataset[0][$i]."</td><td>".$dataset[1][$i]."</td></tr>";
	}
	echo "</tbody></table>";
}
?>