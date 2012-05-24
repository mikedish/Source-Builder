<? 
 $dbc=mysqli_connect("localhost", "sourcebuilder", "BjHLdTGjQsxmyRKM","sourcebuilder") or die(mysql_error()); 
 foreach ($_POST as $key => $value) {
	    $_POST[$key] = mysqli_real_escape_string($dbc,$value);
 } 
 $client=$_POST['client'];
 $base=$_POST['base']; 
 $platform=$_POST['Platform']; 
 $medium=$_POST['Medium']; 
 $date=$_POST['date']; 
 $campaign=$_POST['campaign'];
 $additional=$_POST['additional'];
 $fullsource=$_POST['Medium'] . $_POST['date'] . $_POST['campaign'] . $_POST['additional'];
 $fullurl=$_POST['generated-text'];
 $comments=$_POST['comments'];
 $timestamp = date("Y-m-d G:i:s") ;
 
 $query="INSERT INTO `sourcelog` (Client,Base,Platform,Medium,Date,Campaign,Additional,FullSource,FullURL,Comments,Timestamp) VALUES ('$client','$base','$platform','$medium','$date','$campaign','$additional','$fullsource','$fullurl','$comments','$timestamp')"; 

 mysqli_query($dbc, $query) or die("MySQL error: " . mysqli_error($dbc) . "<hr>\nQuery: $query");
  Print "Your information has been successfully added to the database."; 
 ?> 